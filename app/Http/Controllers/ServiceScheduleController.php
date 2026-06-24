<?php

namespace App\Http\Controllers;

use App\Models\ServiceSchedule;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ServiceScheduleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');

        $schedules = ServiceSchedule::with('vehicle')
            ->whereHas('vehicle', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('service_date', 'like', '%' . $search . '%')
            ->orWhere('status', 'like', '%' . $search . '%')
            ->paginate(10);

        $vehicles = Vehicle::all();
        return view('service-schedules.index', compact('schedules', 'vehicles', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'service_date' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        ServiceSchedule::create($request->all());

        return redirect()->route('service-schedules.index')->with('success', 'Service schedule created successfully.');
    }

    public function edit($id)
    {
        $serviceSchedule = ServiceSchedule::findOrFail($id);
        $vehicles = Vehicle::all();
        return view('service-schedules.edit', compact('serviceSchedule', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'service_date' => 'required|date',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:on going,in progress,done,cancel',
        ]);

        $serviceSchedule = ServiceSchedule::findOrFail($id);

        if ($request->status === 'done' && !$serviceSchedule->finished) {
            $request->merge(['finished' => now()->format('Y-m-d')]);
        }

        if ($request->status !== 'done') {
            $request->merge(['finished' => null]);
        }

        $serviceSchedule->update($request->all());

        return redirect()->route('service-schedules.index')
            ->with('success', 'Service schedule updated successfully.');
    }

    public function destroy(Request $request, $id = null)
    {
        if ($request->isMethod('DELETE') && $id === null) {
            $request->validate([
                'ids' => 'required|array|min:1',
                'ids.*' => 'integer|exists:service-schedules,id',
            ]);

            ServiceSchedule::whereIn('id', $request->ids)->delete();

            return redirect()->route('service-schedules.index')->with('success', 'Selected service schedules deleted successfully.');
        }

        if ($id !== null) {
            $serviceSchedule = ServiceSchedule::findOrFail($id);
            $serviceSchedule->delete();

            return redirect()->route('service-schedules.index')->with('success', 'Service schedule deleted successfully.');
        }
    }
}