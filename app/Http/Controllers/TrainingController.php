<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use App\Imports\TrainingImport;
use Maatwebsite\Excel\Facades\Excel;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $query = Training::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('domicile', 'like', "%{$search}%")
                  ->orWhere('age', 'like', "%{$search}%")
                  ->orWhere('guarantor', 'like', "%{$search}%")
                  ->orWhere('source', 'like', "%{$search}%")
                  ->orWhere('class_label', 'like', "%{$search}%");
        }

        if ($request->filled('sort')) {
            $sort = $request->sort;
            $direction = $request->direction === 'asc' ? 'asc' : 'desc';
            
            $allowedSorts = ['name', 'domicile', 'guarantor', 'age', 'source', 'class_label'];
            if (in_array($sort, $allowedSorts)) {
                $query->orderBy($sort, $direction);
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $trainings = $query->paginate(10)->withQueryString();
        return view('trainings.index', compact('trainings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'domicile'     => 'required|in:Dalam Kota,Luar Kota',
            'age'          => 'required|in:Muda,Dewasa,Tua',
            'guarantor'    => 'required|in:Ada,Tidak Ada',
            'source'       => 'required|string',
            'class_label'  => 'required|in:Aman,Waspada,Bahaya',
        ]);

        $training = Training::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data'    => $training
            ]);
        }

        return redirect()->back()->with('success', 'Data Latih berhasil disimpan.');
    }

    public function destroy($id)
    {
        Training::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data Latih berhasil dihapus.');
    }

    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new TrainingImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data Excel berhasil di-import ke Data Training!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Import: ' . $e->getMessage());
        }
    }

    public function truncate()
    {
        Training::truncate();
        return redirect()->back()->with('success', 'Semua data training telah dikosongkan.');
    }
}