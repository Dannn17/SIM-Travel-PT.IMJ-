<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Training;

class TestingController extends Controller
{
    public function index()
    {
        $totalData = Training::count();
        return view('testing.index', compact('totalData'));
    }

    public function runTest(Request $request)
    {
        $request->validate([
            'split_ratio' => 'required|integer|min:50|max:90',
        ]);

        $splitRatio = $request->split_ratio; // misalnya 80 = 80% training
        $labels = ['Aman', 'Waspada', 'Bahaya'];

        // Ambil semua data training, di-shuffle
        $allData = Training::all()->shuffle()->values();
        $total = $allData->count();

        if ($total < 5) {
            return back()->with('error', 'Data latih terlalu sedikit untuk dilakukan pengujian (minimal 5 data).');
        }

        // Split data
        $trainCount = (int) round($total * $splitRatio / 100);
        $trainSet   = $allData->slice(0, $trainCount)->values();
        $testSet    = $allData->slice($trainCount)->values();

        if ($testSet->count() == 0) {
            return back()->with('error', 'Data testing kosong. Kurangi persentase split.');
        }

        // Inisialisasi confusion matrix: matrix[aktual][prediksi]
        $confusionMatrix = [];
        foreach ($labels as $actual) {
            foreach ($labels as $predicted) {
                $confusionMatrix[$actual][$predicted] = 0;
            }
        }

        $detailResults = [];

        foreach ($testSet as $testItem) {
            $actualLabel = $this->normalizeLabel($testItem->class_label);
            $predictedLabel = $this->classify($testItem, $trainSet, $labels);

            // Pastikan label valid
            if (!in_array($actualLabel, $labels)) $actualLabel = 'Waspada';
            if (!in_array($predictedLabel, $labels)) $predictedLabel = 'Waspada';

            $confusionMatrix[$actualLabel][$predictedLabel]++;

            $detailResults[] = [
                'name'      => $testItem->name,
                'domicile'  => $testItem->domicile,
                'guarantor' => $testItem->guarantor,
                'age'       => $testItem->age,
                'source'    => $testItem->source,
                'actual'    => $actualLabel,
                'predicted' => $predictedLabel,
                'correct'   => $actualLabel === $predictedLabel,
            ];
        }

        // Hitung metrik per kelas
        $metrics = [];
        $totalCorrect = 0;
        $totalTest = $testSet->count();

        foreach ($labels as $label) {
            $tp = $confusionMatrix[$label][$label];
            $fp = 0; // prediksi = label, aktual != label
            $fn = 0; // aktual = label, prediksi != label

            foreach ($labels as $other) {
                if ($other !== $label) {
                    $fp += $confusionMatrix[$other][$label];
                    $fn += $confusionMatrix[$label][$other];
                }
            }

            $precision = ($tp + $fp) > 0 ? $tp / ($tp + $fp) : 0;
            $recall    = ($tp + $fn) > 0 ? $tp / ($tp + $fn) : 0;
            $f1        = ($precision + $recall) > 0
                ? 2 * $precision * $recall / ($precision + $recall)
                : 0;

            $totalCorrect += $tp;

            $metrics[$label] = [
                'tp'        => $tp,
                'fp'        => $fp,
                'fn'        => $fn,
                'precision' => round($precision * 100, 2),
                'recall'    => round($recall * 100, 2),
                'f1'        => round($f1 * 100, 2),
            ];
        }

        $accuracy = $totalTest > 0 ? round(($totalCorrect / $totalTest) * 100, 2) : 0;

        // Rata-rata macro
        $avgPrecision = round(collect($metrics)->avg('precision'), 2);
        $avgRecall    = round(collect($metrics)->avg('recall'), 2);
        $avgF1        = round(collect($metrics)->avg('f1'), 2);

        return view('testing.index', compact(
            'confusionMatrix',
            'metrics',
            'accuracy',
            'avgPrecision',
            'avgRecall',
            'avgF1',
            'detailResults',
            'labels',
            'splitRatio',
            'trainCount',
            'totalTest',
            'total'
        ));
    }

    public function blackbox()
    {
        $testCases = [
            // ====== AUTENTIKASI ======
            ['group' => 'Login', 'scenario' => 'Login dengan kredensial valid', 'input' => 'Email & password terdaftar', 'expected' => 'Redirect ke halaman dashboard sesuai role', 'actual_output' => 'Berhasil redirect ke dashboard', 'status' => 'Berhasil'],
            ['group' => 'Login', 'scenario' => 'Login dengan password salah', 'input' => 'Email valid, password salah', 'expected' => 'Tampil pesan error "Kredensial tidak valid"', 'actual_output' => 'Menampilkan pesan error login gagal', 'status' => 'Berhasil'],
            ['group' => 'Login', 'scenario' => 'Login dengan email tidak terdaftar', 'input' => 'Email tidak terdaftar', 'expected' => 'Tampil pesan error', 'actual_output' => 'Menampilkan pesan error', 'status' => 'Berhasil'],
            ['group' => 'Login', 'scenario' => 'Logout dari sistem', 'input' => 'Klik tombol Logout', 'expected' => 'Sesi berakhir, redirect ke halaman login', 'actual_output' => 'Sesi dihapus, redirect ke /login', 'status' => 'Berhasil'],

            // ====== DATA PENYEWA ======
            ['group' => 'Data Penyewa', 'scenario' => 'Tambah data penyewa baru (valid)', 'input' => 'Semua field wajib diisi dengan data valid', 'expected' => 'Data tersimpan, muncul notifikasi sukses', 'actual_output' => 'Data berhasil ditambahkan ke database', 'status' => 'Berhasil'],
            ['group' => 'Data Penyewa', 'scenario' => 'Tambah data penyewa tanpa field wajib', 'input' => 'Field nama dikosongkan', 'expected' => 'Validasi gagal, tampil pesan error field wajib', 'actual_output' => 'Menampilkan pesan validasi error', 'status' => 'Berhasil'],
            ['group' => 'Data Penyewa', 'scenario' => 'Edit data penyewa', 'input' => 'Ubah nama dan nomor HP', 'expected' => 'Data berhasil diperbarui', 'actual_output' => 'Data terupdate di database', 'status' => 'Berhasil'],
            ['group' => 'Data Penyewa', 'scenario' => 'Hapus satu data penyewa', 'input' => 'Klik hapus pada data tertentu', 'expected' => 'Data terhapus, muncul notifikasi sukses', 'actual_output' => 'Data berhasil dihapus', 'status' => 'Berhasil'],
            ['group' => 'Data Penyewa', 'scenario' => 'Hapus banyak data sekaligus', 'input' => 'Pilih beberapa data lalu hapus massal', 'expected' => 'Semua data yang dipilih terhapus', 'actual_output' => 'Data massal berhasil dihapus', 'status' => 'Berhasil'],
            ['group' => 'Data Penyewa', 'scenario' => 'Import data dari file Excel', 'input' => 'Upload file .xlsx berformat benar', 'expected' => 'Data dari Excel masuk ke database', 'actual_output' => 'Data berhasil di-import', 'status' => 'Berhasil'],
            ['group' => 'Data Penyewa', 'scenario' => 'Export data ke Excel', 'input' => 'Klik tombol Export', 'expected' => 'File Excel terunduh otomatis', 'actual_output' => 'File Data_Penyewa_IMJ.xlsx berhasil diunduh', 'status' => 'Berhasil'],
            ['group' => 'Data Penyewa', 'scenario' => 'Pencarian data penyewa', 'input' => 'Ketik nama atau nomor HP', 'expected' => 'Tampil data yang cocok dengan kata kunci', 'actual_output' => 'Data berhasil difilter sesuai pencarian', 'status' => 'Berhasil'],

            // ====== DATA LATIH ======
            ['group' => 'Data Latih', 'scenario' => 'Tambah data latih baru', 'input' => 'Isi semua field dengan nilai valid', 'expected' => 'Data tersimpan, muncul notifikasi sukses', 'actual_output' => 'Data latih berhasil ditambahkan', 'status' => 'Berhasil'],
            ['group' => 'Data Latih', 'scenario' => 'Import data latih dari Excel', 'input' => 'Upload file .xlsx berformat benar', 'expected' => 'Data Training berhasil ditambahkan massal', 'actual_output' => 'Data berhasil di-import ke tabel trainings', 'status' => 'Berhasil'],
            ['group' => 'Data Latih', 'scenario' => 'Hapus satu data latih', 'input' => 'Klik hapus pada baris tertentu', 'expected' => 'Data latih terhapus', 'actual_output' => 'Data berhasil dihapus', 'status' => 'Berhasil'],
            ['group' => 'Data Latih', 'scenario' => 'Kosongkan semua data latih', 'input' => 'Klik tombol "Kosongkan Semua"', 'expected' => 'Seluruh data latih terhapus', 'actual_output' => 'Semua data latih berhasil dihapus', 'status' => 'Berhasil'],

            // ====== KLASIFIKASI ======
            ['group' => 'Klasifikasi Naive Bayes', 'scenario' => 'Klasifikasi satu penyewa', 'input' => 'Pilih satu penyewa lalu klik Klasifikasikan', 'expected' => 'Tampil hasil klasifikasi (Aman/Waspada/Bahaya) beserta detail perhitungan', 'actual_output' => 'Hasil klasifikasi dan rincian probabilitas tampil', 'status' => 'Berhasil'],
            ['group' => 'Klasifikasi Naive Bayes', 'scenario' => 'Klasifikasi massal banyak penyewa', 'input' => 'Centang beberapa penyewa, klik Klasifikasi Massal', 'expected' => 'Semua penyewa terpilih mendapat hasil klasifikasi', 'actual_output' => 'Semua penyewa berhasil diklasifikasikan', 'status' => 'Berhasil'],
            ['group' => 'Klasifikasi Naive Bayes', 'scenario' => 'Klasifikasi ketika data latih kosong', 'input' => 'Data latih dikosongkan, lalu lakukan klasifikasi', 'expected' => 'Tampil pesan error "Data training kosong"', 'actual_output' => 'Muncul pesan error dan tidak melanjutkan proses', 'status' => 'Berhasil'],
            ['group' => 'Klasifikasi Naive Bayes', 'scenario' => 'Lihat detail hasil klasifikasi', 'input' => 'Klik tombol detail pada penyewa yang sudah diklasifikasi', 'expected' => 'Tampil halaman rincian perhitungan probabilitas', 'actual_output' => 'Halaman detail perhitungan berhasil ditampilkan', 'status' => 'Berhasil'],
            ['group' => 'Klasifikasi Naive Bayes', 'scenario' => 'Verifikasi hasil klasifikasi', 'input' => 'Pilih status aktual dan submit verifikasi', 'expected' => 'Status diperbarui dan data masuk ke data latih', 'actual_output' => 'Hasil terverifikasi dan data latih bertambah', 'status' => 'Berhasil'],

            // ====== PENGUJIAN METODE ======
            ['group' => 'Pengujian Metode', 'scenario' => 'Jalankan pengujian Hold-Out 80/20', 'input' => 'Slider di 80%, klik Jalankan Pengujian', 'expected' => 'Tampil confusion matrix dan nilai akurasi', 'actual_output' => 'Confusion matrix dan metrik berhasil ditampilkan', 'status' => 'Berhasil'],
            ['group' => 'Pengujian Metode', 'scenario' => 'Pengujian dengan data latih terlalu sedikit', 'input' => 'Data latih < 5 record', 'expected' => 'Tampil pesan error "Data terlalu sedikit"', 'actual_output' => 'Muncul pesan error validasi', 'status' => 'Berhasil'],
        ];

        return view('testing.blackbox', compact('testCases'));
    }

    /**
     * Jalankan Naive Bayes pada satu data test menggunakan trainSet.
     */
    private function classify($testItem, $trainSet, array $labels): string
    {
        $totalTrain = $trainSet->count();
        $scores = [];

        // Normalisasi penjamin
        $customerGuarantorNormalized = (
            empty($testItem->guarantor) ||
            in_array(trim(strtolower($testItem->guarantor)), ['tidak ada', 'tidak', 'none', 'no', ''])
        ) ? 'Tidak Ada' : 'Ada';

        foreach ($labels as $label) {
            $classData  = $trainSet->filter(fn($t) => $this->normalizeLabel($t->class_label) === $label);
            $countClass = $classData->count();
            $pClass     = $totalTrain > 0 ? ($countClass / $totalTrain) : 0;

            if ($countClass > 0) {
                $pDomisili = $classData->filter(
                    fn($t) => trim(strtolower($t->domicile)) === trim(strtolower($testItem->domicile))
                )->count() / $countClass;

                $pGuarantor = $classData->filter(
                    fn($t) => trim(strtolower($t->guarantor)) === trim(strtolower($customerGuarantorNormalized))
                )->count() / $countClass;

                $pAge = $classData->filter(
                    fn($t) => trim(strtolower($t->age)) === trim(strtolower($testItem->age))
                )->count() / $countClass;

                $pSource = $classData->filter(
                    fn($t) => trim(strtolower($t->source)) === trim(strtolower($testItem->source))
                )->count() / $countClass;
            } else {
                $pDomisili = $pGuarantor = $pAge = $pSource = 0;
            }

            $scores[$label] = $pClass * $pDomisili * $pGuarantor * $pAge * $pSource;
        }

        $maxScore = max($scores);
        if ($maxScore <= 0) {
            // Fallback ke prior probability tertinggi
            $priors = [];
            foreach ($labels as $label) {
                $classData = $trainSet->filter(fn($t) => $this->normalizeLabel($t->class_label) === $label);
                $priors[$label] = $totalTrain > 0 ? ($classData->count() / $totalTrain) : 0;
            }
            return array_search(max($priors), $priors);
        }

        return array_search($maxScore, $scores);
    }

    private function normalizeLabel(string $label): string
    {
        return ucfirst(trim(strtolower($label)));
    }
}
