@props(['name', 'options'])

@php
    $optionsJson = json_encode($options);
@endphp

<div x-data="searchDropdown({{ $optionsJson }})" x-init="init()" class="relative w-full">
    <!-- Hidden input for ID -->
    <input type="hidden" name="{{ $name }}" :value="selected?.id">

    <!-- Text input -->
    <input type="text" x-model="query" @input="filterList" @focus="open = true" @click.away="open = false"
        class="w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-red-700 focus:ring-2 focus:ring-red-300 focus:border-red-700 text-sm text-gray-900"
        placeholder="Cari nama...">

    <!-- Dropdown -->
    <div x-show="open && filteredOptions.length > 0"
        class="absolute z-10 w-full mt-1 bg-white border rounded shadow max-h-60 overflow-auto">
        <template x-for="option in filteredOptions" :key="option.id">
            <div @click="selectOption(option)"
                class="flex items-start space-x-3 px-4 py-2 hover:bg-gray-100 cursor-pointer">
                <img :src="option.image" class="w-10 h-10 rounded object-cover">
                <div>
                    <div class="font-semibold text-sm" x-text="option.name"></div>
                    <div class="text-xs text-gray-600" x-text="option.description"></div>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    function searchDropdown(options) {
        return {
            open: false,
            query: '',
            selected: null,
            options: options,
            filteredOptions: [],

            init() {
                this.filteredOptions = this.options;
            },

            filterList() {
                const q = this.query.toLowerCase()
                this.filteredOptions = this.options.filter(
                    o => o.name.toLowerCase().includes(q) || o.description.toLowerCase().includes(q)
                )
            },

            selectOption(option) {
                this.query = `${option.name} - ${option.description}`
                this.selected = option
                this.open = false
            }
        }
    }
</script>
