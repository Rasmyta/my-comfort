<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1>Salones</h1>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @forelse ($salons as $salon)
                    <a href="{{ route('salon.show', [$salon->id]) }}">
                        <x-button.link>{{ $salon->name }}</x-button.link>
                    </a>
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
</x-app-layout>
