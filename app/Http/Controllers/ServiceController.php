<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $services = Service::with(['vehicle', 'details'])
            ->when($search, function ($query, $search) {
                return $query->where('quantity', 'like', "%$search%")
                    ->orWhereHas('vehicle', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                              ->orWhere('license_plate', 'like', "%$search%");
                    });
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereHas('details', function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('tanggal_service', [$startDate, $endDate]);
                });
            })
            ->paginate(10);

        return view('services.index', compact('services', 'search', 'startDate', 'endDate'));
    }

    public function create()
    {
        // Retrieve all vehicles and bookings for the form's dropdowns
        $vehicles = Vehicle::all();
        $bookings = Booking::all();

        return view('services.create', compact('vehicles', 'bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'quantity' => 'nullable|numeric|min:1',
            'tanggal_service' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            $q = $request->quantity ? $request->quantity : 1;
            $total = $request->jumlah * $q;
            $service = Service::create([
                'vehicle_id' => $request->vehicle_id,
                'total' => $total,
            ]);
            
            $serviceDetail = ServiceDetail::create([
                'service_id' => $service->id,
                'tanggal_service' => $request->tanggal_service,
                'keterangan' => $request->keterangan,
                'jumlah' => $request->jumlah,
                'quantity' => $q,
                'debet' => 0,
                'kredit' =>  $total,
            ]);

            DB::commit();

            return redirect()->route('services.index')->with('success', 'Service and details saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('services.create')
                             ->with('error', 'Failed to save the service and details. Error: ' . $e->getMessage())
                             ->withInput();
        }
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $vehicles = Vehicle::all();
        return view('services.edit', compact('service', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'quantity' => 'nullable|numeric|min:1',
            'tanggal_service' => 'nullable|date',
            'jumlah' => 'required|numeric|min:1',
        ]);

        // Hitung total
        $quantity = $request->input('quantity', 1);
        $jumlah = $request->input('jumlah');
        $total = $jumlah * $quantity;

        $service = Service::findOrFail($id);
        $service->update([
            'vehicle_id' => $request->vehicle_id,
            'total' => $total,
        ]);

        $serviceDetail = ServiceDetail::where('service_id', $service->id)->firstOrFail();
        $serviceDetailData = [
            'jumlah' => $jumlah,
            'quantity' => $quantity,
        ];

        if (is_null($serviceDetail->booking_id)) {
            $serviceDetailData = array_merge($serviceDetailData, [
                'tanggal_service' => $request->tanggal_service,
                'keterangan' => $request->keterangan,
                'kredit' => $total,
            ]);
        } else {
            $booking = Booking::findOrFail($serviceDetail->booking_id);
            $booking->update(['deposit' => $jumlah]);
            $serviceDetailData['debet'] = $jumlah;
        }

        $serviceDetail->update($serviceDetailData);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Request $request, $id = null)
    {
        if ($request->isMethod('DELETE') && $id === null) {
            // Bulk Delete
            $request->validate([
                'ids' => 'required|array|min:1',
                'ids.*' => 'integer|exists:services,id',
            ]);
    
            Service::whereIn('id', $request->ids)->delete();
    
            return redirect()->route('services.index')->with('success', 'Service data deleted successfully.');
        }
    
        if ($id !== null) {
            // Single Delete
            $vehicle = Service::findOrFail($id);
            $vehicle->delete();
    
            return redirect()->route('services.index')->with('success', 'Service data deleted successfully.');
        }
    }
    public function generateReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $request->validate([
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $reports = ServiceDetail::whereBetween('tanggal_service', [$startDate, $endDate])->get();

        $quantityDebet = $reports->sum('debet');
        $quantityKredit = $reports->sum('kredit');
        $quantityPendapatan = $quantityDebet - $quantityKredit;

        $pdf = Pdf::loadView('services.report', compact('reports', 'startDate', 'endDate', 'quantityDebet', 'quantityKredit', 'quantityPendapatan'));

        return $pdf->download('report_' . $startDate . '_to_' . $endDate . '.pdf');
    }
}
