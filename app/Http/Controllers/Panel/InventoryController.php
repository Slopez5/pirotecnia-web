<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InventoryController extends Controller
{
    //
    public function index()
    {
        $inventory = Inventory::find(1);

        if ($inventory) {
            $products = $inventory->products()->orderBy('name')->get();
        } else {
            $inventory = new Inventory;
            $inventory->name = 'Polvorin 1';
            $inventory->location = 'Rancho el Tequeque';
            $inventory->save();

            $products = collect();
        }

        $reservedByProduct = DB::table('productables')
            ->select('product_id', DB::raw('SUM(quantity) as reserved_quantity'))
            ->where('productable_type', Event::class)
            ->where('check_almacen', false)
            ->groupBy('product_id')
            ->pluck('reserved_quantity', 'product_id');

        $productRows = $products
            ->map(function ($product) use ($reservedByProduct) {
                $quantity = (float) ($product->pivot->quantity ?? 0);
                $price = (float) ($product->pivot->price ?? 0);
                $reserved = (float) ($reservedByProduct[$product->id] ?? 0);
                $available = max($quantity - $reserved, 0);
                $minimum = Inventory::MIN_STOCK;

                if ($available <= 0) {
                    $status = [
                        'key' => 'out',
                        'label' => 'Agotado',
                        'tone' => 'error',
                        'icon' => 'block',
                    ];
                } elseif ($available <= $minimum) {
                    $status = [
                        'key' => 'critical',
                        'label' => 'Critico',
                        'tone' => 'error',
                        'icon' => 'priority_high',
                    ];
                } elseif ($available <= ($minimum * 3)) {
                    $status = [
                        'key' => 'warning',
                        'label' => 'Seguimiento',
                        'tone' => 'warning',
                        'icon' => 'warning',
                    ];
                } else {
                    $status = [
                        'key' => 'healthy',
                        'label' => 'Estable',
                        'tone' => 'accent',
                        'icon' => 'check_circle',
                    ];
                }

                $category = match ((int) $product->product_role_id) {
                    2 => ['label' => 'Material', 'tone' => 'accent'],
                    3 => ['label' => 'Producto paquete', 'tone' => 'warning'],
                    default => ['label' => 'Producto', 'tone' => 'secondary'],
                };

                $detail = collect([
                    $product->description,
                    $product->caliber ? 'Calibre ' . $product->caliber : null,
                    $product->shots ? $product->shots . ' disparos' : null,
                    $product->duration ? $product->duration . ' s' : null,
                ])->filter()->implode(' · ');

                return [
                    'id' => $product->id,
                    'sku' => 'INV-' . str_pad((string) $product->id, 4, '0', STR_PAD_LEFT),
                    'name' => $product->name,
                    'detail' => $detail !== '' ? Str::limit($detail, 90) : 'Sin detalle operativo adicional.',
                    'category_label' => $category['label'],
                    'category_tone' => $category['tone'],
                    'quantity' => $quantity,
                    'reserved' => $reserved,
                    'available' => $available,
                    'unit' => $product->unit ?: 'Pza',
                    'price' => $price,
                    'inventory_value' => $quantity * $price,
                    'status_key' => $status['key'],
                    'status_label' => $status['label'],
                    'status_tone' => $status['tone'],
                    'status_icon' => $status['icon'],
                ];
            })
            ->values();

        $inventoryStats = [
            'inventoryValue' => $productRows->sum('inventory_value'),
            'criticalCount' => $productRows->whereIn('status_key', ['critical', 'out'])->count(),
            'reservedUnits' => $productRows->sum('reserved'),
            'availableUnits' => $productRows->sum('available'),
            'productCount' => $productRows->count(),
            'lowStockCount' => $productRows->where('status_key', 'warning')->count(),
        ];

        $categorySummary = $productRows
            ->groupBy('category_label')
            ->map(function ($items, $label) {
                $first = $items->first();

                return [
                    'label' => $label,
                    'tone' => $first['category_tone'],
                    'count' => $items->count(),
                    'units' => $items->sum('quantity'),
                ];
            })
            ->values()
            ->sortByDesc('count')
            ->values();

        $lowStockProducts = $productRows
            ->filter(fn($product) => $product['status_key'] !== 'healthy')
            ->sortBy([
                ['available', 'asc'],
                ['quantity', 'asc'],
            ])
            ->take(4)
            ->values();

        $upcomingConsumptions = Event::query()
            ->with(['products:id,name', 'typeEvent:id,name'])
            ->where('event_date', '>=', now('America/Mexico_City')->format('Y-m-d H:i:s'))
            ->orderBy('event_date')
            ->limit(4)
            ->get()
            ->map(function ($event) {
                $eventDate = Carbon::parse($event->event_date, 'America/Mexico_City');
                $products = $event->products->sortByDesc(fn($product) => (float) ($product->pivot->quantity ?? 0));
                $requestedUnits = $products->sum(fn($product) => (float) ($product->pivot->quantity ?? 0));
                $requestSummary = $products
                    ->take(2)
                    ->map(function ($product) {
                        return $product->name . ' x' . number_format((float) ($product->pivot->quantity ?? 0), 0);
                    })
                    ->implode(' · ');

                return [
                    'title' => $event->client_name ?: 'Evento programado',
                    'type' => $event->typeEvent->name ?? 'Evento',
                    'date_label' => $eventDate->locale('es')->isoFormat('D MMM'),
                    'relative_label' => $eventDate->isToday()
                        ? 'Hoy'
                        : ($eventDate->isTomorrow() ? 'Manana' : ucfirst($eventDate->diffForHumans(now('America/Mexico_City'), true)) . ' restantes'),
                    'requested_units' => $requestedUnits,
                    'summary' => $requestSummary !== '' ? $requestSummary : 'Sin productos apartados',
                ];
            });
        $itemActive = 5;

        return view('panel.inventory.index', compact(
            'inventory',
            'products',
            'productRows',
            'inventoryStats',
            'categorySummary',
            'lowStockProducts',
            'upcomingConsumptions',
            'itemActive',
        ));
    }

    public function create()
    {
        return view('panel.inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
        ]);

        $inventory = new Inventory;
        $inventory->name = $request->name;
        $inventory->description = $request->description;
        $inventory->price = $request->price;
        $inventory->stock = $request->stock;
        $inventory->image = $request->image;
        $inventory->save();

        return redirect()->route('inventory.index');
    }

    public function edit($id)
    {
        $inventory = Inventory::find($id);

        return view('panel.inventory.edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
        ]);

        $inventory = Inventory::find($id);
        $inventory->name = $request->name;
        $inventory->description = $request->description;
        $inventory->price = $request->price;
        $inventory->stock = $request->stock;
        $inventory->image = $request->image;
        $inventory->save();

        return redirect()->route('inventory.index');
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();

        return redirect()->route('inventory.index');
    }

    public function show($id)
    {
        $inventory = Inventory::find($id);

        return view('panel.inventory.show', compact('inventory'));
    }
}
