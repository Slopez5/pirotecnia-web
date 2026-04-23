<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ClientType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientTypeController extends Controller
{
    public function index()
    {
        $clientTypes = ClientType::query()
            ->withCount('sales')
            ->orderBy('name')
            ->get();

        $clientTypeRows = $clientTypes
            ->map(function (ClientType $clientType) {
                $salesCount = (int) $clientType->sales_count;
                $status = $salesCount > 0
                    ? ['label' => 'Activo', 'tone' => 'secondary']
                    : ['label' => 'Inactivo', 'tone' => 'warning'];

                return [
                    'id' => $clientType->id,
                    'name' => $clientType->name,
                    'description' => $clientType->description,
                    'sales_count' => $salesCount,
                    'status_label' => $status['label'],
                    'status_tone' => $status['tone'],
                    'created_at_label' => optional($clientType->created_at)?->locale('es')->isoFormat('D MMM YYYY') ?? '--',
                ];
            })
            ->values();

        $clientTypeStats = [
            'total' => $clientTypeRows->count(),
            'active' => $clientTypeRows->where('status_label', 'Activo')->count(),
            'inactive' => $clientTypeRows->where('status_label', 'Inactivo')->count(),
        ];

        $parentItemActive = 8;
        $itemActive = 3;

        return view('panel.settings.client_types.index', compact(
            'clientTypes',
            'clientTypeRows',
            'clientTypeStats',
            'itemActive',
            'parentItemActive'
        ));
    }

    public function create()
    {
        return view('panel.settings.client_types.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $clientType = ClientType::create($validated);

        return redirect()
            ->route('client-types.show', $clientType->id)
            ->with('status', 'Tipo de cliente creado correctamente.');
    }

    public function show($id)
    {
        $clientType = ClientType::withCount('sales')->findOrFail($id);

        return view('panel.settings.client_types.show', compact('clientType'));
    }

    public function edit($id)
    {
        $clientType = ClientType::findOrFail($id);

        return view('panel.settings.client_types.edit', compact('clientType'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $clientType = ClientType::findOrFail($id);
        $clientType->update($validated);

        return redirect()
            ->route('client-types.show', $clientType->id)
            ->with('status', 'Tipo de cliente actualizado correctamente.');
    }

    public function destroy($id): RedirectResponse
    {
        $clientType = ClientType::withCount('sales')->findOrFail($id);

        if ((int) $clientType->sales_count > 0) {
            return redirect()
                ->route('settings.client-types.index')
                ->with('error', 'No se puede eliminar un tipo de cliente que ya tiene ventas asociadas.');
        }

        $clientType->delete();

        return redirect()
            ->route('settings.client-types.index')
            ->with('status', 'Tipo de cliente eliminado correctamente.');
    }
}
