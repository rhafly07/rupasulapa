<x-app-layout>
    <div class="flex flex-col space-y-3 p-3">
        <div
            class="flex justify-between rounded-lg w-full overflow-hidden bg-blue-200 h-40 hover:-translate-y-0.5 transition-all ease-in-out">
            <div class="flex flex-col space-y-4 justify-between p-4">
                <div class="flex flex-col">
                    <span class="font-black">Tokoh</span>
                    <span class="text-gray-500 text-sm font-semibold ">Cari tahu tokoh makassar disini</span>
                </div>
                <a href="tokoh">
                    <button class="rounded-lg bg-black text-white w-fit px-2 py-1">
                        Lihat
                    </button>
                </a>
            </div>
            <img src="/images/sultan-hasanuddin.png"
                class="w-60 h-60 object-cover transform scale-x-[-1] hover:scale-x-[-1]" alt="">
        </div>
        <div class="flex space-x-3">
            <div
                class="flex rounded-lg w-full bg-red-200 h-40 p-4 hover:-translate-y-0.5 transition-all ease-in-out overflow-hidden">
                <div class="flex flex-col space-y-4 justify-between">
                    <div class="flex flex-col">
                        <span class="font-black">Makanan</span>
                        {{-- <span class="text-gray-500 text-xs font-semibold">Cari tahu makanan khas makassar disini</span> --}}
                    </div>
                    <a href="makanan">
                        <button class="rounded-lg bg-black text-white w-fit px-2 py-1">
                            Lihat
                        </button>
                    </a>
                </div>
                <img src="/images/coto-makassar.png"
                    class="w-52 h-52 object-cover transform scale-x-[-1] hover:scale-x-[-1]" alt="">
            </div>
            <div
                class="flex rounded-lg w-full bg-green-200 h-40 p-4 hover:-translate-y-0.5 transition-all ease-in-out overflow-hidden">
                <div class="flex flex-col space-y-4 justify-between">
                    <div class="flex flex-col">
                        <span class="font-black">Sejarah</span>
                        {{-- <span class="text-gray-500 text-xs font-semibold">Cari tahu sejara kota makassar disini</span> --}}
                    </div>
                    <button class="rounded-lg bg-black text-white w-fit px-2 py-1">
                        Lihat
                    </button>
                </div>
                <img src="/images/mandala.png" class="w-52 h-52 object-cover transform scale-x-[-1] hover:scale-x-[-1]"
                    alt="">
            </div>
        </div>
        <div class="flex flex-col space-y-4 mt-2">
            <div class="flex justify-between items-center">
                <div class="flex flex-col space-y-2">
                    <h1 class="font-black">History Terjemahan</h1>
                    <hr>
                </div>
                @if ($translations->count() > 5)
                    <a href="{{ route('translate.history') }}"
                        class="text-blue-600 text-sm font-semibold hover:text-blue-800">
                        Lihat Semua
                    </a>
                @endif
            </div>

            <div class="flex flex-col space-y-3 pr-1">
                @php
                    $limitedTranslations = $translations->take(5);
                @endphp

                @if ($limitedTranslations->count() > 0)
                    @foreach ($limitedTranslations as $translation)
                        <div
                            class="flex justify-between bg-gray-100 rounded-lg py-3 px-4 hover:bg-gray-200 transition-colors">
                            <div class="flex flex-col -space-y-1">
                                <span class="font-bold capitalize">{{ $translation->indonesia_word }}</span>
                                <div class="flex flex-col space-y-1">
                                    <span
                                        class="text-gray-600 font-medium text-sm">{{ $translation->makassar_word }}</span>
                                    @if ($translation->pronunciation)
                                        <span
                                            class="text-gray-500 font-light text-xs italic">{{ $translation->pronunciation }}</span>
                                    @endif
                                    @if ($translation->lontara)
                                        <span
                                            class="text-gray-700 text-sm lontara-text">{{ $translation->lontara }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-col items-end justify-between">
                                <button
                                    onclick="copyTranslation('{{ $translation->indonesia_word }}', '{{ $translation->makassar_word }}')"
                                    class="text-gray-500 hover:text-gray-700 transition-colors" title="Copy terjemahan">
                                    <i class="fas fa-copy text-sm"></i>
                                </button>
                                <span class="text-xs text-gray-400">{{ $translation->created_at_human }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-history text-gray-400 text-xl"></i>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada history terjemahan</p>
                        <p class="text-gray-400 text-sm mt-1">Mulai terjemahkan kata untuk melihat riwayat</p>
                        <a href="{{ route('translate.index') }}"
                            class="inline-block mt-3 px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                            Mulai Terjemahkan
                        </a>
                    </div>
                @endif
            </div>
        </div>

        @if ($translations->count() >= 5)
            <div class="text-center pt-2">
                <a href="{{ route('translate.history') }}"
                    class="inline-block px-6 py-2 bg-gray-600 text-white rounded-lg text-sm font-semibold hover:bg-gray-700 transition-colors">
                    Lihat Semua History ({{ $totalTranslations }} kata)
                </a>
            </div>
        @endif
    </div>
    </div>

    <style>
        .lontara-text {
            font-family: 'Lontara', serif;
            font-size: 1.1em;
            line-height: 1.3;
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
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 transition-all duration-300 transform translate-x-full ${
                type === 'success' ? 'bg-green-600' : 'bg-red-600'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Show notification
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Hide notification after 3 seconds
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
