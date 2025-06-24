@props(['currentPage', 'lastPage', 'baseUrl' => '?page='])

<div class="flex items-center justify-center">
    <ul class="inline-flex items-center space-x-2 text-sm">
        {{-- Prev --}}
        <li>
            <a href="{{ $currentPage > 1 ? $baseUrl . ($currentPage - 1) : '#' }}"
                class="px-3 py-1 {{ $currentPage == 1 ? 'text-gray-400 cursor-not-allowed' : 'text-red-700 hover:text-red-900' }}">
                <i class="fas fa-chevron-left"></i>
            </a>
        </li>

        {{-- Page Numbers --}}
        @for ($i = 1; $i <= $lastPage; $i++)
            @if ($i == $currentPage)
                <li>
                    <span class="px-3 py-1 rounded-md bg-red-700 text-white font-semibold">{{ $i }}</span>
                </li>
            @else
                <li>
                    <a href="{{ $baseUrl . $i }}"
                        class="px-3 py-1 rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300 transition">{{ $i }}</a>
                </li>
            @endif
        @endfor

        {{-- Next --}}
        <li>
            <a href="{{ $currentPage < $lastPage ? $baseUrl . ($currentPage + 1) : '#' }}"
                class="px-3 py-1 {{ $currentPage == $lastPage ? 'text-gray-400 cursor-not-allowed' : 'text-red-700 hover:text-red-900' }}">
                <i class="fas fa-chevron-right"></i>
            </a>
        </li>
    </ul>
</div>
