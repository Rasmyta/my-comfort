<button
    {{ $attributes->merge([
    'type' => 'button',
    'class' => 'flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
]) }}>
    {{ $slot }}
</button>
