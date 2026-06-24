@extends('layouts.master')
@section('title')
    {{ __('Customer List') }}
@endsection
@push('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        #detailModal {
            transition: opacity 0.3s ease-in-out;
            backdrop-filter: blur(2px);
        }
    </style>
@endpush

@section('content')
    <x-page-title title="Customer List" pagetitle="Customers" />

    <div class="card" id="customerList">
        <div class="card-body">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-5">
                <div class="flex-1">
                    <form action="{{ route('customers.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
                        <div class="min-w-[180px] flex-grow">
                            <input type="text" name="search" class="form-input w-full border-slate-200 rounded-md py-1.5 text-sm" 
                                placeholder="Search..." value="{{ request('search') }}">
                        </div>

                        <div class="w-36">
                            <select name="filter_status" onchange="this.form.submit()" class="form-select w-full border-slate-200 rounded-md py-1.5 text-sm">
                                <option value="">-- Status --</option>
                                <option value="Sudah Diklasifikasi" {{ request('filter_status') == 'Sudah Diklasifikasi' ? 'selected' : '' }}>Sudah Klasifikasi</option>
                                <option value="Belum Diklasifikasi" {{ request('filter_status') == 'Belum Diklasifikasi' ? 'selected' : '' }}>Belum Klasifikasi</option>
                                <option value="Aman" {{ request('filter_status') == 'Aman' ? 'selected' : '' }}>Aman</option>
                                <option value="Waspada" {{ request('filter_status') == 'Waspada' ? 'selected' : '' }}>Waspada</option>
                                <option value="Bahaya" {{ request('filter_status') == 'Bahaya' ? 'selected' : '' }}>Bahaya</option>
                            </select>
                        </div>

                        <div class="w-40">
                            <select name="sort_by" onchange="this.form.submit()" class="form-select w-full border-slate-200 rounded-md bg-slate-50 py-1.5 text-sm font-medium">
                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Urut: Terbaru</option>
                                <option value="name" {{ request('sort_by') == 'name' && request('sort_order') == 'asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                                <option value="name" {{ request('sort_by') == 'name' && request('sort_order') == 'desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                                <option value="track_record" {{ request('sort_by') == 'track_record' ? 'selected' : '' }}>Riwayat</option>
                                <option value="classification_result" {{ request('sort_by') == 'classification_result' ? 'selected' : '' }}>Klasifikasi</option>
                            </select>
                            <input type="hidden" name="sort_order" value="{{ request('sort_order', 'asc') }}">
                        </div>

                        <div class="flex gap-1">
                            <button type="submit" class="bg-custom-500 text-white px-3 py-1.5 rounded-md hover:bg-custom-600 shadow-sm transition">
                                <i class="ri-search-2-line"></i>
                            </button>
                            <a href="{{ route('customers.index') }}" class="bg-slate-200 text-slate-600 px-3 py-1.5 rounded-md hover:bg-slate-300 shadow-sm flex items-center transition" title="Reset">
                                <i class="ri-refresh-line"></i>
                            </a>
                        </div>
                    </form>
                </div>

                <div class="flex flex-wrap items-center gap-2">
    <a href="{{ route('customers.export', request()->all()) }}" 
       style="background-color: #2563eb !important; color: #ffffff !important;"
       class="text-sm font-bold px-4 py-2 rounded-md shadow-sm transition inline-flex items-center justify-center border-0 cursor-pointer">
        <i class="ri-file-download-line mr-1.5 text-base" style="color: #ffffff !important;"></i> Export
    </a>

    <button data-modal-target="importModal" type="button" 
            style="background-color: #059669 !important; color: #ffffff !important;"
            class="text-sm font-bold px-4 py-2 rounded-md shadow-sm transition flex items-center justify-center border-0 cursor-pointer">
        <i class="ri-file-upload-line mr-1.5 text-base" style="color: #ffffff !important;"></i> Import
    </button>
    
    <button type="button" data-modal-target="showModal"
            style="background-color: #373739ff !important; color: #ffffff !important;"
            class="text-sm font-bold px-4 py-2 rounded-md shadow-sm transition flex items-center justify-center border-0 cursor-pointer">
        <i class="ri-add-line mr-1.5 text-base" style="color: #ffffff !important;"></i> Add
    </button>

    <button type="button" onclick="confirmBulkDelete()" 
            style="background-color: #dc2626 !important; color: #ffffff !important;"
            class="px-3 py-2 rounded-md shadow-sm transition flex items-center justify-center border-0 cursor-pointer" 
            title="Bulk Delete">
        <i class="ri-delete-bin-2-line text-base" style="color: #ffffff !important;"></i>
    </button>
</div>
            </div>

            <div class="overflow-x-auto">
                @if ($errors->any())
                <div id="error-alert" class="relative mb-2 p-3 pr-12 text-sm bg-red-500 border border-transparent rounded-md text-red-50">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 p-3 text-red-200 transition hover:text-red-100">
                        <i data-lucide="x" class="h-5"></i>
                    </button>
                    <span class="font-bold">Gagal menyimpan data!</span>
                    <ul class="list-disc pl-5 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('error'))
                <div id="error-alert-session" class="relative mb-2 p-3 pr-12 text-sm bg-red-500 border border-transparent rounded-md text-red-50">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-0 bottom-0 right-0 p-3 text-red-200 transition hover:text-red-100">
                        <i data-lucide="x" class="h-5"></i>
                    </button>
                    <span class="font-bold">Error!</span> {{ session('error') }}
                </div>
                @endif

                @if (session('success'))
                <div id="alert" class="relative mb-2 p-3 pr-12 text-sm bg-green-500 border border-transparent rounded-md text-green-50">
                    <button data-dismiss="alert" class="absolute top-0 bottom-0 right-0 p-3 text-green-200 transition hover:text-green-100">
                        <i data-lucide="x" class="h-5"></i>
                    </button>
                    <span class="font-bold">Success!</span> {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('customers.bulkDelete') }}" method="POST" id="bulkDeleteForm">
                    @csrf
                    @method('DELETE')
                    <table class="w-full whitespace-nowrap" id="customerTable">
                        <thead class="bg-slate-100 text-slate-500 uppercase text-xs">
                            <tr>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200" style="width: 50px;">
                                    <input type="checkbox" id="checkAll" class="size-4 border rounded-sm cursor-pointer bg-slate-100 border-slate-200">
                                </th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 text-left">Customer</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 text-left">Sumber</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 text-center">Riwayat</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 text-center">Klasifikasi</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @forelse($customers as $item)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-3.5 py-2.5 text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $item->id }}" class="bulk-delete-checkbox size-4 border rounded-sm cursor-pointer border-slate-200">
                                </td>
                                <td class="px-3.5 py-2.5">
                                    <h6 class="mb-1">
                                        <a href="javascript:void(0);" onclick="openDetailModal({{ $item->id }})" class="text-custom-500 hover:underline font-bold">
                                            {{ $item->name }}
                                        </a>
                                    </h6>
                                    <p class="text-slate-400 text-xs">{{ $item->phone ?? '-' }}</p>
                                </td>
                                
                                <td class="px-3.5 py-2.5">
    <div class="flex items-center gap-2">
        @php
            // Kita ubah ke huruf kecil semua agar pengecekan lebih akurat
            $sourceValue = strtolower($item->source); 
            
            $icon = match($sourceValue) {
                'tiktok'    => 'ri-tiktok-fill text-black',
                'facebook'  => 'ri-facebook-box-fill text-blue-600',
                'instagram' => 'ri-instagram-line text-pink-500',
                'whatsapp'  => 'ri-whatsapp-line text-green-500',
                'google'    => 'ri-google-fill text-red-500',
                'teman'     => 'ri-group-line text-orange-500',
                default     => 'ri-user-smile-line text-slate-400'
            };
        @endphp
        <i class="{{ $icon }} text-lg"></i>
        <span class="text-xs font-medium text-slate-600">{{ $item->source ?? 'Lainnya' }}</span>
    </div>
</td>

                                <td class="px-3.5 py-2.5 text-center">
                                    <span class="px-2 py-0.5 text-[10px] font-semibold rounded border {{ $item->track_record == 'Pernah (Telat)' ? 'text-red-500 bg-red-50 border-red-100' : 'text-slate-500 bg-slate-50 border-slate-100' }}">
                                        {{ $item->track_record }}
                                    </span>
                                </td>

                                <td class="px-3.5 py-2.5 text-center">
                                    @php
                                        $label = $item->classification_result ?? 'Belum Diklasifikasi';
                                        $badgeClass = match($label) {
                                            'Aman' => 'bg-green-100 text-green-600 border-green-200',
                                            'Waspada' => 'bg-yellow-100 text-yellow-600 border-yellow-200',
                                            'Bahaya' => 'bg-red-100 text-red-600 border-red-200',
                                            default => 'bg-blue-100 text-blue-600 border-blue-200'
                                        };
                                    @endphp
                                    @if($label != 'Belum Diklasifikasi')
                                        <a href="{{ route('classification.show', $item->id) }}" class="inline-block px-2.5 py-0.5 text-xs font-bold rounded border hover:shadow-md hover:scale-105 transition-all {{ $badgeClass }}" title="Lihat Hasil Klasifikasi">
                                            {{ $label }}
                                        </a>
                                    @else
                                        <span class="px-2.5 py-0.5 text-xs font-bold rounded border {{ $badgeClass }}">
                                            {{ $label }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3.5 py-2.5 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('customers.edit', $item->id) }}" class="text-white bg-yellow-500 btn p-1.5 rounded hover:bg-yellow-600" title="Edit">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <button type="button" onclick="openDetailModal({{ $item->id }})" class="text-white bg-slate-500 btn p-1.5 rounded hover:bg-slate-600" title="Detail Customer">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                        <form action="{{ route('customers.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="button" class="text-white bg-red-500 btn p-1.5 rounded hover:bg-red-600" onclick="confirmSingleDelete(this)" title="Hapus">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-slate-400 italic">No customers found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="flex justify-end mt-4">{{ $customers->links('pagination::tailwind') }}</div>
        </div>
    </div>

    <div id="detailModal" class="fixed inset-0 z-[9999] flex justify-center bg-black/50 hidden" style="backdrop-filter: blur(2px); align-items: flex-start; padding-top: 5rem;">
        <div class="relative bg-white shadow-2xl rounded-xl mx-4 overflow-hidden flex flex-col" style="width: 100%; max-width: 500px; max-height: 83vh;"> 
            <div class="flex items-center justify-between p-4 border-b border-slate-100 bg-slate-50/50 flex-shrink-0">
                <h5 class="text-[10px] font-black uppercase tracking-widest text-slate-500">Customer Profile</h5>
                <button type="button" onclick="closeDetailModal()" class="text-slate-400 hover:text-red-500 transition-colors">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>
            <div id="detailContent" class="p-6 text-slate-600 bg-white overflow-y-auto"></div>
        </div>
    </div>

    @include('customers.create')
    @include('customers.import')
@endsection

@push('scripts')
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.bulk-delete-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        function confirmBulkDelete() {
            let checkedCount = document.querySelectorAll('.bulk-delete-checkbox:checked').length;
            if (checkedCount === 0) {
                Swal.fire({ icon: 'warning', title: 'Pilih data!', text: 'Belum ada data dipilih.' });
                return;
            }
            Swal.fire({
                title: 'Hapus massal?',
                text: `Hapus ${checkedCount} customer?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('bulkDeleteForm').submit();
            });
        }

        function confirmSingleDelete(button) {
            Swal.fire({
                title: 'Hapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) button.closest('form').submit();
            });
        }

        async function openDetailModal(id) {
            const modal = document.getElementById('detailModal');
            const content = document.getElementById('detailContent');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            content.innerHTML = `<div class="flex justify-center py-10"><i class="ri-loader-4-line animate-spin text-3xl text-custom-500"></i></div>`;

            try {
                const response = await fetch(`/customers/${id}`);
                const data = await response.json();
                
                let colorHex = '#3b82f6'; let bgHex = '#eff6ff';
                if(data.classification_result === 'Aman') { colorHex = '#22c55e'; bgHex = '#f0fdf4'; }
                else if(data.classification_result === 'Waspada') { colorHex = '#eab308'; bgHex = '#fefce8'; }
                else if(data.classification_result === 'Bahaya') { colorHex = '#ef4444'; bgHex = '#fef2f2'; }

                content.innerHTML = `
                    <div class="text-center">
                        <div class="mb-4">
                            <h3 class="text-xl font-black text-slate-800">${data.name}</h3>
                            <p class="text-[11px] text-slate-400 font-medium">Sumber: ${data.source ?? 'Lainnya'}</p>
                        </div>
                        <div class="inline-block px-5 py-1.5 rounded-full text-[10px] font-black uppercase mb-8" 
                            style="background-color: ${bgHex}; color: ${colorHex}; border: 2px solid ${colorHex}20;">
                            Hasil Klasifikasi: ${data.classification_result ?? 'BELUM DIKLASIFIKASI'}
                        </div>
                        <div class="grid grid-cols-2 gap-y-6 gap-x-4 text-left border-y border-slate-100 py-6 mb-6">
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-1">WhatsApp</span>
                                <span class="text-sm font-bold text-slate-700">${data.phone ?? '-'}</span>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-1">Kategori Usia</span>
                                <span class="text-sm font-bold text-custom-600">${data.age ?? '-'}</span>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-1">Domisili</span>
                                <span class="text-sm font-bold text-slate-700">${data.domicile ?? '-'}</span>
                            </div>
                            <div>
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-1">Penjamin</span>
                                <span class="text-sm font-bold text-slate-700">${data.guarantor ?? 'Tidak Ada'}</span>
                            </div>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl text-left border border-slate-100">
                            <span class="block text-[9px] font-black text-slate-400 uppercase mb-1">Alamat Lengkap</span>
                            <p class="text-xs text-slate-600 leading-relaxed font-medium">${data.address ?? 'Alamat belum diisi.'}</p>
                        </div>
                    </div>`;
            } catch (e) {
                content.innerHTML = `<div class="py-10 text-center text-red-500 font-bold uppercase text-[10px]">Gagal mengambil data dari server.</div>`;
            }
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
@endpush