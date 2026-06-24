<?php

namespace App\Imports;

use App\Models\Training;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrainingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // 1. Logika untuk Riwayat Sewa (Track Record)
        /* Kita bersihkan data dari spasi dan ubah ke huruf kecil untuk pengecekan
        $statusSewa = strtolower(trim($row['status_sewa'] ?? $row['riwayat_sewa'] ?? ''));
        
        if (empty($statusSewa) || $statusSewa == 'baru') {
            $riwayat = 'Baru';
        } elseif ($statusSewa == 'tepat waktu' || $statusSewa == 'pernah (tepat waktu)') {
            $riwayat = 'Pernah (Tepat Waktu)';
        } else {
            // Jika isinya 'telat', 'pernah (telat)', dsb.
            $riwayat = 'Pernah (Telat)';
        } */

        // 2. Logika untuk Penjamin (Guarantor)
        $penjaminRaw = trim($row['penjamin'] ?? $row['penjamin_utama'] ?? '');
        $penjaminLower = strtolower($penjaminRaw);
        $penjamin = (empty($penjaminRaw) || in_array($penjaminLower, ['tidak ada', 'tidak', 'none', 'no', ''])) ? 'Tidak Ada' : 'Ada';

        return new Training([
            'name'         => $row['nama'] ?? $row['nama_penyewa'] ?? null, 
            'domicile'     => $row['domisili'] ?? null,
            'age'          => $row['usia'] ?? $row['age'] ?? null,
            'guarantor'    => $penjamin,
            //'track_record' => $riwayat,  // Menggunakan hasil logika riwayat
            'source'       => $row['sumber'] ?? $row['sumber_informasi'] ?? null,
            'class_label'  => $row['kelayakan'] ?? $row['label_kelas'] ?? null,
        ]);
    }
}