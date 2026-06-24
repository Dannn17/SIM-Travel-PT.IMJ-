<div id="showModal" modal-center
     class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[30rem] bg-white shadow rounded-md">
        <div class="flex items-center justify-between p-4 border-b border-slate-200">
            <h5 class="text-16" id="exampleModalLabel">Create Report</h5>
            <button data-modal-close="showModal" type="button"
                    class="transition-all duration-200 ease-linear"><i data-lucide="x"
                        class="size-5"></i></button>
        </div>
        <div class="max-h-[calc(theme('height.screen')_-_180px)] overflow-y-auto p-4">
            <form id="reportForm" action="{{ route('service.report') }}" method="GET">
                <div class="mb-3">
                    <label for="start_date" class="block mb-1 font-medium">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="w-full p-2 border rounded-md" required>
                </div>

                <div class="mb-3">
                    <label for="end_date" class="block mb-1 font-medium">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="w-full p-2 border rounded-md" required>
                </div>
                
                <div class="flex justify-end gap-2">
                    <button type="button" data-modal-close="showModal" 
                            class="text-white btn bg-slate-500 border-slate-500 hover:bg-slate-600">Cancel</button>
                    <button type="submit" 
                            class="text-white btn bg-custom-500 border-custom-500 hover:bg-custom-600">
                        <span class="align-middle">Generate Report</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
