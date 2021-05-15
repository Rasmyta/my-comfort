<x-table.row wire:loading.class.delay="opacity-60">
    <x-table.cell>
        <p class="font-semibold truncate">{{ $service->name }}</p>
    </x-table.cell>
    <x-table.cell>
        <p>{{ $service->duration }}</p>
    </x-table.cell>
    <x-table.cell>
        <p>{{ $service->price }}</p>
    </x-table.cell>
    <x-table.cell>
        @if ($service->getCategory)
            <p>{{ $service->getCategory->name }}</p>
        @endif
    </x-table.cell>
    <x-table.cell>
        <p>{{ $service->subcategory }}</p>
    </x-table.cell>
    <x-table.cell>
        <p>{{ now() }}</p>
    </x-table.cell>
    {{-- testing --}}
    <x-table.cell>
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @elseif($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif
    </x-table.cell>
    {{-- testing --}}
    <x-table.cell>
        <div x-data="{open: @entangle('isSelected').defer}">
            <x-button.primary x-show="!open" wire:click="toggleCartItem({{ $service->id }})">Seleccionar</x-button.primary>
            <x-button.primary x-show="open" wire:click="toggleCartItem({{ $service->id }})">Deseleccionar</x-button.primary>
        </div>
    </x-table.cell>
</x-table.row>
