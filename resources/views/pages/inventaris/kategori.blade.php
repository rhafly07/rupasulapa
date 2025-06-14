<x-app-layout>
    @section('title', 'Tambah Produk')
    <div class="flex flex-col bg-white h-fit rounded-lg w-full shadow p-8">
        <div class="flex flex-col justify-between">
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Gambar <span
                    class="text-red-700">*</span></label>
            <div
                class="flex flex-col gap-2 p-6 bg-red-50/25 rounded-lg border-2 border-red-700 border-dashed w-fit h-52 mb-4 items-center justify-center">
                <i class="fas fa-arrow-up-from-bracket text-red-700 text-2xl"></i>
                <span class="text-[9px] font-semibold text-red-700">Unggah Gambar</span>
                <div class="flex flex-col items-center">
                    <span class="text-slate-400 text-[9px]">Maksimal ukuran of 20MB JPEG, PNG</span>
                    <span class="text-slate-400 text-[9px]">Rekomendasi ukuran 300x200</span>
                </div>
            </div>
        </div>
        @php
            $form = [
                [
                    'name' => 'merek',
                    'label' => 'Merek',
                    'required' => false,
                ],
                [
                    'name' => 'nama',
                    'label' => 'Nama',
                    'required' => true,
                ],
                [
                    'name' => 'hargaRetail',
                    'label' => 'Harga Retail',
                    'type' => 'number',
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
                <label for="" class="block text-sm font-medium text-gray-700 mb-1">Deskrpsi <span
                        class="text-red-700">*</span></label>
                <textarea name="" id="" cols="30"
                    class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-red-700 focus:ring-2 focus:ring-red-300 focus:border-red-700 text-sm text-gray-900"
                    rows="10"></textarea>
            </div>
            <x-form.BaseInput name="Pemilik"
                placeholder="Pisahkan beberapa kategori dengan koma. Contoh: tas, backpak, travel" label="Kategori"
                required />
        </div>
        <div x-data="{ selected: 'satuan' }" class="flex flex-row gap-4 my-10 ml-auto">
            @php
                $options = [
                    'satuan' => 'Satuan',
                    'jumlah_besar' => 'Jumlah Besar',
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
