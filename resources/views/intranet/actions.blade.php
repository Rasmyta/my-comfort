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
        {{-- Modify visibility with policies
             <div>
                <x-button.primary wire:click="create">
                    <x-icon.plus></x-icon.plus> New
                </x-button.primary>
             </div> --}}
    </div>
</div>
