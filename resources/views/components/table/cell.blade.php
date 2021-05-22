@props(['whitespace' => 'whitespace-no-wrap'])

<td {{ $attributes->merge(['class' => 'px-6 py-2 text-sm leading-5 ' . $whitespace]) }}>
    {{ $slot }}
</td>
