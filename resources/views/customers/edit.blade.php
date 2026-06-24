@extends('layouts.master')
@section('title')
    {{ __('Customer Edit') }}
@endsection
@push('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
<!-- page title -->
    <x-page-title title="Customer Edit" pagetitle="Customers" />

    <div class="card" id="customerList">
        <div class="card-body">
            <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
                <form id="editCustomerForm" class="tablelist-form" action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $customer->id }}">
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="name" class="block font-medium mb-1 text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}" required class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="Nama sesuai KTP">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="phone" class="block font-medium mb-1 text-slate-700">No. WhatsApp <span class="text-red-500">*</span></label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="0812...">
                            </div>
                            <div>
                                <label for="source" class="block font-medium mb-1 text-slate-700">Sumber Informasi <span class="text-red-500">*</span></label>
                                <select id="source" name="source" required class="form-input w-full border-slate-200 focus:border-custom-500">
                                    <option value="WhatsApp" {{ old('source', $customer->source) == 'WhatsApp' ? 'selected' : '' }}>WhatsApp</option>
                                    <option value="Facebook" {{ old('source', $customer->source) == 'Facebook' ? 'selected' : '' }}>Facebook</option>
                                    <option value="Instagram" {{ old('source', $customer->source) == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                                    <option value="TikTok" {{ old('source', $customer->source) == 'TikTok' ? 'selected' : '' }}>TikTok</option>
                                    <option value="Google" {{ old('source', $customer->source) == 'Google' ? 'selected' : '' }}>Google</option>
                                    <option value="Teman" {{ old('source', $customer->source) == 'Teman' ? 'selected' : '' }}>Teman</option>
                                    <option value="Lainnya" {{ old('source', $customer->source) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="age" class="block font-medium mb-1 text-slate-700">Usia <span class="text-red-500">*</span></label>
                                <select id="age" name="age" required class="form-input w-full border-slate-200 focus:border-custom-500">
                                    <option value="">Pilih Usia</option>
                                    <option value="Muda" {{ old('age', $customer->age) == 'Muda' ? 'selected' : '' }}>Muda (18-30)</option>
                                    <option value="Dewasa" {{ old('age', $customer->age) == 'Dewasa' ? 'selected' : '' }}>Dewasa (31-50)</option>
                                    <option value="Tua" {{ old('age', $customer->age) == 'Tua' ? 'selected' : '' }}>Tua (51+)</option>
                                </select>
                            </div>
                            <div>
                                <label for="occupation" class="block font-medium mb-1 text-slate-700">Pekerjaan <span class="text-slate-400 text-xs">(Opsional)</span></label>
                                <input type="text" id="occupation" name="occupation" value="{{ old('occupation', $customer->occupation) }}" class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="PNS/Swasta/dll">
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block font-medium mb-1 text-slate-700">Alamat Lengkap</label>
                            <textarea id="address" name="address" rows="2" class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="Alamat sekarang">{{ old('address', $customer->address) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="domicile" class="block font-medium mb-1 text-slate-700">Domisili <span class="text-red-500">*</span></label>
                                <select id="domicile" name="domicile" required class="form-input w-full border-slate-200 focus:border-custom-500">
                                    <option value="Dalam Kota" {{ old('domicile', $customer->domicile) == 'Dalam Kota' ? 'selected' : '' }}>Dalam Kota</option>
                                    <option value="Luar Kota" {{ old('domicile', $customer->domicile) == 'Luar Kota' ? 'selected' : '' }}>Luar Kota</option>
                                </select>
                            </div>
                            <div>
                                <label for="guarantor" class="block font-medium mb-1 text-slate-700">Penjamin <span class="text-slate-400 text-xs">(Opsional)</span></label>
                                <input type="text" id="guarantor" name="guarantor" value="{{ old('guarantor', $customer->guarantor) }}" class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="Nama Penjamin (Kosongkan jika tidak ada)">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="guarantee" class="block font-medium mb-1 text-slate-700">Jaminan Utama</label>
                                <input type="text" id="guarantee" name="guarantee" value="{{ old('guarantee', $customer->guarantee) }}" class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="KTP/BPKB/dll">
                            </div>
                            <div>
                                <label for="track_record" class="block font-medium mb-1 text-slate-700">Riwayat Sewa <span class="text-red-500">*</span></label>
                                <select id="track_record" name="track_record" required class="form-input w-full border-slate-200 focus:border-custom-500">
                                    <option value="Baru" {{ old('track_record', $customer->track_record) == 'Baru' ? 'selected' : '' }}>Baru (Belum Pernah)</option>
                                    <option value="Pernah (Tepat Waktu)" {{ old('track_record', $customer->track_record) == 'Pernah (Tepat Waktu)' ? 'selected' : '' }}>Pernah (Tepat Waktu)</option>
                                    <option value="Pernah (Telat)" {{ old('track_record', $customer->track_record) == 'Pernah (Telat)' ? 'selected' : '' }}>Pernah (Terlambat)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-8">
                        <a href="{{ route('customers.index') }}" class="text-white btn bg-slate-500 border-slate-500 hover:bg-slate-600 font-bold px-4 py-2 rounded-md">Cancel</a>
                        <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 font-bold px-4 py-2 rounded-md">
                            <i data-lucide="save" class="inline-block size-4 mr-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endpush
