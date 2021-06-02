<div class="grid grid-cols-2 justify-between py-2 my-2">

    <div class="flex flex-col ">
        <p class="text-gray-600 font-semibold">{{ $service->name }}</p>
        @php $arr = explode(".", number_format($service->duration, 2));  @endphp

        @if ($arr[0] == 0)
            <p>{{ $arr[1] }} min</p>
        @elseif(isset($arr[1]) && $arr[1] == 0 && $arr[0] >= 2)
            <p>{{ $arr[0] }} horas</p>
        @elseif(isset($arr[1]) && $arr[1] == 0)
            <p>{{ $arr[0] }} hora</p>
        @elseif($arr[0] >= 2)
            <p>{{ $arr[0] . ' horas' . ' ' . $arr[1] . ' min' }}</p>
        @else
            <p>{{ $arr[0] . ' hora' . ' ' . $arr[1] . ' min' }}</p>
        @endif
        {{-- @if ($service->getCategory)
            <p>{{ $service->getCategory->name }}</p>
        @endif --}}
    </div>
    <div class="flex flex-row items-center justify-end">
        {{-- test messages --}}
        @if (session('message'))
            <div class="bg-green-500 text-white p-4" role="alert">
                {{ session('message') }}
            </div>
        @elseif($errors->any())
            <div class="bg-red-500 text-white p-4" role="alert">
                {{ $errors->first() }}
            </div>
        @elseif($errors->any())
            <div class="bg-red-500 text-white p-4" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <p class="text-gray-600 font-semibold pr-2">{{ number_format($service->price, 2) }} €</p>
        <div x-data="{open: @entangle('isSelected').defer}">
            <x-button.primary x-show="!open" wire:click="toggleCartItem({{ $service->id }})">Seleccionar
            </x-button.primary>
            <x-button.primary x-show="open" wire:click="toggleCartItem({{ $service->id }})">Deseleccionar
            </x-button.primary>
        </div>
    </div>
</div>
