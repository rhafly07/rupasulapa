<x-app-layout>
    @section('title', 'Detail Unit')
    <div class="flex flex-row items-center h-fit px-8 py-4">
        <span class="font-bold text-xl w-full">Merek - Unit</span>
        <div class="flex flex-row items-center w-full justify-end gap-4">

            <button @click="$dispatch('open-modal', { name: 'hapusModal' })"
                class="bg-slate-100 border border-slate-200 rounded-full shadow px-3 py-2 text-slate-400 cursor-pointer hover:-translate-y-0.5 transition-all ease-in-out duration-300">
                Informasi Unit
            </button>
            <a href="{{ route('inventaris.tambah') }}" class="flex items-start">
                <button
                    class="bg-red-700 rounded-full px-3 py-2 text-white text-sm shadow cursor-pointer hover:-translate-y-0.5 transition-all ease-in-out border-2 border-red-700"><i
                        class="fas fa-plus border rounded-full p-0.5 text-xs"></i> Tambah Unit</button>
            </a>
        </div>
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
            <div class="flex flex-row w-full items-end">
                <div x-data="{ selected: 'aktif' }"
                    class="inline-flex justify-end h-fit rounded-md w-full shadow-md overflow-hidden">
                    <template x-for="option in ['aktif', 'dihentikan sementara', 'dihentikan total']"
                        :key="option">
                        <button @click="selected = option"
                            :class="{
                                'bg-gray-100 text-gray-800': selected !== option,
                                'bg-red-700 text-white shadow-inner rounded-l-md translate-y-0.5': selected ===
                                    option &&
                                    option === 'aktif',
                                'bg-red-700 text-white shadow-inner translate-y-0.5': selected === option &&
                                    option === 'dihentikan sementara',
                                'bg-red-700 text-white shadow-inner rounded-r-md translate-y-0.5': selected ===
                                    option &&
                                    option === 'dihentikan total',
                            }"
                            class="px-4 py-3 text-sm font-medium transition-all duration-200 cursor-pointer border border-slate-200 focus:outline-none w-full "
                            x-text="option.charAt(0).toUpperCase() + option.slice(1)"></button>
                    </template>
                </div>
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
                        <th class="rounded-l-xl px-4 py-2 text-red-700">Nama Unit</th>
                        <th class="px-4 py-2 text-red-700">Ketersediaan Unit</th>
                        <th class="px-4 py-2 text-red-700">Pesanan Berlangsung</th>
                        <th class="px-4 py-2 text-red-700">Pesanan Sekarang</th>
                        <th class="px-4 py-2 text-red-700">Varian</th>
                        <th class="px-4 py-2 text-red-700">Status</th>
                        <th class="rounded-r-xl px-4 py-2 text-red-700">Total</th>
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
            <x-modal name="hapusModal" title="Keterangan Unit" maxWidth="3xl">
                <div class="bg-gray-100/50 rounded-lg  border border-slate-200 p-4 w-full">
                    @php
                        $data = [
                            [
                                'title' => 'Merek',
                                'isi' => 'Merek',
                            ],
                            [
                                'title' => 'Ditambahkan',
                                'isi' => 'Ditambahkan',
                            ],
                            [
                                'title' => 'Harga',
                                'isi' => 'Harga',
                            ],
                            [
                                'title' => 'Kategori',
                                'isi' => 'Kategori',
                            ],
                            [
                                'title' => 'Koleksi',
                                'isi' => 'Koleksi',
                            ],
                            [
                                'title' => 'Deskripsi',
                                'isi' => 'Deskripsi',
                            ],
                        ];
                    @endphp
                    <div class="table w-full">
                        @foreach ($data as $dt)
                            <div
                                class="grid grid-cols-3 gap-4 w-full p-1 px-4 justify-start rounded-lg text-slate-600 {{ $loop->odd ? 'bg-white' : 'bg-slate-100/50' }}">
                                <span class="font-medium">{{ $dt['title'] }}</span>
                                <span class="text-cente pr-4">:</span>
                                <span>{{ $dt['isi'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-modal>

        </div>
    </div>
</x-app-layout>
