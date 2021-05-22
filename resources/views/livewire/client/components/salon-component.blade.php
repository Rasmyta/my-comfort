<div>
    <a href="{{ route('salon.show', [$salon->id]) }}">
        <div class="flex w-full h-48 bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="w-1/3 bg-cover"
                style="background-image: url('https://images.unsplash.com/photo-1494726161322-5360d4d0eeae?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80')">
            </div>
            <div class="w-2/3 p-4">
                <div class="flex flex-row justify-between">
                    <h1 class="font-bold text-2xl">{{ $salon->name }}</h1>
                    <div class="flex items-center mt-2">
                        <svg class="w-5 h-5 fill-current text-yellow-300" viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                        </svg>
                        <svg class="w-5 h-5 fill-current text-yellow-300" viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                        </svg>
                        <svg class="w-5 h-5 fill-current text-yellow-300" viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                        </svg>
                        <svg class="w-5 h-5 fill-current text-yellow-100" viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                        </svg>
                        <svg class="w-5 h-5 fill-current text-yellow-100" viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" />
                        </svg>
                        <p class="font-bold pl-2 text-yellow-300">4.5</p>
                    </div>
                </div>
                <div class="flex flex-row gap-2 items-center mt-2 ">
                    <x-icon.location />
                    <p class="text-gray-500 text-sm">{{ $salon->address . ', ' . $salon->city }}</p>
                </div>

                <div class="flex item-center justify-between mt-3">

                </div>
            </div>
        </div>
    </a>
</div>
