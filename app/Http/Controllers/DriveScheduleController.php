<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\DriveSchedule;
use Illuminate\Http\Request;

class DriveScheduleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');  // Get search term from the request
        $schedules = DriveSchedule::with('driver', 'booking')
            ->whereHas('driver', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('booking', function ($query) use ($search) {
                $query->where('destination', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        $drivers = Driver::All();
        return view('drive-schedules.index', compact('schedules','drivers', 'search'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'driver_id' => 'nullable|exists:drivers,id',
            'honor' => 'nullable|numeric',
            'status' => 'required|in:on going,in progress,done,cancel',
        ]);

        $schedule = DriveSchedule::findOrFail($id);
        $booking = $schedule->booking;

        if ($request->status === 'done') {
            $now = now();
            $schedule->kedatangan = $now;

            if ($booking && $now->greaterThan($booking->end_date)) {
                $hoursLate = $now->diffInHours($booking->end_date);
                $schedule->denda = $hoursLate * 10000;
            }
        }
        
        $schedule->update([
            'driver_id' => $request->driver_id,
            'honor' => $request->honor,
            'kedatangan' => $schedule->kedatangan,
            'denda' => $schedule->denda,
            'status' => $request->status,
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return redirect()->route('drive-schedules.index')->with('success', 'Schedule updated successfully');
    }

    public function destroy(Request $request, $id = null)
    {
        if ($request->isMethod('DELETE') && $id === null) {
            // Bulk Delete
            $request->validate([
                'ids' => 'required|array|min:1',
                'ids.*' => 'integer|exists:schedules,id',
            ]);
    
            // Menghapus pelanggan berdasarkan ID yang dipilih
            DriveSchedule::whereIn('id', $request->ids)->delete();
    
            return redirect()->route('drive-schedules.index')->with('success', 'Schedule deleted successfully.');
        }
    
        if ($id !== null) {
            // Single Delete
            $customer = DriveSchedule::findOrFail($id);
            $customer->delete();
    
            return redirect()->route('drive-schedules.index')->with('success', 'Schedule deleted successfully.');
        }
    }
}
