@props([
    'type' => 'text',
    'name',
    'label' => null,
    'value' => '',
    'required' => false,
    'placeholder' => null,
])

@php
    $placeholderValue = $placeholder ?? 'Masukkan ' . $label;
@endphp

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }} <span class="text-red-700">{{ $required ? '*' : '' }}</span>
        </label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        placeholder="{{ $placeholderValue }}" {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' =>
                'w-full px-3 py-2 border border-slate-300 rounded-md shadow-sm focus:outline-red-700 focus:ring-2 focus:ring-red-300 focus:border-red-700 text-sm text-gray-900',
        ]) }}>

    @error($name)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
