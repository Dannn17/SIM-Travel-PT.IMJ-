@extends('layouts.master')

@section('title', 'Pengujian Metode Naive Bayes')

@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex items-center justify-between mt-[calc(theme('spacing.header')_*_1)] py-5 mb-2">
        <div>
            <h5 class="text-16">Pengujian Metode</h5>
            <p class="text-slate-500 dark:text-zink-200 text-sm mt-1">Evaluasi akurasi algoritma Naive Bayes menggunakan metode Hold-Out</p>
        </div>
    </div>

    {{-- Flash Message --}}
    @if(session('error'))
        <div class="px-4 py-3 text-sm text-red-500 border border-red-200 rounded-md bg-red-50 dark:bg-red-500/20 dark:border-red-500/50 flex items-center gap-3 mb-4">
            <i data-lucide="alert-circle" class="size-4 shrink-0"></i>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    {{-- FORM KONFIGURASI --}}
    <div class="card">
        <div class="card-body">
            <div class="flex items-center gap-3 mb-4">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                    <i data-lucide="flask-conical" class="size-5"></i>
                </div>
                <div>
                    <h6 class="text-15 font-semibold">Konfigurasi Pengujian</h6>
                    <p class="text-slate-500 dark:text-zink-200 text-xs">Total data latih tersedia: <strong>{{ $total ?? $totalData }}</strong> record</p>
                </div>
            </div>

            <form action="{{ route('testing.run') }}" method="POST">
                @csrf
                <div class="flex flex-wrap items-end gap-4">
                    <div class="grow">
                        <label class="inline-block mb-2 text-base font-medium">Persentase Data Training</label>
                        <div class="flex items-center gap-3">
                            <input type="range" id="split_ratio" name="split_ratio"
                                min="50" max="90" step="10"
                                value="{{ $splitRatio ?? 80 }}"
                                class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer dark:bg-zink-500"
                                oninput="updateSplitLabel(this.value)">
                            <span id="split-label" class="text-sm font-semibold text-custom-500 min-w-[100px]">
                                {{ $splitRatio ?? 80 }}% Training / {{ 100 - ($splitRatio ?? 80) }}% Testing
                            </span>
                        </div>
                        <p class="text-xs text-slate-400 mt-1">Geser untuk mengubah proporsi data training vs testing</p>
                    </div>
                    <div class="shrink-0">
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 focus:bg-custom-600 active:bg-custom-600 flex items-center gap-2">
                            <i data-lucide="play" class="size-4"></i>
                            Jalankan Pengujian
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @isset($accuracy)
    {{-- RINGKASAN METRIK --}}
    <div class="grid grid-cols-1 gap-x-5 sm:grid-cols-2 xl:grid-cols-4 mb-5">
        {{-- Akurasi --}}
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100 text-green-500 dark:bg-green-500/20 text-xl font-bold shrink-0">
                        <i data-lucide="check-circle-2" class="size-6"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 dark:text-zink-200 text-sm mb-1">Akurasi</p>
                        <h4 class="text-2xl font-bold {{ $accuracy >= 70 ? 'text-green-500' : ($accuracy >= 50 ? 'text-yellow-500' : 'text-red-500') }}">
                            {{ $accuracy }}%
                        </h4>
                        <p class="text-xs text-slate-400">{{ $totalTest }} data uji</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Presisi --}}
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-500 dark:bg-blue-500/20 text-xl font-bold shrink-0">
                        <i data-lucide="target" class="size-6"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 dark:text-zink-200 text-sm mb-1">Presisi (Macro Avg)</p>
                        <h4 class="text-2xl font-bold text-blue-500">{{ $avgPrecision }}%</h4>
                        <p class="text-xs text-slate-400">Rata-rata semua kelas</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- Recall --}}
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-orange-100 text-orange-500 dark:bg-orange-500/20 text-xl font-bold shrink-0">
                        <i data-lucide="refresh-cw" class="size-6"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 dark:text-zink-200 text-sm mb-1">Recall (Macro Avg)</p>
                        <h4 class="text-2xl font-bold text-orange-500">{{ $avgRecall }}%</h4>
                        <p class="text-xs text-slate-400">Rata-rata semua kelas</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- F1 Score --}}
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-100 text-purple-500 dark:bg-purple-500/20 text-xl font-bold shrink-0">
                        <i data-lucide="bar-chart-2" class="size-6"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 dark:text-zink-200 text-sm mb-1">F1-Score (Macro Avg)</p>
                        <h4 class="text-2xl font-bold text-purple-500">{{ $avgF1 }}%</h4>
                        <p class="text-xs text-slate-400">Harmonic mean P & R</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 mb-5">
        {{-- CONFUSION MATRIX --}}
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="grid-3x3" class="size-5 text-custom-500"></i>
                    <h6 class="text-15 font-semibold">Confusion Matrix</h6>
                    <span class="text-xs text-slate-400 ml-auto">{{ $splitRatio }}% Training / {{ 100 - $splitRatio }}% Testing ({{ $totalTest }} data uji)</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border border-collapse text-sm text-center">
                        <thead>
                            <tr>
                                <th class="border border-slate-200 dark:border-zink-500 bg-slate-100 dark:bg-zink-600 p-2 text-xs" rowspan="2" colspan="2"></th>
                                <th class="border border-slate-200 dark:border-zink-500 bg-custom-50 dark:bg-custom-500/20 p-2 text-custom-600 dark:text-custom-400 font-semibold" colspan="{{ count($labels) }}">
                                    Prediksi
                                </th>
                            </tr>
                            <tr>
                                @foreach($labels as $label)
                                <th class="border border-slate-200 dark:border-zink-500 p-3 bg-slate-50 dark:bg-zink-600
                                    {{ $label == 'Aman' ? 'text-green-600' : ($label == 'Waspada' ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $label }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($labels as $actual)
                            <tr>
                                @if($loop->first)
                                <td class="border border-slate-200 dark:border-zink-500 bg-custom-50 dark:bg-custom-500/20 p-2 font-semibold text-custom-600 dark:text-custom-400 text-xs"
                                    rowspan="{{ count($labels) }}" style="writing-mode: vertical-rl; transform: rotate(180deg);">
                                    Aktual
                                </td>
                                @endif
                                <td class="border border-slate-200 dark:border-zink-500 p-3 bg-slate-50 dark:bg-zink-600 font-semibold
                                    {{ $actual == 'Aman' ? 'text-green-600' : ($actual == 'Waspada' ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $actual }}
                                </td>
                                @foreach($labels as $predicted)
                                <td class="border border-slate-200 dark:border-zink-500 p-3 text-center font-medium
                                    {{ $actual === $predicted
                                        ? 'bg-green-50 dark:bg-green-500/10 text-green-700 dark:text-green-300 font-bold text-lg'
                                        : ($confusionMatrix[$actual][$predicted] > 0 ? 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400' : 'text-slate-400') }}">
                                    {{ $confusionMatrix[$actual][$predicted] }}
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text-xs text-slate-400 mt-2">
                    <span class="inline-block w-3 h-3 bg-green-100 rounded mr-1"></span> Diagonal hijau = prediksi benar (True Positive)
                    &nbsp;|&nbsp;
                    <span class="inline-block w-3 h-3 bg-red-100 rounded mr-1"></span> Merah = prediksi salah
                </p>
            </div>
        </div>

        {{-- METRIK PER KELAS --}}
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="table-2" class="size-5 text-custom-500"></i>
                    <h6 class="text-15 font-semibold">Metrik Per Kelas</h6>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="text-slate-500 bg-slate-50 dark:bg-zink-600 dark:text-zink-200">
                            <tr>
                                <th class="px-3 py-3 text-left font-semibold">Kelas</th>
                                <th class="px-3 py-3 text-center font-semibold">TP</th>
                                <th class="px-3 py-3 text-center font-semibold">FP</th>
                                <th class="px-3 py-3 text-center font-semibold">FN</th>
                                <th class="px-3 py-3 text-center font-semibold">Presisi</th>
                                <th class="px-3 py-3 text-center font-semibold">Recall</th>
                                <th class="px-3 py-3 text-center font-semibold">F1-Score</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                            @foreach($labels as $label)
                            @php $m = $metrics[$label]; @endphp
                            <tr>
                                <td class="px-3 py-3 font-semibold">
                                    <span class="px-2 py-1 rounded-full text-xs
                                        {{ $label == 'Aman' ? 'bg-green-100 text-green-700' : ($label == 'Waspada' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-center text-green-600 font-semibold">{{ $m['tp'] }}</td>
                                <td class="px-3 py-3 text-center text-red-500">{{ $m['fp'] }}</td>
                                <td class="px-3 py-3 text-center text-orange-500">{{ $m['fn'] }}</td>
                                <td class="px-3 py-3 text-center">
                                    <div class="flex items-center gap-2">
                                        <div class="grow bg-slate-100 dark:bg-zink-500 rounded-full h-1.5">
                                            <div class="bg-blue-500 h-1.5 rounded-full" style="width:{{ $m['precision'] }}%"></div>
                                        </div>
                                        <span class="text-xs font-medium min-w-[42px]">{{ $m['precision'] }}%</span>
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <div class="flex items-center gap-2">
                                        <div class="grow bg-slate-100 dark:bg-zink-500 rounded-full h-1.5">
                                            <div class="bg-orange-500 h-1.5 rounded-full" style="width:{{ $m['recall'] }}%"></div>
                                        </div>
                                        <span class="text-xs font-medium min-w-[42px]">{{ $m['recall'] }}%</span>
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <div class="flex items-center gap-2">
                                        <div class="grow bg-slate-100 dark:bg-zink-500 rounded-full h-1.5">
                                            <div class="bg-purple-500 h-1.5 rounded-full" style="width:{{ $m['f1'] }}%"></div>
                                        </div>
                                        <span class="text-xs font-medium min-w-[42px]">{{ $m['f1'] }}%</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            {{-- Rata-rata --}}
                            <tr class="bg-slate-50 dark:bg-zink-600 font-semibold">
                                <td class="px-3 py-3 text-slate-600 dark:text-zink-100">Macro Avg</td>
                                <td class="px-3 py-3 text-center">—</td>
                                <td class="px-3 py-3 text-center">—</td>
                                <td class="px-3 py-3 text-center">—</td>
                                <td class="px-3 py-3 text-center text-blue-600">{{ $avgPrecision }}%</td>
                                <td class="px-3 py-3 text-center text-orange-600">{{ $avgRecall }}%</td>
                                <td class="px-3 py-3 text-center text-purple-600">{{ $avgF1 }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- DETAIL HASIL PREDIKSI --}}
    <div class="card">
        <div class="card-body">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <i data-lucide="list-checks" class="size-5 text-custom-500"></i>
                    <h6 class="text-15 font-semibold">Detail Hasil Prediksi Data Uji</h6>
                    <span class="px-2 py-0.5 text-xs rounded-full bg-custom-100 text-custom-600 dark:bg-custom-500/20">{{ count($detailResults) }} data</span>
                </div>
                <button onclick="window.print()" class="text-slate-500 btn btn-sm border border-slate-200 hover:bg-slate-50 dark:border-zink-500 flex items-center gap-1.5">
                    <i data-lucide="printer" class="size-3.5"></i> Print
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="text-slate-500 bg-slate-50 dark:bg-zink-600 dark:text-zink-200">
                        <tr>
                            <th class="px-3 py-3 text-left">No</th>
                            <th class="px-3 py-3 text-left">Nama</th>
                            <th class="px-3 py-3 text-center">Domisili</th>
                            <th class="px-3 py-3 text-center">Penjamin</th>
                            <th class="px-3 py-3 text-center">Usia</th>
                            <th class="px-3 py-3 text-center">Sumber</th>
                            <th class="px-3 py-3 text-center">Kelas Aktual</th>
                            <th class="px-3 py-3 text-center">Prediksi</th>
                            <th class="px-3 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                        @forelse($detailResults as $i => $row)
                        <tr class="{{ $row['correct'] ? '' : 'bg-red-50/50 dark:bg-red-500/5' }}">
                            <td class="px-3 py-2.5 text-slate-500">{{ $i + 1 }}</td>
                            <td class="px-3 py-2.5 font-medium">{{ $row['name'] }}</td>
                            <td class="px-3 py-2.5 text-center text-slate-500">{{ $row['domicile'] }}</td>
                            <td class="px-3 py-2.5 text-center text-slate-500">{{ $row['guarantor'] }}</td>
                            <td class="px-3 py-2.5 text-center text-slate-500">{{ $row['age'] }}</td>
                            <td class="px-3 py-2.5 text-center text-slate-500">{{ $row['source'] }}</td>
                            <td class="px-3 py-2.5 text-center">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                    {{ $row['actual'] == 'Aman' ? 'bg-green-100 text-green-700' : ($row['actual'] == 'Waspada' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $row['actual'] }}
                                </span>
                            </td>
                            <td class="px-3 py-2.5 text-center">
                                <span class="px-2 py-0.5 rounded-full text-xs font-medium
                                    {{ $row['predicted'] == 'Aman' ? 'bg-green-100 text-green-700' : ($row['predicted'] == 'Waspada' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $row['predicted'] }}
                                </span>
                            </td>
                            <td class="px-3 py-2.5 text-center">
                                @if($row['correct'])
                                    <span class="inline-flex items-center gap-1 text-green-600 text-xs font-semibold">
                                        <i data-lucide="check" class="size-3.5"></i> Benar
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-red-500 text-xs font-semibold">
                                        <i data-lucide="x" class="size-3.5"></i> Salah
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-6 text-slate-400">Tidak ada data hasil pengujian</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endisset

    {{-- NAVIGASI KE BLACK BOX --}}
    <div class="card bg-gradient-to-r from-custom-500 to-purple-600 text-white mb-5">
        <div class="card-body flex items-center justify-between">
            <div>
                <h6 class="text-white font-semibold text-15 mb-1">Pengujian Black Box</h6>
                <p class="text-white/80 text-sm">Lihat hasil pengujian fungsionalitas sistem secara menyeluruh</p>
            </div>
            <a href="{{ route('testing.blackbox') }}"
               class="text-custom-600 btn bg-white hover:bg-white/90 border-white flex items-center gap-2 shrink-0">
                <i data-lucide="clipboard-list" class="size-4"></i>
                Lihat Black Box Testing
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateSplitLabel(val) {
    document.getElementById('split-label').textContent = val + '% Training / ' + (100 - val) + '% Testing';
}
</script>
@endpush
