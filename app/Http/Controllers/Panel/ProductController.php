<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Event;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::with(['inventories'])
            ->withCount('packages')
            ->where('product_role_id', '!=', 3)
            ->orderBy('name', 'ASC')
            ->get();

        $reservedByProduct = DB::table('productables')
            ->select('product_id', DB::raw('SUM(quantity) as reserved_quantity'))
            ->where('productable_type', Event::class)
            ->where('check_almacen', false)
            ->groupBy('product_id')
            ->pluck('reserved_quantity', 'product_id');

        $productRows = $products
            ->map(function ($product) use ($reservedByProduct) {
                $inventoryPivot = $product->inventories->first()?->pivot;
                $quantity = (float) ($inventoryPivot?->quantity ?? 0);
                $price = (float) ($inventoryPivot?->price ?? 0);
                $reserved = (float) ($reservedByProduct[$product->id] ?? 0);
                $available = max($quantity - $reserved, 0);
                $minimum = Inventory::MIN_STOCK;

                if (! $inventoryPivot) {
                    $status = [
                        'key' => 'untracked',
                        'label' => 'Sin inventario',
                        'tone' => 'warning',
                        'icon' => 'inventory',
                    ];
                } elseif ($available <= 0) {
                    $status = [
                        'key' => 'out',
                        'label' => 'Sin stock',
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
                        'label' => 'Disponible',
                        'tone' => 'accent',
                        'icon' => 'check_circle',
                    ];
                }

                $category = match ((int) $product->product_role_id) {
                    2 => ['key' => 'material', 'label' => 'Material', 'tone' => 'accent'],
                    default => ['key' => 'product', 'label' => 'Producto', 'tone' => 'secondary'],
                };

                $detail = collect([
                    $product->description,
                    $product->caliber ? 'Calibre ' . $product->caliber : null,
                    $product->shots ? $product->shots . ' disparos' : null,
                    $product->duration ? $product->duration . ' s' : null,
                    $product->shape ?: null,
                ])->filter()->implode(' · ');

                return [
                    'id' => $product->id,
                    'sku' => 'PROD-' . str_pad((string) $product->id, 4, '0', STR_PAD_LEFT),
                    'name' => $product->name,
                    'detail' => $detail !== '' ? Str::limit($detail, 110) : 'Sin detalle operativo adicional.',
                    'category_key' => $category['key'],
                    'category_label' => $category['label'],
                    'category_tone' => $category['tone'],
                    'quantity' => $quantity,
                    'reserved' => $reserved,
                    'available' => $available,
                    'unit' => $product->unit ?: 'Pza',
                    'price' => $price,
                    'inventory_value' => $quantity * $price,
                    'package_count' => (int) $product->packages_count,
                    'status_key' => $status['key'],
                    'status_label' => $status['label'],
                    'status_tone' => $status['tone'],
                    'status_icon' => $status['icon'],
                ];
            })
            ->values();

        $productStats = [
            'productCount' => $productRows->count(),
            'trackedCount' => $productRows->filter(fn ($product) => $product['status_key'] !== 'untracked')->count(),
            'materialCount' => $productRows->where('category_key', 'material')->count(),
            'linkedPackageCount' => $productRows->filter(fn ($product) => $product['package_count'] > 0)->count(),
            'inventoryValue' => $productRows->sum('inventory_value'),
            'availableUnits' => $productRows->sum('available'),
            'reservedUnits' => $productRows->sum('reserved'),
            'lowStockCount' => $productRows->whereIn('status_key', ['out', 'critical', 'warning'])->count(),
        ];

        $roleSummary = $productRows
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

        $spotlightProduct = $productRows
            ->sortByDesc(fn ($product) => ($product['package_count'] * 1000000) + $product['inventory_value'])
            ->first();

        $lowStockProducts = $productRows
            ->filter(fn ($product) => in_array($product['status_key'], ['untracked', 'out', 'critical', 'warning'], true))
            ->sortBy([
                ['available', 'asc'],
                ['quantity', 'asc'],
            ])
            ->take(4)
            ->values();

        $parentItemActive = 8;
        $itemActive = 1;

        return view('panel.settings.products.index', compact(
            'products',
            'productRows',
            'productStats',
            'roleSummary',
            'spotlightProduct',
            'lowStockProducts',
            'itemActive',
            'parentItemActive'
        ));
    }

    public function create()
    {
        return view('panel.settings.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $product = new Product;
        $product->product_role_id = 1;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->duration = $request->duration;
        $product->shots = $request->shots;
        $product->caliber = $request->caliber;
        $product->save();
        $isMultiple = $request->multiple;
        if ($isMultiple == 'on') {
            return redirect()->route('products.show', ['id' => $product->id]);
        } else {
            return redirect()->route('settings.products.index');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('panel.settings.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->duration = $request->duration;
        $product->shots = $request->shots;
        $product->caliber = $request->caliber;
        $product->save();

        return redirect()->route('products.show', ['id' => $product->id]);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('panel.settings.products.show', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('settings.products.index');
    }

    public function import()
    {
        return view('panel.settings.products.import');
    }

    public function importSubmit(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $path = $file->storeAs('public/uploads', 'updatedProducts.xlsx');
        $fullPath = storage_path('app/'.$path);
        Excel::import(new ProductsImport, $fullPath);

        return redirect()->route('settings.products.index');
    }

    public function catalogo()
    {
        return view('panel.products.catalog');
    }
}
