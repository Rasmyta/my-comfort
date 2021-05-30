@props(['notify' => ''])

<span x-data="{ open: false }" x-init="
                @this.on('{{ $notify }}', () => {
                    if (open === false) setTimeout(() => { open = false }, 3500);
                    open = true;
                })
            " x-show.transition.out.duration.1000ms="open" style="display: none;"
    class="bg-green-400 text-white py-2 px-4 border rounded-md text-sm leading-5 font-medium focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out">
    {{ __('Guardado!') }}
</span>
