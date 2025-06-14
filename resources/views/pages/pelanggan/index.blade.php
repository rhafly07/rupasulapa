<x-app-layout>

    @section('title', 'Pelanggan')

    <div class="flex flex-row justify-between items-center h-fit mb-4">
        <span class="font-bold text-xl">Pelanggan</span>
        <a href="{{ route('inventaris.tambah') }}" class="flex items-start">
            <button
                class="bg-red-700 rounded-full px-3 py-2 text-white text-sm shadow cursor-pointer hover:-translate-y-0.5 transition-all ease-in-out border-2 border-red-700"><i
                    class="fas fa-plus border-2 rounded-full px-1 p-0.5 text-xs"></i> Tambah Pelanggan</button>
        </a>
    </div>
    <div class="flex flex-col gap-5">
        <div class="flex flex-row bg-white rounded-lg h-fit shadow px-8 py-4 gap-4">
            <div class="relative w-full">
                <span
                    class="absolute inset-y-0 right-0 flex items-center justify-center p-4 top-6 bg-red-700 rounded-lg text-white">
                    <i class="fas fa-search"></i>
                </span>
                <x-form.BaseInput name="Pemilik" placeholder="Cari Pesanan" label="Silahkan Cari Pesanan" />
            </div>
        </div>
        <div class="flex flex-col bg-white rounded-lg h-fit shadow px-8 py-4">
            <div class="flex flex-row justify-between items-center mb-4">
                <span class="font-bold text-xl w-full">Daftar Unit</span>
                <div class="flex flex-row w-full items-center gap-4">
                    <div class="flex flex-row w-full items-center gap-2">
                        <span class="font-medium text-gray-400">show</span>
                        <select name="" id=""
                            class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-red-700 focus:ring-2 focus:ring-red-300 focus:border-red-700 text-sm text-gray-900">
                            <option value="">ALL COLUMN</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-center ">
                        <ul class="inline-flex items-center space-x-2 text-sm">
                            <li>
                                <button class="px-3 py-1 text-red-700" disabled>
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            </li>

                            <li>
                                <button class="px-3 py-1 rounded-md bg-red-700 text-white font-semibold">1</button>
                            </li>
                            <li>
                                <button
                                    class="px-3 py-1 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300 transition">2</button>
                            </li>
                            <li>
                                <button
                                    class="px-3 py-1 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300 transition">3</button>
                            </li>
                            <li>
                                <span class="px-3 py-1 text-gray-500">...</span>
                            </li>
                            <li>
                                <button
                                    class="px-3 py-1 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300 transition">10</button>
                            </li>

                            <li>
                                <button class="px-3 py-1 text-red-700">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <table class="w-full border-collapse">
                <thead class="">
                    <tr class="bg-gray-100">
                        <th class="rounded-l-xl px-4 py-2 text-red-700">Pelanggan</th>
                        <th class="px-4 py-2 text-red-700">Tanggal Nota</th>
                        <th class="px-4 py-2 text-red-700">Total</th>
                        <th class="rounded-r-xl px-4 py-2 text-red-700">Lunas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-4">
                            sepeda 1
                        </td class="p-4">
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
