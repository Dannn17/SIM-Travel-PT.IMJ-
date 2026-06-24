<div id="importModal" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-linear left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[30rem] bg-white shadow-2xl rounded-xl overflow-hidden">
        <div class="flex items-center justify-between p-4 border-b border-slate-100 bg-slate-50/50">
            <h5 class="text-[10px] font-black uppercase tracking-widest text-slate-500">Import Data Customer</h5>
            <button data-modal-close="importModal" type="button" class="text-slate-400 hover:text-red-500 transition-colors">
                <i data-lucide="x" class="size-5"></i>
            </button>
        </div>

        <div class="p-6">
            <form action="{{ route('customers.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label class="block text-[11px] font-bold text-slate-400 uppercase mb-2">Pilih File Excel/CSV</label>
                    <div class="relative border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:border-custom-500 transition-all group bg-slate-50/30">
                        <input type="file" name="file" required 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="space-y-3">
                            <div class="mx-auto size-12 bg-green-50 rounded-full flex items-center justify-center group-hover:bg-green-100 transition-colors">
                                <i class="ri-file-excel-2-line text-2xl text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-700">Klik untuk unggah file</p>
                                <p class="text-[10px] text-slate-400 mt-1">Format yang didukung: .xlsx, .csv</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 mb-6">
                    <div class="flex gap-3">
                        <i class="ri-information-fill text-blue-500 text-lg"></i>
                        <p class="text-[10px] text-blue-800 leading-relaxed">
                            <span class="font-black uppercase block mb-1 underline">Penting:</span>
                            Header Excel harus sesuai: <span class="font-bold">nama, telepon, domisili, penjamin, status_sewa, sumber</span>. Pastikan tidak ada kolom kosong pada data wajib.
                        </p>
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" data-modal-close="importModal"
                        class="text-slate-500 btn bg-slate-100 border-slate-100 hover:bg-slate-200 shadow-sm font-bold px-5">
                        Batal
                    </button>
                    <button type="submit" id="btnSubmitImport"
                        class="text-white btn bg-green-500 border-green-500 hover:bg-green-600 shadow-md font-bold px-5 flex items-center gap-2">
                        <i class="ri-file-excel-2-line"></i>
                        <span id="textSubmitImport">Mulai Import</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>