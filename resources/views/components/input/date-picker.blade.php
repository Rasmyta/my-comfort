<input
    x-data="{dateTime: new Date()}"
    x-model="$wire.dateOutput"
    x-ref="input"
    x-init="
    flatpickr($refs.input,
        {locale: 'es',
        enableTime: true,
        time_24hr: true,
        minDate: 'today',
        defaultDate: dateTime,
        altInput: true,
        altFormat: 'F j - H:i',
        inline: true
        })

        $wire.set('dateOutput', dateTime)
        $wire.set('timeOutput', dateTime.toLocaleTimeString('es-ES'))
        "
    type="text"
    {{ $attributes }}
>
