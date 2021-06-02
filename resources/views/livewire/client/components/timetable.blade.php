<x-table-show-one class="flex-shrink-0 min-w-80">
    <tbody class="bg-white">
        <x-table.row>
            <th class="px-4 py-2 text-left leading-4 font-medium text-cool-gray-500 tracking-wider">{{ __('Lunes') }}
            </th>
            <th class="px-4 py-1 text-right leading-4 font-medium text-cool-gray-500 tracking-wider">
                <p><span>{{ $timetable->monday_start }}</span> - <span>{{ $timetable->monday_end }}</span></p>
            </th>
        </x-table.row>
        <x-table.row>
            <th class="px-4 py-2 text-left leading-4 font-medium text-cool-gray-500 tracking-wider">{{ __('Martes') }}
            </th>
            <th class="px-4 py-1 text-right leading-4 font-medium text-cool-gray-500 tracking-wider">
                <p><span>{{ $timetable->tuesday_start }}</span> - <span>{{ $timetable->tuesday_end }}</span></p>
            </th>
        </x-table.row>
        <x-table.row>
            <th class="px-4 py-2 text-left leading-4 font-medium text-cool-gray-500 tracking-wider">
                {{ __('Miércoles') }}</th>
            <th class="px-4 py-1 text-right leading-4 font-medium text-cool-gray-500 tracking-wider">
                <p><span>{{ $timetable->wednesday_start }}</span> - <span>{{ $timetable->wednesday_end }}</span></p>
            </th>
        </x-table.row>
        <x-table.row>
            <th class="px-4 py-2 text-left leading-4 font-medium text-cool-gray-500 tracking-wider">{{ __('Jueves') }}
            </th>
            <th class="px-4 py-1 text-right leading-4 font-medium text-cool-gray-500 tracking-wider">
                <p><span>{{ $timetable->thursday_start }}</span> - <span>{{ $timetable->thursday_end }}</span></p>
            </th>
        </x-table.row>
        <x-table.row>
            <th class="px-4 py-2 text-left leading-4 font-medium text-cool-gray-500 tracking-wider">
                {{ __('Viernes') }}</th>
            <th class="px-4 py-1 text-right leading-4 font-medium text-cool-gray-500 tracking-wider">
                <p><span>{{ $timetable->friday_start }}</span> - <span>{{ $timetable->friday_end }}</span></p>
            </th>
        </x-table.row>
        <x-table.row>
            <th class="px-4 py-2 text-left leading-4 font-medium text-cool-gray-500 tracking-wider">
                {{ __('Sábado') }}</th>
            <th class="px-4 py-1 text-right leading-4 font-medium text-cool-gray-500 tracking-wider">
                <p><span>{{ $timetable->saturday_start }}</span> - <span>{{ $timetable->saturday_end }}</span></p>
            </th>
        </x-table.row>
        <x-table.row>
            @if (empty($timetable->sunday_start))
                <th class="px-4 py-2 text-left leading-4 font-medium text-cool-gray-400 tracking-wider">
                    {{ __('Domingo') }}</th>
                <th class="px-4 py-1 text-right leading-4 font-medium text-cool-gray-400 tracking-wider">
                    <p><span>{{ __('Cerrado') }}</span></p>
                </th>
            @else
                <th class="px-4 py-2 text-left leading-4 font-medium text-cool-gray-500 tracking-wider">
                    {{ __('Domingo') }}</th>
                <th class="px-4 py-1 text-right leading-4 font-medium text-cool-gray-500 tracking-wider">
                    <p><span>{{ $timetable->sunday_start }}</span> - <span>{{ $timetable->sunday_end }}</span></p>
                </th>
            @endif

        </x-table.row>
    </tbody>
</x-table-show-one>
