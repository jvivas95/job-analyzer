<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

use App\Models\Profile;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Profile::create([
            'user_id' => $user->id,
            'full_name' => $user->name,
            'email' => $user->email,
            ]);

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#a65b3e]">Empieza por aquí</p>
        <h2 class="mt-3 font-display text-4xl leading-tight text-[#20332e]">Crea tu cuenta</h2>
        <p class="mt-3 text-sm leading-6 text-[#65746d]">Organiza tus oportunidades y prepara cada candidatura desde un solo lugar.</p>
    </div>

    <form wire:submit="register" class="grid gap-4">
        <div class="grid gap-2">
            <label for="name" class="text-sm font-semibold text-[#30443c]">Nombre completo</label>
            <input wire:model="name" id="name" class="w-full rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15" type="text" name="name" placeholder="Tu nombre" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="text-sm text-[#a64036]" />
        </div>

        <div class="grid gap-2">
            <label for="email" class="text-sm font-semibold text-[#30443c]">Correo electrónico</label>
            <input wire:model="email" id="email" class="w-full rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15" type="email" name="email" placeholder="tu@correo.com" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="text-sm text-[#a64036]" />
        </div>

        <div class="grid gap-2">
            <label for="password" class="text-sm font-semibold text-[#30443c]">Contraseña</label>
            <input wire:model="password" id="password" class="w-full rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15" type="password" name="password" placeholder="Crea una contraseña" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="text-sm text-[#a64036]" />
        </div>

        <div class="grid gap-2">
            <label for="password_confirmation" class="text-sm font-semibold text-[#30443c]">Confirma tu contraseña</label>
            <input wire:model="password_confirmation" id="password_confirmation" class="w-full rounded-md border border-[#d4ded6] bg-white px-4 py-3 text-sm text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15" type="password" name="password_confirmation" placeholder="Repite tu contraseña" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-sm text-[#a64036]" />
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:target="register" class="mt-2 inline-flex w-full items-center justify-center rounded-md bg-[#27634d] px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-[#1e513d] focus:outline-none focus:ring-2 focus:ring-[#39785d] focus:ring-offset-2 disabled:cursor-wait disabled:opacity-70">
            <span wire:loading.remove wire:target="register">Crear cuenta</span>
            <span wire:loading wire:target="register">Creando cuenta...</span>
        </button>
    </form>
</div>
