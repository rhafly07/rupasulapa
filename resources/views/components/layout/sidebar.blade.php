<aside
    class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 bg-white border-r border-gray-200 shadow-sm transition-all duration-300 z-40"
    :class="sidebarOpen ? 'lg:w-64' : 'lg:w-16'">

    <!-- Header -->
    <div class="flex items-center justify-between px-4 h-16 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <img :class="sidebarOpen ? 'w-8 h-8' : 'w-10 h-10'"
                class="w-8 h-8 transition-all duration-200 object-contain" src="/images/logo.png" alt="App Logo">
            <span x-show="sidebarOpen" class="text-red-700 font-bold text-lg transition-opacity duration-200">
                {{-- {{ config('app.name') }} --}} Rental.Id
            </span>
        </div>
        <button @click="sidebarOpen = false" x-show="sidebarOpen"
            class="text-red-700 hover:text-red-900 p-1 rounded transition-colors">
            <i class="fas fa-chevron-left text-sm"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

        @foreach ($menu as $mn)
            @php
                if (empty($mn['children'])) {
                    if (isset($mn['route'])) {
                        $isActive = request()->routeIs($mn['route']);
                        if (!$isActive && strpos($mn['route'], '.') !== false) {
                            $routePrefix = explode('.', $mn['route'])[0];
                            $isActive = request()->routeIs($routePrefix . '.*');
                        }
                    } else {
                        $isActive = false;
                    }
                } else {
                    $isActive = isset($mn['route']) ? request()->routeIs($mn['route'] . '*') : false;
                }

                $hasActiveChild = false;
                if (!empty($mn['children'])) {
                    foreach ($mn['children'] as $child) {
                        if (isset($child['route']) && request()->routeIs($child['route'] . '*')) {
                            $hasActiveChild = true;
                            break;
                        }
                    }
                }

                $isMenuActive = $isActive || $hasActiveChild;
            @endphp

            <div x-data="{ open: {{ $hasActiveChild ? 'true' : 'false' }} }">
                @if (empty($mn['children']))
                    <a href="{{ isset($mn['route']) ? route($mn['route']) : 'javascript:void(0)' }}"
                        class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ $isActive ? 'bg-red-50 text-red-700 border-r-2 border-red-700' : 'text-gray-700 hover:bg-red-50 hover:text-red-700' }}">
                        <i
                            class="fas fa-{{ $mn['icon'] }} transition-colors duration-200 flex-shrink-0 text-base w-5
                            {{ $isActive ? 'text-red-700' : 'text-gray-500 group-hover:text-red-700' }}"></i>
                        <span x-show="sidebarOpen" class="ml-3 truncate transition-opacity duration-200">
                            {{ $mn['menu'] }}
                        </span>
                    </a>
                @else
                    <button @click="open = !open"
                        class="group w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 {{ $isMenuActive ? 'bg-red-50 text-red-700' : 'text-gray-700 hover:bg-red-50 hover:text-red-700' }}">
                        <div class="flex items-center">
                            <i
                                class="fas fa-{{ $mn['icon'] }} transition-colors duration-200 flex-shrink-0 text-base w-5
                                {{ $isMenuActive ? 'text-red-700' : 'text-gray-500 group-hover:text-red-700' }}"></i>
                            <span x-show="sidebarOpen" class="ml-3 truncate transition-opacity duration-200">
                                {{ $mn['menu'] }}
                            </span>
                        </div>
                        <i x-show="sidebarOpen" x-cloak
                            class="fas transition-transform duration-200 text-xs {{ $isMenuActive ? 'text-red-700' : 'text-gray-400 group-hover:text-red-700' }}"
                            :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                @endif

                @if (!empty($mn['children']))
                    <div x-show="open && sidebarOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform -translate-y-2"
                        x-transition:enter-end="opacity-100 transform translate-y-0"
                        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" class="mt-1 ml-8 space-y-1">
                        @foreach ($mn['children'] as $child)
                            @php
                                $isChildActive = isset($child['route']) ? request()->routeIs($child['route']) : false;
                            @endphp
                            <a href="{{ isset($child['route']) ? route($child['route']) : 'javascript:void(0)' }}"
                                class="group flex items-center px-3 py-2 text-sm rounded-md transition-all duration-200 {{ $isChildActive ? 'bg-red-100 text-red-800 font-medium border-l-2 border-red-600' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                                <span
                                    class="w-2 h-2 rounded-full mr-3 {{ $isChildActive ? 'bg-red-600' : 'bg-gray-300 group-hover:bg-red-400' }} transition-colors duration-200"></span>
                                {{ $child['menu'] }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </nav>

    <!-- Footer -->
    <div class="border-t border-gray-100 p-3">
        <div class="flex items-center justify-center">
            <button @click="sidebarOpen = !sidebarOpen"
                class="p-2 rounded-lg text-gray-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200"
                :class="sidebarOpen ? 'hidden' : 'block'">
                <i class="fas fa-chevron-right text-sm"></i>
            </button>
        </div>
    </div>
</aside>
