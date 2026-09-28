<div class="min-h-[calc(100vh-4rem)] bg-[#f3f6f2] px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
    <div class="mx-auto max-w-5xl">
        <header class="mb-8 border-b border-[#dce4dd] pb-6">
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#a65b3e]">Tu información profesional</p>
            <h1 class="mt-2 font-display text-4xl leading-tight text-[#20332e]">Mi perfil</h1>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-[#65746d]">Mantén actualizada tu experiencia para obtener análisis de ofertas más precisos y candidaturas mejor adaptadas.</p>
        </header>

        <div class="profile-form">

                @if (session('success'))
                    <div class="mb-6 rounded-md border border-[#c9dfd0] bg-[#eaf4ed] px-4 py-3 text-sm text-[#27634d]" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit="save" class="grid gap-8">
                    <section class="grid gap-5 border-b border-[#dce4dd] pb-8">
                        <div>
                            <h2 class="font-display text-2xl text-[#20332e]">Datos personales</h2>
                            <p class="mt-1 text-sm text-[#65746d]">Información básica para identificar tu perfil.</p>
                        </div>

                    <div>
                        <x-input-label for="full_name" value="Nombre completo" />
                        <x-text-input
                            wire:model="full_name"
                            id="full_name"
                            type="text"
                            readonly
                            class="mt-1 block w-full" />
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

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
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

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
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
                        <textarea wire:model="summary" id="summary" rows="5" placeholder="Resume tu experiencia, especialidad y principales fortalezas..." class="mt-1 block w-full resize-y rounded-md border border-[#d4ded6] bg-white px-3 py-2.5 text-sm leading-6 text-[#20332e] shadow-sm placeholder:text-[#9aa69f] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15"></textarea>
                        <x-input-error :messages="$errors->get('summary')" class="mt-2" />
                    </div>
                    </section>

                    <section class="grid gap-5 border-b border-[#dce4dd] pb-8">
                        <div>
                            <h2 class="font-display text-2xl text-[#20332e]">Habilidades</h2>
                            <p class="mt-1 text-sm text-[#65746d]">Añade competencias para afinar la comparación con cada puesto.</p>
                        </div>
                    <div class="grid gap-2">
                        <x-input-label value="Habilidades técnicas" />

                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($skills as $index => $skill)
                                <span class="inline-flex items-center gap-2 rounded-md bg-[#e5f2e8] px-2.5 py-1.5 text-sm text-[#27634d]">
                                    {{ $skill }}
                                    <button type="button" wire:click="removeSkill({{ $index }})" aria-label="Eliminar {{ $skill }}" class="text-[#537761] hover:text-[#173c35]">
                                        &times;
                                    </button>
                                </span>
                            @endforeach
                        </div>

                        <x-text-input
                            type="text"
                            wire:model="newSkill"
                            wire:keydown.enter.prevent="addSkill"
                            placeholder="Escribe una habilidad y pulsa Enter"
                            class="w-full rounded-md"
                        />
                        <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                    </div>

                    {{-- Soft Skills --}}
                    <div class="grid gap-2">
                        <x-input-label value="Soft Skills" />

                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($soft_skills as $index => $soft_skill)
                                <span class="inline-flex items-center gap-2 rounded-md bg-[#f6e8dc] px-2.5 py-1.5 text-sm text-[#92533b]">
                                    {{ $soft_skill }}
                                    <button type="button" wire:click="removeSoftSkill({{ $index }})" aria-label="Eliminar {{ $soft_skill }}" class="text-[#a65b3e] hover:text-[#783d2c]">
                                        &times;
                                    </button>
                                </span>
                            @endforeach
                        </div>

                        <x-text-input
                            type="text"
                            wire:model="newSoftSkill"
                            wire:keydown.enter.prevent="addSoftSkill"
                            placeholder="Escribe una soft skill y pulsa Enter"
                            class="w-full rounded-md"
                        />
                        <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                    </div>
                    </section>

                    <section class="grid gap-5 border-b border-[#dce4dd] pb-8">
                    <div>
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                            <h2 class="font-display text-2xl text-[#20332e]">Experiencia laboral</h2>

                            <button type="button" wire:click="addExperience" class="rounded-md border border-[#b9cbbf] px-3 py-2 text-sm font-semibold text-[#27634d] transition hover:bg-white">Añadir experiencia</button>
                        </div>

                        <!-- Si no hay nada en la experiencia (control con @ if por seguridad) -->
                        @if (empty($experience))
                            <p class="text-sm text-[#7a8881]">
                                No has añadido ninguna experiencia laboral todavía.
                            </p>
                        @else
                            <!-- Recorremos los datos (vengan de la BD o sean nuevos) -->
                            @foreach ($experience as $index => $item)
                                <div wire:key="experience-item-{{ $index }}" class="relative grid gap-4 rounded-md border border-[#dce4dd] bg-white p-4 sm:p-5">

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
                                        <div class="mt-3 flex items-center gap-2">
                                            <input
                                                id="is_current-{{ $index }}"
                                                type="checkbox"
                                                wire:model.live="experience.{{ $index }}.is_current"
                                                class="h-4 w-4 rounded border-[#b9cbbf] text-[#27634d] focus:ring-[#39785d]/30"
                                            >
                                            <x-input-label for="is_current-{{ $index }}" value="Trabajo actualmente aquí" />
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
                                                    <x-input-label value="Fecha de fin" />
                                                    <x-text-input
                                                        type="text"
                                                        value="Actualmente"
                                                        disabled
                                                        class="mt-1 block w-full cursor-not-allowed bg-[#f3f6f2] text-[#7a8881]"
                                                    />
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Descripción -->
                                        <div>
                                            <x-input-label for="description-{{ $index }}" value="Descripción" />
                                            <textarea
                                                id="description-{{ $index }}"
                                                wire:model="experience.{{ $index }}.description"
                                                rows="3"
                                                class="mt-1 block w-full resize-y rounded-md border border-[#d4ded6] bg-white px-3 py-2.5 text-sm text-[#20332e] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15"
                                            ></textarea>
                                            <x-input-error :messages="$errors->get('experience.' . $index . '.description')" class="mt-1" />
                                        </div>
                                    </div>

                                    <!-- Botón de eliminar este registro específico -->
                                    <div class="flex justify-end">
                                        <button type="button" wire:click="removeExperience({{ $index }})" class="rounded-md px-3 py-2 text-sm font-medium text-[#a64036] transition hover:bg-[#fbf3ed]">Eliminar experiencia</button>
                                    </div>

                                </div>
                            @endforeach
                        @endif

                        <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                    </div>
                    </section>

                    <section class="grid gap-5 border-b border-[#dce4dd] pb-8">
                    <div>
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                            <h2 class="font-display text-2xl text-[#20332e]">Proyectos personales <span class="font-sans text-sm font-normal text-[#7a8881]">(opcional)</span></h2>

                            <button type="button" wire:click="addProject" class="rounded-md border border-[#b9cbbf] px-3 py-2 text-sm font-semibold text-[#27634d] transition hover:bg-white">Añadir proyecto</button>
                        </div>
                        <!-- Recorremos los datos (vengan de la BD o sean nuevos) -->
                            @foreach ($projects as $index => $item)
                                <div wire:key="projects-item-{{ $index }}" class="relative grid gap-4 rounded-md border border-[#dce4dd] bg-white p-4 sm:p-5">

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
                                            <x-input-label for="secondary_url-{{ $index }}" value="Enlace secundario" />
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
                                            <textarea
                                                id="description-{{ $index }}"
                                                wire:model="projects.{{ $index }}.description"
                                                rows="3"
                                                class="mt-1 block w-full resize-y rounded-md border border-[#d4ded6] bg-white px-3 py-2.5 text-sm text-[#20332e] focus:border-[#39785d] focus:outline-none focus:ring-2 focus:ring-[#39785d]/15"
                                            ></textarea>
                                            <x-input-error :messages="$errors->get('projects.' . $index . '.description')" class="mt-1" />
                                        </div>
                                    </div>

                                    <!-- Botón de eliminar este registro específico -->
                                    <div class="flex justify-end">
                                        <button type="button" wire:click="removeProject({{ $index }})" class="rounded-md px-3 py-2 text-sm font-medium text-[#a64036] transition hover:bg-[#fbf3ed]">Eliminar proyecto</button>
                                    </div>

                                </div>
                            @endforeach

                    </div>
                    </section>

                    <section class="grid gap-5 border-b border-[#dce4dd] pb-8">
                    <div>
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                            <h2 class="font-display text-2xl text-[#20332e]">Formación académica</h2>

                            <button type="button" wire:click="addEducation" class="rounded-md border border-[#b9cbbf] px-3 py-2 text-sm font-semibold text-[#27634d] transition hover:bg-white">Añadir estudios</button>
                        </div>

                        <!-- Si no hay nada en la experiencia (control con @ if por seguridad) -->
                        @if (empty($education))
                            <p class="text-sm text-[#7a8881]">
                                No has añadido ningún estudio
                            </p>
                        @else
                            <!-- Recorremos los datos (vengan de la BD o sean nuevos) -->
                            @foreach ($education as $index => $item)
                                <div wire:key="education-item-{{ $index }}" class="relative grid gap-4 rounded-md border border-[#dce4dd] bg-white p-4 sm:p-5">

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Degree -->
                                        <div>
                                            <x-input-label for="degree-{{ $index }}" value="Nombre del estudio" />
                                            <x-text-input
                                                id="degree-{{ $index }}"
                                                type="text"
                                                wire:model="education.{{ $index }}.degree"
                                                class="mt-1 block w-full"
                                            />
                                            <x-input-error :messages="$errors->get('education.' . $index . '.role')" class="mt-1" />
                                        </div>

                                        <!-- Institution -->
                                        <div>
                                            <x-input-label for="institution-{{ $index }}" value="Centro" />
                                            <x-text-input
                                                id="institution-{{ $index }}"
                                                type="text"
                                                wire:model="education.{{ $index }}.institution"
                                                class="mt-1 block w-full"
                                            />
                                            <x-input-error :messages="$errors->get('education.' . $index . '.institution')" class="mt-1" />
                                        </div>

                                        <!-- Period -->
                                        <div class="mt-3 flex items-center gap-2">
                                            <input
                                                id="is_current-{{ $index }}"
                                                type="checkbox"
                                                wire:model.live="education.{{ $index }}.is_current"
                                                class="h-4 w-4 rounded border-[#b9cbbf] text-[#27634d] focus:ring-[#39785d]/30"
                                            >
                                            <x-input-label for="is_current-{{ $index }}" value="Estudio actualmente" />
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                            <!-- Fecha de Inicio -->
                                            <div>
                                                <x-input-label for="start_date-{{ $index }}" value="Fecha de inicio" />
                                                <x-text-input
                                                    id="start_date-{{ $index }}"
                                                    type="date"
                                                    wire:model="education.{{ $index }}.start_date"
                                                    class="mt-1 block w-full"
                                                />
                                                <x-input-error :messages="$errors->get('education.' . $index . '.start_date')" class="mt-1" />
                                            </div>

                                            <!-- Fecha de Fin (Se oculta si is_current es true) -->
                                            <div>
                                                @if (empty($item['is_current']))
                                                    <x-input-label for="end_date-{{ $index }}" value="Fecha de fin" />
                                                    <x-text-input
                                                        id="end_date-{{ $index }}"
                                                        type="date"
                                                        wire:model="education.{{ $index }}.end_date"
                                                        class="mt-1 block w-full"
                                                    />
                                                    <x-input-error :messages="$errors->get('education.' . $index . '.end_date')" class="mt-1" />
                                                @else
                                                    <x-input-label value="Fecha de fin" />
                                                    <x-text-input
                                                        type="text"
                                                        value="Actualmente"
                                                        disabled
                                                        class="mt-1 block w-full cursor-not-allowed bg-[#f3f6f2] text-[#7a8881]"
                                                    />
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Botón de eliminar este registro específico -->
                                    <div class="flex justify-end">
                                        <button type="button" wire:click="removeEducation({{ $index }})" class="rounded-md px-3 py-2 text-sm font-medium text-[#a64036] transition hover:bg-[#fbf3ed]">Eliminar estudios</button>
                                    </div>

                                </div>
                            @endforeach
                        @endif

                        <x-input-error :messages="$errors->get('education')" class="mt-2" />
                    </div>
                    </section>

                    {{-- <div>
                        <x-input-label for="soft_skills" value="Habilidades personales (opcional)" />
                        <x-text-input wire:model="soft_skills" id="soft_skills" type="text" class="mt-1 block w-full" />
                    </div> --}}

                    <section class="grid gap-5 border-b border-[#dce4dd] pb-8">
                    <div>
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                            <h2 class="font-display text-2xl text-[#20332e]">Idiomas</h2>
                            <button type="button"
                                    wire:click="addLanguage"
                                    class="rounded-md border border-[#b9cbbf] px-3 py-2 text-sm font-semibold text-[#27634d] transition hover:bg-white">
                                Añadir idioma
                            </button>
                        </div>

                        <div class="grid gap-3">
                            @foreach($languages as $index => $language)
                                <div wire:key="language-{{ $index }}" class="grid grid-cols-[minmax(0,1fr)_minmax(0,1fr)_auto] items-center gap-3">

                                    <!-- Nombre del idioma -->
                                    <div class="flex-1">
                                        <input type="text"
                                            wire:model="languages.{{ $index }}.name"
                                            placeholder="Ej: Español, Inglés, Catalán..."
                                            class="w-full rounded-md text-sm">
                                    </div>

                                    <!-- Desplegable de nivel -->
                                    <div class="min-w-0">
                                        <select wire:model="languages.{{ $index }}.level"
                                                class="w-full rounded-md text-sm">
                                            @foreach($languageLevels as $level)
                                                <option value="{{ $level }}">{{ $level }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Botón eliminar -->
                                    <button type="button"
                                            wire:click="removeLanguage({{ $index }})"
                                            class="flex h-9 w-9 items-center justify-center rounded-md text-[#a64036] transition hover:bg-[#fbf3ed]"
                                            title="Eliminar idioma">
                                        &times;
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    </section>

                    <div class="flex flex-wrap items-center gap-4 pb-4">
                        <button type="submit" wire:loading.attr="disabled" wire:target="save" class="inline-flex min-w-44 items-center justify-center rounded-md bg-[#27634d] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#1e513d] focus:outline-none focus:ring-2 focus:ring-[#39785d] focus:ring-offset-2 disabled:cursor-wait disabled:opacity-70">
                            <span wire:loading.remove wire:target="save">Guardar perfil</span>
                            <span wire:loading wire:target="save">Guardando...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
</div>
