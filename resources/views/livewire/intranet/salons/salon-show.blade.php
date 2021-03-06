<div>
    <x-slot name="title">
        {{ __($title) }}
    </x-slot>

    <!-- Main Info -->
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
                    @if ($salon->getManager)
                        <x-table.cell>{{ $salon->getManager->name }}</x-table.cell>
                    @else
                        <x-table.cell></x-table.cell>
                    @endif
                </x-table.row>
                <x-table.row>
                    <x-table.heading>{{ __('Descripción') }}</x-table.heading>
                    <x-table.cell whitespace="whitespace-normal">{{ $salon->description }}</x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table-show-one>

        <!-- Timetable -->
        @if ($timetable)
            <form wire:submit.prevent="editTimetable">
            <x-table-show-one class="flex-shrink-0 min-w-80 mx-auto">
                <x-slot name="head">
                    <x-table.row>
                        <x-table.heading>{{ __('Horario') }}</x-table.heading>
                        <x-table.heading>
                            <x-notify.saved notify="timetable-saved" />
                            <x-button.bordered type="submit" id="confirm-time" style="display: none;">
                                {{ __('Confirmar cambios') }}
                            </x-button.bordered>
                        </x-table.heading>
                    </x-table.row>
                </x-slot>
                <x-slot name="body">
                    <x-table.row>
                        <x-table.heading>{{ __('lunes') }}</x-table.heading>
                        <x-table.heading class="weekDays dark:weekDays tooltipTimetable">
                            <div class="flex flex-nowrap dark:text-gray-900">
                                <input wire:model.defer="{{ 'timetable.monday_start' }}" type="time" disabled>
                                <input wire:model.defer="{{ 'timetable.monday_end' }}" type="time" disabled>
                            </div>
                        </x-table.heading>
                    </x-table.row>
                    <x-table.row>
                        <x-table.heading>{{ __('martes') }}</x-table.heading>
                        <x-table.heading class="weekDays dark:weekDays tooltipTimetable">
                            <div class="flex flex-nowrap dark:text-gray-900">
                                <input wire:model.defer="{{ 'timetable.tuesday_start' }}" type="time" disabled>
                                <input wire:model.defer="{{ 'timetable.tuesday_end' }}" type="time" disabled>
                            </div>
                        </x-table.heading>
                    </x-table.row>
                    <x-table.row>
                        <x-table.heading>{{ __('miércoles') }}</x-table.heading>
                        <x-table.heading class="weekDays dark:weekDays tooltipTimetable">
                            <div class="flex flex-nowrap dark:text-gray-900">
                                <input wire:model.defer="{{ 'timetable.wednesday_start' }}" type="time" disabled>
                                <input wire:model.defer="{{ 'timetable.wednesday_end' }}" type="time" disabled>
                            </div>
                        </x-table.heading>
                    </x-table.row>
                    <x-table.row>
                        <x-table.heading>{{ __('jueves') }}</x-table.heading>
                        <x-table.heading class="weekDays dark:weekDays tooltipTimetable">
                            <div class="flex flex-nowrap dark:text-gray-900">
                                <input wire:model.defer="{{ 'timetable.thursday_start' }}" type="time" disabled>
                                <input wire:model.defer="{{ 'timetable.thursday_end' }}" type="time" disabled>
                            </div>
                        </x-table.heading>
                    </x-table.row>
                    <x-table.row>
                        <x-table.heading>{{ __('viernes') }}</x-table.heading>
                        <x-table.heading class="weekDays dark:weekDays tooltipTimetable">
                            <div class="flex flex-nowrap dark:text-gray-900">
                                <input wire:model.defer="{{ 'timetable.friday_start' }}" type="time" disabled>
                                <input wire:model.defer="{{ 'timetable.friday_end' }}" type="time" disabled>
                            </div>
                        </x-table.heading>
                    </x-table.row>
                    <x-table.row>
                        <x-table.heading>{{ __('sábado') }}</x-table.heading>
                        <x-table.heading class="weekDays dark:weekDays tooltipTimetable">
                            <div class="flex flex-nowrap dark:text-gray-900">
                                <input wire:model.defer="{{ 'timetable.saturday_start' }}" type="time" disabled>
                                <input wire:model.defer="{{ 'timetable.saturday_end' }}" type="time" disabled>
                            </div>
                        </x-table.heading>
                    </x-table.row>
                    <x-table.row>
                        <x-table.heading>{{ __('domingo') }}</x-table.heading>
                        <x-table.heading class="weekDays dark:weekDays tooltipTimetable">
                            <div class="flex flex-nowrap dark:text-gray-900">
                                <input wire:model.defer="{{ 'timetable.sunday_start' }}" type="time" disabled>
                                <input wire:model.defer="{{ 'timetable.sunday_end' }}" type="time" disabled>
                            </div>
                        </x-table.heading>
                    </x-table.row>
                </x-slot>
            </x-table-show-one>
        </form>
        @endif
    </div>

    <!-- Photos -->
    <div class=" my-10">

        <!-- Buttons -->
        <div class="space-x-3 flex justify-center items-center">
            <x-notify.saved notify="image-saved" />
            <span wire:loading wire:target="saveImages" class="bg-green-300 text-white py-2 px-4 border rounded-md text-sm leading-5 font-medium focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out">{{ __('Guardando...') }}</span>
            @if ($newImages)
                <x-button.primary wire:click.prevent="saveImages()"  @click="event.target.style.display='none';">{{ __('Guardar') }}</x-button.primary>
            @endif
        </div>

        <!-- Upload New Photos -->
        @if ($showForm)
            <form>
                <x-input.group label="" for="newImages" inline="true" :error="$errors->first('newImages.*')">
                    <x-input.file-pond wire:model="newImages" multiple />
                </x-input.group>
            </form>
        @endif

        <!-- Show All Photos -->
        <div class="flex flex-wrap gap-1 justify-items-center justify-start">
            @foreach ($images as $image)
                <img src="{{ Storage::disk('s3')->url($image->path) }}" alt="Salon image"
                    class="max-w-28 h-20 md:max-w-48 md:h-40" />
            @endforeach
        </div>
    </div>

</div>
