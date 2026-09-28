<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-8">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#a65b3e]">Bienvenido de nuevo</p>
        <h2 class="mt-3 font-display text-4xl leading-tight text-[#20332e]">Inicia sesión</h2>
        <p class="mt-3 text-sm leading-6 text-[#65746d]">Retoma tu búsqueda y continúa preparando tu próxima candidatura.</p>
    </div>

    <x-auth-session-status class="mb-5 rounded-md border border-[#c9dfd0] bg-[#eaf4ed] px-4 py-3 text-sm text-[#27634d]" :status="session('status')" />

    <form wire:submit="login" class="grid gap-5">
        <div class="grid gap-2">
            <label for="email" class="text-sm font-semibold text-[#30443c]">Correo electrónico</label>
            <input wire:model="form.email" id="email" class="w-full rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15" type="email" name="email" placeholder="tu@correo.com" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('form.email')" class="text-sm text-[#a64036]" />
        </div>

        <div class="grid gap-2">
            <label for="password" class="text-sm font-semibold text-[#30443c]">Contraseña</label>
            <input wire:model="form.password" id="password" class="w-full rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15" type="password" name="password" placeholder="Tu contraseña" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('form.password')" class="text-sm text-[#a64036]" />
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3">
            <label for="remember" class="inline-flex items-center gap-2.5 text-sm text-[#65746d]">
                <input wire:model="form.remember" id="remember" type="checkbox" class="h-4 w-4 rounded border-[#b9c8bd] text-[#27634d] focus:ring-[#39785d]/30" name="remember">
                <span>Recordarme</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-[#27634d] underline decoration-[#a6c2b3] underline-offset-4 hover:text-[#173c35]" href="{{ route('password.request') }}" wire:navigate>¿Olvidaste tu contraseña?</a>
            @endif
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:target="login" class="mt-1 inline-flex w-full items-center justify-center rounded-md bg-[#27634d] px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-[#1e513d] focus:outline-none focus:ring-2 focus:ring-[#39785d] focus:ring-offset-2 disabled:cursor-wait disabled:opacity-70">
            <span wire:loading.remove wire:target="login">Iniciar sesión</span>
            <span wire:loading wire:target="login">Entrando...</span>
        </button>

        <div class="flex items-center gap-4 py-1 text-xs font-medium uppercase tracking-[0.14em] text-[#89968f]">
            <span class="h-px flex-1 bg-[#dce4dd]"></span>
            <span>o continúa con</span>
            <span class="h-px flex-1 bg-[#dce4dd]"></span>
        </div>

        <a href="{{ route('google.redirect') }}" class="inline-flex w-full items-center justify-center rounded-md border border-[#d4ded6] bg-white px-5 py-3 text-sm font-semibold text-[#30443c] transition hover:border-[#a9bdb0] hover:bg-[#f8faf7] focus:outline-none focus:ring-2 focus:ring-[#39785d]/30 focus:ring-offset-2">
            Continuar con Google
        </a>
    </form>
</div>
