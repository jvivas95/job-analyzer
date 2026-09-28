<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false, accountOpen: false }" class="relative z-20 border-b border-[#dce4dd] bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex min-h-16 items-center justify-between gap-5 py-3">
            <a href="{{ route('dashboard') }}" wire:navigate class="inline-flex shrink-0 items-center gap-3" aria-label="Job Analyzer, inicio">
                <span class="flex h-9 w-9 items-center justify-center rounded-md bg-[#173c35] text-xs font-semibold text-white">JA</span>
                <span class="hidden text-sm font-semibold text-[#20332e] sm:inline">Job Analyzer</span>
            </a>

            <div class="hidden items-center gap-1 sm:flex">
                <a href="{{ route('dashboard') }}" wire:navigate @class(['rounded-md px-3 py-2 text-sm font-medium transition', 'bg-[#eaf2ec] text-[#27634d]' => request()->routeIs('dashboard'), 'text-[#65746d] hover:bg-[#f3f6f2] hover:text-[#20332e]' => !request()->routeIs('dashboard')])>
                    Inicio
                </a>
                <a href="{{ route('offers.index') }}" wire:navigate @class(['rounded-md px-3 py-2 text-sm font-medium transition', 'bg-[#eaf2ec] text-[#27634d]' => request()->routeIs('offers.index', 'offers.show'), 'text-[#65746d] hover:bg-[#f3f6f2] hover:text-[#20332e]' => !request()->routeIs('offers.index', 'offers.show')])>
                    Mis ofertas
                </a>
                <a href="{{ route('offers.create') }}" wire:navigate @class(['rounded-md px-3 py-2 text-sm font-medium transition', 'bg-[#eaf2ec] text-[#27634d]' => request()->routeIs('offers.create'), 'text-[#65746d] hover:bg-[#f3f6f2] hover:text-[#20332e]' => !request()->routeIs('offers.create')])>
                    Nueva oferta
                </a>
                <a href="{{ route('profile.edit') }}" wire:navigate @class(['rounded-md px-3 py-2 text-sm font-medium transition', 'bg-[#eaf2ec] text-[#27634d]' => request()->routeIs('profile.edit'), 'text-[#65746d] hover:bg-[#f3f6f2] hover:text-[#20332e]' => !request()->routeIs('profile.edit')])>
                    CV
                </a>
            </div>

            <div class="hidden sm:block">
                <div class="relative">
                    <button type="button" @click="accountOpen = !accountOpen" @click.outside="accountOpen = false" :aria-expanded="accountOpen.toString()" class="inline-flex items-center gap-2.5 rounded-md border border-[#dce4dd] bg-white px-2.5 py-1.5 text-sm font-medium text-[#30443c] transition hover:border-[#b9cbbf] focus:outline-none focus:ring-2 focus:ring-[#39785d]/20">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-[#f6e8dc] text-xs font-semibold text-[#a65b3e]">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
                        <span class="max-w-36 truncate">{{ auth()->user()->name }}</span>
                        <span aria-hidden="true" class="text-xs text-[#7a8881]">⌄</span>
                    </button>

                    <div x-cloak x-show="accountOpen" x-transition.origin.top.right class="absolute right-0 top-full mt-2 w-56 overflow-hidden rounded-md border border-[#dce4dd] bg-white py-1 shadow-lg shadow-[#173c35]/10">
                        <a href="{{ route('profile') }}" wire:navigate class="block px-4 py-2.5 text-sm text-[#53675f] transition hover:bg-[#f3f6f2] hover:text-[#20332e]">Configuración cuenta</a>
                        <button type="button" wire:click="logout" class="block w-full px-4 py-2.5 text-left text-sm text-[#a65b3e] transition hover:bg-[#fbf3ed]">Cerrar sesión</button>
                    </div>
                </div>
            </div>

            <button type="button" @click="open = !open" :aria-expanded="open.toString()" aria-label="Abrir menú" class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-[#dce4dd] text-[#30443c] transition hover:bg-[#f3f6f2] focus:outline-none focus:ring-2 focus:ring-[#39785d]/20 sm:hidden">
                <span class="text-xl leading-none" x-text="open ? '×' : '☰'"></span>
            </button>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden border-t border-[#dce4dd] bg-white px-4 pb-4 pt-3 sm:hidden">
        <div class="grid gap-1">
            <a href="{{ route('dashboard') }}" wire:navigate @class(['rounded-md px-3 py-2.5 text-sm font-medium', 'bg-[#eaf2ec] text-[#27634d]' => request()->routeIs('dashboard'), 'text-[#53675f] hover:bg-[#f3f6f2]' => !request()->routeIs('dashboard')])>Inicio</a>
            <a href="{{ route('offers.index') }}" wire:navigate @class(['rounded-md px-3 py-2.5 text-sm font-medium', 'bg-[#eaf2ec] text-[#27634d]' => request()->routeIs('offers.index', 'offers.show'), 'text-[#53675f] hover:bg-[#f3f6f2]' => !request()->routeIs('offers.index', 'offers.show')])>Mis ofertas</a>
            <a href="{{ route('offers.create') }}" wire:navigate @class(['rounded-md px-3 py-2.5 text-sm font-medium', 'bg-[#eaf2ec] text-[#27634d]' => request()->routeIs('offers.create'), 'text-[#53675f] hover:bg-[#f3f6f2]' => !request()->routeIs('offers.create')])>Nueva oferta</a>
            <a href="{{ route('profile') }}" wire:navigate @class(['rounded-md px-3 py-2.5 text-sm font-medium', 'bg-[#eaf2ec] text-[#27634d]' => request()->routeIs('profile'), 'text-[#53675f] hover:bg-[#f3f6f2]' => !request()->routeIs('profile.edit')])>Configuración cuenta</a>
        </div>

        <div class="mt-3 flex items-center justify-between gap-3 border-t border-[#dce4dd] pt-3">
            <div class="min-w-0">
                <p class="truncate text-sm font-semibold text-[#30443c]">{{ auth()->user()->name }}</p>
                <p class="truncate text-xs text-[#7a8881]">{{ auth()->user()->email }}</p>
            </div>
            <button type="button" wire:click="logout" class="shrink-0 rounded-md px-3 py-2 text-sm font-medium text-[#a65b3e] hover:bg-[#fbf3ed]">Cerrar sesión</button>
        </div>
    </div>
</nav>
