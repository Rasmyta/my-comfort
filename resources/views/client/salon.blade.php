<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $salon->name }}
        </h2>
    </x-slot>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white mb-6 overflow-hidden shadow-xl sm:rounded-lg">
                {{-- {{ dd( Cart::content())}} --}}
                @forelse (Cart::content() as $item)
                    <p>{{ 'ID: ' . $item->id . ', ' . $item->name }}</p>
                @empty
                    <p>Cart is empty</p>
                @endforelse


                <!-- Salon Table -->
                {{-- <div class="">
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>{{ __('Nombre') }}</x-table.heading>
                            <x-table.heading>{{ __('Actividad') }}</x-table.heading>
                            <x-table.heading>{{ __('Dirección') }}</x-table.heading>
                        </x-slot>

                        <x-slot name="body">
                            <x-table.row>
                                <x-table.cell>
                                    <p class="font-semibold truncate">{{ $salon->name }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p>{{ $salon->getActivity->name }}</p>
                                </x-table.cell>
                                <x-table.cell>
                                    <p>{{ $salon->address . ', ' . $salon->city . ', ' . $salon->postal_code }}
                                    </p>
                                </x-table.cell>
                            </x-table.row>

                        </x-slot>
                    </x-table>
                </div> --}}

                <!-- Services -->
                <div class="">
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>{{ __('Nombre') }}</x-table.heading>
                            <x-table.heading>{{ __('Duración') }}</x-table.heading>
                            <x-table.heading>{{ __('Precio') }}</x-table.heading>
                            <x-table.heading>{{ __('Categoría') }}</x-table.heading>
                            <x-table.heading>{{ __('Subcategoría') }}</x-table.heading>
                            <x-table.heading>{{ now() }}</x-table.heading>
                        </x-slot>

                        <x-slot name="body">
                            @forelse ($salon->getServices as $service)
                                {{-- Service Components --}}
                                @livewire('client.components.service-component', ['service' => $service],
                                key($service->id))
                            @empty
                                <x-table.row>
                                    <x-table.cell colspan="9">
                                        <div class="flex justify-center items-center space-x-2">
                                            <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                            <span
                                                class="font-medium py-8 text-cool-gray-400 text-xl">{{ __('No se encontraron servicios ...') }}</span>
                                        </div>
                                    </x-table.cell>
                                </x-table.row>
                            @endforelse
                        </x-slot>
                    </x-table>
                </div>

            </div>

            <a href="{{ url()->previous() }}">
                <x-button.primary><i class="fas fa-chevron-left"></i> Ir Atrás</x-button.primary>
            </a>
        </div>
    </div>
</x-app-layout>
