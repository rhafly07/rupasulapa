<x-app-layout>

    @section('title', 'Dahsboard')

    <div class="w-full flex flex-col justify-between">
        <div class="flex flex-row gap-10 h-[200px]">
            <div
                class="flex flex-col text-white bg-red-700 shadow-lg p-8 w-[600px] h-full rounded-2xl hover:-translate-y-1 transition-all ease-in-out duration-300">
                <span>Total Saldo <i class="fas fa-eye"></i></span>
                <div class="flex flex-row justify-between my-4">
                    <span>Rp. 00</span>
                    <button
                        class="bg-white border-2 shadow-inner border-red-700 text-red-700 rounded-full p-3 text-xs hover:-translate-y-0.5 cursor-pointer transition-all ease-in-out">Terima
                        Pembayaran</button>
                </div>
                <hr>
                <div class="flex flex-row justify-between mt-4">
                    <span>Dana sedang diproses <i class="fas fa-circle-info"></i></span>
                    <span>Rp. 00</span>
                </div>
            </div>
            <div
                class="flex flex-col shadow-lg rounded-2xl hover:-translate-y-1 transition-all ease-in-out duration-300 w-[350px] bg-white h-full p-8 justify-between">
                <div class="flex flex-row justify-between items-center">
                    <span class="text-slate-400">Piutang Usaha <i class="fas fa-circle-info"></i></span>
                    <i class="fas fa-rotate-right text-blue-400"></i>
                </div>
                <span>Rp. 00</span>
                <hr class="text-slate-300">
                <div class="flex flex-row justify-between">
                    <span class="text-slate-400"><span class="text-green-700">0</span> Unpaid</span>
                    <span class="text-slate-400"><span class="text-red-700">0</span> Overdue</span>
                </div>
                <button class="text-blue-400 font-semibold ml-auto">Buat Invoice</button>
            </div>
            <div
                class="flex flex-col shadow-lg rounded-2xl hover:-translate-y-1 transition-all ease-in-out duration-300 w-[350px] bg-white h-full p-8 justify-between">
                <div class="flex flex-row justify-between items-center">
                    <span class="text-slate-400">Utang Usaha <i class="fas fa-circle-info"></i></span>
                    <i class="fas fa-rotate-right text-blue-400"></i>
                </div>
                <span>Rp. 00</span>
                <hr class="text-slate-300">
                <div class="flex flex-row justify-between">
                    <span class="text-slate-400"><span class="text-green-700">0</span> Unpaid</span>
                    <span class="text-slate-400"><span class="text-red-700">0</span> Overdue</span>
                </div>
                <button class="text-blue-400 font-semibold ml-auto">Bayar Tagihan</button>
            </div>
        </div>
    </div>
</x-app-layout>
