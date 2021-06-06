<input
    x-data="{date: new Date()}"
    x-model="$wire.dateOutput"
    x-ref="input"
    x-init="
    flatpickr($refs.input,
        {locale: 'es',
        enableTime: true,
        time_24hr: true,
        minDate: 'today',
        defaultDate: date,
        altInput: true,
        altFormat: 'F j - H:i',
        inline: true
        })

        $wire.set('dateOutput', date)
        "
    type="text"
    {{ $attributes }}
>
