<div>
    <x-slot name="title">
        {{ __($title) }}
    </x-slot>

    @include("intranet.actions")

     <!-- Advanced Search -->
    <div>
        @if ($showFilters)
            <div class="bg-cool-gray-200 p-4 rounded shadow-inner flex relative">
                <div class="w-1/2 pr-2 space-y-4">
                    <x-input.group inline for="filter-activity" label="Actividad">
                        <x-input.select wire:model="filters.activity_id" id="filter-activity">
                            <option value="" disabled>{{ __('Selecciona Actividad...') }}</option>

                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>
                </div>
                <div class="w-1/2 pl-2 space-y-4">
                    <x-input.group inline for="filter-city" label="Ciudad">
                        <x-input.text wire:model.lazy="filters.city" id="filter-city" />
                    </x-input.group>
                </div>

                <x-button.reset-filters></x-button.reset-filters>
            </div>
        @endif
    </div>

    <!-- Salons Table -->
    <div class="grid grid-cols-1 lg:max-w-7xl space-y-4">
        <x-table>
            <x-slot name="head">
                <x-table.heading class="pr-0 w-8">
                    <x-input.checkbox wire:model="selectPage" />
                </x-table.heading>
                <x-table.heading />
                <x-table.heading sortable wire:click="sortBy('name')"
                    :direction="$sortField === 'name' ? $sortDirection : null" class="w-full">
                    {{ __('Nombre') }}</x-table.heading>
                <x-table.heading>{{ __('Actividad') }}</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('employees')"
                    :direction="$sortField === 'employees' ? $sortDirection : null">{{ __('Empleados') }}
                </x-table.heading>
                <x-table.heading sortable wire:click="sortBy('address')"
                    :direction="$sortField === 'address' ? $sortDirection : null">{{ __('Dirección') }}
                </x-table.heading>
                <x-table.heading>{{ __('Gestor(FK)') }}</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="6">
                            @unless($selectAll)
                                <div>
                                    <span>You have selected <strong>{{ $salons->count() }}</strong> salons,
                                        do you want to select all <strong>{{ $salons->total() }}</strong>?</span>
                                    <x-button.link wire:click="selectAll" class="pl-0">Select All</x-button.link>
                                </div>
                            @else
                                <span>You are currently selecting all <strong>{{ $salons->total() }}</strong>
                                    sallons.</span>
                            @endunless
                        </x-table.cell>
                    </x-table.row>
                @endif

                @forelse ($salons as $salon)
                    <x-table.row wire:loading.class.delay="opacity-60" wire:key="row-{{ $salon->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $salon->id }}" />
                        </x-table.cell>
                        <x-table.cell>
                            <div class="flex items-center space-x-1 text-sm">
                                <x-button.link wire:click="edit({{ $salon->id }})" aria-label="Edit">
                                    <x-icon.edit></x-icon.edit>
                                </x-button.link>
                                <x-button.link aria-label="Delete" wire:click="delete({{ $salon->id }})"
                                    aria-label="Delete">
                                    <x-icon.trash></x-icon.trash>
                                </x-button.link>
                            </div>
                        </x-table.cell>
                        <x-table.cell>
                            <p class="font-semibold truncate">{{ $salon->name }}</p>
                        </x-table.cell>
                        <x-table.cell>
                            <p class="">{{ $salon->getActivity->name }}</p>
                        </x-table.cell>
                        <x-table.cell>
                            <p class="">{{ $salon->employees }}</p>
                        </x-table.cell>
                        <x-table.cell>
                            <p class="">{{ $salon->address . ', ' . $salon->city . ', ' . $salon->postal_code }}</p>
                        </x-table.cell>
                        <x-table.cell>
                            <x-button.link>{{ $salon->getManager->name }}</x-button.link>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="5">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span
                                    class="font-medium py-8 text-cool-gray-400 text-xl">{{ __('No se encontraron salones
                                    ...') }}</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>
        <!-- Pagination -->
        <x-table.pagination>
            <x-slot name="links">{{ $salons->links() }}</x-slot>
        </x-table.pagination>
    </div>


    <!-- Update / Create Modal -->
    <div>
        @if ($showEditModal)
            <form wire:submit.prevent="save">
                <x-modal.dialog wire:model.defer="showEditModal">
                    <x-slot name="title">{{ $titleModal }}</x-slot>
                    <x-slot name="content">
                        <x-input.group for="name" label="Nombre" :error="$errors->first('editing.name')">
                            <x-input.text wire:model="editing.name" id="name" />
                        </x-input.group>
                        <x-input.group for="activity" label="Actividad" :error="$errors->first('editing.activity')">
                            <x-input.select wire:model="editing.activity_id" id="activity_id">
                                @foreach ($activities as $activity)
                                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                @endforeach
                            </x-input.select>
                        </x-input.group>
                        <x-input.group for="employees" label="Empleados" :error="$errors->first('editing.employees')">
                            <x-input.text wire:model="editing.employees" id="employees" />
                        </x-input.group>
                        <x-input.group for="address" label="Dirección" :error="$errors->first('editing.address')">
                            <x-input.text wire:model="editing.address" id="address" />
                        </x-input.group>
                        <x-input.group for="city" label="Ciudad" :error="$errors->first('editing.city')">
                            <x-input.text wire:model="editing.city" id="city" />
                        </x-input.group>
                        <x-input.group for="postal_code" label="Código postal"
                            :error="$errors->first('editing.postal_code')">
                            <x-input.text wire:model="editing.postal_code" id="postal_code" />
                        </x-input.group>
                        <x-input.group for="description" label="Descripción"
                            :error="$errors->first('editing.description')">
                            <x-input.textarea wire:model="editing.description" id="description" />
                        </x-input.group>
                    </x-slot>
                    <x-slot name="footer">
                        <x-button.secondary wire:click="$set('showEditModal', false)">{{ __('Cancelar') }}
                        </x-button.secondary>
                        <x-button.primary type="submit">{{ __('Guardar') }}</x-button.primary>
                    </x-slot>
                </x-modal.dialog>
            </form>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div>
        @if ($showDeleteModal)
            <form wire:submit.prevent="deleteConfirm">
                <x-modal.confirmation wire:model.defer="showDeleteModal">
                    <x-slot name="title">{{ __('Eliminar Salon') }}</x-slot>

                    <x-slot name="content">
                        <div class="py-8 text-cool-gray-700">{{ __('¿Está seguro? Esta acción es irreversible.') }}
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-button.secondary wire:click="$set('showDeleteModal', false)">{{ __('Cancelar') }}
                        </x-button.secondary>

                        <x-button.primary type="submit">{{ __('Eliminar') }}</x-button.primary>
                    </x-slot>
                </x-modal.confirmation>
            </form>

        @endif
    </div>
</div>
