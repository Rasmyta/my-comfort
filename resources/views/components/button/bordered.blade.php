<x-button
    {{ $attributes->merge(['class' => 'px-3 py-1 text-sm font-medium leading-5 text-purple-600 transition-colors duration-150 bg-white border border-4 border-purple-600 rounded-md active:bg-purple-700 hover:bg-purple-600 hover:text-white focus:outline-none focus:shadow-outline-purple']) }}>
    {{ $slot }}</x-button>
