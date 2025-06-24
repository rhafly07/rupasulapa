<x-app-layout>
    @section('title', 'Tambah Pelanggan')
    <div class="flex flex-col bg-white h-fit rounded-lg w-full shadow p-8">

        <x-ui.stepper :steps="['Detail Pengiriman', 'Informasi Akun', 'Rekening', 'Catatan']">
            <x-slot name="step0">
                <div class="grid grid-cols-2 gap-4">
                    <x-form.BaseInput type="text" name="nama" label="Nama" required />
                    <x-form.BaseInput type="text" name="telepon" label="Telepon" required />
                    <x-form.BaseInput type="text" name="nama" label="Kota Kecamatan" required />
                    <div>
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Catatan <span
                                class="text-red-700">*</span></label>
                        <textarea name="note" id="" cols="30"
                            class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-red-700 focus:ring-2 focus:ring-red-300 focus:border-red-700 text-sm text-gray-900"
                            rows="10"></textarea>
                    </div>
                    <x-form.BaseInput type="text" name="nama_penerima" label="Nama Penerima" required />
                    <x-form.BaseInput type="text" name="telepon_penerima" label="Telepon Penerima" required />
                    <x-form.BaseInput type="text" name="kode_pos" label="Kode POS" required />
                    <x-form.BaseInput type="text" name="google_maps" label="Google Maps" required />
                </div>
            </x-slot>
            <x-slot name="step1">
                <div class="grid grid-cols-2 gap-4">
                    <x-form.BaseInput type="text" name="email" label="Email" required />
                    <x-form.BaseInput type="text" name="instagram" label="Instagram" required />
                    <x-form.BaseInput type="text" name="facebook" label="Facebook" required />
                    <x-form.BaseInput type="text" name="nama_kontak_darutat" label="Nama Kontak Darutat" required />
                    <x-form.BaseInput type="text" name="telepon_kontak_darutat" label="Telepon Kontak Darutat"
                        required />
                </div>
            </x-slot>
            <x-slot name="step2">
                <div class="grid grid-cols-2 gap-4">
                    <x-form.BaseInput type="text" name="no_rekening" label="Nomor Rekening" required />
                    <x-form.BaseInput type="text" name="nama_rekening" label="Nama di Rekening" required />
                    <x-form.BaseInput type="text" name="nama_bank" label="Nama Bank" required />
                </div>
            </x-slot>
            <x-slot name="step3">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Status Pelanggan
                            <span class="text-red-700">*</span></label>
                        <div x-data="{ selected: 'penyewa' }" class="flex flex-row gap-4 mb-10 ml-auto">
                            @php
                                $options = [
                                    'penyewa' => 'Penyewa',
                                    'pemilik_unit' => 'Pemilik Unit',
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
                    <div>
                        <label for="" class="block text-sm font-medium text-gray-700 mb-1">Catatan <span
                                class="text-red-700">*</span></label>
                        <textarea name="note" id="" cols="30"
                            class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-red-700 focus:ring-2 focus:ring-red-300 focus:border-red-700 text-sm text-gray-900"
                            rows="10"></textarea>
                    </div>
                </div>
            </x-slot>
        </x-ui.stepper>

    </div>
</x-app-layout>
