<div class="pt-8 pb-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex flex-row justify-between pb-2">
        <h2 class="font-semibold text-4xl text-white leading-tight subpixel-antialiased tracking-wide">
            {{ $salon->name }}</h2>
        <div class="flex items-center">
            <p class="font-bold pl-2 text-3xl text-yellow-200">4.5</p>
            <svg class="w-10 h-10 fill-current text-yellow-200" viewBox="0 0 24 24">
                <path
                    d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
            </svg>
            <svg class="w-10 h-10 fill-current text-yellow-200" viewBox="0 0 24 24">
                <path
                    d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
            </svg>
            <svg class="w-10 h-10 fill-current text-yellow-200" viewBox="0 0 24 24">
                <path
                    d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
            </svg>
            <svg class="w-10 h-10 fill-current text-yellow-50" viewBox="0 0 24 24">
                <path
                    d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
            </svg>
            <svg class="w-10 h-10 fill-current text-yellow-50" viewBox="0 0 24 24">
                <path
                    d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
            </svg>
        </div>
    </div>

    <!-- Flickity carousel -->
    @if (count($images) != 0)
        <div wire:ignore class="gallery mb-8 shadow-2xl sm:rounded-lg"
            data-flickity='{ "cellAlign": "left", "imagesLoaded": true,  "wrapAround": true, "fullscreen": true}'>
            @foreach ($images as $image)
                <div class="gallery-cell">
                    <img src="{{ Storage::url($image->path) }}" class=" sm:rounded-lg" alt="Salon image" />
                </div>
            @endforeach
        </div>
    @endif


    <!-- Session / error messages -->
    <x-messages class="w-1/3"></x-messages>

    <!-- Content -->
    <div class="bg-white mb-8 p-8 text-gray-500 sm:rounded-lg">

        <div>
            <!-- Cart Items Card -->
            <div style="position: sticky; top: 0; width: 20rem; float: right;">
                @if (count(Cart::content()) != 0)
                    <div class="p-4 bg-white shadow-2xl sm:rounded-lg">
                        @foreach (Cart::content() as $item)
                            <p
                                class="inline-block py-1 px-4 m-1 bg-purple-100 rounded-full text-sm font-medium text-gray-600">
                                {{ $item->name }} <i wire:click="removeCartItem('{{ $item->id }}')"
                                    class="fas fa-times p-2 cursor-pointer"></i>
                            </p>
                        @endforeach
                        <a href="#">
                            <div class="text-center text-lg font-semibold text-gray-600 py-2 px-4 my-3 rounded-full transition-colors duration-150 bg-yellow-200 hover:bg-yellow-300 hover:bg-opacity-75">
                                <p>{{ Cart::subtotal() }} €</p>
                                <p>{{ __('Escoge la hora') }}</p>
                            </div>
                        </a>
                    </div>
                @endif
            </div>

            <div class="">
                <!-- Services -->
                <div class="md:w-1/2 divide-y divide-gray-300">
                    <h2 class="text-2xl text-gray-600 pb-4">{{ __('Lista de servicios') }}</h2>
                    @forelse ($salon->getServices as $service)
                        {{-- Service Components --}}
                        @livewire('client.components.service-component', ['service' => $service], key($service->id))
                    @empty
                        <div class="flex justify-center items-center space-x-2">
                            <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                            <span
                                class="font-medium py-8 text-cool-gray-400 text-xl">{{ __('No se encontraron servicios ...') }}</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- About -->
        <div>
            <h2 class="text-2xl text-gray-600 py-4">{{ __('Sobre') }}</h2>
            <div class="grid grid-cols-4 justify-end">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3067.032731444075!2d3.163291414739535!3d39.76137350315973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x129632105559c20d%3A0x49fd4a284f8100af!2sPasseig%20Mallorca%2C%2007458%20Can%20Picafort%2C%20Illes%20Balears!5e0!3m2!1ses!2ses!4v1622671799328!5m2!1ses!2ses"
                    class="w-full col-span-2 shadow sm:rounded-lg" height="270" style="border:0;" allowfullscreen=""
                    loading="lazy">
                </iframe>
                <div class="flex flex-col flex-nowrap items-center gap-2 shadow sm:rounded-lg text-gray-500 px-8">
                    <x-icon.location class="w-10 h-10" />
                    <p class="text-lg text-gray-600 font-medium">{{ $salon->name }}</p>
                    <p>{{ $salon->address }}</p>
                    <p>{{ $salon->city }}</p>
                    <p>{{ $salon->postal_code }}</p>
                </div>
                <!-- Timetable Component -->
                @livewire('client.components.timetable', ['timetable' => $timetable])

            </div>

            <div class="my-4 w-2/3">
                <p>{{ $salon->description }}</p>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ url()->previous() }}">
            <x-button.primary><i class="fas fa-chevron-left"></i> Ir Atrás</x-button.primary>
        </a>
    </div>

</div>
