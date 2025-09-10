<x-app-layout>
    <div class="flex flex-col space-y-4 p-4 max-h-[90vh] overflow-y-auto">
        <h1 class="text-red-700 font-black text-xl">Daftar Makanan Khas Makassar</h1>
        @foreach ($makanan as $item)
            <div class="flex space-x-8 border border-gray-200 rounded-lg shadow-sm w-full h-40 p-4">
                <img src="{{ $item['foto_url'] }}" class="w-32 h-32 rounded-md" alt="">
                <div class="flex flex-col space-y-4 justify-center">
                    <span class="font-black text-xl">{{ $item['nama'] }}</span>
                    <p class="text-xs text-gray-900">{{ $item['deskripsi'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
