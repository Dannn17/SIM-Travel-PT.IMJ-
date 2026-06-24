@extends('layouts.master')
@section('title')
    {{ __('Proses Klasifikasi') }}
@endsection
@push('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="p-6 bg-slate-50 min-h-screen">
    <div class="bg-custom-500 px-6 py-4 rounded-t-lg shadow-md">
        <h1 class="text-white text-xl font-bold">Proses Klasifikasi Naive Bayes</h1>
    </div>

    <div class="bg-white p-6 shadow-md rounded-b-lg">
        <div class="mb-8">
            <h2 class="text-slate-800 font-bold mb-4">Daftar Antrean Penyewa Baru (Data Uji)</h2>

            <div class="flex flex-wrap justify-between items-center mb-4 gap-4 p-4 border border-slate-200 bg-white shadow-sm rounded-lg">
    <button type="button" 
            onclick="document.getElementById('bulkClassifyForm').submit()" 
            style="background-color: #3b82f6 !important; color: #ffffff !important;"
            class="text-white text-sm font-bold px-4 py-2 rounded-md shadow-sm transition inline-flex items-center justify-center border-0 cursor-pointer hover:opacity-90">
        <i class="ri-flashlight-line mr-1.5 text-base" style="color: #ffffff !important;"></i> Proses Massal (Bulk Classify)
    </button>

                
                <!-- Search Form -->
                <form action="{{ route('classification.index') }}" method="GET" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari antrean..." class="form-input border-slate-300 focus:border-custom-500 rounded-md px-3 py-1.5 text-sm w-64">
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                        <input type="hidden" name="direction" value="{{ request('direction') }}">
                    @endif
                    <button type="submit" class="text-white btn bg-slate-600 border-slate-600 hover:bg-slate-700 shadow-sm px-3 py-1.5 rounded-md text-sm">
                        <i class="ri-search-line"></i> Cari
                    </button>
                    @if(request('search') || request('sort'))
                        <a href="{{ route('classification.index') }}" class="text-slate-600 btn bg-slate-200 border-slate-200 hover:bg-slate-300 px-3 py-1.5 rounded-md text-sm">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
            
            <div class="border border-slate-200 rounded-lg overflow-hidden shadow-sm overflow-x-auto">
                <form action="{{ route('classification.bulkProcess') }}" method="POST" id="bulkClassifyForm">
                    @csrf
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="bg-slate-500 text-white">
                        <tr>
                            <th class="p-4 border-r border-slate-400 w-10 text-center">
                                <input type="checkbox" id="checkAll" class="size-4 border rounded-sm cursor-pointer border-slate-400">
                            </th>
                            <th class="p-4 border-r border-slate-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('sort') == 'name' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex justify-between items-center hover:text-slate-200">
                                    Nama Penyewa
                                    @if(request('sort') == 'name')
                                        <i class="{{ request('direction') == 'asc' ? 'ri-sort-asc' : 'ri-sort-desc' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="p-4 border-r border-slate-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'domicile', 'direction' => request('sort') == 'domicile' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex justify-between items-center hover:text-slate-200">
                                    Domisili
                                    @if(request('sort') == 'domicile')
                                        <i class="{{ request('direction') == 'asc' ? 'ri-sort-asc' : 'ri-sort-desc' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="p-4 border-r border-slate-400 text-center">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'guarantor', 'direction' => request('sort') == 'guarantor' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex justify-center gap-1 items-center hover:text-slate-200">
                                    Penjamin
                                    @if(request('sort') == 'guarantor')
                                        <i class="{{ request('direction') == 'asc' ? 'ri-sort-asc' : 'ri-sort-desc' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="p-4 border-r border-slate-400 text-center">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'age', 'direction' => request('sort') == 'age' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex justify-center gap-1 items-center hover:text-slate-200">
                                    Usia
                                    @if(request('sort') == 'age')
                                        <i class="{{ request('direction') == 'asc' ? 'ri-sort-asc' : 'ri-sort-desc' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="p-4 border-r border-slate-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'source', 'direction' => request('sort') == 'source' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex justify-between items-center hover:text-slate-200">
                                    Sumber
                                    @if(request('sort') == 'source')
                                        <i class="{{ request('direction') == 'asc' ? 'ri-sort-asc' : 'ri-sort-desc' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($customers as $c)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 text-center">
                                <input type="checkbox" name="customer_ids[]" value="{{ $c->id }}" class="customer-checkbox size-4 border rounded-sm cursor-pointer border-slate-300">
                            </td>
                            <td class="p-4 font-medium text-slate-900">{{ $c->name }}</td>
                            <td class="p-4 text-slate-700">{{ $c->domicile }}</td>
                            <td class="p-4 text-center text-slate-700">
                                {{ (empty($c->guarantor) || in_array(trim(strtolower($c->guarantor)), ['tidak ada', 'tidak', 'none', 'no', ''])) ? 'Tidak Ada' : 'Ada' }}
                            </td>
                            <td class="p-4 text-center text-slate-700">{{ $c->age }}</td>
                            <td class="p-4 text-slate-700 italic text-sm">{{ $c->source }}</td>
                            <td class="p-4 text-center">
                                <button type="button" onclick="submitSingleProcess({{ $c->id }})" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 font-bold px-6 py-1.5 rounded-full shadow-sm transition transform active:scale-95">
                                    <i class="ri-cpu-line me-1"></i> Proses Hitung
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-10 text-center text-slate-500 italic">
                                Tidak ada antrean penyewa baru. Semua data sudah diklasifikasi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </form>
            </div>
            
            <form id="singleProcessForm" action="{{ route('classification.process') }}" method="POST" style="display:none;">
                @csrf
                <input type="hidden" name="customer_id" id="singleCustomerId">
            </form>
            
            <div class="mt-4">
                {{ $customers->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    @include('layouts.script-delete')
    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.customer-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        function submitSingleProcess(id) {
            document.getElementById('singleCustomerId').value = id;
            document.getElementById('singleProcessForm').submit();
        }
    </script>
@endpush