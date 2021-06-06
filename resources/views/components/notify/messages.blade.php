<div>
    @if (session('message'))
        <div {{ $attributes->merge(['class' => 'bg-green-100 text-gray-600 text-sm p-2 mb-1 rounded-lg']) }}>
            <i class="far fa-check-circle"></i> {{ session('message') }}
        </div>
    @elseif(session('warning'))
        <div {{ $attributes->merge(['class' => 'bg-yellow-100 text-gray-600 text-sm p-2 mb-1 rounded-lg']) }}>
            <i class="fas fa-exclamation"></i> {{ session('warning') }}
        </div>
    @elseif($errors->any())
        <div {{ $attributes->merge(['class' => 'bg-red-200 text-gray-600 text-sm p-2 mb-1 rounded-lg']) }}>
            <i class="fas fa-times"></i> {{ $errors->first() }}
        </div>
    @endif
</div>
