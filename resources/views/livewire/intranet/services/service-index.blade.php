<div>
    <x-slot name="title">
        {{ __($title) }}
    </x-slot>

    <!-- Actions -->
    <div class="flex mb-3 justify-between items-center">
        <div class="flex space-x-4 items-center">
            <x-input.search wire:model="filters.search" placeholder="Buscar..." />

            <x-button.link wire:click="toggleShowFilters">
                @if ($showFilters) Ocultar @endif Búsqueda Avanzada...
            </x-button.link>
        </div>
        <div class="space-x-2 flex items-center">
            <x-input.group borderless paddingless for="perPage" label="Por Página">
                <x-input.select wire:model="perPage" id="perPage">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </x-input.select>
            </x-input.group>
            @if ($selected)
                <div>
                    <x-button.primary wire:click="exportSelected">
                        <x-icon.download /> <span>{{ __('Exportar') }}</span>
                    </x-button.primary>
                </div>
            @else
                <div id="tooltipExport">
                    <x-button.primary disabled>
                        <x-icon.download /> <span>{{ __('Exportar') }}</span>
                    </x-button.primary>
                </div>
            @endif

            <div>
                @can('create', App\Models\Service::class)
                    <x-button.primary wire:click="create">
                        <x-icon.plus></x-icon.plus> New
                    </x-button.primary>
                @endcan
            </div>
        </div>
    </div>


    <!-- Advanced Search -->
    <div>
        @if ($showFilters)
            <div class="bg-cool-gray-200 p-4 rounded shadow-inner flex relative">
                <div class="w-1/2 pr-2 space-y-4">
                    <x-input.group inline for="filter-category" label="Categoría">
                        <x-input.select wire:model="filters.category_id" id="filter-category" class="mb-2">
                            <option value="" disabled>{{ __('Selecciona Categoría...') }}</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                            @endforeach
                        </x-input.select>
                        <x-input.group inline for="filter-duration-min" label="Duración Mínima">
                            <x-input.text wire:model.lazy="filters.duration-min" id="filter-duration-min" placeholder="0.00 Hora" />
                        </x-input.group>
                        <x-input.group inline for="filter-duration-max" label="Duración Máxima">
                            <x-input.text wire:model.lazy="filters.duration-max" id="filter-duration-max" placeholder="0.00 Hora" />
                        </x-input.group>
                    </x-input.group>
                </div>
                <div class="w-1/2 pl-2 space-y-4">
                     <x-input.group inline for="filter-salon_id" label="Salón">
                        <x-input.select wire:model="filters.salon_id" id="filter-salon" class="mb-2">
                                <option value="" disabled>{{ __('Selecciona Salón...') }}</option>

                                @foreach ($salons as $salon)
                                    <option value="{{ $salon->id }}">{{ ucfirst($salon->name) }}</option>
                                @endforeach
                            </x-input.select>
                        <x-input.group inline for="filter-price-min" label="Precio Mínimo">
                            <x-input.text wire:model.lazy="filters.price-min" id="filter-price-min" placeholder="0.00 €" />
                        </x-input.group>
                        <x-input.group inline for="filter-price-max" label="Precio Máximo">
                            <x-input.text wire:model.lazy="filters.price-max" id="filter-price-max" placeholder="0.00 €" />
                        </x-input.group>
                    </x-input.group>
                </div>

                <x-button.reset-filters></x-button.reset-filters>
            </div>
        @endif
    </div>

     <!-- Services Table -->
    <div class="grid grid-cols-1 lg:max-w-7xl space-y-4">
        <x-table>
            <x-slot name="head">
                <x-table.heading class="pr-0 w-8">
                    <x-input.checkbox wire:model="selectPage" />
                </x-table.heading>
                <x-table.heading />
                <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null" >
                    {{ __('Nombre') }}</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('duration')" :direction="$sortField === 'duration' ? $sortDirection : null">
                    {{ __('Duración') }}</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('price')" :direction="$sortField === 'price' ? $sortDirection : null">
                    {{ __('Precio') }}</x-table.heading>
                <x-table.heading>{{ __('Categoría') }}</x-table.heading>
                <x-table.heading>{{ __('Subcategoría') }}</x-table.heading>
                <x-table.heading>{{ __('Descripción') }}</x-table.heading>
                <x-table.heading>{{ __('Salón') }}</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="6">
                            @unless($selectAll)
                                <div>
                                    <span>You have selected <strong>{{ $services->count() }}</strong> users,
                                        do you want to select all <strong>{{ $services->total() }}</strong>?</span>
                                    <x-button.link wire:click="selectAll" class="pl-0">Select All</x-button.link>
                                </div>
                            @else
                                <span>You are currently selecting all <strong>{{ $services->total() }}</strong>
                                    users.</span>
                            @endunless
                        </x-table.cell>
                    </x-table.row>
                @endif

                @forelse ($services as $service)
                    <x-table.row wire:loading.class.delay="opacity-60" wire:key="row-{{ $service->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $service->id }}" />
                        </x-table.cell>
                        <x-table.cell>
                            <div class="flex items-center space-x-1 text-sm">
                                <x-button.link wire:click="edit({{ $service->id }})" aria-label="Edit"><x-icon.edit></x-icon.edit></x-button.link>
                                <x-button.link wire:click="delete({{ $service->id }})" aria-label="Delete"><x-icon.trash></x-icon.trash></x-button.link>
                            </div>
                        </x-table.cell>
                        <x-table.cell><p class="font-semibold truncate">{{ $service->name }}</p></x-table.cell>
                        <x-table.cell><p>{{ $service->duration }}</p></x-table.cell>
                        <x-table.cell><p>{{ $service->price }}</p></x-table.cell>
                        <x-table.cell>
                           @if ( $service->getCategory)<p>{{ $service->getCategory->name }}</p> @endif
                        </x-table.cell>
                        <x-table.cell><p>{{ $service->subcategory }}</p></x-table.cell>
                        <x-table.cell><p>{{ $service->description }}</p></x-table.cell>
                        <x-table.cell><p>{{ $service->getSalon->name }}</p></x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="9">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">{{ __('No se encontraron servicios ...') }}</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <!-- Pagination -->
        <x-table.pagination>
            <x-slot name="links">{{ $services->links() }}</x-slot>
        </x-table.pagination>
    </div>


    <!-- Update / Create Modal -->
    <div>
        @if ($showEditModal)

        {{-- TEST --}}
    <x-notify.messages class="w-1/3"></x-notify.messages>

            <form wire:submit.prevent="save">
                <x-modal.dialog wire:model.defer="showEditModal">
                    <x-slot name="title">{{ $titleModal }}</x-slot>
                    <x-slot name="content">
                        <x-input.group for="name" label="Nombre" :error="$errors->first('editing.name')">
                            <x-input.text wire:model="editing.name" id="name" />
                        </x-input.group>
                        <x-input.group for="duration" label="Duración" :error="$errors->first('editing.duration')">
                            <x-input.text wire:model="editing.duration" id="duration" placeholder="hh.mm" />
                        </x-input.group>
                         <x-input.group for="category_id" label="Categoría" :error="$errors->first('editing.category_id')">
                            <x-input.select wire:model="editing.category_id" id="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                @endforeach
                            </x-input.select>
                        </x-input.group>
                        <x-input.group for="subcategory" label="Subcategoría" :error="$errors->first('editing.subcategory')">
                            <x-input.text wire:model="editing.subcategory" id="subcategory" />
                        </x-input.group>
                        <x-input.group for="price" label="Precio" :error="$errors->first('editing.price')">
                            <x-input.text wire:model="editing.price" id="price" placeholder="0.00 €" />
                        </x-input.group>
                        <x-input.group for="description" label="Descripción" :error="$errors->first('editing.description')">
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
                    <x-slot name="title">{{ __('Eliminar Servicio') }}</x-slot>

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
