<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex flex-row gap-6 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="lg:w-1/2 bg-contain sm:rounded-lg" style="background-image: url('https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fcdn.images.express.co.uk%2Fimg%2Fdynamic%2F25%2F590x%2Fsecondary%2Fgoogle-maps-spain-photo-privacy-blur-1641607.jpg%3Fr%3D1544650962441&f=1&nofb=1');
                background-repeat:no-repeat;">
            </div>

            <div class="flex flex-col gap-6 w-full lg:w-1/2">
                <!-- Salon Components -->
                @forelse ($salons as $salon)
                    @livewire('client.components.salon-component', ['salonId' => $salon->id], key($salon->id))
                @empty
                    <div class="flex justify-center items-center space-x-2">
                        <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                        <span
                            class="font-medium py-8 text-cool-gray-400 text-xl">{{ __('No se encontraron salones ...') }}</span>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</div>
