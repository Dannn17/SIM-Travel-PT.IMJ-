<div id="showModal" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-linear left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[32rem] bg-white shadow rounded-md">
        <div class="flex items-center justify-between p-4 border-b border-slate-200">
            <h5 class="text-16 font-bold" id="exampleModalLabel">Add New Customer</h5>
            <button data-modal-close="showModal" type="button" class="transition-all duration-200 ease-linear text-slate-400 hover:text-red-500">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>

        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-5">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="name" class="block font-medium mb-1 text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" required class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="Nama sesuai KTP">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block font-medium mb-1 text-slate-700">No. WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" id="phone" name="phone" required class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="0812...">
                        </div>
                        <div>
                            <label for="source" class="block font-medium mb-1 text-slate-700">Sumber Informasi <span class="text-red-500">*</span></label>
                            <select id="source" name="source" required class="form-input w-full border-slate-200 focus:border-custom-500">
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Instagram">Instagram</option>
                                <option value="TikTok">TikTok</option>
                                <option value="Google">Google</option>
                                <option value="Teman">Teman</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="age" class="block font-medium mb-1 text-slate-700">Usia <span class="text-red-500">*</span></label>
                            <select id="age" name="age" required class="form-input w-full border-slate-200 focus:border-custom-500">
                                <option value="">Pilih Usia</option>
                                <option value="Muda">Muda (18-30)</option>
                                <option value="Dewasa">Dewasa (31-50)</option>
                                <option value="Tua">Tua (51+)</option>
                            </select>
                        </div>
                        <div>
                            <label for="occupation" class="block font-medium mb-1 text-slate-700">Pekerjaan <span class="text-slate-400 text-xs">(Opsional)</span></label>
                            <input type="text" id="occupation" name="occupation" class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="PNS/Swasta/dll">
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block font-medium mb-1 text-slate-700">Alamat Lengkap</label>
                        <textarea id="address" name="address" rows="2" class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="Alamat sekarang"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="domicile" class="block font-medium mb-1 text-slate-700">Domisili <span class="text-red-500">*</span></label>
                            <select id="domicile" name="domicile" required class="form-input w-full border-slate-200 focus:border-custom-500">
                                <option value="Dalam Kota">Dalam Kota</option>
                                <option value="Luar Kota">Luar Kota</option>
                            </select>
                        </div>
                        <div>
                            <label for="guarantor" class="block font-medium mb-1 text-slate-700">Penjamin <span class="text-slate-400 text-xs">(Opsional)</span></label>
                            <input type="text" id="guarantor" name="guarantor" class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="Nama Penjamin (Kosongkan jika tidak ada)">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="guarantee" class="block font-medium mb-1 text-slate-700">Jaminan Utama</label>
                            <input type="text" id="guarantee" name="guarantee" class="form-input w-full border-slate-200 focus:border-custom-500" placeholder="KTP/BPKB/dll">
                        </div>
                        <div>
                            <label for="track_record" class="block font-medium mb-1 text-slate-700">Riwayat Sewa <span class="text-red-500">*</span></label>
                            <select id="track_record" name="track_record" required class="form-input w-full border-slate-200 focus:border-custom-500">
                                <option value="Baru">Baru (Belum Pernah)</option>
                                <option value="Pernah (Tepat Waktu)">Pernah (Tepat Waktu)</option>
                                <option value="Pernah (Telat)">Pernah (Terlambat)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-8">
                    <button type="button" data-modal-close="showModal" class="text-white btn bg-slate-500 border-slate-500 hover:bg-slate-600 font-bold">Cancel</button>
                    <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600 font-bold">
                        <i data-lucide="save" class="inline-block size-4 mr-1"></i> Save Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>