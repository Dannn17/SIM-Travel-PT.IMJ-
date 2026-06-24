<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $statusSewaExcel = strtolower(trim($row['status_sewa'] ?? ''));
        
        if (empty($statusSewaExcel)) {
            $riwayatSewa = 'Baru';
        } elseif ($statusSewaExcel == 'tepat waktu') {
            $riwayatSewa = 'Pernah (Tepat Waktu)';
        } else {
            $riwayatSewa = 'Pernah (Telat)';
        }

        return new Customer([
            'name'            => $row['nama'], 
            'identity_number' => $row['no_identitas'] ?? null, 
            'phone'           => $row['telepon'] ?? null, 
            'age'             => $row['usia'] ?? null, 
            'occupation'      => $row['pekerjaan'] ?? null, 
            'address'         => $row['alamat'] ?? null, 
            'domicile'        => $row['domisili'], 
            'source'          => $row['sumber'], 

            'guarantor'       => $row['penjamin'] ?? 'Tidak Ada', 

            'guarantee'       => $row['jaminan'] ?? null, 
            
            'track_record'    => $riwayatSewa,
            
            'classification_result' => 'Belum Diklasifikasi',
        ]);
    }
}