<x-app-layout>
    @section('title', 'Tambah Pelanggan')
    <div class="flex flex-col bg-white h-fit rounded-lg w-full shadow p-8">

        @php
            $form = [
                [
                    'name' => 'jenisProduk',
                    'label' => 'Jenis Produk',
                    'required' => true,
                    'type' => 'number',
                    'list' => [
                        ['ket' => 'Ketikan nama produk yang dicari atau nama produk baru yang akan ditambahkan'],
                    ],
                ],
                [
                    'name' => 'jumlahStok',
                    'label' => 'Jumlah Stok',
                    'required' => true,
                    'list' => [['ket' => 'Jumlah stok minimum adalah 1 atau lebih']],
                ],
                [
                    'name' => 'kodeUnit',
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
                    'name' => 'harga',
                    'label' => 'Harga',
                    'required' => true,
                ],
                [
                    'name' => 'tglBeli',
                    'label' => 'Tanggal Beli',
                    'required' => true,
                ],
            ];
        @endphp
        <div class="grid grid-cols-2 gap-5">
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
                <textarea name="" id="" cols="30"
                    class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-red-700 focus:ring-2 focus:ring-red-300 focus:border-red-700 text-sm text-gray-900"
                    rows="10"></textarea>
            </div>
            <x-form.BaseInput name="Pemilik" placeholder="Cari nama/telepon pelanggan" label="Pemilik" required />
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
        </div>
        <div x-data="{ selected: 'aktif' }" class="flex flex-row gap-4 my-10 ml-auto">
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

                    <i x-show="selected === '{{ $value }}'" class="fas fa-circle-check text-green-600"></i>

                </button>
            @endforeach

            <input type="hidden" name="status" :value="selected">
        </div>
        <button
            class="bg-red-700 w-fit mt-4 ml-auto rounded-full px-3 py-2 text-white text-sm shadow-md cursor-pointer hover:-translate-y-0.5 transition-all ease-in-out hover:bg-gray-100 border-2 border-red-700 hover:text-red-700">
            Tambah Unit</button>
        {{-- <div x-data="{
            rows: [{
                produk: '',
                deskripsi: '',
                kuantitas: '',
                harga: '',
                total: ''
            }],
            addRow() {
                this.rows.push({
                    produk: '',
                    deskripsi: '',
                    kuantitas: '',
                    harga: '',
                    total: ''
                });
            },
            removeRow(index) {
                this.rows.splice(index, 1);
            }
        }">
            <table class="w-full border-collapse rounded-xl mt-4 rounded-xl">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="rounded-l-xl px-4 py-2">Produk</th>
                        <th class=" px-4 py-2">Deskripsi</th>
                        <th class=" px-4 py-2">Kuantitas</th>
                        <th class=" px-4 py-2">Harga</th>
                        <th class=" px-4 py-2">Total</th>
                        <th class="rounded-r-xl px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(row, index) in rows" :key="index">
                        <tr>
                            <td class=" px-2 py-1">
                                <x-form.BaseInput type="text" x-bind:name="`items[${index}][produk]`"
                                    x-model="row.produk" placeholder="Produk" />
                            </td>
                            <td class=" px-2 py-3">
                                <x-form.BaseInput type="text" x-bind:name="`items[${index}][deskripsi]`"
                                    x-model="row.deskripsi" placeholder="Deskripsi" />
                            </td>
                            <td class=" px-2 py-3">
                                <x-form.BaseInput type="number" x-bind:name="`items[${index}][kuantitas]`"
                                    x-model="row.kuantitas" placeholder="Kuantitas" />
                            </td>
                            <td class=" px-2 py-3">
                                <x-form.BaseInput type="number" x-bind:name="`items[${index}][harga]`" x-model="row.harga"
                                    placeholder="Harga" />
                            </td>
                            <td class=" px-2 py-3">
                                <x-form.BaseInput type="number" x-bind:name="`items[${index}][total]`" x-model="row.total"
                                    placeholder="Total" />
                            </td>
                            <td class=" px-2 py-3 text-center">
                                <button type="button" @click="removeRow(index)"
                                    class="text-red-500 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            <div class="flex flex-row justify-end gap-4">
                <button type="button" @click="addRow()"
                    class="bg-slate-300 w-fit mt-4  rounded-full p-2 text-white text-sm shadow-md cursor-pointer hover:-translate-y-0.5 transition-all ease-in-out ">
                    <i class="fas fa-plus border-2 rounded-full p-0.5 text-xs"></i> Tambah Baris
                </button>
                <button
                    class="bg-red-700 w-fit mt-4  rounded-full p-2 text-white text-sm shadow-md cursor-pointer hover:-translate-y-0.5 transition-all ease-in-out hover:bg-gray-100 border-2 border-red-700 hover:text-red-700"><i
                        class="fas fa-plus border-2 rounded-full p-0.5 text-xs mr-1"></i> Buat Sales
                    Order Baru</button>
            </div>
        </div> --}}
        <div>

        </div>
    </div>
</x-app-layout>
