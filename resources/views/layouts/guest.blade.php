<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --neon-purple: #a78bfa;
                --neon-pink: #f472b6;
                --neon-cyan: #22d3ee;
            }

            body {
                background: #f8f7ff;
                background-image: 
                    radial-gradient(at 0% 0%, rgba(139, 92, 246, 0.12) 0px, transparent 50%),
                    radial-gradient(at 100% 0%, rgba(236, 72, 153, 0.12) 0px, transparent 50%),
                    radial-gradient(at 100% 100%, rgba(6, 182, 212, 0.12) 0px, transparent 50%),
                    radial-gradient(at 0% 100%, rgba(16, 185, 129, 0.12) 0px, transparent 50%);
                min-height: 100vh;
                font-family: 'Figtree', -apple-system, BlinkMacSystemFont, sans-serif;
            }
            
            .logo-container {
                animation: fadeInDown 0.8s ease-out, float 3s ease-in-out infinite;
            }
            
            .form-container {
                animation: fadeInUp 0.8s ease-out;
                backdrop-filter: blur(20px) saturate(180%);
            }
            
            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-10px);
                }
            }
            
            .glass-effect {
                background: rgba(255, 255, 255, 0.9);
                box-shadow: 
                    0 8px 32px 0 rgba(139, 92, 246, 0.15),
                    0 0 60px 0 rgba(236, 72, 153, 0.1),
                    inset 0 0 60px 0 rgba(139, 92, 246, 0.03);
                border: 2px solid rgba(139, 92, 246, 0.2);
            }

            .glass-effect:hover {
                border-color: rgba(139, 92, 246, 0.4);
                box-shadow: 
                    0 12px 48px 0 rgba(139, 92, 246, 0.2),
                    0 0 80px 0 rgba(236, 72, 153, 0.15),
                    inset 0 0 80px 0 rgba(139, 92, 246, 0.05);
            }
            
            .logo-gradient {
                background: linear-gradient(135deg, var(--neon-purple), var(--neon-pink), var(--neon-cyan));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .blob {
                position: absolute;
                border-radius: 50%;
                filter: blur(80px);
                mix-blend-mode: multiply;
                animation: blob 8s infinite;
                opacity: 0.3;
            }

            .blob-1 {
                top: 10%;
                left: 10%;
                width: 400px;
                height: 400px;
                background: rgba(139, 92, 246, 0.25);
                animation-delay: 0s;
            }

            .blob-2 {
                top: 20%;
                right: 10%;
                width: 350px;
                height: 350px;
                background: rgba(236, 72, 153, 0.25);
                animation-delay: 2s;
            }

            .blob-3 {
                bottom: 20%;
                left: 50%;
                width: 450px;
                height: 450px;
                background: rgba(6, 182, 212, 0.25);
                animation-delay: 4s;
            }

            .blob-4 {
                bottom: 10%;
                right: 20%;
                width: 380px;
                height: 380px;
                background: rgba(16, 185, 129, 0.25);
                animation-delay: 6s;
            }

            @keyframes blob {
                0%, 100% {
                    transform: translate(0, 0) scale(1) rotate(0deg);
                }
                25% {
                    transform: translate(40px, -60px) scale(1.1) rotate(90deg);
                }
                50% {
                    transform: translate(-30px, 30px) scale(0.9) rotate(180deg);
                }
                75% {
                    transform: translate(50px, 50px) scale(1.05) rotate(270deg);
                }
            }

            .logo-icon {
                filter: drop-shadow(0 0 20px rgba(167, 139, 250, 0.8));
                transition: all 0.3s ease;
            }

            .logo-icon:hover {
                filter: drop-shadow(0 0 30px rgba(236, 72, 153, 1));
                transform: scale(1.1) rotate(5deg);
            }

            .neon-text {
                text-shadow: 
                    0 0 10px rgba(167, 139, 250, 0.8),
                    0 0 20px rgba(236, 72, 153, 0.6),
                    0 0 30px rgba(34, 211, 238, 0.4);
            }

            .footer-glow {
                text-shadow: 0 0 15px rgba(139, 92, 246, 0.3);
                color: #7c3aed;
            }

            .footer-cyan {
                color: #0891b2;
            }
        </style>
    </head> 
 
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Animated Background Blobs -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="blob blob-1"></div>
                <div class="blob blob-2"></div>
                <div class="blob blob-3"></div>
                <div class="blob blob-4"></div>
            </div>
            
            <!-- Scanline Effect -->
            <div class="absolute inset-0 pointer-events-none" style="background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(139, 92, 246, 0.015) 2px, rgba(139, 92, 246, 0.015) 4px); opacity: 0.5;"></div>
            
            <div class="relative z-10 logo-container">
                <a href="/" class="flex flex-col items-center gap-4 group">
                    <x-application-logo class="w-24 h-24 fill-current text-purple-400 logo-icon" />
                    <div class="text-center">
                        <h1 class="text-5xl font-black logo-gradient neon-text tracking-tighter uppercase">
                            Inventory
                        </h1>
                        <p class="text-sm font-bold tracking-widest uppercase mt-2" style="color: var(--neon-cyan); text-shadow: 0 0 10px rgba(34, 211, 238, 0.5);">
                            ⚡ Management System ⚡
                        </p>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-10 px-8 py-10 glass-effect overflow-hidden sm:rounded-3xl form-container transition-all duration-500">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm font-bold footer-glow relative z-10" style="color: var(--neon-purple);">
                <p class="uppercase tracking-widest">
                    &copy; {{ date('Y') }} Inventory System
                </p>
                <p class="text-xs mt-2" style="color: var(--neon-cyan);">
                    All Rights Reserved
                </p>
            </div>
            
            <!-- Floating Particles -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <div class="absolute w-2 h-2 rounded-full" style="background: var(--neon-purple); top: 20%; left: 15%; animation: float 4s ease-in-out infinite; box-shadow: 0 0 10px rgba(167, 139, 250, 0.8);"></div>
                <div class="absolute w-2 h-2 rounded-full" style="background: var(--neon-pink); top: 40%; right: 20%; animation: float 5s ease-in-out infinite 1s; box-shadow: 0 0 10px rgba(244, 114, 182, 0.8);"></div>
                <div class="absolute w-2 h-2 rounded-full" style="background: var(--neon-cyan); bottom: 30%; left: 25%; animation: float 6s ease-in-out infinite 2s; box-shadow: 0 0 10px rgba(34, 211, 238, 0.8);"></div>
                <div class="absolute w-2 h-2 rounded-full" style="background: var(--neon-purple); top: 60%; right: 30%; animation: float 4.5s ease-in-out infinite 1.5s; box-shadow: 0 0 10px rgba(167, 139, 250, 0.8);"></div>
            </div>
        </div>
    </body>
</html>