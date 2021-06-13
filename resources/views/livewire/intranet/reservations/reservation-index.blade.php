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
                    <x-input.group inline for="filter-date-min" label="Fecha Mínima">
                        <x-input.text wire:model.lazy="filters.date-min" type="date" id="filter-date-min"/>
                    </x-input.group>
                    <x-input.group inline for="filter-date-max" label="Fecha Máxima">
                        <x-input.text wire:model.lazy="filters.date-max" type="date"  id="filter-date-max" />
                    </x-input.group>

                </div>
                <div class="w-1/2 pl-2 space-y-4">
                    <x-input.group inline for="filter-time-min" label="Hora Mínima">
                        <x-input.text wire:model.lazy="filters.time-min" type="time" id="filter-time-min"/>
                    </x-input.group>
                    <x-input.group inline for="filter-time-max" label="Hora Máxima">
                        <x-input.text wire:model.lazy="filters.time-max" type="time" id="filter-time-max"/>
                    </x-input.group>
                </div>

                <x-button.reset-filters></x-button.reset-filters>
            </div>
        @endif
    </div>


    <!-- Reservations Table -->
    <div class="grid grid-cols-1 lg:max-w-7xl space-y-4">
        <x-table>
            <x-slot name="head">
                <x-table.heading class="pr-0 w-8">
                    <x-input.checkbox wire:model="selectPage" />
                </x-table.heading>
                <x-table.heading>{{ __('Id') }}</x-table.heading>
                <x-table.heading>{{ __('Fecha') }}</x-table.heading>
                <x-table.heading>{{ __('Hora') }}</x-table.heading>
                @if (auth()->user()->getRole->name == 'admin') <x-table.heading>{{ __('Salón') }}</x-table.heading> @endif
                <x-table.heading>{{ __('Usuario') }}</x-table.heading>
                <x-table.heading>{{ __('Servicios') }}</x-table.heading>
                <x-table.heading>{{ __('Duración total') }}</x-table.heading>
            </x-slot>

            <x-slot name="body">
                @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-message">
                        <x-table.cell colspan="6">
                            @unless($selectAll)
                                <div>
                                    <span>You have selected <strong>{{ $reservations->count() }}</strong> reservations,
                                        do you want to select all <strong>{{ $reservations->total() }}</strong>?</span>
                                    <x-button.link wire:click="selectAll" class="pl-0">Select All</x-button.link>
                                </div>
                            @else
                                <span>You are currently selecting all <strong>{{ $reservations->total() }}</strong>
                                    reservations.</span>
                            @endunless
                        </x-table.cell>
                    </x-table.row>
                @endif

                @forelse ($reservations as $reservation)
                    <x-table.row wire:loading.class.delay="opacity-60" wire:key="row-{{ $reservation->id }}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{ $reservation->id }}" />
                        </x-table.cell>
                        <x-table.cell><p class="font-semibold truncate">{{ $reservation->id }}</p></x-table.cell>
                        <x-table.cell><p>{{ $reservation->date }}</p></x-table.cell>
                        <x-table.cell><p>{{ $reservation->time }}</p></x-table.cell>
                        @if (auth()->user()->getRole->name == 'admin')
                            <x-table.cell><a href="{{ route('intranet.salon.show', [$reservation->getSalon->id]) }}"><x-button.link>{{ $reservation->getSalon->name }}</x-button.link></a></x-table.cell>
                        @endif
                        <x-table.cell><a href="#"><x-button.link>{{ $reservation->getUser->name }}</x-button.link></a></x-table.cell>
                        <td class="grid grid-cols-1 gap-2 px-6 py-2 text-xs leading-5">
                            @foreach ($reservation->getServices as $service)
                                <p><span class="py-1 px-4 bg-purple-100 rounded-full text-xs font-medium text-gray-600">{{ $service->name }}</span></p>
                            @endforeach
                        </td>
                        <x-table.cell>
                            <x-duration duration="{{ $reservation->getTotalTime() }}" class="text-right mr-8"></x-duration>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="9">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">{{ __('No se encontraron reservas ...') }}</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <!-- Pagination -->
        <x-table.pagination>
            <x-slot name="links">{{ $reservations->links() }}</x-slot>
        </x-table.pagination>
    </div>


</div>
