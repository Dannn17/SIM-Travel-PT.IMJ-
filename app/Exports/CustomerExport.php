<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $search;
    protected $filterStatus;

    public function __construct($search = null, $filterStatus = null)
    {
        $this->search = $search;
        $this->filterStatus = $filterStatus;
    }

    public function query()
    {
        $query = Customer::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterStatus != '') {
            if ($this->filterStatus == 'Sudah Diklasifikasi') {
                $query->where('classification_result', '!=', 'Belum Diklasifikasi')
                      ->whereNotNull('classification_result');
            } else {
                $query->where('classification_result', $this->filterStatus);
            }
        }
        
        $query->orderBy('created_at', 'desc');

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'No. Identitas',
            'No. HP',
            'Usia',
            'Pekerjaan',
            'Alamat',
            'Domisili',
            'Penjamin',
            'Jaminan',
            'Riwayat Sewa',
            'Sumber Info',
            'Hasil Klasifikasi',
            'Tanggal Daftar'
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->name,
            $customer->identity_number,
            $customer->phone,
            $customer->age,
            $customer->occupation,
            $customer->address,
            $customer->domicile,
            $customer->guarantor,
            $customer->guarantee,
            $customer->track_record,
            $customer->source,
            $customer->classification_result,
            $customer->created_at ? $customer->created_at->format('Y-m-d H:i:s') : '',
        ];
    }
}
