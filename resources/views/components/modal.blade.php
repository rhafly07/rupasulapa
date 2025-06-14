@props([
    'id' => 'modal',
    'title' => null,
    'name',
    'show' => false,
    'maxWidth' => '2xl',
])

@php
    $maxWidthClass = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
    ][$maxWidth];
@endphp

<div x-data="{ show: @js($show) }" x-show="show" x-cloak @keydown.escape.window="show = false"
    x-on:open-modal.window="if ($event.detail.name === '{{ $name }}') show = true"
    x-on:close-modal.window="if ($event.detail.name === '{{ $name }}') show = false"
    class="fixed inset-0 z-50 flex items-start justify-center px-4 py-6 bg-black/50 sm:px-0">

    <!-- Backdrop -->
    <div x-show="show" class="fixed inset-0 bg-gray-500 opacity-75" @click="show = false"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <!-- Modal content -->
    <div x-show="show"
        class="relative bg-white rounded-lg shadow-xl overflow-hidden w-full {{ $maxWidthClass }} sm:mx-auto"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-10"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-10">

        <!-- Close Button -->
        <button @click="show = false" class="absolute top-4 right-4 text-gray-400 hover:text-red-600 text-xl">
            <i class="fas fa-xmark"></i>
        </button>

        <!-- Title -->
        @if ($title)
            <div class="px-6 pt-6 text-lg font-semibold">{{ $title }}</div>
        @endif

        <!-- Slot Content -->
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>
