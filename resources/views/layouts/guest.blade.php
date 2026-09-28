<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Job Analyzer</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|dm-serif-display:400&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f3f6f2] font-sans text-[#20332e] antialiased">
        <main class="grid min-h-screen lg:grid-cols-[0.92fr_1.08fr]">
            <aside class="relative hidden overflow-hidden bg-[#173c35] px-10 py-10 text-white lg:flex lg:flex-col lg:justify-between xl:px-16 xl:py-12">
                <a href="/" wire:navigate class="inline-flex w-fit items-center gap-3" aria-label="Job Analyzer, inicio">
                    <span class="flex h-10 w-10 items-center justify-center rounded-md bg-[#f2b66d] font-semibold text-[#173c35]">JA</span>
                    <span class="text-sm font-semibold tracking-wide">Job Analyzer</span>
                </a>

                <div class="mx-auto w-full max-w-lg py-12">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#b7d8c8]">Tu búsqueda, con más dirección</p>
                    <h1 class="mt-5 max-w-md font-display text-5xl leading-[1.08]">Cada oferta merece una estrategia.</h1>
                    <p class="mt-5 max-w-md text-base leading-7 text-[#d1dfd8]">Compara lo que pide cada puesto con tu experiencia y prepara una candidatura que hable de ti.</p>

                    <div class="mt-10 rounded-lg border border-white/15 bg-[#f3f6f2] p-5 text-[#20332e] shadow-xl shadow-black/10">
                        <div class="flex items-center justify-between border-b border-[#dce4dd] pb-4">
                            <div>
                                <p class="text-[10px] font-semibold uppercase tracking-[0.16em] text-[#648076]">Vista de análisis</p>
                                <p class="mt-1 text-sm font-semibold">Tu perfil frente a la oferta</p>
                            </div>
                            <span class="h-2.5 w-2.5 rounded-full bg-[#da805c]" aria-hidden="true"></span>
                        </div>

                        <div class="grid gap-3 pt-4">
                            <div class="flex items-center justify-between gap-4 text-sm">
                                <span class="text-[#53675f]">Habilidades coincidentes</span>
                                <span class="font-medium text-[#27634d]">Puntos fuertes</span>
                            </div>
                            <div class="h-1.5 overflow-hidden rounded-full bg-[#dce4dd]">
                                <div class="h-full w-3/4 rounded-full bg-[#4f9a70]"></div>
                            </div>
                            <div class="flex items-center justify-between gap-4 pt-2 text-sm">
                                <span class="text-[#53675f]">Requisitos por reforzar</span>
                                <span class="font-medium text-[#a65b3e]">Siguientes pasos</span>
                            </div>
                            <div class="h-1.5 overflow-hidden rounded-full bg-[#dce4dd]">
                                <div class="h-full w-2/5 rounded-full bg-[#da805c]"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-xs text-[#b7d8c8]">Un espacio para tomar mejores decisiones profesionales.</p>
            </aside>

            <section class="flex min-h-screen flex-col px-5 py-6 sm:px-8 lg:px-12 lg:py-10">
                <header class="flex items-center justify-between gap-4">
                    <a href="/" wire:navigate class="inline-flex items-center gap-2.5 lg:hidden" aria-label="Job Analyzer, inicio">
                        <span class="flex h-9 w-9 items-center justify-center rounded-md bg-[#173c35] text-xs font-semibold text-white">JA</span>
                        <span class="text-sm font-semibold">Job Analyzer</span>
                    </a>

                    <div class="ml-auto flex items-center gap-2 text-sm">
                        @if (request()->routeIs('register'))
                            <span class="hidden text-[#65746d] sm:inline">¿Ya tienes cuenta?</span>
                            <a href="{{ route('login') }}" wire:navigate class="font-semibold text-[#27634d] underline decoration-[#a6c2b3] underline-offset-4 transition hover:text-[#173c35]">Iniciar sesión</a>
                        @else
                            <span class="hidden text-[#65746d] sm:inline">¿Primera vez aquí?</span>
                            <a href="{{ route('register') }}" wire:navigate class="font-semibold text-[#27634d] underline decoration-[#a6c2b3] underline-offset-4 transition hover:text-[#173c35]">Crear cuenta</a>
                        @endif
                    </div>
                </header>

                <div class="flex flex-1 items-center justify-center py-10 lg:py-14">
                    <div class="w-full max-w-md">
                        {{ $slot }}
                    </div>
                </div>

                <footer class="text-center text-xs text-[#7a8881] lg:text-left">© {{ date('Y') }} Job Analyzer</footer>
            </section>
        </div>
    </body>
</html>
