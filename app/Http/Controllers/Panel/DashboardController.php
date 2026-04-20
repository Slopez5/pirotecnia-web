<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now('America/Mexico_City');
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        $startOfPreviousMonth = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $endOfPreviousMonth = $now->copy()->subMonthNoOverflow()->endOfMonth();
        $endOfWeek = $now->copy()->endOfWeek();
        $endOfNext30Days = $now->copy()->addDays(30)->endOfDay();

        $events = Event::with(['packages', 'typeEvent', 'employees'])
            ->orderBy('event_date')
            ->get();

        $inventory = Inventory::with('products')->first();

        $futureEvents = $events
            ->filter(fn (Event $event) => $this->eventDate($event)->gte($now))
            ->values();

        $eventsThisMonth = $events
            ->filter(fn (Event $event) => $this->eventDate($event)->between($startOfMonth, $endOfMonth, true))
            ->values();

        $eventsPreviousMonth = $events
            ->filter(fn (Event $event) => $this->eventDate($event)->between($startOfPreviousMonth, $endOfPreviousMonth, true))
            ->values();

        $eventsThisWeek = $futureEvents
            ->filter(fn (Event $event) => $this->eventDate($event)->between($now, $endOfWeek, true))
            ->count();

        $eventsNext30Days = $futureEvents
            ->filter(fn (Event $event) => $this->eventDate($event)->between($now, $endOfNext30Days, true))
            ->count();

        $monthlyRevenue = $eventsThisMonth->sum(fn (Event $event) => $this->calculateEventTotal($event));
        $previousMonthlyRevenue = $eventsPreviousMonth->sum(fn (Event $event) => $this->calculateEventTotal($event));

        $packagesThisMonth = $eventsThisMonth->sum(fn (Event $event) => $this->countPackagesForEvent($event));
        $packagesPreviousMonth = $eventsPreviousMonth->sum(fn (Event $event) => $this->countPackagesForEvent($event));

        $lowStockItems = $this->buildLowStockItems($inventory);
        $lowStockCount = count($lowStockItems);
        $criticalLowStockCount = collect($lowStockItems)->where('color', 'error')->count();

        $monthlyRevenueSeries = $this->buildMonthlyRevenueSeries($events, $now);
        $eventTypeSegments = $this->buildEventTypeSegments($events, $now);
        $upcomingEvents = $this->buildUpcomingEvents($futureEvents, $now);

        $itemActive = 1;

        return view('panel.dashboard', [
            'itemActive' => $itemActive,
            'monthlyRevenue' => $this->formatMoney($monthlyRevenue),
            'monthlyRevenueIndicator' => $this->formatTrendLabel($monthlyRevenue, $previousMonthlyRevenue, 'Nueva actividad'),
            'monthlyRevenueIndicatorColor' => $monthlyRevenue >= $previousMonthlyRevenue ? 'text-secondary' : 'text-warning',
            'eventsNext30Days' => (string) $eventsNext30Days,
            'eventsNext30Indicator' => $eventsThisWeek > 0 ? "Semana: $eventsThisWeek" : 'Sin eventos esta semana',
            'lowStockCount' => (string) $lowStockCount,
            'lowStockIndicator' => $lowStockCount > 0 ? 'Accion requerida' : 'Sin alertas',
            'lowStockIndicatorColor' => $lowStockCount > 0 ? 'text-error' : 'text-secondary',
            'packagesThisMonth' => (string) $packagesThisMonth,
            'packagesThisMonthIndicator' => $this->formatTrendLabel($packagesThisMonth, $packagesPreviousMonth, 'Nueva actividad'),
            'packagesThisMonthIndicatorColor' => $packagesThisMonth >= $packagesPreviousMonth ? 'text-secondary' : 'text-warning',
            'monthlyRevenueSeries' => $monthlyRevenueSeries,
            'eventTypeSegments' => $eventTypeSegments,
            'upcomingEvents' => $upcomingEvents,
            'lowStockItems' => $lowStockItems,
            'criticalLowStockCount' => $criticalLowStockCount,
        ]);
    }

    private function eventDate(Event $event): Carbon
    {
        return Carbon::parse($event->event_date, 'America/Mexico_City');
    }

    private function calculateEventSubtotal(Event $event): float
    {
        if ((float) $event->price > 0) {
            return (float) $event->price;
        }

        return $event->packages->sum(function ($package) {
            $quantity = (int) ($package->pivot->quantity ?? 1);
            $unitPrice = (float) (($package->pivot->price ?? 0) > 0 ? $package->pivot->price : $package->price);

            return $unitPrice * max($quantity, 1);
        });
    }

    private function calculateEventTotal(Event $event): float
    {
        $subtotal = $this->calculateEventSubtotal($event);
        $discount = (float) $event->discount;
        $discountAmount = $discount > 1 ? $discount : $subtotal * $discount;

        return max($subtotal - $discountAmount + (float) $event->travel_expenses, 0);
    }

    private function countPackagesForEvent(Event $event): int
    {
        return (int) $event->packages->sum(function ($package) {
            return max((int) ($package->pivot->quantity ?? 1), 1);
        });
    }

    private function formatMoney(float $amount): string
    {
        return '$'.number_format($amount, 2);
    }

    private function formatTrendLabel(float|int $current, float|int $previous, string $fallback): string
    {
        if ($previous <= 0) {
            return $current > 0 ? $fallback : 'Sin movimiento';
        }

        $difference = (($current - $previous) / $previous) * 100;

        if (abs($difference) < 0.05) {
            return 'Sin cambios';
        }

        return ($difference > 0 ? '+' : '').number_format($difference, 1).'%';
    }

    private function buildMonthlyRevenueSeries(Collection $events, Carbon $referenceDate): array
    {
        $year = $referenceDate->year;

        return collect(range(1, 12))
            ->map(function (int $month) use ($events, $year, $referenceDate) {
                $monthEvents = $events->filter(function (Event $event) use ($month, $year) {
                    $eventDate = $this->eventDate($event);

                    return $eventDate->year === $year && $eventDate->month === $month;
                });

                $value = $monthEvents->sum(fn (Event $event) => $this->calculateEventTotal($event));
                $labelDate = Carbon::create($year, $month, 1, 0, 0, 0, 'America/Mexico_City')->locale('es');

                return [
                    'label' => Str::upper($labelDate->isoFormat('MMM')),
                    'value' => $value,
                    'formatted' => $this->formatMoney($value),
                    'isCurrent' => $referenceDate->month === $month,
                ];
            })
            ->all();
    }

    private function buildEventTypeSegments(Collection $events, Carbon $referenceDate): array
    {
        $yearEvents = $events->filter(function (Event $event) use ($referenceDate) {
            return $this->eventDate($event)->year === $referenceDate->year;
        });

        if ($yearEvents->isEmpty()) {
            $yearEvents = $events->filter(fn (Event $event) => $this->eventDate($event)->gte($referenceDate));
        }

        $grouped = $yearEvents
            ->groupBy(fn (Event $event) => optional($event->typeEvent)->name ?: 'Sin tipo')
            ->map->count()
            ->sortDesc();

        if ($grouped->count() > 4) {
            $topSegments = $grouped->take(3);
            $topSegments->put('Otros', $grouped->slice(3)->sum());
            $grouped = $topSegments;
        }

        $colors = ['primary', 'accent', 'secondary', 'warning'];

        return $grouped
            ->values()
            ->map(function ($value, $index) use ($grouped, $colors) {
                return [
                    'label' => $grouped->keys()->values()->get($index),
                    'value' => $value,
                    'color' => $colors[$index % count($colors)],
                ];
            })
            ->all();
    }

    private function buildUpcomingEvents(Collection $futureEvents, Carbon $referenceDate): array
    {
        return $futureEvents
            ->take(5)
            ->map(function (Event $event) use ($referenceDate) {
                $eventDate = $this->eventDate($event)->locale('es');

                if ($eventDate->isToday()) {
                    $status = ['label' => 'Hoy', 'color' => 'warning'];
                } elseif ($eventDate->between($referenceDate, $referenceDate->copy()->endOfWeek(), true)) {
                    $status = ['label' => 'Esta semana', 'color' => 'secondary'];
                } else {
                    $status = ['label' => 'Programado', 'color' => 'accent'];
                }

                return [
                    'month' => Str::upper($eventDate->isoFormat('MMM')),
                    'day' => $eventDate->isoFormat('D'),
                    'year' => $eventDate->isoFormat('YYYY'),
                    'client' => $event->client_name ?: 'Cliente sin nombre',
                    'type' => optional($event->typeEvent)->name ?: 'Sin tipo',
                    'status' => $status['label'],
                    'statusColor' => $status['color'],
                    'price' => $this->formatMoney($this->calculateEventTotal($event)),
                ];
            })
            ->all();
    }

    private function buildLowStockItems(?Inventory $inventory): array
    {
        if (! $inventory) {
            return [];
        }

        return $inventory->products
            ->filter(function ($product) {
                return isset($product->pivot->quantity) && (float) $product->pivot->quantity <= Inventory::MIN_STOCK;
            })
            ->sortBy(fn ($product) => (float) $product->pivot->quantity)
            ->take(4)
            ->map(function ($product) {
                $quantity = (float) $product->pivot->quantity;
                $isCritical = $quantity <= max(1, Inventory::MIN_STOCK / 2);

                return [
                    'icon' => $this->resolveInventoryIcon($product->unit),
                    'title' => $product->name,
                    'subtitle' => $product->unit ?: 'Existencias',
                    'value' => $this->formatQuantity($quantity),
                    'subValue' => 'Min: '.Inventory::MIN_STOCK,
                    'color' => $isCritical ? 'error' : 'warning',
                ];
            })
            ->values()
            ->all();
    }

    private function resolveInventoryIcon(?string $unit): string
    {
        $normalizedUnit = Str::lower((string) $unit);

        return match (true) {
            str_contains($normalizedUnit, 'lt'),
            str_contains($normalizedUnit, 'litro') => 'opacity',
            str_contains($normalizedUnit, 'kg'),
            str_contains($normalizedUnit, 'gram') => 'science',
            str_contains($normalizedUnit, 'paq'),
            str_contains($normalizedUnit, 'pack') => 'inventory_2',
            default => 'inventory_2',
        };
    }

    private function formatQuantity(float $quantity): string
    {
        if (fmod($quantity, 1.0) === 0.0) {
            return (string) (int) $quantity;
        }

        return rtrim(rtrim(number_format($quantity, 2, '.', ''), '0'), '.');
    }
}
