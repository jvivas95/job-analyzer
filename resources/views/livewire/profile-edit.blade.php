<div class="min-h-screen bg-[#0a1111] px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-6xl gap-6 lg:grid-cols-[1.3fr_0.7fr]">
        <div class="rounded-[30px] border border-[#24463f] bg-[#0d1716] p-6 shadow-[0_0_0_1px_rgba(88,166,146,0.12),0_20px_40px_rgba(10,18,17,0.75)] sm:p-8">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Mi perfil</h1>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit="save" class="space-y-6 bg-white p-6 rounded-lg shadow">

                    <div>
                        <x-input-label for="full_name" value="Nombre completo" />
                        <x-text-input wire:model="full_name" id="full_name" type="text" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="title" value="Título profesional" />
                        <x-text-input wire:model="title" id="title" type="text" class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label for="location" value="Ubicación" />
                        <x-text-input wire:model="location" id="location" type="text" class="mt-1 block w-full" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="email" value="Email de contacto" />
                            <x-text-input wire:model="email" id="email" type="text" class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-input-label for="phone" value="Teléfono" />
                            <x-text-input wire:model="phone" id="phone" type="text" class="mt-1 block w-full" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="linkedin" value="LinkedIn" />
                        <x-text-input wire:model="linkedin" id="linkedin" type="text" class="mt-1 block w-full" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="website" value="Sitio web (opcional)" />
                            <x-text-input wire:model="website" id="website" type="text" class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-input-label for="secondary_url" value="Enlace secundario (opcional)" />
                            <x-text-input wire:model="secondary_url" id="secondary_url" type="text" class="mt-1 block w-full" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="summary" value="Resumen profesional" />
                        <textarea wire:model="summary" id="summary" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="experience_text" value="Experiencia laboral" />
                        <textarea wire:model="experience_text" id="experience_text" rows="8" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('experience_text')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="projects_text" value="Proyectos personales (opcional)" />
                        <textarea wire:model="projects_text" id="projects_text" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div>
                        <x-input-label for="skills" value="Habilidades técnicas (separadas por comas)" />
                        <textarea wire:model="skills" id="skills" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="education_text" value="Formación" />
                        <textarea wire:model="education_text" id="education_text" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div>
                        <x-input-label for="soft_skills" value="Habilidades personales (opcional)" />
                        <x-text-input wire:model="soft_skills" id="soft_skills" type="text" class="mt-1 block w-full" />
                    </div>

                    <div>
                        <x-input-label for="languages" value="Idiomas" />
                        <x-text-input wire:model="languages" id="languages" type="text" class="mt-1 block w-full" />
                    </div>

                    <x-primary-button>Guardar perfil</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
