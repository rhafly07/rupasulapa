<x-app-layout>

    @section('title', 'Inventaris')

    @php
        $data = [
            [
                'title' => 'Unit Aktif',
                'isi' => 'Aktif',
                'color' => 'green-600',
                'icon' => 'circle-check',
            ],
            [
                'title' => 'Unit Dihentikan Sementara',
                'isi' => 'Dihentikan Sementara',
                'color' => 'yellow-500',
                'icon' => 'pause',
            ],
            [
                'title' => 'Unit Dihentikan Total',
                'isi' => 'Dihentikan Total',
                'color' => 'red-700',
                'icon' => 'circle-xmark',
            ],
        ];
    @endphp
    <div class="grid grid-cols-3 justify-start gap-10 p-1 rounded-lg text-white text-sm">
        @foreach ($data as $dt)
            <div
                class="group relative col-span-1 flex flex-row justify-between p-8 rounded-lg shadow-lg hover:-translate-y-1 transition-all ease-in-out duration-300 bg-{{ $dt['color'] }} overflow-hidden">

                <div class="flex flex-col z-10">
                    <span class="text-xs">{{ $dt['title'] }}</span>
                    <span class="font-bold text-xl">{{ $dt['isi'] }}</span>
                    <span class="font-bold text-2xl">40</span>
                </div>
                <i
                    class="fas fa-{{ $dt['icon'] }} absolute right-4 bottom-1 text-white/30 text-9xl transform -rotate-12 scale-100 transition-transform duration-300 group-hover:rotate-0 group-hover:scale-110 pointer-events-none">
                </i>
            </div>
        @endforeach
    </div>
    <div class="flex flex-row justify-between items-center h-fit py-4">
        <span class="font-bold text-xl">Pesanan</span>
        <a href="{{ route('inventaris.kategori') }}">
            <button
                class="bg-red-700 rounded-full px-3 py-3 text-white text-sm shadow-md cursor-pointer hover:-translate-y-0.5 transition-all ease-in-out duration-300">
                <i class="fas fa-plus border-2 rounded-full px-1 p-0.5 text-xs"></i> Tambah Jenis Produk
            </button>
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
        <div class="bg-white grid grid-cols-6 gap-5 p-8 rounded-lg h-fit shadow">
            <a href="{{ route('inventaris.detail-unit') }}">
                <div
                    class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                    <img src="/images/logo.png" alt="">
                    <span class="text-sm text-slate-400">Merek</span>
                    <span class="text-slate-500 font-semibold">Nama</span>
                    <span class="text-green-600 text-sm">Unit</span>
                </div>
            </a>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
            <div
                class="flex flex-col shadow-md items-center p-2 rounded-lg border border-slate-300 cursor-pointer hover:-translate-y-1 transition-all ease-in-out duration-300">
                <img src="/images/logo.png" alt="">
                <span class="text-sm text-slate-400">Merek</span>
                <span class="text-slate-500 font-semibold">Nama</span>
                <span class="text-green-600 text-sm">Unit</span>
            </div>
        </div>
        {{-- <div class="flex flex-col w-full h-fit py-20 items-center">
            <img src="/images/nodata.svg" class="w-96 mx-auto" alt="">
            <span class="font-bold tetx-lg text-red-700 mt-10">Belum ada data yang ditampilkan</span>
            <span class="text-sm text-slate-400">Buat sales order yang bisa anda akses dari semua device anda</span>
        </div> --}}
    </div>
</x-app-layout>
