
@extends('layouts.master')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')



    <x-page-title title="Dashboard" pagetitle="Dashboards" />

    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
        <div class="relative col-span-12 overflow-hidden card 2xl:col-span-8 bg-slate-900">
            <div class="absolute inset-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-100" version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="1440"
                    height="560" preserveAspectRatio="none" viewBox="0 0 1440 560">
                    <g mask="url(&quot;#SvgjsMask1000&quot;)" fill="none">
                        <use xlink:href="#SvgjsSymbol1007" x="0" y="0"></use>
                        <use xlink:href="#SvgjsSymbol1007" x="720" y="0"></use>
                    </g>
                    <defs>
                        <mask id="SvgjsMask1000">
                            <rect width="1440" height="560" fill="#ffffff"></rect>
                        </mask>
                        <path d="M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z" id="SvgjsPath1003"></path>
                        <path d="M-3 0 a3 3 0 1 0 6 0 a3 3 0 1 0 -6 0z" id="SvgjsPath1004"></path>
                        <path d="M-5 0 a5 5 0 1 0 10 0 a5 1 0 1 0 -10 0z" id="SvgjsPath1001"></path>
                        <path d="M2 -2 L-2 2z" id="SvgjsPath1005"></path>
                        <path d="M6 -6 L-6 6z" id="SvgjsPath1002"></path>
                        <path d="M30 -30 L-30 30z" id="SvgjsPath1006"></path>
                    </defs>
                    <symbol id="SvgjsSymbol1007">
                        <use xlink:href="#SvgjsPath1001" x="30" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="30" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="30" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="30" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="30" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="30" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="90" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="90" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="90" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="90" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="150" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="150" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="150" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="150" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="150" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="150" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1004" x="150" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="150" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="150" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="150" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="210" y="150" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="210" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="210" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="210" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="210" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1003" x="210" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="270" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="270" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="270" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="270" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="270" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="270" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="330" y="90" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="330" y="270" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1001" x="330" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="330" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="330" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="330" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="390" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="390" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="390" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="390" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="390" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="390" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="450" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="450" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="450" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="450" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="510" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="510" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="510" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="510" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="510" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1001" x="510" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="570" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="570" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="570" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1005" x="570" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="570" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="630" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="630" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="630" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="630" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="630" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="630" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="630" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="630" y="450" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1001" x="630" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="630" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="690" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="690" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="690" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="690" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="690" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="690" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="690" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="690" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="690" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1003" x="690" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                    </symbol>
                </svg>
            </div>
            <div class="relative card-body">
                <div class="grid items-center grid-cols-12">
                    <div class="col-span-12 lg:col-span-8 2xl:col-span-7">
                        <h5 class="mb-3 font-normal tracking-wide text-slate-200">Welcome {{ Auth::user()->Employe->name }} 🎉</h5>
                        <p class="mb-5 text-slate-400">An SIM-IMJ dashboard has just that purpose. It provides your
                            IMJ team with a clear overview of key financial and website KPIs at any time.</p>
                        <a href="{{ route('bookings.create') }}"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-500/20 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-500/20">Make a Vehicle Booking</a>
                    </div>
                    <div class="hidden col-span-12 2xl:col-span-3 lg:col-span-2 lg:col-start-11 2xl:col-start-10 lg:block">
                        <img src="{{ URL::asset('images/logo.png') }}" alt=""
                            class="h-40 ltr:2xl:ml-auto rtl:2xl:mr-auto">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 card 2xl:col-span-4 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center mb-3">
                    <h6 class="grow text-15">Order Statistics</h6>
                    <div class="relative">
                        <a href="{{ route('bookings.index') }}"
                            class="underline transition-all duration-200 ease-linear text-custom-500 hover:text-custom-600">View
                            All <i data-lucide="move-right"
                                class="inline-block size-4 align-middle ltr:ml-1 rtl:mr-1"></i></a>
                    </div>
                </div>
                <div id="orderStatisticsChart" class="apex-charts" data-chart-colors='["bg-purple-500", "bg-sky-500"]'
                data-api="{{ url('/order-statistics') }}" dir="ltr"></div>
            </div>
        </div>
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2"> 
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500">
                    <i data-lucide="wallet-2"></i>
                </div>
                <h5 class="mt-4 mb-2">Rp. {{ number_format($totalRevenue, 2) }}</h5>
                <p class="text-slate-500">Total Revenue</p>
            </div>
        </div>
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-purple-500 bg-purple-100 rounded-full size-14">
                    <i data-lucide="package"></i>
                </div>
                <h5 class="mt-4 mb-2">{{ $totalBookings }}</h5>
                <p class="text-slate-500">Total Orders</p>
            </div>
        </div>
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-green-500 bg-green-100 rounded-full size-14">
                    <i data-lucide="truck"></i>
                </div>
                <h5 class="mt-4 mb-2">{{ $totalVehicles }}</h5>
                <p class="text-slate-500">Total Vehicles</p>
            </div>
        </div>
        <!-- CARD BARU: VEHICLES IN SERVICE -->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-yellow-600 bg-yellow-100 rounded-full size-14">
                    <i data-lucide="wrench"></i>
                </div>
                <h5 class="mt-4 mb-2">{{ $vehiclesInService ?? 0 }}</h5>
                <p class="text-slate-500">Vehicles In Service</p>
            </div>
        </div>
     
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-red-500 bg-red-100 rounded-full size-14">
                    <i data-lucide="package-x"></i>
                </div>
                <h5 class="mt-4 mb-2">{{ $totalCancelledBookings }}</h5>
                <p class="text-slate-500">Cancelled</p>
            </div>
        </div>
        
        <div class="col-span-12 card 2xl:col-span-8">
            <div class="card-body">
                <div class="flex flex-col gap-4 mb-4 md:mb-3 md:items-center md:flex-row">
                    <h6 class="grow text-15">Sales Revenue Overview</h6>
                    {{-- <div class="relative">
                        <i data-lucide="calendar-range"
                            class="absolute size-4 ltr:left-3 rtl:right-3 top-3 text-slate-500"></i>
                        <input type="text"
                            class="ltr:pl-10 rtl:pr-10 form-input border-slate-200 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 disabled:border-slate-300 disabled:text-slate-500 placeholder:text-slate-400"
                            data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true"
                            readonly="readonly" placeholder="Select Date">
                    </div> --}}
                </div>
                <div class="grid grid-cols-12 gap-4 mb-3">
                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center size-12 rounded-md text-sky-500 bg-sky-50 shrink-0">
                                <i data-lucide="bar-chart"></i>
                            </div>
                            <div class="grow">
                                <p class="mb-1 text-slate-500">Total Kredit</p>
                                <h5 class="text-15">Rp. <span class="counter-value" data-target="{{ $totalKredit }}">0</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center size-12 text-green-500 rounded-md bg-green-50 shrink-0">
                                <i data-lucide="trending-up"></i>
                            </div>
                            <div class="grow">
                                <p class="mb-1 text-slate-500">Total Debit</p>
                                <h5 class="text-15">Rp. <span class="counter-value" data-target="{{ $totalDebet }}">0</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="salesRevenueOverview" class="apex-charts" data-monthly-data="{{ json_encode($monthlyData) }}"
                    data-chart-colors='["bg-custom-500", "bg-custom-400", "bg-custom-300"]' dir="ltr"></div>
            </div>
        </div><!--end col-->

        <div class="col-span-12 card 2xl:col-span-12">
            <div class="card">
                <div class="card-body">
                    <div cursor-pointerid='calendar-container'>
                        <button type="hidden" id="calendarBtn" data-modal-target="event-modal"></button>
                       
                        <div id='calendar' 
                            data-service-schedules="{{ json_encode($activeServiceSchedules ?? []) }}"
                            data-upcoming-bookings="{{ json_encode($upcomingBookings ?? []) }}"
                        ></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 card 2xl:col-span-12">
            <div class="card-body">
                <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                    <div class="2xl:col-span-3">
                        <h6 class="text-15">Service Data</h6>
                    </div><!--end col-->
                    <div class="2xl:col-span-3 2xl:col-start-10">
                        <div class="flex gap-3">
                            <div class="relative grow">
                                <input type="text"
                                    class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 disabled:border-slate-300 disabled:text-slate-500 placeholder:text-slate-400"
                                    placeholder="Search for ..." autocomplete="off">
                                <i data-lucide="search"
                                    class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 fill-slate-100"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500">
                            <tr>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">#</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Vehicle - Nopol</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Booking Name</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Tanggal Service</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Keterangan</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Jumlah</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Debet</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Kredit</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $item)
                                <tr class="border">
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $loop->iteration }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $item->vehicle_id ? $item->vehicle->name . ' - ' . $item->vehicle->license_plate : '-' }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $item->details->booking_id ? $item->details->booking->customer->name : '-' }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $item->details->tanggal_service }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $item->details->keterangan ?? 'Sewa' }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">Rp. {{ number_format($item->details->jumlah, 2) }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">Rp. {{ number_format($item->details->debet, 2) }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">Rp. {{ number_format($item->details->kredit, 2) }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">
                                        <div class="relative dropdown">
                                            <button id="orderAction1" data-bs-toggle="dropdown"
                                                class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100"><i
                                                    data-lucide="more-horizontal" class="size-3"></i></button>
                                            <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem]"
                                                aria-labelledby="orderAction1">
                                                {{-- <li>
                                                    <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500"
                                                        href="{{ url('apps-ecommerce-order-overview') }}"><i data-lucide="eye"
                                                            class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                            class="align-middle">Overview</span></a>
                                                </li> --}}
                                                <form action="{{ route('services.destroy', $item->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500"
                                                            href="{{ route('services.edit', $item->id) }}"><i data-lucide="file-edit"
                                                                class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                                class="align-middle">Edit</span></a>
                                                    </li>
                                                    <li>
                                                        <button type="button" id="sa-params" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 btn-delete">
                                                            <i data-lucide="trash-2"
                                                                class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                                class="align-middle">Delete</span></button>
                                                    </li>
                                                </form>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col items-center mt-5 md:flex-row">
                    <div class="flex justify-end mt-4">
                        <div class="flex gap-2 pagination-wrap">
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end col-->
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- calendar min js -->
    <script src="{{ URL::asset('build/libs/fullcalendar/index.global.min.js') }}"></script>
    <!--apexchart js-->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!--dashboard ecommerce init js-->
    <script src="{{ URL::asset('build/js/pages/dashboards-ecommerce.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    @include('layouts.script-delete')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.querySelector(".search");
            const tableRows = document.querySelectorAll("tbody tr");
        
            searchInput.addEventListener("input", function () {
                const searchText = searchInput.value.toLowerCase();
        
                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    if (rowText.includes(searchText)) {
                        row.style.display = ""; // Tampilkan baris jika cocok
                    } else {
                        row.style.display = "none"; // Sembunyikan jika tidak cocok
                    }
                });
            });
            
            // --- INISIALISASI FULLCALENDAR DENGAN DATA SERVIS & BOOKING ---
            const calendarEl = document.getElementById('calendar');
            const dataElement = document.getElementById('calendar'); 

            let allCalendarEvents = [];

            // 1. Ambil & Proses Data SERVICE SCHEDULES
            let serviceSchedules = [];
            try {
                // Pastikan data diparse dengan aman
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
        });
    </script>
@endpush

{{-- 
@extends('layouts.master')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')

    <x-page-title title="Dashboard" pagetitle="Dashboards" />

    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
        <div class="relative col-span-12 overflow-hidden card 2xl:col-span-8 bg-slate-900">
            <div class="absolute inset-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-100" version="1.1"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="1440"
                    height="560" preserveAspectRatio="none" viewBox="0 0 1440 560">
                    <g mask="url(&quot;#SvgjsMask1000&quot;)" fill="none">
                        <use xlink:href="#SvgjsSymbol1007" x="0" y="0"></use>
                        <use xlink:href="#SvgjsSymbol1007" x="720" y="0"></use>
                    </g>
                    <defs>
                        <mask id="SvgjsMask1000">
                            <rect width="1440" height="560" fill="#ffffff"></rect>
                        </mask>
                        <path d="M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z" id="SvgjsPath1003"></path>
                        <path d="M-3 0 a3 3 0 1 0 6 0 a3 3 0 1 0 -6 0z" id="SvgjsPath1004"></path>
                        <path d="M-5 0 a5 5 0 1 0 10 0 a5 5 0 1 0 -10 0z" id="SvgjsPath1001"></path>
                        <path d="M2 -2 L-2 2z" id="SvgjsPath1005"></path>
                        <path d="M6 -6 L-6 6z" id="SvgjsPath1002"></path>
                        <path d="M30 -30 L-30 30z" id="SvgjsPath1006"></path>
                    </defs>
                    <symbol id="SvgjsSymbol1007">
                        <use xlink:href="#SvgjsPath1001" x="30" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="30" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="30" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="30" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="30" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="30" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="30" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="90" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="90" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="90" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="90" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="90" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="150" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="150" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="150" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="150" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="150" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="150" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1004" x="150" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="150" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="150" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="150" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="210" y="150" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="210" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="210" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="210" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="210" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="210" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1003" x="210" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="270" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="270" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="270" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="270" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="270" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="270" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="270" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="330" y="90" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="330" y="270" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1001" x="330" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="330" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="330" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="330" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="330" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="390" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="390" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="390" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="390" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="390" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="390" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="390" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="450" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="450" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="450" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="450" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="450" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="510" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="510" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="510" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1004" x="510" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="510" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1001" x="510" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="510" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="570" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="570" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="570" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1005" x="570" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="570" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="570" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="630" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="630" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="630" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="630" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="630" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="630" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1002" x="630" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="630" y="450" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1001" x="630" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="630" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="690" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="690" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="690" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1002" x="690" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1005" x="690" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1001" x="690" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="690" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1003" x="690" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                        <use xlink:href="#SvgjsPath1006" x="690" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3">
                        </use>
                        <use xlink:href="#SvgjsPath1003" x="690" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                    </symbol>
                </svg>
            </div>
            <div class="relative card-body">
                <div class="grid items-center grid-cols-12">
                    <div class="col-span-12 lg:col-span-8 2xl:col-span-7">
                        <h5 class="mb-3 font-normal tracking-wide text-slate-200">Welcome {{ Auth::user()->Employe->name }} 🎉</h5>
                        <p class="mb-5 text-slate-400">An SIM-IMJ dashboard has just that purpose. It provides your
                            IMJ team with a clear overview of key financial and website KPIs at any time.</p>
                        <a href="{{ route('bookings.create') }}"
                            class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-500/20 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-500/20">Make a Vehicle Booking</a>
                    </div>
                    <div class="hidden col-span-12 2xl:col-span-3 lg:col-span-2 lg:col-start-11 2xl:col-start-10 lg:block">
                        <img src="{{ URL::asset('images/logo.png') }}" alt=""
                            class="h-40 ltr:2xl:ml-auto rtl:2xl:mr-auto">
                    </div>
                </div>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card 2xl:col-span-4 2xl:row-span-2">
            <div class="card-body">
                <div class="flex items-center mb-3">
                    <h6 class="grow text-15">Order Statistics</h6>
                    <div class="relative">
                        <a href="{{ route('bookings.index') }}"
                            class="underline transition-all duration-200 ease-linear text-custom-500 hover:text-custom-600">View
                            All <i data-lucide="move-right"
                                class="inline-block size-4 align-middle ltr:ml-1 rtl:mr-1"></i></a>
                    </div>
                </div>
                <div id="orderStatisticsChart" class="apex-charts" data-chart-colors='["bg-purple-500", "bg-sky-500"]'
                data-api="{{ url('/order-statistics') }}" dir="ltr"></div>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2"> 
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500">
                    <i data-lucide="wallet-2"></i>
                </div>
                <h5 class="mt-4 mb-2">Rp. {{ number_format($totalRevenue, 2) }}</h5>
                <p class="text-slate-500">Total Revenue</p>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-purple-500 bg-purple-100 rounded-full size-14">
                    <i data-lucide="package"></i>
                </div>
                <h5 class="mt-4 mb-2">{{ $totalBookings }}</h5>
                <p class="text-slate-500">Total Orders</p>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-green-500 bg-green-100 rounded-full size-14">
                    <i data-lucide="truck"></i>
                </div>
                <h5 class="mt-4 mb-2">{{ $totalVehicles }}</h5>
                <p class="text-slate-500">Total Vehicles</p>
            </div>
        </div><!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-red-500 bg-red-100 rounded-full size-14">
                    <i data-lucide="package-x"></i>
                </div>
                <h5 class="mt-4 mb-2">{{ $totalCancelledBookings }}</h5>
                <p class="text-slate-500">Cancelled</p>
            </div>
        </div><!--end col-->
        
        <div class="col-span-12 card 2xl:col-span-8">
            <div class="card-body">
                <div class="flex flex-col gap-4 mb-4 md:mb-3 md:items-center md:flex-row">
                    <h6 class="grow text-15">Sales Revenue Overview</h6>
                    
                </div>
                <div class="grid grid-cols-12 gap-4 mb-3">
                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center size-12 rounded-md text-sky-500 bg-sky-50 shrink-0">
                                <i data-lucide="bar-chart"></i>
                            </div>
                            <div class="grow">
                                <p class="mb-1 text-slate-500">Total Kredit</p>
                                <h5 class="text-15">Rp. <span class="counter-value" data-target="{{ $totalKredit }}">0</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center size-12 text-green-500 rounded-md bg-green-50 shrink-0">
                                <i data-lucide="trending-up"></i>
                            </div>
                            <div class="grow">
                                <p class="mb-1 text-slate-500">Total Debit</p>
                                <h5 class="text-15">Rp. <span class="counter-value" data-target="{{ $totalDebet }}">0</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="salesRevenueOverview" class="apex-charts" data-monthly-data="{{ json_encode($monthlyData) }}"
                    data-chart-colors='["bg-custom-500", "bg-custom-400", "bg-custom-300"]' dir="ltr"></div>
            </div>
        </div><!--end col-->

        <div class="col-span-12 card 2xl:col-span-12">
            <div class="card">
                <div class="card-body">
                    <div cursor-pointerid='calendar-container'>
                        <button type="hidden" id="calendarBtn" data-modal-target="event-modal"></button>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 card 2xl:col-span-12">
            <div class="card-body">
                <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                    <div class="2xl:col-span-3">
                        <h6 class="text-15">Service Data</h6>
                    </div><!--end col-->
                    <div class="2xl:col-span-3 2xl:col-start-10">
                        <div class="flex gap-3">
                            <div class="relative grow">
                                <input type="text"
                                    class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 disabled:border-slate-300 disabled:text-slate-500 placeholder:text-slate-400"
                                    placeholder="Search for ..." autocomplete="off">
                                <i data-lucide="search"
                                    class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 fill-slate-100"></i>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end grid-->
                
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500">
                            <tr>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">#</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Vehicle - Nopol</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Booking Name</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Tanggal Service</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Keterangan</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Jumlah</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Debet</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Kredit</th>
                                <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $item)
                                <tr class="border">
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $loop->iteration }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $item->vehicle_id ? $item->vehicle->name . ' - ' . $item->vehicle->license_plate : '-' }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $item->details->booking_id ? $item->details->booking->customer->name : '-' }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $item->details->tanggal_service }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">{{ $item->details->keterangan ?? 'Sewa' }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">Rp. {{ number_format($item->details->jumlah, 2) }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">Rp. {{ number_format($item->details->debet, 2) }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">Rp. {{ number_format($item->details->kredit, 2) }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200">
                                        <div class="relative dropdown">
                                            <button id="orderAction1" data-bs-toggle="dropdown"
                                                class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100"><i
                                                    data-lucide="more-horizontal" class="size-3"></i></button>
                                            <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem]"
                                                aria-labelledby="orderAction1">
                                                
                                                <form action="{{ route('services.destroy', $item->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <li>
                                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500"
                                                            href="{{ route('services.edit', $item->id) }}"><i data-lucide="file-edit"
                                                                class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                                class="align-middle">Edit</span></a>
                                                    </li>
                                                    <li>
                                                        <button type="button" id="sa-params" class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 btn-delete">
                                                            <i data-lucide="trash-2"
                                                                class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span
                                                                class="align-middle">Delete</span></button>
                                                    </li>
                                                </form>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col items-center mt-5 md:flex-row">
                    <div class="flex justify-end mt-4">
                        <div class="flex gap-2 pagination-wrap">
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end col-->
@endsection
@push('scripts')
    <!-- calendar min js -->
    <script src="{{ URL::asset('build/libs/fullcalendar/index.global.min.js') }}"></script>
        
    <script src="{{ URL::asset('build/js/pages/apps-calendar.init.js') }}"></script>
    <!--apexchart js-->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!--dashboard ecommerce init js-->
    <script src="{{ URL::asset('build/js/pages/dashboards-ecommerce.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    @include('layouts.script-delete')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.querySelector(".search");
            const tableRows = document.querySelectorAll("tbody tr");
    
            searchInput.addEventListener("input", function () {
                const searchText = searchInput.value.toLowerCase();
    
                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    if (rowText.includes(searchText)) {
                        row.style.display = ""; // Tampilkan baris jika cocok
                    } else {
                        row.style.display = "none"; // Sembunyikan jika tidak cocok
                    }
                });
            });
        });
    </script>
@endpush

--}}

