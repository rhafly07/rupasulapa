@props([
    'steps' => [],
])

<div x-data="{
    steps: @js($steps),
    currentStep: 0,
    prevStep() {
        if (this.currentStep > 0) {
            this.currentStep--;
        }
    },
    nextStep() {
        if (this.currentStep < this.steps.length - 1) {
            this.currentStep++;
        }
    },
    submit() {
        console.log('Form submitted!');
        this.$dispatch('stepper-completed', {
            currentStep: this.currentStep,
            totalSteps: this.steps.length
        });
    }
}" class="w-full max-w-6xl mx-auto p-4" x-cloak>

    {{-- Step Headers --}}
    <div class="flex justify-between items-center mb-6">
        <template x-for="(label, index) in steps" :key="index">
            <div class="flex-1">
                <div class="flex flex-row items-center">
                    <div :class="currentStep >= index ? 'bg-red-700 text-white' : 'bg-gray-200 text-gray-500 mb-10'"
                        class="absolute w-10 h-10 rounded-full flex items-center justify-center mx-auto font-semibold">
                        <span x-text="index + 1"></span>
                    </div>
                    <div class="bg-red-700 h-1 rounded-full w-full" :class="currentStep >= index ? 'block' : 'hidden'">
                    </div>
                </div>
                <div class="text-sm mt-6 text-red-700 font-semibold" :class="currentStep >= index ? 'block' : 'hidden'"
                    x-text="label"></div>
            </div>
        </template>
    </div>

    {{-- Step Content --}}
    <div class="mb-6">
        @for ($i = 0; $i < count($steps); $i++)
            <div x-show="currentStep === {{ $i }}" x-transition>
                @if (isset(${'step' . $i}))
                    {{ ${'step' . $i} }}
                @else
                    <div class="text-center text-gray-500 py-8 border-2 border-dashed border-gray-300 rounded-lg">
                        <div class="mb-2">
                            <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="font-medium">Konten untuk step "{{ $steps[$i] }}" belum tersedia</p>
                        <p class="text-sm mt-1">Gunakan slot: <code
                                class="bg-gray-100 px-2 py-1 rounded text-xs">step{{ $i }}</code></p>
                    </div>
                @endif
            </div>
        @endfor
    </div>

    {{-- Navigation Buttons --}}
    <div class="flex justify-between">
        <button x-show="currentStep > 0" @click="prevStep"
            class="px-4 rounded-full py-2 bg-gray-300 text-gray-700 hover:bg-gray-400 transition-colors text-sm">
            Sebelumnya
        </button>
        <button x-show="currentStep < steps.length - 1" @click="nextStep"
            class="ml-auto px-4 rounded-full py-2 bg-red-700 text-white hover:bg-red-800 transition-colors text-sm">
            Selanjutnya
        </button>
        <button x-show="currentStep === steps.length - 1" @click="submit"
            class="ml-auto px-4 rounded-full py-2 bg-green-600 text-white hover:bg-green-700 transition-colors text-sm">
            Selesai
        </button>
    </div>

    {{-- Debug Info (hapus di production) --}}
    {{-- <div class="mt-4 p-2 bg-gray-100 rounded text-xs text-gray-600" x-show="true">
        <strong>Debug:</strong> Current Step: <span x-text="currentStep"></span>,
        Total Steps: <span x-text="steps.length"></span>,
        Steps: <span x-text="JSON.stringify(steps)"></span>
    </div> --}}
</div>
