<x-app-layout>
    <div class="flex flex-col space-y-4 p-4">
        <div class="flex justify-between items-center">
            <div class="flex flex-col">
                <h1 class="text-2xl font-black text-gray-800">History Terjemahan</h1>
                <p class="text-gray-600 text-sm">Semua kata yang pernah diterjemahkan</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4">
            <form method="GET" action="{{ route('translate.history') }}" class="flex space-x-3">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ $search }}"
                        placeholder="Cari kata Indonesia atau Makassar..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <button type="submit"
                    class="px-6 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                    Cari
                </button>
                @if ($search)
                    <a href="{{ route('translate.history') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg font-medium hover:bg-gray-600 transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-y-auto max-h-[70vh]">
            @if ($translations->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach ($translations as $translation)
                        <div class="p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="text-lg font-bold text-gray-900 capitalize">
                                            {{ $translation->indonesia_word }}
                                        </h3>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                            {{ $translation->word_class ?? 'Kata' }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500 mb-1">Kata Makassar:</p>
                                            <p class="font-semibold text-red-600">
                                                {{ $translation->makassar_word }}
                                            </p>
                                            @if ($translation->pronunciation)
                                                <p class="text-sm text-gray-600 italic">
                                                    ({{ $translation->pronunciation }})
                                                </p>
                                            @endif
                                        </div>

                                        @if ($translation->lontara)
                                            <div>
                                                <p class="text-sm text-gray-500 mb-1">Aksara Lontara:</p>
                                                <p class="text-xl font-bold text-gray-800 lontara-text">
                                                    {{ $translation->lontara }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    @if ($translation->indonesia_meaning)
                                        <div class="mt-3">
                                            <p class="text-sm text-gray-500 mb-1">Arti:</p>
                                            <p class="text-green-600 font-medium">
                                                {{ $translation->indonesia_meaning }}
                                            </p>
                                        </div>
                                    @endif

                                    <div class="flex justify-between items-center mt-3 pt-3 border-t border-gray-100">
                                        <span class="text-xs text-gray-400">
                                            Ditambahkan
                                            {{ $translation->created_at_human }}
                                        </span>
                                        <div class="flex space-x-2">
                                            <button
                                                onclick="copyTranslation('{{ $translation->indonesia_word }}', '{{ $translation->makassar_word }}')"
                                                class="text-gray-500 hover:text-blue-600 transition-colors"
                                                title="Copy terjemahan">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-4 py-3 bg-gray-50 border-t">
                    {{ $translations->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-gray-400 text-2xl"></i>
                    </div>
                    @if ($search)
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada hasil untuk
                            "{{ $search }}"</h3>
                        <p class="text-gray-600 mb-4">Coba kata kunci yang berbeda atau hapus filter pencarian</p>
                        <a href="{{ route('translate.history') }}"
                            class="inline-block px-4 py-2 bg-gray-600 text-white rounded-lg text-sm font-semibold hover:bg-gray-700 transition-colors">
                            Lihat Semua History
                        </a>
                    @else
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada history terjemahan</h3>
                        <p class="text-gray-600 mb-4">Mulai terjemahkan kata untuk melihat riwayat di sini</p>
                        <a href="{{ route('translate.index') }}"
                            class="inline-block px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                            Mulai Terjemahkan
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <style>
        .lontara-text {
            font-family: 'Lontara', serif;
            line-height: 1.4;
        }
    </style>

    <script>
        function copyTranslation(indonesia, makassar) {
            const text = `${indonesia} = ${makassar}`;

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(function() {
                    showNotification('Terjemahan berhasil disalin!', 'success');
                }).catch(function(err) {
                    fallbackCopyTextToClipboard(text);
                });
            } else {
                fallbackCopyTextToClipboard(text);
            }
        }

        function fallbackCopyTextToClipboard(text) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";

            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                const successful = document.execCommand('copy');
                if (successful) {
                    showNotification('Terjemahan berhasil disalin!', 'success');
                } else {
                    showNotification('Gagal menyalin terjemahan', 'error');
                }
            } catch (err) {
                showNotification('Gagal menyalin terjemahan', 'error');
            }

            document.body.removeChild(textArea);
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-600' : type === 'error' ? 'bg-red-600' : 'bg-blue-600';

            notification.className =
                `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 transition-all duration-300 transform translate-x-full ${bgColor}`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
    </script>
</x-app-layout>
