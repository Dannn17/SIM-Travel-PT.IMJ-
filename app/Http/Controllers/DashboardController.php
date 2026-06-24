<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ServiceSchedule;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = ServiceDetail::sum(DB::raw('debet - kredit'));

        $totalBookings = Booking::count();

        $totalVehicles = Vehicle::count();

        $totalCancelledBookings = Booking::where('status', 'cancel')->count();

        $monthlyData = DB::table('service_details')
            ->selectRaw('MONTH(tanggal_service) as month, YEAR(tanggal_service) as year, 
                        SUM(kredit) as total_kredit, SUM(debet) as total_debet')
            ->groupBy(DB::raw('MONTH(tanggal_service), YEAR(tanggal_service)'))
            ->orderBy(DB::raw('YEAR(tanggal_service), MONTH(tanggal_service)'))
            ->get();

        $totalKredit = DB::table('service_details')->sum('kredit');
        $totalDebet = DB::table('service_details')->sum('debet');
        $total = $totalDebet - $totalKredit;
        $services = Service::with('details.booking', 'vehicle')->paginate(10);

        // --- LOGIKA UNTUK DASHBOARD: KALENDER & STATISTIK SERVIS ---

        // 1. Ambil jumlah kendaraan dalam servis (untuk card statistik)
        $vehiclesInService = ServiceSchedule::whereNotIn('status', ['done', 'cancel'])->count();

        // 2. Ambil data Service Schedules yang akan datang atau aktif
        $activeServiceSchedules = ServiceSchedule::with('vehicle')
            ->whereNotIn('status', ['done', 'cancel'])
            ->orWhere('service_date', '>=', Carbon::today())
            ->get();
            
        // 3. Ambil data Bookings yang akan datang atau sedang berlangsung
        $upcomingBookings = Booking::with('vehicle', 'customer')
            ->whereIn('status', ['pending', 'deposit'])
            ->orWhere('end_date', '>=', Carbon::now()) // Sedang berlangsung
            ->get();

        return view('index', compact(
            'totalRevenue',
            'totalBookings',
            'totalVehicles',
            'totalCancelledBookings',
            'monthlyData',
            'totalKredit',
            'totalDebet',
            'services',

            'vehiclesInService', 
            'activeServiceSchedules', 
            'upcomingBookings' 
        ));
    }

    public function getSalesProfit(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Ambil data berdasarkan rentang tanggal
        $monthlyData = DB::table('service_details')
            ->selectRaw('MONTH(tanggal_service) as month, YEAR(tanggal_service) as year, 
                        SUM(kredit) as total_kredit, SUM(debet) as total_debet')
            ->whereBetween('tanggal_service', [$startDate, $endDate])
            ->groupBy(DB::raw('MONTH(tanggal_service), YEAR(tanggal_service)'))
            ->orderBy(DB::raw('YEAR(tanggal_service), MONTH(tanggal_service)'))
            ->get();

    
        $months = [];
        $totalSales = [];
        $totalProfit = [];

        foreach ($monthlyData as $data) {
            $months[] = $data->month . '-' . $data->year;
            $totalSales[] = $data->total_kredit;
            $totalProfit[] = $data->total_debet;
        }

        return response()->json([
            'months' => $months,
            'totalSalesData' => $totalSales,
            'totalProfitData' => $totalProfit,
            'totalSales' => array_sum($totalSales) / 1000,  // dalam ribuan
            'totalProfit' => array_sum($totalProfit) / 1000,  // dalam ribuan
        ]);
    }
    public function getOrderStatistics()
    {
        $data = Booking::selectRaw("MONTH(created_at) as month, status, COUNT(*) as count")
            ->groupBy('month', 'status')
            ->orderBy('month')
            ->get();

        $formattedData = [];

        foreach ($data as $row) {
            $formattedData[$row->status][$row->month] = $row->count;
        }

        return response()->json($formattedData);
    }
    /*
    public function getSchedules()
    {
        $serviceSchedules = collect(ServiceSchedule::with('vehicle')->get()->map(function ($schedule) {
            return [
                'title' => 'Service: ' . ($schedule->vehicle->name ?? 'Unknown Vehicle'),
                'start' => Carbon::parse($schedule->service_date)->format('Y-m-d'), // Hanya tanggal
                'className' => 'text-green-500 w-[100%] !bg-green-100 dark:!bg-green-500/20 border-none rounded-md py-1.5 px-3',
            ];
        }));
        
        $bookings = collect(Booking::with('vehicle')->get()->map(function ($booking) {
            return [
                'title' => 'Booking: ' . ($booking->vehicle->name ?? 'Unknown Vehicle'),
                'start' => Carbon::parse($booking->start_date)->format('Y-m-d'), // Hanya tanggal
                'end' => Carbon::parse($booking->end_date)->format('Y-m-d'),   // Hanya tanggal
                'className' => 'text-purple-500 w-[100%] !bg-purple-100 dark:!bg-purple-500/20 border-none rounded-md py-1.5 px-3',
            ];
        }));
        
        // Menggabungkan jadwal
        $events = $serviceSchedules->merge($bookings);
        
        // Mengembalikan data dalam format JSON untuk kalender
        return response()->json($events);
    }
        */

    public function karyawanIndex()
    {
        $totalCustomers = Customer::count();
        $unclassifiedCustomers = Customer::where('classification_result', 'Belum Diklasifikasi')
            ->orWhereNull('classification_result')
            ->count();
        $amanCustomers = Customer::where('classification_result', 'Aman')->count();
        $waspadaCustomers = Customer::where('classification_result', 'Waspada')->count();
        $bahayaCustomers = Customer::where('classification_result', 'Bahaya')->count();

        // New statistics for pegawai dashboard
        $totalBookings = Booking::count();
        $totalVehicles = Vehicle::count();
        $totalDrivers = Driver::count();
        $vehiclesInService = ServiceSchedule::whereNotIn('status', ['done', 'cancel'])->count();

        // Event data for schedules calendar
        $activeServiceSchedules = ServiceSchedule::with('vehicle')
            ->whereNotIn('status', ['done', 'cancel'])
            ->orWhere('service_date', '>=', Carbon::today())
            ->get();
            
        $upcomingBookings = Booking::with('vehicle', 'customer')
            ->whereIn('status', ['pending', 'deposit'])
            ->orWhere('end_date', '>=', Carbon::now())
            ->get();

        return view('karyawan-dashboard', compact(
            'totalCustomers',
            'unclassifiedCustomers',
            'amanCustomers',
            'waspadaCustomers',
            'bahayaCustomers',
            'totalBookings',
            'totalVehicles',
            'totalDrivers',
            'vehiclesInService',
            'activeServiceSchedules',
            'upcomingBookings'
        ));
    }
}
