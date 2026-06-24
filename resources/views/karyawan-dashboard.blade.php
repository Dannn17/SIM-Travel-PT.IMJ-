@extends('layouts.master')
@section('title')
    {{ __('Karyawan Dashboard') }}
@endsection
@section('content')

    <x-page-title title="Dashboard Pegawai" pagetitle="Dashboards" />

    <div class="grid grid-cols-12 gap-x-5">
        <!-- WELCOME BANNER -->
        <div class="relative col-span-12 overflow-hidden card bg-slate-900 shadow-lg mb-5">
            <div class="absolute inset-0 opacity-40">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full" version="1.1" preserveAspectRatio="none" viewBox="0 0 1440 560">
                    <g fill="none">
                        <path d="M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z" stroke="rgba(32, 43, 61, 1)"></path>
                        <path d="M-5 0 a5 5 0 1 0 10 0 a5 1 0 1 0 -10 0z" stroke="rgba(32, 43, 61, 1)"></path>
                    </g>
                </svg>
            </div>
            <div class="relative card-body p-6 md:p-8">
                <div class="grid items-center grid-cols-12">
                    <div class="col-span-12 lg:col-span-8">
                        <h5 class="mb-3 text-xl md:text-2xl font-bold text-slate-100 tracking-wide">
                            Selamat Datang, {{ Auth::user()->Employe->name }}! 🎉
                        </h5>
                        <p class="mb-5 text-slate-400 leading-relaxed text-sm md:text-base max-w-xl">
                            Anda masuk sebagai **Pegawai**. Gunakan portal ini untuk mengelola data penyewa, melakukan proses klasifikasi kelayakan kredit sewa, dan membuat laporan servis kendaraan.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('customers.index') }}"
                                class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:ring focus:ring-custom-500/20 active:bg-custom-600 font-medium px-4 py-2 rounded-md transition-all duration-200">
                                Kelola Penyewa
                            </a>
                            <a href="{{ route('classification.index') }}"
                                class="text-white btn bg-purple-500 border-purple-500 hover:bg-purple-600 hover:border-purple-600 focus:bg-purple-600 focus:ring focus:ring-purple-500/20 active:bg-purple-600 font-medium px-4 py-2 rounded-md transition-all duration-200">
                                Klasifikasi Baru
                            </a>
                        </div>
                    </div>
                    <div class="hidden col-span-4 lg:block">
                        <img src="{{ URL::asset('images/logo.png') }}" alt="PT IMJ Logo" class="h-36 mx-auto hover:scale-105 transition-transform duration-300">
                    </div>
                </div>
            </div>
        </div>

        <!-- STATS / METRICS CARDS -->
        <!-- Total Penyewa -->
        <div class="col-span-12 md:col-span-6 lg:col-span-4 card shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="card-body p-5 flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-14 bg-blue-100 text-blue-600 shrink-0">
                    <i data-lucide="users" class="size-6"></i>
                </div>
                <div>
                    <p class="text-slate-500 font-medium text-sm uppercase tracking-wider mb-1">Total Penyewa</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $totalCustomers }}</h3>
                    <a href="{{ route('customers.index') }}" class="text-xs text-blue-500 font-semibold hover:underline flex items-center gap-1 mt-1">
                        Lihat Semua <i data-lucide="arrow-right" class="size-3"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Belum Diklasifikasi -->
        <div class="col-span-12 md:col-span-6 lg:col-span-4 card shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="card-body p-5 flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-14 bg-yellow-100 text-yellow-600 shrink-0">
                    <i data-lucide="loader" class="size-6 animate-spin"></i>
                </div>
                <div>
                    <p class="text-slate-500 font-medium text-sm uppercase tracking-wider mb-1">Belum Diklasifikasi</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $unclassifiedCustomers }}</h3>
                    <a href="{{ route('classification.index') }}" class="text-xs text-yellow-600 font-semibold hover:underline flex items-center gap-1 mt-1">
                        Proses Sekarang <i data-lucide="play" class="size-3"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Laporan Cepat -->
        <div class="col-span-12 md:col-span-6 lg:col-span-4 card shadow-md hover:shadow-lg transition-shadow duration-300 bg-gradient-to-br from-purple-500/10 to-indigo-500/5 border border-purple-100">
            <div class="card-body p-5 flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-14 bg-purple-100 text-purple-600 shrink-0">
                    <i data-lucide="printer" class="size-6"></i>
                </div>
                <div>
                    <p class="text-slate-500 font-medium text-sm uppercase tracking-wider mb-1">Cetak Laporan</p>
                    <h3 class="text-lg font-bold text-purple-700">Laporan Servis</h3>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#showModal" data-modal-target="showModal"
                            class="text-xs text-purple-600 font-semibold hover:underline flex items-center gap-1 mt-1 border-none bg-transparent cursor-pointer">
                        Buat Laporan <i data-lucide="printer" class="size-3"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Total Booking -->
        <div class="col-span-12 md:col-span-6 lg:col-span-4 card shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="card-body p-5 flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-14 bg-red-100 text-red-600 shrink-0">
                    <i data-lucide="archive" class="size-6"></i>
                </div>
                <div>
                    <p class="text-slate-500 font-medium text-sm uppercase tracking-wider mb-1">Total Booking</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $totalBookings }}</h3>
                    <a href="{{ route('bookings.index') }}" class="text-xs text-red-500 font-semibold hover:underline flex items-center gap-1 mt-1">
                        Kelola Booking <i data-lucide="arrow-right" class="size-3"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Kendaraan -->
        <div class="col-span-12 md:col-span-6 lg:col-span-4 card shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="card-body p-5 flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-14 bg-emerald-100 text-emerald-600 shrink-0">
                    <i data-lucide="car-front" class="size-6"></i>
                </div>
                <div>
                    <p class="text-slate-500 font-medium text-sm uppercase tracking-wider mb-1">Total Kendaraan</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $totalVehicles }}</h3>
                    <a href="{{ route('vehicles.index') }}" class="text-xs text-emerald-500 font-semibold hover:underline flex items-center gap-1 mt-1">
                        Kelola Kendaraan <i data-lucide="arrow-right" class="size-3"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Supir -->
        <div class="col-span-12 md:col-span-6 lg:col-span-4 card shadow-md hover:shadow-lg transition-shadow duration-300">
            <div class="card-body p-5 flex items-center gap-4">
                <div class="flex items-center justify-center rounded-xl size-14 bg-orange-100 text-orange-600 shrink-0">
                    <i data-lucide="gauge" class="size-6"></i>
                </div>
                <div>
                    <p class="text-slate-500 font-medium text-sm uppercase tracking-wider mb-1">Total Supir</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ $totalDrivers }}</h3>
                    <a href="{{ route('drivers.index') }}" class="text-xs text-orange-500 font-semibold hover:underline flex items-center gap-1 mt-1">
                        Kelola Supir <i data-lucide="arrow-right" class="size-3"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- BREAKDOWN KLASIFIKASI KREDIT -->
        <div class="col-span-12 card shadow-md mt-5">
            <div class="card-body p-6">
                <h6 class="text-slate-800 font-bold text-lg mb-4 flex items-center gap-2">
                    <i data-lucide="pie-chart" class="text-purple-500"></i> Status Kelayakan Kredit Penyewa
                </h6>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Aman -->
                    <div class="p-4 rounded-xl border border-green-200 bg-green-50/50 flex flex-col justify-between">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-green-800 font-semibold text-sm">Aman</span>
                            <span class="px-2 py-0.5 text-xs font-bold rounded-full bg-green-100 text-green-800">Rendah Risiko</span>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-green-700 mb-1">{{ $amanCustomers }}</h2>
                            <p class="text-xs text-slate-500">Penyewa yang dinilai layak dan aman untuk bertransaksi.</p>
                        </div>
                    </div>

                    <!-- Waspada -->
                    <div class="p-4 rounded-xl border border-orange-200 bg-orange-50/50 flex flex-col justify-between">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-orange-800 font-semibold text-sm">Waspada</span>
                            <span class="px-2 py-0.5 text-xs font-bold rounded-full bg-orange-100 text-orange-800">Risiko Sedang</span>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-orange-700 mb-1">{{ $waspadaCustomers }}</h2>
                            <p class="text-xs text-slate-500">Penyewa dengan beberapa catatan yang membutuhkan perhatian.</p>
                        </div>
                    </div>

                    <!-- Bahaya -->
                    <div class="p-4 rounded-xl border border-red-200 bg-red-50/50 flex flex-col justify-between">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-red-800 font-semibold text-sm">Bahaya</span>
                            <span class="px-2 py-0.5 text-xs font-bold rounded-full bg-red-100 text-red-800">Risiko Tinggi</span>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold text-red-700 mb-1">{{ $bahayaCustomers }}</h2>
                            <p class="text-xs text-slate-500">Penyewa yang dinilai berisiko tinggi untuk bertransaksi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SCHEDULE CALENDAR -->
        <div class="col-span-12 card shadow-md mt-5">
            <div class="card-header border-b border-slate-200 p-4 flex items-center gap-2">
                <h6 class="text-slate-800 font-bold text-lg flex items-center gap-2">
                    <i data-lucide="calendar-range" class="text-custom-500"></i> Kalender Jadwal Mobil & Servis
                </h6>
            </div>
            <div class="card-body p-6">
                <div cursor-pointerid='calendar-container'>
                    <button type="hidden" id="calendarBtn" data-modal-target="event-modal"></button>
                    <div id='calendar' 
                        data-service-schedules="{{ json_encode($activeServiceSchedules ?? []) }}"
                        data-upcoming-bookings="{{ json_encode($upcomingBookings ?? []) }}"
                    ></div>
                </div>
            </div>
        </div>

        <!-- QUICK GUIDELINES -->
        <div class="col-span-12 card shadow-md mt-5">
            <div class="card-body p-6">
                <h6 class="text-slate-800 font-bold text-base mb-3 flex items-center gap-2">
                    <i data-lucide="info" class="text-blue-500"></i> Alur Kerja Pegawai
                </h6>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm text-slate-600">
                    <div class="flex gap-3">
                        <span class="flex items-center justify-center rounded-full size-8 bg-slate-100 font-bold text-slate-800 shrink-0">1</span>
                        <div>
                            <p class="font-semibold text-slate-800 mb-1">Entri Data Penyewa</p>
                            <p class="text-xs text-slate-500 leading-relaxed">Masukkan data penyewa baru secara lengkap di menu **Kelola Penyewa** sebelum mengajukan sewa.</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <span class="flex items-center justify-center rounded-full size-8 bg-slate-100 font-bold text-slate-800 shrink-0">2</span>
                        <div>
                            <p class="font-semibold text-slate-800 mb-1">Jalankan Klasifikasi</p>
                            <p class="text-xs text-slate-500 leading-relaxed">Buka menu **Klasifikasi** untuk memproses data uji penyewa baru menggunakan algoritma Naive Bayes.</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <span class="flex items-center justify-center rounded-full size-8 bg-slate-100 font-bold text-slate-800 shrink-0">3</span>
                        <div>
                            <p class="font-semibold text-slate-800 mb-1">Verifikasi Hasil</p>
                            <p class="text-xs text-slate-500 leading-relaxed">Setelah hasil klasifikasi keluar, verifikasi keakuratan datanya agar otomatis masuk sebagai data latih baru.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- moment js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- calendar min js -->
    <script src="{{ URL::asset('build/libs/fullcalendar/index.global.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // --- INISIALISASI FULLCALENDAR DENGAN DATA SERVIS & BOOKING ---
            const calendarEl = document.getElementById('calendar');
            const dataElement = document.getElementById('calendar'); 

            if (calendarEl) {
                let allCalendarEvents = [];

                // 1. Ambil & Proses Data SERVICE SCHEDULES
                let serviceSchedules = [];
                try {
                    serviceSchedules = JSON.parse(dataElement.dataset.serviceSchedules);
                } catch (e) {
                    console.error("Gagal parsing data jadwal servis:", e);
                }

                const serviceEvents = serviceSchedules.map(schedule => ({
                    id: 'service-' + schedule.id,
                    title: 'SERVICE: ' + (schedule.vehicle ? schedule.vehicle.name : 'Unknown Vehicle'),
                    start: schedule.service_date,
                    allDay: true,
                    className: 'bg-yellow-600 text-white !bg-yellow-600/70 border-none rounded-md py-1.5 px-3', 
                    extendedProps: {
                        type: 'Service',
                        status: schedule.status,
                        keterangan: schedule.keterangan,
                        vehicleName: schedule.vehicle ? schedule.vehicle.name : 'N/A'
                    }
                }));
                allCalendarEvents = allCalendarEvents.concat(serviceEvents);

                // 2. Ambil & Proses Data UPCOMING BOOKINGS
                let upcomingBookings = [];
                try {
                    upcomingBookings = JSON.parse(dataElement.dataset.upcomingBookings);
                } catch (e) {
                    console.error("Gagal parsing data booking:", e);
                }

                const bookingEvents = upcomingBookings.map(booking => {
                    const endDateAdjusted = moment(booking.end_date).add(1, 'days').format('YYYY-MM-DD');

                    return {
                        id: 'booking-' + booking.id,
                        title: 'BOOKING: ' + (booking.vehicle ? booking.vehicle.name : 'N/A') + ' (' + (booking.customer ? booking.customer.name : 'N/A') + ')',
                        start: booking.start_date,
                        end: endDateAdjusted, 
                        allDay: true, 
                        className: 'bg-red-500 text-white !bg-red-500/70 border-none rounded-md py-1.5 px-3', 
                        extendedProps: {
                            type: 'Booking',
                            status: booking.status,
                            customerName: booking.customer ? booking.customer.name : 'N/A',
                            vehicleName: booking.vehicle ? booking.vehicle.name : 'N/A'
                        }
                    }
                });
                allCalendarEvents = allCalendarEvents.concat(bookingEvents);

                // 3. INISIALISASI KALENDER
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    editable: false,
                    selectable: true,
                    events: allCalendarEvents, 
                    eventClick: function(info) {
                        const props = info.event.extendedProps;
                        let htmlContent = '';

                        if (props.type === 'Service') {
                            htmlContent = `
                                <p><strong>Tipe:</strong> Servis Kendaraan</p>
                                <p><strong>Kendaraan:</strong> ${props.vehicleName}</p>
                                <p><strong>Tanggal Servis:</strong> ${info.event.start.toLocaleDateString()}</p>
                                <p><strong>Status:</strong> ${props.status}</p>
                                <p><strong>Keterangan:</strong> ${props.keterangan || 'N/A'}</p>
                            `;
                        } else if (props.type === 'Booking') {
                            const displayEndDate = moment(info.event.end).subtract(1, 'days').format('DD/MM/YYYY');
                            htmlContent = `
                                <p><strong>Tipe:</strong> Booking Kendaraan Keluar</p>
                                <p><strong>Pelanggan:</strong> ${props.customerName}</p>
                                <p><strong>Kendaraan:</strong> ${props.vehicleName}</p>
                                <p><strong>Mulai:</strong> ${info.event.start.toLocaleDateString()}</p>
                                <p><strong>Selesai:</strong> ${displayEndDate}</p>
                                <p><strong>Status:</strong> ${props.status}</p>
                            `;
                        }

                        Swal.fire({
                            title: info.event.title,
                            html: htmlContent,
                            icon: 'info',
                            confirmButtonText: 'Tutup'
                        });
                    }
                });

                calendar.render();
            }
        });
    </script>
@endpush
