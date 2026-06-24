<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel; 
use App\Imports\CustomersImport; 
use App\Exports\CustomerExport;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filterStatus = $request->input('filter_status');
        
        $sortBy = $request->input('sort_by', 'created_at'); 
        $sortOrder = $request->input('sort_order', 'desc'); 

        $query = Customer::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        if ($filterStatus != '') {
            if ($filterStatus == 'Sudah Diklasifikasi') {
                $query->where('classification_result', '!=', 'Belum Diklasifikasi')->whereNotNull('classification_result');
            } else {
                $query->where('classification_result', $filterStatus);
            }
        }

        $query->orderBy($sortBy, $sortOrder);

        $customers = $query->paginate(10)->withQueryString();

        return view('customers.index', compact('customers', 'search', 'filterStatus', 'sortBy', 'sortOrder'));
    }

    

    public function create()
    {
        return view('customers.create');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048'
        ]);

        try {
            Excel::import(new CustomersImport, $request->file('file'));

            return redirect()->route('customers.index')->with('success', 'Data Customer berhasil di-import!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Import: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        $search = $request->input('search');
        $filterStatus = $request->input('filter_status');
        
        return Excel::download(new CustomerExport($search, $filterStatus), 'Data_Penyewa_IMJ.xlsx');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'identity_number' => 'nullable',
            'phone'           => 'required',
            'age'             => 'required|string|max:255',
            'occupation'      => 'nullable|string',
            'address'         => 'nullable',
            'domicile'        => 'required',
            'guarantor'       => 'nullable',
            'source'         => 'required',
            'guarantee'       => 'nullable',
            'track_record'    => 'required',
        ]);
        
        $validated['classification_result'] = 'Belum Diklasifikasi';

        Customer::create($validated);

        return redirect()->route('customers.index')
            ->with('success', "Data penyewa berhasil ditambahkan.");
    }
    /**
     * Proses penyimpanan data dan eksekusi Naive Bayes.
     
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:15',
            'address'       => 'required',
            'occupation'    => 'required',
            'collateral'    => 'required',
            'age'           => 'required|numeric',
            'track_record'  => 'required',
        ]);

        $data = $request->all();

        // JALANKAN LOGIKA NAIVE BAYES
        // Kita mengirimkan kriteria input ke fungsi perhitungan
        $hasil = $this->calculateNaiveBayes(
            $request->occupation, 
            $request->collateral, 
            $request->age, 
            $request->track_record
        );
        
        // Masukkan hasil ke dalam array data sebelum simpan
        $data['classification_result'] = $hasil;

        Customer::create($data);

        return redirect()->route('customers.index')
            ->with('success', "Penyewa berhasil ditambahkan. Hasil Klasifikasi: $hasil");
    }
    */

    /**
     * Update data penyewa (jika ada perubahan kriteria, hitung ulang).
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'identity_number' => 'nullable',
            'phone'           => 'required',
            'age'             => 'required|string|max:255',
            'occupation'      => 'nullable|string',
            'address'         => 'nullable',
            'domicile'        => 'required',
            'guarantor'       => 'nullable',
            'source'         => 'required',
            'guarantee'       => 'nullable',
            'track_record'    => 'required',
        ]);

        $customer = Customer::findOrFail($id);

        // Jika salah satu kriteria penentu Naive Bayes berubah, reset hasil klasifikasi ke 'Belum Diklasifikasi'
        if (
            $customer->age !== $validated['age'] ||
            $customer->domicile !== $validated['domicile'] ||
            $customer->guarantor !== $validated['guarantor'] ||
            $customer->source !== $validated['source']
        ) {
            $validated['classification_result'] = 'Belum Diklasifikasi';
        }

        $customer->update($validated);

        return redirect()->route('customers.index')
            ->with('success', "Data penyewa berhasil diperbarui.");
    }

    public function show(Customer $customer)
{
    // Return dalam bentuk JSON untuk dibaca JavaScript
    return response()->json($customer);
}


    /**
     * Menghapus satu atau banyak data.
     */
    public function destroy(Request $request, $id = null)
    {
        if ($request->isMethod('DELETE') && $id === null) {
            $request->validate([
                'ids' => 'required|array|min:1',
                'ids.*' => 'integer|exists:customers,id',
            ]);
            Customer::whereIn('id', $request->ids)->delete();
            return redirect()->route('customers.index')->with('success', 'Beberapa data penyewa berhasil dihapus.');
        }

        if ($id !== null) {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return redirect()->route('customers.index')->with('success', 'Data penyewa berhasil dihapus.');
        }
    }

    private function calculateNaiveBayes($occupation, $guarantee, $age, $track_record, $guarantor)
    {
        
    }
}