@extends('layouts.master')

@section('title', 'Pengujian Black Box')

@push('css')
<style>
    @media print {
        .no-print { display: none !important; }
        .card { border: 1px solid #e2e8f0 !important; box-shadow: none !important; }
        body { background: white !important; }
    }
</style>
@endpush

@section('content')
<div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
    <div class="flex items-center justify-between mt-[calc(theme('spacing.header')_*_1)] py-5 mb-2">
        <div>
            <h5 class="text-16">Pengujian Black Box</h5>
            <p class="text-slate-500 dark:text-zink-200 text-sm mt-1">Pengujian fungsionalitas sistem secara menyeluruh (Black Box Testing)</p>
        </div>
        <div class="flex items-center gap-2 no-print">
            <a href="{{ route('testing.index') }}" class="text-slate-500 btn border border-slate-200 dark:border-zink-500 hover:bg-slate-50 flex items-center gap-1.5">
                <i data-lucide="arrow-left" class="size-4"></i> Kembali
            </a>
            <button onclick="window.print()" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 flex items-center gap-2">
                <i data-lucide="printer" class="size-4"></i> Print / PDF
            </button>
        </div>
    </div>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5 no-print">
        <div class="card text-center">
            <div class="card-body py-4">
                <p class="text-sm text-slate-500 mb-1">Total Skenario</p>
                <h4 class="text-3xl font-bold text-custom-500">{{ count($testCases) }}</h4>
            </div>
        </div>
        <div class="card text-center">
            <div class="card-body py-4">
                <p class="text-sm text-slate-500 mb-1">Berhasil ✅</p>
                <h4 class="text-3xl font-bold text-green-500">{{ collect($testCases)->where('status', 'Berhasil')->count() }}</h4>
            </div>
        </div>
        <div class="card text-center">
            <div class="card-body py-4">
                <p class="text-sm text-slate-500 mb-1">Persentase</p>
                @php
                    $pass = collect($testCases)->where('status', 'Berhasil')->count();
                    $pct = count($testCases) > 0 ? round($pass / count($testCases) * 100, 1) : 0;
                @endphp
                <h4 class="text-3xl font-bold {{ $pct == 100 ? 'text-green-500' : 'text-yellow-500' }}">{{ $pct }}%</h4>
            </div>
        </div>
    </div>

    {{-- Tabel Black Box --}}
    <div class="card">
        <div class="card-body">
            <div class="flex items-center gap-2 mb-4">
                <i data-lucide="clipboard-check" class="size-5 text-custom-500"></i>
                <h6 class="text-15 font-semibold">Tabel Pengujian Black Box</h6>
                <span class="text-xs text-slate-400 ml-auto">SIM Travel PT. IMJ</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border border-collapse">
                    <thead class="bg-slate-700 text-white dark:bg-zink-600">
                        <tr>
                            <th class="border border-slate-600 px-3 py-3 text-center w-10">No</th>
                            <th class="border border-slate-600 px-3 py-3 text-left w-32">Modul / Fungsi</th>
                            <th class="border border-slate-600 px-3 py-3 text-left w-40">Skenario Pengujian</th>
                            <th class="border border-slate-600 px-3 py-3 text-left">Data Input</th>
                            <th class="border border-slate-600 px-3 py-3 text-left">Output yang Diharapkan</th>
                            <th class="border border-slate-600 px-3 py-3 text-left">Output Sistem</th>
                            <th class="border border-slate-600 px-3 py-3 text-center w-24">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testCases as $i => $tc)
                        @php
                            $isFirstInGroup = $i === 0 || $testCases[$i-1]['group'] !== $tc['group'];
                            $groupCount = collect($testCases)->where('group', $tc['group'])->count();
                        @endphp
                        <tr class="{{ $i % 2 == 0 ? 'bg-white dark:bg-zink-700' : 'bg-slate-50 dark:bg-zink-600' }}">
                            <td class="border border-slate-200 dark:border-zink-500 px-3 py-2.5 text-center text-slate-500">{{ $i + 1 }}</td>
                            @if($isFirstInGroup)
                            <td class="border border-slate-200 dark:border-zink-500 px-3 py-2.5 font-semibold align-top bg-custom-50 dark:bg-custom-500/10 text-custom-700 dark:text-custom-300"
                                rowspan="{{ $groupCount }}">
                                {{ $tc['group'] }}
                            </td>
                            @endif
                            <td class="border border-slate-200 dark:border-zink-500 px-3 py-2.5">{{ $tc['scenario'] }}</td>
                            <td class="border border-slate-200 dark:border-zink-500 px-3 py-2.5 text-slate-500 text-xs">{{ $tc['input'] }}</td>
                            <td class="border border-slate-200 dark:border-zink-500 px-3 py-2.5 text-xs">{{ $tc['expected'] }}</td>
                            <td class="border border-slate-200 dark:border-zink-500 px-3 py-2.5 text-xs text-slate-600 dark:text-zink-300">{{ $tc['actual_output'] }}</td>
                            <td class="border border-slate-200 dark:border-zink-500 px-3 py-2.5 text-center">
                                @if($tc['status'] === 'Berhasil')
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400">
                                        <i data-lucide="check" class="size-3"></i> Berhasil
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400">
                                        <i data-lucide="x" class="size-3"></i> Gagal
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Kesimpulan --}}
            <div class="mt-6 p-4 bg-slate-50 dark:bg-zink-600 rounded-lg border border-slate-200 dark:border-zink-500">
                <h6 class="font-semibold text-slate-700 dark:text-zink-100 mb-2">Kesimpulan Pengujian Black Box</h6>
                <p class="text-sm text-slate-600 dark:text-zink-300">
                    Berdasarkan hasil pengujian Black Box Testing yang telah dilakukan terhadap <strong>{{ count($testCases) }} skenario uji</strong>
                    pada sistem SIM Travel PT. IMJ, seluruh fungsi yang diuji memberikan output yang sesuai dengan yang diharapkan.
                    Tingkat keberhasilan pengujian mencapai <strong class="text-custom-600">{{ $pct }}%</strong>,
                    dengan <strong>{{ $pass }} skenario berhasil</strong> dari total {{ count($testCases) }} skenario yang diujikan.
                    Hal ini menunjukkan bahwa sistem berjalan dengan baik secara fungsional.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
