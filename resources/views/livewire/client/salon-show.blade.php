<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $salon->name }}
        </h2>
    </x-slot>


    @if (session('message'))
        <div class="bg-green-500 text-white p-4 w-1/3" role="alert">
            {{ session('message') }}
        </div>
    @elseif($errors->any())
        <div class="bg-red-500 text-white p-4 w-1/3" role="alert">
            {{ $errors->first() }}
        </div>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 overflow-hidden sm:rounded-lg">
                {{-- {{ dd( Cart::content())}} --}}
                {{-- @forelse (Cart::content() as $item)
                    <p>{{ 'ID: ' . $item->id . ', ' . $item->name }}</p>
                @empty
                    <p>Cart is empty</p>
                @endforelse --}}

                <!-- Flickity carousel -->
                <div class="gallery mb-8" data-flickity='{ "cellAlign": "left", "imagesLoaded": true,  "wrapAround": true, "fullscreen": true}'>
                    @foreach ($images as $image)
                        <div class="gallery-cell">
                            <img src="{{ Storage::url($image->path) }}" alt="Salon image" />
                        </div>
                    @endforeach
                </div>


                <!-- Services -->
                <div class="bg-white ">
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
</div>
