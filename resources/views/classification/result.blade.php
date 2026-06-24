@extends('layouts.master')
@section('title')
    {{ __('Hasil Klasifikasi') }}
@endsection
@push('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
<div class="p-6 bg-slate-50 min-h-screen">
    <div class="bg-custom-500 px-6 py-4 rounded-t-lg shadow-md flex justify-between items-center">
        <h1 class="text-white text-xl font-bold">Hasil Analisis Naive Bayes</h1>
        <a href="{{ route('classification.index') }}" class="bg-white/20 text-white px-4 py-1 rounded text-sm hover:bg-white/30 transition">Kembali</a>
    </div>

    <div class="bg-white p-6 shadow-md rounded-b-lg space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-slate-50 rounded-lg border border-slate-200">
            <div>
                <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest">Nama Penyewa (Data Uji)</p>
                <p class="text-lg font-bold text-slate-800">{{ $customer->name }}</p>
            </div>
            <div class="md:text-right">
                <p class="text-[10px] text-slate-500 uppercase font-black tracking-widest">Keputusan Akhir Sistem</p>
                <span class="text-xl font-black {{ $finalResult == 'Aman' ? 'text-green-600' : ($finalResult == 'Waspada' ? 'text-yellow-600' : 'text-red-600') }}">
                    {{ strtoupper($finalResult) }}
                </span>
            </div>
        </div>

        <div>
            <h3 class="font-bold text-slate-700 mb-3 flex items-center">
                <i class="ri-calculator-line me-2 text-custom-500 text-lg"></i> Detail Probabilitas Likelihood P(X|Ci)
            </h3>
            <div class="overflow-x-auto border border-slate-200 rounded-lg shadow-sm">
                <table class="w-full text-sm text-left whitespace-nowrap">
                    <thead class="bg-slate-100 text-slate-700 uppercase text-[11px] font-bold">
                        <tr>
                            <th class="p-3 border-b">Kriteria / Fitur</th>
                            @foreach($calculation as $label => $val)
                                <th class="p-3 border-b text-center">Kelas: {{ $label }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(['Domisili', 'Penjamin', 'Usia', 'Sumber'] as $kriteria)
                        <tr>
                            <td class="p-3 border-b font-medium bg-slate-50/50">{{ $kriteria }}</td>
                            @foreach($calculation as $label => $val)
                                <td class="p-3 border-b text-center text-slate-600 font-mono">
                                    {{-- Jika 0, kita beri tanda khusus --}}
                                    @if($val['details'][$kriteria] == 0)
                                        <span class="text-red-500 font-bold">0.000000</span>
                                    @else
                                        {{ number_format($val['details'][$kriteria], 6) }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                        
                        <tr class="bg-blue-50/30 font-semibold italic text-blue-800">
                            <td class="p-3 border-t border-b">Prior Probability P(Ci)</td>
                            @foreach($calculation as $label => $val)
                                <td class="p-3 border-t border-b text-center font-mono">
                                    {{ number_format($val['pClass'], 6) }}
                                </td>
                            @endforeach
                        </tr>

                        <tr class="bg-slate-800 text-white font-bold">
                            <td class="p-3">SKOR AKHIR (Posterior)</td>
                            @foreach($calculation as $label => $val)
                                <td class="p-3 text-center font-mono {{ $label == $finalResult ? 'bg-custom-500 text-white' : '' }}">
                                    {{ number_format($val['score'], 12) }}
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- Keterangan kecil --}}
            <p class="text-[10px] text-slate-400 mt-2 italic">* Perhitungan menggunakan rumus Naive Bayes Klasik (Standard).</p>
        </div>

        <div class="p-4 rounded-lg border-2 {{ $finalResult == 'Aman' ? 'border-green-200 bg-green-50 text-green-800' : ($finalResult == 'Waspada' ? 'border-yellow-200 bg-yellow-50 text-yellow-800' : 'border-red-200 bg-red-50 text-red-800') }}">
            <div class="flex items-start gap-3">
                <div class="text-2xl">
                    @if($finalResult == 'Aman') <i class="ri-checkbox-circle-fill"></i>
                    @elseif($finalResult == 'Waspada') <i class="ri-error-warning-fill"></i>
                    @else <i class="ri-close-circle-fill"></i>
                    @endif
                </div>
                <div>
                    <h4 class="font-black uppercase text-sm mb-1">Rekomendasi Berdasarkan Analisis:</h4>
                    <p class="text-sm leading-relaxed font-medium">
                        @if($finalResult == 'Aman')
                            Hasil perkalian probabilitas menunjukkan skor tertinggi pada kategori <strong>AMAN</strong>. Sistem merekomendasikan pemberian izin sewa kepada <strong>{{ $customer->name }}</strong>.
                        @elseif($finalResult == 'Waspada')
                            Hasil klasifikasi menunjukkan status <strong>WASPADA</strong>. Admin disarankan untuk melakukan pengecekan data fisik lebih teliti atau meminta jaminan tambahan.
                        @else
                            Sistem mendeteksi risiko tinggi (<strong>BAHAYA</strong>). Sangat disarankan untuk menolak pengajuan sewa ini guna menghindari risiko kehilangan unit kendaraan di PT Ikhwanin Mulyo Joyo.
                        @endif
                    </p>
                </div>
            </div>
        </div>

{{-- menu untuk verifikasi dan memasukan ke data train --}}
        <div class="mt-8 border-t border-slate-200 pt-6">
            <h3 class="font-bold text-slate-700 mb-3 flex items-center">
                <i class="ri-checkbox-multiple-line me-2 text-custom-500 text-lg"></i> Verifikasi Manual & Tambah ke Data Latih
            </h3>
            <p class="text-sm text-slate-500 mb-4">Jika Anda merasa keputusan sistem kurang tepat setelah melakukan pengecekan manual, Anda dapat merevisi statusnya di sini. Data ini akan otomatis masuk ke tabel Data Latih agar sistem Naive Bayes menjadi lebih pintar ke depannya.</p>
            
            <form action="{{ route('classification.verify', $customer->id) }}" method="POST" class="bg-slate-50 p-4 border border-slate-200 rounded-lg flex flex-wrap items-end gap-4">
                @csrf
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Aktual (Kenyataan)</label>
                    <select name="actual_status" required class="form-select border-slate-300 focus:border-custom-500 rounded-md w-full">
                        <option value="">-- Pilih Status --</option>
                        <option value="Aman" {{ $finalResult == 'Aman' ? 'selected' : '' }}>Aman</option>
                        <option value="Waspada" {{ $finalResult == 'Waspada' ? 'selected' : '' }}>Waspada</option>
                        <option value="Bahaya" {{ $finalResult == 'Bahaya' ? 'selected' : '' }}>Bahaya</option>
                    </select>
                </div>
                <button type="submit" 
                    style="background-color: #2563eb !important; color: #ffffff !important;"
                    class="text-sm font-bold py-2 px-6 rounded-md shadow-sm transition inline-flex items-center justify-center border-0 cursor-pointer hover:opacity-90">
                    <i class="ri-save-line mr-1.5 text-base" style="color: #ffffff !important;"></i> Verifikasi & Simpan
                </button>
            </form>
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
@endpush