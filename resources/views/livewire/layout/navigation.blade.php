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

<nav x-data="{ open: false }" class="border-b border-[#24463f] bg-[#0d1716] shadow-[0_10px_25px_rgba(10,18,17,0.45)]">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-[#ebfff8]" />
                    </a>
                </div>

                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-[#dfeae7] hover:text-[#edf8f4]">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('offers.index')" :active="request()->routeIs('offers.index')" class="text-[#dfeae7] hover:text-[#edf8f4]">
                        {{ __('Mis ofertas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('offers.create')" :active="request()->routeIs('offers.create')" class="text-[#dfeae7] hover:text-[#edf8f4]">
                        {{ __('Nueva oferta') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('offers.create')" class="text-[#dfeae7] hover:text-[#edf8f4]">
                        {{ __('Perfil') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded-md border border-[#2d4945] bg-[#122c29] px-3 py-2 text-sm font-medium leading-4 text-[#dfeae7] transition hover:border-[#4a8a7b] hover:text-[#edf8f4] focus:outline-none">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate class="text-[#dfeae7] hover:bg-[#143932]">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link class="text-[#dfeae7] hover:bg-[#143932]">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-[#9aa9a4] transition hover:bg-[#112b28] hover:text-[#edf8f4] focus:outline-none focus:bg-[#112b28] focus:text-[#edf8f4]">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="space-y-1 pt-2 pb-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate class="text-[#dfeae7] hover:bg-[#112b28]">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('offers.index')" :active="request()->routeIs('offers.index')" class="text-[#dfeae7] hover:bg-[#112b28]">
                {{ __('Mis ofertas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('offers.create')" :active="request()->routeIs('offers.create')" class="text-[#dfeae7] hover:bg-[#112b28]">
                {{ __('Nueva oferta') }}
            </x-responsive-nav-link>
        </div>

        <div class="border-t border-[#24463f] pt-4 pb-1">
            <div class="px-4">
                <div class="text-base font-medium text-[#edf8f4]" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="text-sm text-[#9aa9a4]">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate class="text-[#dfeae7] hover:bg-[#112b28]">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link class="text-[#dfeae7] hover:bg-[#112b28]">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
