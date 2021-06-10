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
                    <x-input.group inline for="filter-role" label="Rol">
                        <x-input.select wire:model="filters.role_id" id="filter-role" class="mb-4">
                            <option value="" disabled>{{ __('Selecciona Rol...') }}</option>

                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </x-input.select>
                        <x-input.group inline for="filter-email" label="Email">
                            <x-input.text wire:model.lazy="filters.email" id="filter-email" />
                        </x-input.group>
                    </x-input.group>
                </div>
                <div class="w-1/2 pl-2 space-y-4">
                    <x-input.group inline for="filter-phone" label="Teléfono">
                        <x-input.text wire:model.lazy="filters.phone" id="filter-phone" />
                    </x-input.group>
                </div>

                <x-button.reset-filters></x-button.reset-filters>
            </div>
        @endif
    </div>

    <!-- Users Table -->
    <div class="grid grid-cols-1 lg:max-w-7xl space-y-4">
        <x-table>
            <x-slot name="head">
                <x-table.heading class="pr-0 w-8">
                    <x-input.checkbox wire:model="selectPage" />
                </x-table.heading>
                <x-table.heading />
                <x-table.heading sortable wire:click="sortBy('name')" :direction="$sortField === 'name' ? $sortDirection : null" class="w-full">
                    {{ __('Nombre') }}</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('surname')" :direction="$sortField === 'surname' ? $sortDirection : null">
                    {{ __('Apellidos') }}</x-table.heading>
                <x-table.heading>{{ __('Email') }}</x-table.heading>
                <x-table.heading>{{ __('Teléfono') }}</x-table.heading>
                <x-table.heading>{{ __('Código postal') }}</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('role_id')" :direction="$sortField === 'role_id' ? $sortDirection : null">
                    {{ __('Rol') }}</x-table.heading>
                <x-table.heading>{{ __('Registrado') }}</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="6">
                            @unless($selectAll)
                                <div>
                                    <span>You have selected <strong>{{ $users->count() }}</strong> users,
                                        do you want to select all <strong>{{ $users->total() }}</strong>?</span>
                                    <x-button.link wire:click="selectAll" class="pl-0">Select All</x-button.link>
                                </div>
                            @else
                                <span>You are currently selecting all <strong>{{ $users->total() }}</strong>
                                    users.</span>
                            @endunless
                        </x-table.cell>
                    </x-table.row>
                @endif

                @forelse ($users as $user)
                    <x-table.row wire:loading.class.delay="opacity-60" wire:key="row-{{ $user->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $user->id }}" />
                        </x-table.cell>
                        <x-table.cell>
                            <div class="flex items-center space-x-1 text-sm">
                                <x-button.link wire:click="edit({{ $user->id }})" aria-label="Edit"> <x-icon.edit></x-icon.edit></x-button.link>
                                <x-button.link wire:click="delete({{ $user->id }})" aria-label="Delete"><x-icon.trash></x-icon.trash></x-button.link>
                            </div>
                        </x-table.cell>
                        <x-table.cell><p class="font-semibold truncate">{{ $user->name }}</p></x-table.cell>
                        <x-table.cell><p>{{ $user->surname }}</p></x-table.cell>
                        <x-table.cell><p>{{ $user->email }}</p></x-table.cell>
                        <x-table.cell><p>{{ $user->phone }}</p></x-table.cell>
                        <x-table.cell><p>{{ $user->postal_code }}</p></x-table.cell>
                        <x-table.cell><p>{{ ucfirst($user->getRole->name) }}</p></x-table.cell>
                        <x-table.cell><p>{{ $user->created_at }}</p></x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="9">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">{{ __('No se encontraron usuarios ...') }}</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>



        {{-- @forelse ($user->getReviews as $review)
            {{ count($user->getReviews) }}
            <p>{{ $review->comment }}</p>
        @empty
            <p>No reviews.</p>
        @endforelse --}}

        <!-- Pagination -->
        <x-table.pagination>
            <x-slot name="links">{{ $users->links() }}</x-slot>
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
                        <x-input.group for="surname" label="Apellidos" :error="$errors->first('editing.surname')">
                            <x-input.text wire:model="editing.surname" id="surname" />
                        </x-input.group>
                        <x-input.group for="email" label="Email" :error="$errors->first('editing.email')">
                            <x-input.text wire:model="editing.email" id="email" />
                        </x-input.group>
                        <x-input.group for="phone" label="Teléfono" :error="$errors->first('editing.phone')">
                            <x-input.text wire:model="editing.phone" id="phone" />
                        </x-input.group>
                        <x-input.group for="postal_code" label="Código postal"
                            :error="$errors->first('editing.postal_code')">
                            <x-input.text wire:model="editing.postal_code" id="postal_code" />
                        </x-input.group>
                        <x-input.group for="role_id" label="Rol" :error="$errors->first('editing.role_id')">
                            <x-input.select wire:model="editing.role_id" id="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </x-input.select>
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
                    <x-slot name="title">{{ __('Eliminar Usuario') }}</x-slot>

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
