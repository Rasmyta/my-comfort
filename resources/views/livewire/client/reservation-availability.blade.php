<div class="pt-8 pb-10 max-w-7xl mx-auto sm:px-6 lg:px-8">

    <!-- Logo -->
    <div class="p-8 ">
        <a href="{{ route('welcome') }}"
            class="font-bold text-5xl text-white leading-tight subpixel-antialiased tracking-tighter">
            My Comfort
        </a>
    </div>

    <!-- Session / error messages -->
    <x-notify.messages class="w-1/3"></x-notify.messages>

    <!-- Content -->
    <div class="bg-white grid grid-cols-2 justify-between gap-6 mb-8 p-6 bg-white shadow-lg rounded-lg"
        style="min-height: 60vh;">
        @if (count(Cart::content()) != 0)
            <!-- DateTime Picker -->
            <div wire:ignore>
                <p class="font-medium pb-2">{{ __('Selecciona una hora para tu visita') }}</p>
                <x-input.date-picker id="date" />
            </div>
            <!-- Cart -->
            <div wire:loading.class="opacity-50">
                @foreach (Cart::content() as $item)
                    <div class="mt-8 px-4 m-1 font-medium text-gray-600 border-solid border-gray-300 border-b">
                        <p>{{ $item->name }}</p>
                        <div class="flex flex-nowrap justify-between items-center font-normal text-gray-500">
                            <x-duration duration="{{ $item->options->duration }}"></x-duration>
                            <span>{{ number_format($item->price, 2) . ' €' }} <i
                                    wire:click="removeCartItem('{{ $item->id }}')"
                                    class="fas fa-times p-2 cursor-pointer inline"></i></span>
                        </div>
                    </div>
                @endforeach
                <div class="text-right font-medium p-4">
                    <p>{{ __('Total Pedido') }}</p>
                    <p>{{ Cart::subtotal() }} €</p>
                    <p>{{ __('(pagarás en el salón)') }}</p>
                </div>

                @auth
                    <button wire:click="reserve" id="reserveBtn" type="button"
                        class="block w-full text-center text-lg font-semibold text-gray-600 py-2 px-4 my-3 rounded-full transition-colors duration-150 bg-yellow-200 hover:bg-yellow-300 hover:bg-opacity-75">
                        {{ __('Reserva') }}
                    </button>
                @endauth

                @guest
                    <a href="{{ route('register') }}">
                        <button id="reserveBtn" type="button"
                            class="block w-full text-center text-lg font-semibold text-gray-600 py-2 px-4 my-3 rounded-full transition-colors duration-150 bg-yellow-200 hover:bg-yellow-300 hover:bg-opacity-75">
                            {{ __('Reserva') }}
                        </button>
                    </a>
                @endguest
            </div>
        @else
            <div
                class="flex flex-col gap-4 flex-nowrap items-center justify-center text-lg col-span-2 font-medium leading-5 ">
                <p>{{ __('Tu cesta está vacía') }}</p>
                <a href="{{ route('salon.show', [$salon->id]) }}" class="text-purple-600">
                    <p><i class="fas fa-cart-plus"></i> {{ __('Añadir otro servicio de ' . $salon->name) }}</p>
                </a>
            </div>
        @endif
    </div>

    <div class="text-center">
        <a href="{{ url()->previous() }}">
            <x-button.primary><i class="fas fa-chevron-left"></i> Ir Atrás</x-button.primary>
        </a>
    </div>
</div>

@push('scripts')
    <script>

    </script>
@endpush
