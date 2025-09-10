<div x-show="showModal" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95"
    class="fixed bottom-20 z-50 w-96 rounded-xl shadow-lg overflow-y-auto" x-cloak>

    <div x-data="makassarTranslator()" class="flex flex-col h-full bg-white shadow-lg">

        <div x-show="showRulesModal"
            class="fixed inset-0 z-50 flex items-center justify-center modal-backdrop bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-6 mx-4 max-w-sm w-full shadow-xl modal-enter">
                <div class="text-center mb-4">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Cara Penggunaan</h2>
                </div>

                <div class="space-y-4 text-sm text-gray-700">
                    <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                        <p class="font-semibold text-yellow-800 mb-1">📝 Format Input:</p>
                        <p>Ketik: <strong>"arti dari [kata]"</strong></p>
                        <p class="text-xs mt-1 text-yellow-700">Contoh: "arti dari makan"</p>
                    </div>

                    <div class="bg-blue-50 p-3 rounded-lg border border-blue-200">
                        <p class="font-semibold text-blue-800 mb-1">🔍 Yang Dicari:</p>
                        <p>Sistem hanya akan memproses kata setelah "arti dari", bagian "arti dari" akan
                            diabaikan.</p>
                    </div>

                    <div class="bg-green-50 p-3 rounded-lg border border-green-200">
                        <p class="font-semibold text-green-800 mb-1">📚 Hasil:</p>
                        <p>• Kata Makassar + Pengucapan</p>
                        <p>• Aksara Lontara</p>
                        <p>• Arti Indonesia</p>
                        <p>• Kelas Kata</p>
                    </div>
                </div>

                <button @click="closeRulesModal()"
                    class="w-full mt-6 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Mulai Menggunakan
                </button>
            </div>
        </div>

        <!-- Header -->
        <header class="bg-red-600 text-white p-4 shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-700 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold">Rupasulapa</h1>
                        <p class="text-sm text-red-200" x-show="isTranslating">Mencari terjemahan...</p>
                        <p class="text-sm text-red-200" x-show="!isTranslating">Siap membantu</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <button @click="showRulesModal = true" class="p-2 rounded-full hover:bg-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>
                    <button @click="clearChat()" class="p-2 rounded-full hover:bg-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                    <button @click="closeModal" class="p-2 rounded-full hover:bg-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- Chat Messages -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4 chat-container" x-ref="chatContainer">
            <div x-show="messages.length === 0" class="text-center py-8">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Selamat datang! 👋</h2>
                <p class="text-gray-600 text-sm px-4 mb-4">Saya akan membantu Anda menerjemahkan kata dari
                    Indonesia ke
                    Bahasa Makassar dengan aksara Lontara.</p>
                <p class="text-xs text-gray-500 px-4">💡 Ketik "arti dari [kata]" untuk memulai</p>
            </div>

            <template x-for="message in messages" :key="message.id">
                <div :class="message.type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="{
                        'bg-red-600 text-white message-user': message.type === 'user',
                        'bg-gray-100 text-gray-800 message-ai': message.type === 'ai'
                    }"
                        class="max-w-xs lg:max-w-md px-4 py-3 rounded-2xl relative">

                        <div x-show="message.type === 'user'">
                            <p x-text="message.content" class="text-sm leading-relaxed"></p>
                            <span x-text="message.timestamp" class="text-xs opacity-75 mt-1 block"></span>
                        </div>

                        <div x-show="message.type === 'ai'">
                            <div x-show="message.error" class="text-red-600">
                                <p x-text="message.content" class="text-sm"></p>
                            </div>

                            <div x-show="!message.error && message.translation">
                                <!-- Badge untuk sumber data -->
                                <div class="mb-2" x-show="message.source">
                                    <span
                                        :class="{
                                            'bg-green-100 text-green-800': message.source === 'database',
                                            'bg-blue-100 text-blue-800': message.source === 'api'
                                        }"
                                        class="text-xs px-2 py-1 rounded-full font-medium">
                                        <span x-show="message.source === 'database'">📚 Dari Database</span>
                                        <span x-show="message.source === 'api'">🌐 Dari API</span>
                                    </span>
                                </div>

                                <div class="mb-3" x-show="message.translation && message.translation.makassar">
                                    <p class="text-xs text-gray-500 mb-1">Kata Makassar:</p>
                                    <p class="font-semibold text-red-600 text-base"
                                        x-text="(message.translation && message.translation.makassar) || 'Tidak tersedia'">
                                    </p>
                                    <p class="text-xs text-gray-600 italic"
                                        x-text="(message.translation && message.translation.pronunciation) || ''"
                                        x-show="message.translation && message.translation.pronunciation"></p>
                                </div>

                                <div class="mb-3" x-show="message.translation && message.translation.lontara">
                                    <p class="text-xs text-gray-500 mb-1">Aksara Lontara:</p>
                                    <p class="lontara-text font-bold text-gray-800"
                                        x-text="(message.translation && message.translation.lontara) || 'Tidak tersedia'">
                                    </p>
                                </div>

                                <div class="mb-3" x-show="message.translation && message.translation.indonesia">
                                    <p class="text-xs text-gray-500 mb-1">Arti Indonesia:</p>
                                    <p class="font-medium text-green-600"
                                        x-text="(message.translation && message.translation.indonesia) || 'Tidak tersedia'">
                                    </p>
                                </div>

                                <div class="mb-2" x-show="message.translation && message.translation.wordClass">
                                    <p class="text-xs text-gray-500 mb-1">Kelas Kata:</p>
                                    <p class="text-sm italic text-gray-700"
                                        x-text="(message.translation && message.translation.wordClass) || 'Tidak tersedia'">
                                    </p>
                                </div>
                            </div>

                            <span x-text="message.timestamp" class="text-xs text-gray-500 mt-2 block"></span>
                        </div>
                    </div>
                </div>
            </template>

            <div x-show="showTyping" class="flex justify-start">
                <div class="bg-gray-100 text-gray-800 max-w-xs px-4 py-3 rounded-2xl message-ai">
                    <div class="typing-dots">
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                        <div class="typing-dot"></div>
                    </div>
                </div>
            </div>

            <div x-show="currentProcessing && isTranslating" class="flex justify-start">
                <div class="bg-blue-50 text-blue-800 max-w-xs px-4 py-2 rounded-2xl border border-blue-200">
                    <p class="text-sm">🔍 Mencari: <span x-text="currentProcessing" class="font-semibold"></span>
                    </p>
                    <p class="text-xs mt-1 text-blue-600">Mohon ditunggu...</p>
                </div>
            </div>
        </div>

        <div class="p-4 bg-white border-t">
            <div class="flex space-x-2">
                <div class="flex-1 relative">
                    <input x-model="inputText" @keydown.enter="processTranslation()" :disabled="isTranslating"
                        type="text" placeholder="Ketik: arti dari [kata]..."
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-full focus:ring-2 focus:ring-red-500 focus:border-transparent disabled:opacity-50 disabled:cursor-not-allowed">
                    <button @click="inputText = ''" x-show="inputText.length > 0"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <button @click="processTranslation()" :disabled="!inputText.trim() || isTranslating"
                    class="px-6 py-3 bg-red-600 text-white rounded-full hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                    <svg x-show="!isTranslating" class="w-5 h-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <svg x-show="isTranslating" class="w-5 h-5 animate-spin" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="flex flex-wrap gap-2 mt-3">
                <template x-for="example in quickExamples">
                    <button @click="inputText = example; processTranslation()" :disabled="isTranslating"
                        class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                        x-text="example">
                    </button>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
    function mainApp() {
        return {
            showModal: false,

            openModal() {
                this.showModal = true;
            },

            closeModal() {
                this.showModal = false;
            }
        }
    }

    function makassarTranslator() {
        return {
            messages: [],
            inputText: '',
            isTranslating: false,
            showTyping: false,
            currentProcessing: '',
            showRulesModal: true,
            quickExamples: ['arti dari makan', 'arti dari minum', 'arti dari rumah'],

            init() {
                this.scrollToBottom();
            },

            closeRulesModal() {
                this.showRulesModal = false;
            },

            async processTranslation() {
                if (!this.inputText.trim() || this.isTranslating) return;

                const userInput = this.inputText.trim();
                this.addUserMessage(userInput);

                const wordsToTranslate = this.extractWordsFromInput(userInput);

                if (wordsToTranslate.length === 0) {
                    this.addErrorMessage('Format tidak valid. Gunakan: "arti dari [kata]"');
                    return;
                }

                this.inputText = '';
                this.isTranslating = true;
                this.showTyping = true;

                await this.sleep(800);
                this.showTyping = false;

                try {
                    for (const word of wordsToTranslate) {
                        this.currentProcessing = word;
                        await this.translateWord(word);
                        await this.sleep(500);
                    }
                } catch (error) {
                    console.error('Translation error:', error);
                    this.addErrorMessage('Terjadi kesalahan saat menerjemahkan. Silakan coba lagi.');
                } finally {
                    this.isTranslating = false;
                    this.currentProcessing = '';
                }
            },

            extractWordsFromInput(input) {
                const lowerInput = input.toLowerCase();
                let cleanInput = lowerInput;
                if (lowerInput.includes('arti dari')) {
                    cleanInput = lowerInput.replace(/arti\s+dari\s+/gi, '').trim();
                }
                return cleanInput.split(/\s+/).filter(word => word.trim().length > 0);
            },

            async translateWord(word) {
                try {
                    // Kirim request ke controller Laravel
                    const response = await fetch('/translate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            kata: word
                        })
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        this.addTranslationMessage(word, result.data, result.source);
                    } else {
                        this.addErrorMessage(result.message || `Kata "${word}" tidak dapat diterjemahkan.`);
                    }

                } catch (error) {
                    console.error('API Error:', error);
                    this.addErrorMessage(`Gagal menerjemahkan kata "${word}". Silakan coba lagi.`);
                }
            },

            addUserMessage(content) {
                const message = {
                    id: Date.now() + Math.random(),
                    type: 'user',
                    content: content,
                    timestamp: this.getCurrentTime()
                };
                this.messages.push(message);
                this.scrollToBottom();
            },

            addTranslationMessage(originalWord, translation, source) {
                const safeTranslation = {
                    makassar: translation?.makassar || '',
                    pronunciation: translation?.pronunciation || '',
                    lontara: translation?.lontara || '',
                    indonesia: translation?.indonesia || '',
                    wordClass: translation?.wordClass || ''
                };

                const message = {
                    id: Date.now() + Math.random(),
                    type: 'ai',
                    translation: safeTranslation,
                    originalWord: originalWord,
                    source: source,
                    error: false,
                    timestamp: this.getCurrentTime()
                };
                this.messages.push(message);
                this.scrollToBottom();
            },

            addErrorMessage(content) {
                const message = {
                    id: Date.now() + Math.random(),
                    type: 'ai',
                    content: content,
                    error: true,
                    translation: null,
                    timestamp: this.getCurrentTime()
                };
                this.messages.push(message);
                this.scrollToBottom();
            },

            clearChat() {
                this.messages = [];
            },

            scrollToBottom() {
                this.$nextTick(() => {
                    if (this.$refs.chatContainer) {
                        this.$refs.chatContainer.scrollTop = this.$refs.chatContainer.scrollHeight;
                    }
                });
            },

            sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            },

            getCurrentTime() {
                return new Date().toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        }
    }
</script>
