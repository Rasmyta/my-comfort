<x-guest-layout>
    <div class="mb-8">
        <x-jet-authentication-card>
            <x-slot name="logo">
                <x-jet-authentication-card-logo />

                <h2 class="text-3xl">
                    {{ __('Sobre ti y tu negocio') }}
                </h2>
            </x-slot>

             <!-- Session / error messages -->
                <x-notify.messages></x-notify.messages>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('store.salon') }}">
                @csrf

                <div>
                    <x-jet-label for="name" value="{{ __('Nombre salón') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                </div>

                <div>
                    <x-jet-label for="activity_id" value="{{ __('Actividad') }}" />
                    <select id="activity_id" class="block mt-1 mb-2 pb-1 w-full" name="activity_id"
                        :value="old('activity_id')" required>
                        <option value="" readonly>{{ __('Selecciona...') }}</option>
                        @foreach (App\Models\Activity::all() as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-jet-label for="cif" value="{{ __('CIF') }}" />
                    <x-jet-input id="cif" class="block mt-1 w-full" type="text" name="cif" :value="old('cif')"
                        required />
                </div>

                <div>
                    <x-jet-label for="employees" value="{{ __('Número de empleados') }}" />
                    <x-jet-input id="employees" class="block mt-1 w-full" type="number" min="1" name="employees"
                        :value="old('employees')" required />
                </div>

                <div>
                    <x-jet-label for="address" value="{{ __('Dirección') }}" />
                    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address"
                        :value="old('address')" required />
                </div>

                <div>
                    <x-jet-label for="city" value="{{ __('Ciudad') }}" />
                    <x-jet-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')"
                        required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="postal_code" value="{{ __('Código postal') }}" />
                    <x-jet-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                        :value="old('postal_code')" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Tu Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                </div>


                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms" />

                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Terms of Service') . '</a>',
    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900">' . __('Privacy Policy') . '</a>',
]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('¿Ya registrado?') }}
                    </a>

                    <x-jet-button class="ml-4 uppercase">
                        {{ __('Enviar solicitud') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </div>
</x-guest-layout>
