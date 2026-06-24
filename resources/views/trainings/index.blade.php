@extends('layouts.master')
@section('title')
    {{ __('Data Training') }}
@endsection
@push('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
<div class="p-6 bg-slate-50 min-h-screen">
    <div class="bg-custom-500 px-6 py-4 rounded-t-lg shadow-md">
        <h1 class="text-white text-xl font-bold">Input Data Training (Knowledge Base)</h1>
    </div>

    <div class="bg-white p-6 shadow-md rounded-b-lg">
        
        <section class="mb-10">
            <div class="inline-block bg-custom-100 text-custom-700 px-5 py-1.5 rounded-t-md font-bold text-sm">
                Tambah Data Training
            </div>
            <div class="border-2 border-custom-100 p-6 rounded-b-lg rounded-r-lg bg-white">
                
                <div class="mb-6 pb-4 border-b border-slate-100">
                    <form action="{{ route('trainings.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3">
                        @csrf
                        <input type="file" name="file" required class="block w-auto text-sm text-slate-900 border border-slate-300 rounded-lg cursor-pointer bg-slate-50 focus:outline-none p-1">
                        <button type="submit" class="text-white btn bg-green-500 border-green-500 hover:bg-green-600 font-bold shadow-sm">
                            <i class="ri-file-excel-line"></i> Import Excel
                        </button>
                    </form>
                </div>

                <form id="formTraining" class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-5">
                    @csrf
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <label class="w-40 text-slate-800 font-bold">Nama Penyewa</label>
                            <input type="text" name="name" id="name" required class="flex-1 form-input border-slate-300 focus:border-custom-500" placeholder="Nama lengkap...">
                        </div>
                        <div class="flex items-center">
                            <label class="w-40 text-slate-800 font-bold">Domisili</label>
                            <select name="domicile" id="domicile" required class="flex-1 form-input border-slate-300 focus:border-custom-500">
                                <option value="Dalam Kota">Dalam Kota</option>
                                <option value="Luar Kota">Luar Kota</option>
                            </select>
                        </div>
                        <div class="flex items-center">
                            <label class="w-40 text-slate-800 font-bold">Sumber</label>
                            <select name="source" id="source" required class="flex-1 form-input border-slate-300 focus:border-custom-500">
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Facebook">Facebook</option>
                                <option value="TikTok">TikTok</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Google">Google</option>
                                <option value="Teman">Teman</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <label class="w-40 text-slate-800 font-bold">Penjamin</label>
                            <select name="guarantor" id="guarantor" required class="flex-1 form-input border-slate-300 focus:border-custom-500">
                                <option value="Ada">Ada</option>
                                <option value="Tidak Ada">Tidak Ada</option>
                            </select>
                        </div>
                        <div class="flex items-center">
                            <label class="w-40 text-slate-800 font-bold">Usia</label>
                            <select name="age" id="age" required class="flex-1 form-input border-slate-300 focus:border-custom-500">
                                <option value="Muda">Muda (< 25)</option>
                                <option value="Dewasa">Dewasa (25-40)</option>
                                <option value="Tua">Tua (> 40)</option>
                            </select>
                        </div>
                    </div>

                    <div class="md:col-span-2 flex items-center bg-red-50 p-3 rounded-md border border-red-200">
                        <label class="w-40 text-red-700 font-black tracking-widest">HASIL LABEL</label>
                        <select name="class_label" id="class_label" required class="flex-1 form-input border-red-300 text-red-700 font-bold">
                            <option value="Aman">Aman (Layak)</option>
                            <option value="Waspada">Waspada</option>
                            <option value="Bahaya">Bahaya (Tidak Layak)</option>
                        </select>
                    </div>
                </form>

                <div class="flex justify-end gap-4 mt-8">
                    <button type="button" id="btnSimpan" onclick="handleSimpan()" 
                        class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 shadow-md font-bold px-10 py-2.5 rounded-full transition transform active:scale-95">
                        <i class="ri-save-line me-1"></i> Simpan Data Training
                    </button>
                    <button type="button" onclick="document.getElementById('formTraining').reset()" 
                        class="text-slate-500 btn bg-slate-200 border-slate-200 hover:bg-slate-300">
                        Batal
                    </button>
                </div>
            </div>
        </section>

        <section>
            <div class="inline-block bg-slate-100 text-slate-700 px-5 py-1.5 rounded-t-md font-bold text-sm">
                Data Training Terdaftar (Knowledge Base)
            </div>

            <div class="flex flex-wrap justify-between items-center mb-4 gap-4 p-4 border border-slate-200 bg-white shadow-sm rounded-r-lg">
                <!-- Kosongkan Data Form -->
                <form action="{{ route('trainings.truncate') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus SEMUA data latih? Tindakan ini tidak dapat dibatalkan.');">
                    @csrf
                    <button type="submit" class="text-white btn bg-red-500 border-red-500 hover:bg-red-600 font-bold shadow-sm px-4 py-2 rounded-md text-sm">
                        <i class="ri-delete-bin-5-line"></i> Kosongkan Data
                    </button>
                </form>

                <!-- Search Form -->
                <form action="{{ route('trainings.index') }}" method="GET" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data..." class="form-input border-slate-300 focus:border-custom-500 rounded-md px-3 py-1.5 text-sm w-64">
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                        <input type="hidden" name="direction" value="{{ request('direction') }}">
                    @endif
                    <button type="submit" class="text-white btn bg-slate-600 border-slate-600 hover:bg-slate-700 shadow-sm px-3 py-1.5 rounded-md text-sm">
                        <i class="ri-search-line"></i> Cari
                    </button>
                    @if(request('search') || request('sort'))
                        <a href="{{ route('trainings.index') }}" class="text-slate-600 btn bg-slate-200 border-slate-200 hover:bg-slate-300 px-3 py-1.5 rounded-md text-sm">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
            <div class="border border-slate-200 rounded-b-lg rounded-r-lg overflow-hidden shadow-sm overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="bg-slate-500 text-white">
                        <tr>
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
                            <th class="p-4 border-r border-slate-400 text-center">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'source', 'direction' => request('sort') == 'source' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex justify-center gap-1 items-center hover:text-slate-200">
                                    Sumber
                                    @if(request('sort') == 'source')
                                        <i class="{{ request('direction') == 'asc' ? 'ri-sort-asc' : 'ri-sort-desc' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="p-4 border-r border-slate-400 text-center">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'class_label', 'direction' => request('sort') == 'class_label' && request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="flex justify-center gap-1 items-center hover:text-slate-200">
                                    Label Kelas
                                    @if(request('sort') == 'class_label')
                                        <i class="{{ request('direction') == 'asc' ? 'ri-sort-asc' : 'ri-sort-desc' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="trainingTableBody" class="divide-y divide-slate-200">
                        @forelse($trainings as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 font-medium text-slate-900">{{ $item->name }}</td>
                            <td class="p-4 text-slate-700">{{ $item->domicile }}</td>
                            <td class="p-4 text-center text-slate-700">{{ $item->guarantor }}</td>
                            <td class="p-4 text-center">
                                <span class="text-[11px] font-bold px-3 py-1 rounded bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $item->age }}
                                </span>
                            </td>
                            <td class="p-4 text-center text-slate-700 italic text-xs">{{ $item->source }}</td>
                            <td class="p-4 text-center">
                                <span class="px-2.5 py-0.5 text-xs font-bold rounded border 
                                    {{ $item->class_label == 'Aman' ? 'bg-green-100 border-green-200 text-green-500' : ($item->class_label == 'Waspada' ? 'bg-yellow-100 border-yellow-200 text-yellow-500' : 'bg-red-100 border-red-200 text-red-500') }}">
                                    {{ $item->class_label }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('trainings.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition" onclick="return confirm('Hapus data latih ini?')">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-10 text-center text-slate-400 italic">Belum ada data training. Silakan tambah manual atau import Excel.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $trainings->links('pagination::tailwind') }}
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    async function handleSimpan() {
        const btn = document.getElementById('btnSimpan');
        const form = document.getElementById('formTraining');
        
        if(!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="ri-loader-4-line animate-spin"></i> Menyimpan...';

        try {
            const formData = new FormData(form);
            const response = await fetch("{{ route('trainings.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                const tableBody = document.getElementById('trainingTableBody');
                
                const row = `
                    <tr class="border-b bg-green-50 transition-all duration-500">
                        <td class="p-4 font-medium text-slate-900">${result.data.name}</td>
                        <td class="p-4 text-slate-700">${result.data.domicile}</td>
                        <td class="p-4 text-center text-slate-700">${result.data.guarantor}</td>
                        <td class="p-4 text-center">
                             <span class="text-[11px] font-bold px-3 py-1 rounded bg-slate-100 text-slate-700 border border-slate-200">
                                ${result.data.age}
                             </span>
                        </td>
                        <td class="p-4 text-center text-slate-700 italic text-xs">${result.data.source}</td>
                        <td class="p-4 text-center">
                            <span class="px-2.5 py-0.5 text-xs font-bold rounded border bg-blue-100 border-blue-200 text-blue-500">
                                ${result.data.class_label}
                            </span>
                        </td>
                        <td class="p-4 text-center text-slate-400 italic text-xs">Baru saja</td>
                    </tr>
                `;
                
                // Jika tabel tadinya kosong (ada row "Belum ada data"), hapus dulu baris kosongnya
                if (tableBody.innerHTML.includes('Belum ada data training')) {
                    tableBody.innerHTML = '';
                }

                tableBody.insertAdjacentHTML('afterbegin', row);
                
                form.reset();
                document.getElementById('name').focus();
                
                // Optional: Notifikasi sukses
                if(window.Swal) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tersimpan!',
                        text: 'Data training berhasil ditambahkan ke basis pengetahuan.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }

            } else {
                alert("Gagal menyimpan data: " + (result.message || "Terjadi kesalahan server"));
            }
        } catch (error) {
            console.error(error);
            alert('Terjadi kesalahan koneksi.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="ri-save-line me-1"></i> Simpan Data Training';
    }
</script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: '{!! implode("<br>", $errors->all()) !!}'
            });
        @endif
    });
</script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endpush