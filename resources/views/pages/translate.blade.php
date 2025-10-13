<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rupasulapa - Translator Bahasa Makassar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .lontara-text {
            font-family: 'Times New Roman', serif;
            font-size: 1.2em;
            line-height: 1.4;
        }

        .modal-backdrop {
            backdrop-filter: blur(4px);
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="bg-red-600 text-white rounded-t-2xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-red-700 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">Rupasulapa</h1>
                            <p class="text-red-200 text-sm">Translator Indonesia - Bahasa Makassar</p>
                        </div>
                    </div>
                    <a href="{{ route('translator.history') }}"
                        class="p-2 rounded-full hover:bg-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white rounded-b-2xl shadow-lg overflow-hidden">
                <!-- Instructions -->
                <div class="bg-yellow-50 border-b border-yellow-200 p-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-6 h-6 bg-yellow-100 rounded-full flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="text-sm">
                            <p class="font-semibold text-yellow-800 mb-1">Cara Penggunaan:</p>
                            <p class="text-yellow-700">
                                Ketik: <span class="font-mono bg-yellow-200 px-1 rounded">"arti dari [kata]"</span>
                                - Contoh: "arti dari makan"
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="p-6">
                    <form action="{{ route('translator.translate') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="relative">
                            <input type="text" name="query" value="{{ old('query') }}"
                                placeholder="Ketik: arti dari [kata]..."
                                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                autofocus>
                            <button type="submit"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Quick Examples -->
                        <div class="flex flex-wrap gap-2">
                            <span class="text-sm text-gray-600">Contoh cepat:</span>
                            @foreach (['arti dari makan', 'arti dari minum', 'arti dari rumah'] as $example)
                                <button type="button"
                                    onclick="document.querySelector('input[name=query]').value='{{ $example }}'"
                                    class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors">
                                    {{ $example }}
                                </button>
                            @endforeach
                        </div>
                    </form>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-red-700 font-medium">{{ $errors->first() }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Session Error -->
                    @if (session('error'))
                        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-red-700 font-medium">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Results -->
                    @if (session('results'))
                        <div class="mt-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-800">Hasil Terjemahan</h3>
                                <span class="text-sm text-gray-500">
                                    Query: "{{ session('original_query') }}"
                                </span>
                            </div>

                            dd()

                            @foreach (session('results') as $result)
                                @if ($result['success'])
                                    <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                                        @if ($result['cached'])
                                            <div
                                                class="inline-flex items-center space-x-1 px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span>Dari cache</span>
                                            </div>
                                        @endif

                                        <!-- Word Indonesia -->
                                        <div>
                                            <p class="text-sm text-gray-500 mb-1">Kata Indonesia:</p>
                                            <p class="font-semibold text-blue-600 text-lg">
                                                {{ $result['data']['word_indonesia'] }}</p>
                                        </div>

                                        <!-- Word Makassar -->
                                        @if (!empty($result['data']['word_makassar']))
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Kata Makassar:</p>
                                                <p class="font-semibold text-red-600 text-lg">
                                                    {{ $result['data']['word_makassar'] }}</p>
                                                @if (!empty($result['data']['pronunciation']))
                                                    <p class="text-sm text-gray-600 italic mt-1">
                                                        [{{ $result['data']['pronunciation'] }}]</p>
                                                @endif
                                            </div>
                                        @endif

                                        <!-- Lontara -->
                                        @if (!empty($result['data']['lontara']))
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Aksara Lontara:</p>
                                                <p class="lontara-text font-bold text-gray-800 text-xl">
                                                    {{ $result['data']['lontara'] }}</p>
                                            </div>
                                        @endif

                                        <!-- Meaning -->
                                        @if (!empty($result['data']['meaning']))
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Arti:</p>
                                                <p class="font-medium text-green-600">{{ $result['data']['meaning'] }}
                                                </p>
                                            </div>
                                        @endif

                                        <!-- Word Class -->
                                        @if (!empty($result['data']['word_class']))
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Kelas Kata:</p>
                                                <p class="text-sm italic text-gray-700">
                                                    {{ $result['data']['word_class'] }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-red-700">{{ $result['error'] }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <!-- Welcome Message -->
                    @if (!session('results') && !$errors->any() && !session('error'))
                        <div class="mt-6 text-center py-8">
                            <div
                                class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Selamat datang! 👋</h2>
                            <p class="text-gray-600 mb-4">Saya akan membantu Anda menerjemahkan kata dari Indonesia ke
                                Bahasa Makassar dengan aksara Lontara.</p>
                            <p class="text-sm text-gray-500">💡 Ketik "arti dari [kata]" untuk memulai</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-6 text-center text-gray-500 text-sm">
                <p>Rupasulapa - Translator Bahasa Makassar</p>
                <p class="mt-1">Hasil terjemahan disimpan untuk mempercepat pencarian selanjutnya</p>
            </div>
        </div>
    </div>
</body>

</html>
