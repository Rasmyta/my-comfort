<div>
    <x-slot name="title">
        {{ __($title) }}
    </x-slot>

    <div class="flex gap-8">
        <x-table-show-one class="w-2/3">
            <x-slot name="body">
                <x-table.row>
                    <x-table.heading>{{ __('Actividad') }}</x-table.heading>
                    <x-table.cell>{{ $salon->getActivity->name }}</x-table.cell>
                </x-table.row>
                <x-table.row>
                    <x-table.heading>{{ __('Empleados') }}</x-table.heading>
                    <x-table.cell>{{ $salon->employees }}</x-table.cell>
                </x-table.row>
                <x-table.row>
                    <x-table.heading>{{ __('Dirección') }}</x-table.heading>
                    <x-table.cell whitespace="whitespace-normal">
                        {{ $salon->address . ', ' . $salon->city . ', ' . $salon->postal_code }}</x-table.cell>
                </x-table.row>
                <x-table.row>
                    <x-table.heading>{{ __('Gestor') }}</x-table.heading>
                    <x-table.cell>{{ $salon->getManager->name }}</x-table.cell>
                </x-table.row>
                <x-table.row>
                    <x-table.heading>{{ __('Descripción') }}</x-table.heading>
                    <x-table.cell whitespace="whitespace-normal">{{ $salon->description }}</x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table-show-one>

        <x-table-show-one class="flex-shrink-0 min-w-80 mx-auto">
            <x-slot name="head">
                <x-table.row>
                    <x-table.heading>{{ __('Horario') }}</x-table.heading>
                    <x-table.heading />
                </x-table.row>
            </x-slot>
            <x-slot name="body">
                @for ($i = 1; $i < count($columns) - 2; $i++)
                    <x-table.row>
                        <x-table.heading>{{ $columns[$i] }}</x-table.heading>
                        <x-table.heading>{{ $salon->getTimetable[$columns[$i]] }}</x-table.heading>
                    </x-table.row>
                @endfor
            </x-slot>
        </x-table-show-one>
    </div>

    <div class=" my-10">

        @if ($errors->any())
            <div class="bg-red-500" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="space-x-3 flex justify-center items-center">
            <span x-data="{ open: false }" x-init="
                        @this.on('notify-saved', () => {
                            if (open === false) setTimeout(() => { open = false }, 3500);
                            open = true;
                        })
                    " x-show.transition.out.duration.1000ms="open" style="display: none;"
                class="bg-green-400 text-white py-2 px-4 border rounded-md text-sm leading-5 font-medium focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out">
                Guardado!</span>
            @if ($newImages)
                <x-button.primary wire:click.prevent="saveImages()">{{ __('Guardar') }}</x-button.primary>
            @endif
        </div>


        <form>
            <x-input.group label="" for="newImages" inline="true" :error="$errors->first('newImages.*')">
                <x-input.file-pond wire:model="newImages" multiple />
            </x-input.group>
        </form>

        <div class="flex flex-wrap gap-1 justify-items-center justify-start">
            @foreach ($images as $image)
                <img src="{{ Storage::disk('s3')->url($image->path) }}" alt="Salon image"
                    class="max-w-28 h-20 md:max-w-48 md:h-40" />
            @endforeach
        </div>
    </div>

</div>
