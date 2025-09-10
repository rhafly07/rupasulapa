<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Rental.id') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

        .typing-dots {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .typing-dot {
            width: 6px;
            height: 6px;
            background-color: #6b7280;
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {

            0%,
            60%,
            100% {
                transform: translateY(0);
                opacity: 0.4;
            }

            30% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }

        .lontara-text {
            font-family: 'Lontara', serif;
            font-size: 1.2em;
            line-height: 1.4;
        }

        .message-user {
            animation: slideInRight 0.3s ease-out;
        }

        .message-ai {
            animation: slideInLeft 0.3s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .modal-enter {
            animation: modalEnter 0.3s ease-out;
        }

        @keyframes modalEnter {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .chat-container {
            max-height: 400px;
        }

        .chat-container::-webkit-scrollbar {
            width: 4px;
        }

        .chat-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 2px;
        }

        .chat-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }

        .chat-container::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-user {
            animation: slideInRight 0.3s ease-out;
        }

        .message-ai {
            animation: slideInLeft 0.3s ease-out;
        }

        .modal-enter {
            animation: slideUp 0.3s ease-out;
        }

        .typing-dots {
            display: inline-flex;
            gap: 2px;
        }

        .typing-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: #6B7280;
            animation: typing 1.5s infinite;
        }

        .typing-dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {

            0%,
            60%,
            100% {
                transform: translateY(0);
                opacity: 0.4;
            }

            30% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }

        .modal-backdrop {
            backdrop-filter: blur(4px);
        }

        .chat-container::-webkit-scrollbar {
            width: 4px;
        }

        .chat-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-container::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 2px;
        }

        .lontara-text {
            font-size: 1.5rem;
            line-height: 1.4;
        }

        .chat-bubble {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 40;
        } */
    </style>

</head>

<body class="font-sans antialiased h-screen bg-gray-200 overflow-hidden flex items-center" x-data="mainApp()">

    <div class="relative flex flex-col items-center h-screen w-full">
        <div class="flex space-x-2 items-center border border-b-gray-200 bg-white max-w-md w-full px-5 py-2 shadow-lg">
            {{-- <button><i class="fas fa-arrow-left text-gray-800 mr-2"></i></button> --}}
            <img src="/images/logo.svg" class="w-12 h-12 bg-red-700 rounded-full p-2" alt="">
            <h1 class="text-lg font-black text-orange-400">Rupasulapa</h1>
        </div>

        <main class="h-screen max-w-md w-full bg-gray-50">
            {{ $slot }}
        </main>
        <button @click="openModal"
            class="absolute flex items-center justify-center rounded-full text-2xl w-16 h-16 bg-red-700 text-white p-5 bottom-6 right-[38%] hover:-translate-y-0.5 transition-all ease-in-out">
            <i class="fas fa-comments"></i>
        </button>

        @include('pages/dashboard')

    </div>
</body>

</html>
