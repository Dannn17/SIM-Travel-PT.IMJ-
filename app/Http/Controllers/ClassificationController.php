<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Training;

class ClassificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::where(function($q) {
            $q->where('classification_result', 'Belum Diklasifikasi')
              ->orWhereNull('classification_result');
        });

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('domicile', 'like', "%{$search}%")
                  ->orWhere('guarantor', 'like', "%{$search}%")
                  ->orWhere('age', 'like', "%{$search}%")
                  ->orWhere('source', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sort')) {
            $sort = $request->sort;
            $direction = $request->direction === 'asc' ? 'asc' : 'desc';
            
            $allowedSorts = ['name', 'domicile', 'guarantor', 'age', 'source'];
            if (in_array($sort, $allowedSorts)) {
                $query->orderBy($sort, $direction);
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $customers = $query->paginate(10)->withQueryString();
                            
        return view('classification.index', compact('customers'));
    }

    public function process(Request $request)
    {
        $customer = Customer::findOrFail($request->customer_id);
        $trainings = Training::all();
        $totalTrain = $trainings->count();

        if ($totalTrain == 0) {
            return redirect()->back()->with('error', 'Data training kosong!');
        }

        $labels = ['Aman', 'Waspada', 'Bahaya'];
        $calculation = [];

        foreach ($labels as $label) {
            // Prior Probability P(Ci) - Filter secara case-insensitive
            $classData = $trainings->filter(function($t) use ($label) {
                return trim(strtolower($t->class_label)) === trim(strtolower($label));
            });
            $countClass = $classData->count();
            $pClass = $totalTrain > 0 ? ($countClass / $totalTrain) : 0;

            if ($countClass > 0) {
                // Likelihood P(Xi|Ci) - Filter secara case-insensitive dan abaikan spasi berlebih
                $pDomisili = $classData->filter(function($t) use ($customer) {
                    return trim(strtolower($t->domicile)) === trim(strtolower($customer->domicile));
                })->count() / $countClass;

                $customerGuarantorNormalized = (empty($customer->guarantor) || in_array(trim(strtolower($customer->guarantor)), ['tidak ada', 'tidak', 'none', 'no', ''])) ? 'Tidak Ada' : 'Ada';
                $pGuarantor = $classData->filter(function($t) use ($customerGuarantorNormalized) {
                    return trim(strtolower($t->guarantor)) === trim(strtolower($customerGuarantorNormalized));
                })->count() / $countClass;

                $pAge = $classData->filter(function($t) use ($customer) {
                    return trim(strtolower($t->age)) === trim(strtolower($customer->age));
                })->count() / $countClass;

                $pSource = $classData->filter(function($t) use ($customer) {
                    return trim(strtolower($t->source)) === trim(strtolower($customer->source));
                })->count() / $countClass;
            } else {
                $pDomisili = $pGuarantor = $pAge = $pSource = 0;
            }

            // Probabilitas Akhir (Posterior)
            $finalScore = $pClass * $pDomisili * $pGuarantor * $pAge * $pSource;

            $calculation[$label] = [
                'pClass' => $pClass,
                'details' => [
                    'Domisili' => $pDomisili,
                    'Penjamin' => $pGuarantor,
                    'Usia'     => $pAge,
                    'Sumber'   => $pSource,
                ],
                'score' => $finalScore
            ];
        }

        // skor tertinggi untuk menentukan hasil
        $maxScore = -1;
        $finalResult = 'Waspada'; 
        foreach ($calculation as $label => $data) {
            if ($data['score'] > $maxScore) {
                $maxScore = $data['score'];
                $finalResult = $label;
            }
        }

        
        if ($maxScore <= 0) {
            $finalResult = array_search(max(array_column($calculation, 'pClass')), array_column($calculation, 'pClass'));
        }

        $customer->classification_result = $finalResult;
        $customer->save();

        return view('classification.result', compact('customer', 'calculation', 'finalResult'));
    }

    public function bulkProcess(Request $request)
    {
        $request->validate([
            'customer_ids' => 'required|array|min:1',
            'customer_ids.*' => 'integer|exists:customers,id',
        ]);

        $trainings = Training::all();
        $totalTrain = $trainings->count();

        if ($totalTrain == 0) {
            return redirect()->back()->with('error', 'Data training kosong! Tidak bisa melakukan klasifikasi.');
        }

        $labels = ['Aman', 'Waspada', 'Bahaya'];
        $customers = Customer::whereIn('id', $request->customer_ids)->get();

        foreach ($customers as $customer) {
            $calculation = [];
            foreach ($labels as $label) {
                $classData = $trainings->filter(function($t) use ($label) {
                    return trim(strtolower($t->class_label)) === trim(strtolower($label));
                });
                $countClass = $classData->count();
                $pClass = $totalTrain > 0 ? ($countClass / $totalTrain) : 0;

                if ($countClass > 0) {
                    $pDomisili = $classData->filter(function($t) use ($customer) {
                        return trim(strtolower($t->domicile)) === trim(strtolower($customer->domicile));
                    })->count() / $countClass;

                    $customerGuarantorNormalized = (empty($customer->guarantor) || in_array(trim(strtolower($customer->guarantor)), ['tidak ada', 'tidak', 'none', 'no', ''])) ? 'Tidak Ada' : 'Ada';
                    $pGuarantor = $classData->filter(function($t) use ($customerGuarantorNormalized) {
                        return trim(strtolower($t->guarantor)) === trim(strtolower($customerGuarantorNormalized));
                    })->count() / $countClass;

                    $pAge = $classData->filter(function($t) use ($customer) {
                        return trim(strtolower($t->age)) === trim(strtolower($customer->age));
                    })->count() / $countClass;

                    $pSource = $classData->filter(function($t) use ($customer) {
                        return trim(strtolower($t->source)) === trim(strtolower($customer->source));
                    })->count() / $countClass;
                } else {
                    $pDomisili = $pGuarantor = $pAge = $pSource = 0;
                }

                $finalScore = $pClass * $pDomisili * $pGuarantor * $pAge * $pSource;
                $calculation[$label] = ['pClass' => $pClass, 'score' => $finalScore];
            }

            $maxScore = -1;
            $finalResult = 'Waspada'; 
            foreach ($calculation as $label => $data) {
                if ($data['score'] > $maxScore) {
                    $maxScore = $data['score'];
                    $finalResult = $label;
                }
            }

            if ($maxScore <= 0) {
                $finalResult = array_search(max(array_column($calculation, 'pClass')), array_column($calculation, 'pClass'));
            }

            $customer->classification_result = $finalResult;
            $customer->save();
        }

        return redirect()->route('classification.index')->with('success', count($customers) . ' penyewa berhasil diklasifikasikan secara massal.');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        
        if (!$customer->classification_result || $customer->classification_result == 'Belum Diklasifikasi') {
            return redirect()->back()->with('error', 'Data customer ini belum diklasifikasi!');
        }

        $trainings = Training::all();
        $totalTrain = $trainings->count();

        if ($totalTrain == 0) {
            return redirect()->back()->with('error', 'Data training kosong, tidak dapat melakukan perhitungan ulang!');
        }

        $labels = ['Aman', 'Waspada', 'Bahaya'];
        $calculation = [];

        foreach ($labels as $label) {
            // Prior Probability P(Ci) - Filter secara case-insensitive
            $classData = $trainings->filter(function($t) use ($label) {
                return trim(strtolower($t->class_label)) === trim(strtolower($label));
            });
            $countClass = $classData->count();
            $pClass = $totalTrain > 0 ? ($countClass / $totalTrain) : 0;

            if ($countClass > 0) {
                // Likelihood P(Xi|Ci) - Filter secara case-insensitive
                $pDomisili = $classData->filter(function($t) use ($customer) {
                    return trim(strtolower($t->domicile)) === trim(strtolower($customer->domicile));
                })->count() / $countClass;

                $customerGuarantorNormalized = (empty($customer->guarantor) || in_array(trim(strtolower($customer->guarantor)), ['tidak ada', 'tidak', 'none', 'no', ''])) ? 'Tidak Ada' : 'Ada';
                $pGuarantor = $classData->filter(function($t) use ($customerGuarantorNormalized) {
                    return trim(strtolower($t->guarantor)) === trim(strtolower($customerGuarantorNormalized));
                })->count() / $countClass;

                $pAge = $classData->filter(function($t) use ($customer) {
                    return trim(strtolower($t->age)) === trim(strtolower($customer->age));
                })->count() / $countClass;

                $pSource = $classData->filter(function($t) use ($customer) {
                    return trim(strtolower($t->source)) === trim(strtolower($customer->source));
                })->count() / $countClass;
            } else {
                $pDomisili = $pGuarantor = $pAge = $pSource = 0;
            }

            $finalScore = $pClass * $pDomisili * $pGuarantor * $pAge * $pSource;

            $calculation[$label] = [
                'pClass' => $pClass,
                'details' => [
                    'Domisili' => $pDomisili,
                    'Penjamin' => $pGuarantor,
                    'Usia'     => $pAge,
                    'Sumber'   => $pSource,
                ],
                'score' => $finalScore
            ];
        }

        $finalResult = $customer->classification_result; // Kita ambil hasil yang sudah tersimpan di database

        return view('classification.result', compact('customer', 'calculation', 'finalResult'));
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'actual_status' => 'required|in:Aman,Waspada,Bahaya'
        ]);

        $customer = Customer::findOrFail($id);
        
        // Update status customer
        $customer->classification_result = $request->actual_status;
        $customer->save();

        $customerGuarantorNormalized = (empty($customer->guarantor) || in_array(trim(strtolower($customer->guarantor)), ['tidak ada', 'tidak', 'none', 'no', ''])) ? 'Tidak Ada' : 'Ada';
        // Masukkan ke Data Latih
        Training::create([
            'name' => $customer->name,
            'domicile' => $customer->domicile,
            'guarantor' => $customerGuarantorNormalized,
            'age' => $customer->age,
            'source' => $customer->source,
            'class_label' => $request->actual_status
        ]);

        return redirect()->route('customers.index')->with('success', 'Hasil klasifikasi diverifikasi dan berhasil ditambahkan ke Data Latih!');
    }
}