<div>
    <div class="grid grid-cols-2 justify-between py-2 my-2">
        <div class="flex flex-col ">
            <p class="text-gray-600 font-semibold">{{ $service->name }}</p>

            <x-duration duration="{{ $service->duration }}" class="inline"></x-duration>

        </div>
        <div class="flex flex-row items-center justify-end">
            <p class="text-gray-600 font-semibold pr-2">{{ number_format($service->price, 2) }} €</p>
            <div x-data="{open: @entangle('isSelected')}">
                <x-button.bordered x-show="!open" wire:click="toggleCartItem({{ $service->id }})">{{ __('Seleccionar') }}
                </x-button.bordered>
                <x-button.primary x-show="open" wire:click="toggleCartItem({{ $service->id }})">{{ __('Seleccionado') }}
                </x-button.primary>
            </div>
        </div>
    </div>

    <!-- Session / error messages -->
    <x-notify.messages></x-notify.messages>

</div>
