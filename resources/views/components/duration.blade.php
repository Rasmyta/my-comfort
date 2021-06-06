@props(['duration'])

<div {{ $attributes->merge(['class' => '']) }} >
    @php $arr = explode(".", number_format($duration, 2));  @endphp

    @if ($arr[0] == 0)
        <span>{{ $arr[1] }} min</span>
    @elseif(isset($arr[1]) && $arr[1] == 0 && $arr[0] >= 2)
        <span>{{ $arr[0] }} horas</span>
    @elseif(isset($arr[1]) && $arr[1] == 0)
        <span>{{ $arr[0] }} hora</span>
    @elseif($arr[0] >= 2)
        <span>{{ $arr[0] . ' horas' . ' ' . $arr[1] . ' min' }}</span>
    @else
        <span>{{ $arr[0] . ' hora' . ' ' . $arr[1] . ' min' }}</span>
    @endif

    {{ $slot }}
</div>
