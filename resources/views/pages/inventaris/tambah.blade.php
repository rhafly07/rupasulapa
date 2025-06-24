<x-app-layout>
    @section('title', 'Tambah Unit')
    <div class="flex flex-col bg-white h-fit rounded-lg w-full shadow p-8">
        <form action="{{ route('inventaris.unit.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_type_id" value="{{ $productType->id }}">
            @php
                $form = [
                    [
                        'name' => 'stock',
                        'label' => 'Jumlah Stok',
                        'required' => true,
                        'list' => [['ket' => 'Jumlah stok minimum adalah 1 atau lebih']],
                    ],
                    [
                        'name' => 'unit_code',
                        'label' => 'Kode Unit',
                        'required' => true,
                        'list' => [
                            [
                                'ket' =>
                                    'Kode unit adalah kode yang Anda gunakan untuk mengidentifikasi setiap barang sewaan Anda. Harus unik untuk setiap unit',
                            ],
                            [
                                'ket' =>
                                    'Jika jumlah stok lebih dari 1 maka karakter yang di input pada kolom kode unit akan menjadi prefix dari kode unit',
                            ],
                            [
                                'ket' => '
                                Contoh: kode unit "buku baru" makan kode unit akan menjadi "buku-baru-qasdf" yang mana "qasdf" adalah karakter acak',
                            ],
                        ],
                    ],
                    [
                        'name' => 'purchase_price',
                        'label' => 'Harga',
                        'required' => true,
                    ],
                    [
                        'name' => 'purchase_date',
                        'label' => 'Tanggal Beli',
                        'required' => true,
                        'type' => 'date',
                    ],
                ];
            @endphp
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">Jenis Produk <span
                            class="text-red-700">*</span></label>
                    <x-search-dropdown name="product_type_id" :options="$jenisProduct" />
                </div>
                <ul class="list-disc list-inside text-slate-300 px-2 text-xs col-span-2">
                    <li>Ketikan nama produk yang dicari atau nama produk baru yang akan ditambahkan</li>
                </ul>
                @foreach ($form as $fm)
                    <div>
                        <x-form.BaseInput :type="isset($fm['type']) ? $fm['type'] : ''" name="{{ $fm['name'] }}" label="{{ $fm['label'] }}"
                            :required="isset($fm['required']) ? $fm['required'] : false" />
                        @if (!empty($fm['list']))
                            <ul class="list-disc list-inside text-slate-300 px-2 pt-2 text-xs">
                                @foreach ($fm['list'] as $item)
                                    <li>{{ $item['ket'] }}</li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                @endforeach
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">Catatan <span
                            class="text-red-700">*</span></label>
                    <textarea name="note" id="" cols="30"
                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-red-700 focus:ring-2 focus:ring-red-300 focus:border-red-700 text-sm text-gray-900"
                        rows="10"></textarea>
                </div>
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">Pemilik</label>
                    <x-search-dropdown name="" :options="['tidak ada']" />
                </div>
                <div class="flex flex-col">
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">Skema Bagi Hasil <span
                            class="text-red-700">*</span></label>
                    <select name="" id=""
                        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-red-700 focus:ring-2 focus:ring-red-300 focus:border-red-700 text-sm text-gray-900">
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </div>
                <div>
                    <label for="" class="block text-sm font-medium text-gray-700 mb-1">Status Unit <span
                            class="text-red-700">*</span></label>
                    <div x-data="{ selected: 'aktif' }" class="flex flex-row gap-4 mb-10 ml-auto">
                        @php
                            $options = [
                                'aktif' => 'Aktif',
                                'mati_sementara' => 'Mati Sementara',
                                'mati_total' => 'Mati Total',
                            ];
                        @endphp
                        @foreach ($options as $value => $label)
                            <button type="button" @click="selected = '{{ $value }}'"
                                :class="selected === '{{ $value }}'
                                    ?
                                    'bg-green-600/10 border-2 border-green-600 text-black' :
                                    ' text-gray-700 hover:bg-gray-200 border border-slate-300'"
                                class="flex items-center justify-between px-4 py-4 cursor-pointer w-52  rounded-md text-sm font-medium transition-colors duration-300 ease-in-out
                ">

                                <span class="capitalize">
                                    {{ $label }}
                                </span>

                                <i x-show="selected === '{{ $value }}'"
                                    class="fas fa-circle-check text-green-600"></i>

                            </button>
                        @endforeach

                        <input type="hidden" name="status" :value="selected">
                    </div>
                </div>
            </div>
            <button
                class="bg-red-700 w-fit mt-4 ml-auto rounded-full px-3 py-2 text-white text-sm shadow-md cursor-pointer hover:-translate-y-0.5 transition-all ease-in-out hover:bg-gray-100 border-2 border-red-700 hover:text-red-700">
                Tambah Unit</button>
        </form>
    </div>
</x-app-layout>
