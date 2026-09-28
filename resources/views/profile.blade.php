<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#a65b3e]">Cuenta</p>
            <h1 class="mt-1 font-display text-3xl leading-tight text-[#20332e]">Configuración</h1>
        </div>
    </x-slot>

    <div class="account-settings px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <div class="mx-auto grid max-w-5xl gap-5">
            <section class="account-panel rounded-md border border-[#dce4dd] bg-white p-5 shadow-sm sm:p-8">
                <div class="max-w-2xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </section>

            <section class="account-panel rounded-md border border-[#dce4dd] bg-white p-5 shadow-sm sm:p-8">
                <div class="max-w-2xl">
                    <livewire:profile.update-password-form />
                </div>
            </section>

            <section class="account-panel account-panel-danger rounded-md border border-[#ecd4c7] bg-[#fffaf7] p-5 shadow-sm sm:p-8">
                <div class="max-w-2xl">
                    <livewire:profile.delete-user-form />
                </div>
            </section>
        </div>
    </div>

    <style>
        .account-settings .account-panel h2 {
            font-family: 'DM Serif Display', Georgia, serif;
            color: #20332e;
        }

        .account-settings .account-panel p {
            color: #65746d;
        }

        .account-settings .account-panel-danger h2 {
            color: #92533b;
        }
    </style>
</x-app-layout>
