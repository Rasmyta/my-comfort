<div>
    <x-slot name="title">
        {{ __('Salones') }}
    </x-slot>

    <div class="flex-col space-y-4">
        <x-table>
            <x-slot name="head">
                <x-table.heading class="w-full">{{ __('Nombre') }}</x-table.heading>
                <x-table.heading>{{ __('Actividad') }}</x-table.heading>
                <x-table.heading>{{ __('Ciudad') }}</x-table.heading>
                <x-table.heading>{{ __('Gestor(FK)') }}</x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @forelse ($salons as $salon)
                    <x-table.row>
                        <x-table.cell>
                            <p class="font-semibold truncate">{{ $salon->name }}</p>
                        </x-table.cell>
                        <x-table.cell>
                            <p class="">{{ $salon->activity }}</p>
                        </x-table.cell>
                        <x-table.cell>
                            <p class="">{{ $salon->city }}</p>
                        </x-table.cell>
                        <x-table.cell>
                            <x-button.link>Gestor</x-button.link>
                        </x-table.cell>
                        <x-table.cell>
                            <x-button.link>Edit</x-button.link>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="6">
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

        <div>
            {{ $salons->links() }}
        </div>
    </div>

</div>
