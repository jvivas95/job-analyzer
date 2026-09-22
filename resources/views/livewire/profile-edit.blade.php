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
                        <x-input-label for="name" value="Nombre completo" />
                        <x-text-input
                            wire:model="name"
                            id="name"
                            type="text"
                            readonly
                            class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
                            <x-text-input
                                wire:model="email"
                                id="email"
                                type="text"
                                readonly
                                class="mt-1 block w-full"
                            />
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

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                                Experiencia Laboral
                            </h3>

                            <!-- Botón para añadir un nuevo bloque de experiencia -->
                            <x-secondary-button type="button" wire:click="addExperience">
                                + Añadir experiencia
                            </x-secondary-button>
                        </div>

                        <!-- Si no hay nada en la experiencia (control con @ if por seguridad) -->
                        @if (empty($experience))
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                No has añadido ninguna experiencia laboral todavía.
                            </p>
                        @else
                            <!-- Recorremos los datos (vengan de la BD o sean nuevos) -->
                            @foreach ($experience as $index => $item)
                                <div wire:key="experience-item-{{ $index }}" class="p-4 mb-4 border rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 relative">

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Nombre del puesto -->
                                        <div>
                                            <x-input-label for="role-{{ $index }}" value="Nombre del puesto" />
                                            <x-text-input
                                                id="role-{{ $index }}"
                                                type="text"
                                                wire:model="experience.{{ $index }}.role"
                                                class="mt-1 block w-full"
                                                placeholder="Ej. Desarrollador Web"
                                            />
                                            <x-input-error :messages="$errors->get('experience.' . $index . '.role')" class="mt-1" />
                                        </div>

                                        <!-- Empresa -->
                                        <div>
                                            <x-input-label for="company-{{ $index }}" value="Empresa" />
                                            <x-text-input
                                                id="company-{{ $index }}"
                                                type="text"
                                                wire:model="experience.{{ $index }}.company"
                                                class="mt-1 block w-full"
                                                placeholder="Ej. Mi Empresa S.L."
                                            />
                                            <x-input-error :messages="$errors->get('experience.' . $index . '.company')" class="mt-1" />
                                        </div>

                                        <!-- Period -->
                                        <div class="mt-3 flex items-center">
                                            <input
                                                id="is_current-{{ $index }}"
                                                type="checkbox"
                                                wire:model.live="experience.{{ $index }}.is_current"
                                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            >
                                            <x-input-label for="is_current-{{ $index }}" value="Trabajo actualmente aquí" class="ml-2" />
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                            <!-- Fecha de Inicio -->
                                            <div>
                                                <x-input-label for="start_date-{{ $index }}" value="Fecha de inicio" />
                                                <x-text-input
                                                    id="start_date-{{ $index }}"
                                                    type="date"
                                                    wire:model="experience.{{ $index }}.start_date"
                                                    class="mt-1 block w-full"
                                                />
                                                <x-input-error :messages="$errors->get('experience.' . $index . '.start_date')" class="mt-1" />
                                            </div>

                                            <!-- Fecha de Fin (Se oculta si is_current es true) -->
                                            <div>
                                                @if (empty($item['is_current']))
                                                    <x-input-label for="end_date-{{ $index }}" value="Fecha de fin" />
                                                    <x-text-input
                                                        id="end_date-{{ $index }}"
                                                        type="date"
                                                        wire:model="experience.{{ $index }}.end_date"
                                                        class="mt-1 block w-full"
                                                    />
                                                    <x-input-error :messages="$errors->get('experience.' . $index . '.end_date')" class="mt-1" />
                                                @else
                                                    <!-- Opcional: Un mensaje o campo deshabilitado indicando 'Actualidad' -->
                                                    <x-input-label value="Fecha de fin" />
                                                    <x-text-input
                                                        type="text"
                                                        value="Actualmente"
                                                        disabled
                                                        class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 cursor-not-allowed"
                                                    />
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Descripción -->
                                        <div>
                                            <x-input-label for="description-{{ $index }}" value="Descripción" />
                                            <x-text-input
                                                id="description-{{ $index }}"
                                                type="textarea"
                                                wire:model="experience.{{ $index }}.description"
                                                class="mt-1 block w-full"
                                            />
                                            <x-input-error :messages="$errors->get('experience.' . $index . '.description')" class="mt-1" />
                                        </div>
                                    </div>

                                    <!-- Botón de eliminar este registro específico -->
                                    <div class="mt-3 text-right">
                                        <x-danger-button type="button" wire:click="removeExperience({{ $index }})">
                                            Eliminar
                                        </x-danger-button>
                                    </div>

                                </div>
                            @endforeach
                        @endif

                        <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                                Proyectos personales (opcional)
                            </h3>

                            <!-- Botón para añadir un nuevo bloque de experiencia -->
                            <x-secondary-button type="button" wire:click="addProject">
                                + Añadir proyecto
                            </x-secondary-button>
                        </div>
                        <!-- Recorremos los datos (vengan de la BD o sean nuevos) -->
                            @foreach ($projects as $index => $item)
                                <div wire:key="projects-item-{{ $index }}" class="p-4 mb-4 border rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 relative">

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Nombre del proyecto -->
                                        <div>
                                            <x-input-label for="name-{{ $index }}" value="Nombre del proyecto" />
                                            <x-text-input
                                                id="name-{{ $index }}"
                                                type="text"
                                                wire:model="projects.{{ $index }}.name"
                                                class="mt-1 block w-full"
                                            />
                                            <x-input-error :messages="$errors->get('projects.' . $index . '.name')" class="mt-1" />
                                        </div>

                                        <!-- URL -->
                                        <div>
                                            <x-input-label for="url-{{ $index }}" value="URL" />
                                            <x-text-input
                                                id="url-{{ $index }}"
                                                type="url"
                                                wire:model="projects.{{ $index }}.url"
                                                class="mt-1 block w-full"
                                                placeholder="(opcional)"
                                            />
                                            <x-input-error :messages="$errors->get('projects.' . $index . '.url')" class="mt-1" />
                                        </div>

                                        <!-- Secondary URL -->
                                        <div>
                                            <x-input-label for="secondary_url-{{ $index }}" value="Secondary URL" />
                                            <x-text-input
                                                id="secondary_url-{{ $index }}"
                                                type="url"
                                                wire:model="projects.{{ $index }}.secondary_url"
                                                class="mt-1 block w-full"
                                                placeholder="(opcional)"
                                            />
                                            <x-input-error :messages="$errors->get('projects.' . $index . '.secondary_url')" class="mt-1" />
                                        </div>

                                        <!-- Descripción -->
                                        <div>
                                            <x-input-label for="description-{{ $index }}" value="Descripción" />
                                            <x-text-input
                                                id="description-{{ $index }}"
                                                type="textarea"
                                                wire:model="projects.{{ $index }}.description"
                                                class="mt-1 block w-full"
                                            />
                                            <x-input-error :messages="$errors->get('projects.' . $index . '.description')" class="mt-1" />
                                        </div>
                                    </div>

                                    <!-- Botón de eliminar este registro específico -->
                                    <div class="mt-3 text-right">
                                        <x-danger-button type="button" wire:click="removeProject({{ $index }})">
                                            Eliminar
                                        </x-danger-button>
                                    </div>

                                </div>
                            @endforeach

                    <div>
                        <x-input-label value="Habilidades técnicas" />

                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($skills as $index => $skill)
                                <span class="inline-flex items-center gap-1 bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">
                                    {{ $skill }}
                                    <button type="button" wire:click="removeSkill({{ $index }})" class="text-indigo-500 hover:text-indigo-900">
                                        &times;
                                    </button>
                                </span>
                            @endforeach
                        </div>

                        <input
                            type="text"
                            wire:model="newSkill"
                            wire:keydown.enter.prevent="addSkill"
                            placeholder="Escribe una habilidad y pulsa Enter"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                        >
                    </div>

                    <div>
                        <x-input-label for="education_text" value="Formación" />
                        <textarea wire:model="education_text" id="education_text" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    {{-- <div>
                        <x-input-label for="soft_skills" value="Habilidades personales (opcional)" />
                        <x-text-input wire:model="soft_skills" id="soft_skills" type="text" class="mt-1 block w-full" />
                    </div> --}}

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
