<x-table.row wire:loading.class.delay="opacity-60">
    {{-- testing --}}
    <x-table.cell>
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @elseif($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif
    </x-table.cell>
    {{-- testing --}}

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
    <x-table.cell>
        <x-button.primary wire:click="add({{ $service->id }})">Seleccionar</x-button.primary>
    </x-table.cell>
</x-table.row>
