@props(['head' => '', 'body' => ''])

<div class="align-middle w-2/3 overflow-y-auto overflow-x-auto shadow overflow-hidden sm:rounded-lg scrollbar-thin scrollbar-thumb-rounded-full scrollbar-track-rounded-full scrollbar-thumb-gray-300 scrollbar-track-gray-100 dark:scrollbar-track-gray-700 dark:scrollbar-thumb-gray-600">
    <table class="text-left min-w-full divide-y divide-cool-gray-200">
        @if ($head)
            <thead>
                <tr class="dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800">
                    {{ $head }}
                </tr>
            </thead>
        @endif

        @if ($body)
            <tbody class="bg-white divide-y divide-cool-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                {{ $body }}
            </tbody>
        @endif

        {{ $slot }}
    </table>
</div>
