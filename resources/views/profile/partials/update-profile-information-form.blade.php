<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="nickname" :value="__('Nickname')" />
            <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $user->nickname)" required autofocus autocomplete="nickname" />
            <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
        </div>

        <!-- is admin -->
        <div>
            <x-input-label for="is_admin" :value="__('Is Admin')" />
            <x-text-input id="is_admin" name="is_admin" type="text" class="mt-1 block w-full" :value="old('is_admin', $user->is_admin)" required autofocus autocomplete="is_admin" />
            <x-input-error class="mt-2" :messages="$errors->get('is_admin')" />
        </div>

        <!-- is active -->
        <div>
            <x-input-label for="is_active" :value="__('Is Active')" />
            <x-text-input id="is_active" name="is_active" type="text" class="mt-1 block w-full" :value="old('is_active', $user->is_active)" required autofocus autocomplete="is_active" />
            <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
        </div>

        <!-- Position -->
        <div>
            <x-input-label for="position" :value="__('Position')" />
            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $user->position->name)" required autofocus autocomplete="position" />
            <x-input-error class="mt-2" :messages="$errors->get('position')" />
        </div>

        <!-- Departaments -->
        <div>
            <x-input-label for="departaments" :value="__('Departaments')" />
            <x-text-input id="departaments" name="departaments" type="text" class="mt-1 block w-full" :value="old('departaments', $user->position->department->name)" required autofocus autocomplete="departaments" />
            <x-input-error class="mt-2" :messages="$errors->get('departaments')" />
        </div>

        <!--<div>
            <x-input-label for="is_active" :value="__('Is Active')" />
            <x-toggle-button label-true="Ativado" checked="{{ $user->is_active }}" label-false="Desativado" >
            </x-toggle-button>
            <x-text-input id="is_active" name="is_active" type="text" class="mt-1 block w-full" :value="old('is_active', $user->is_active)" autocomplete="is_active" />
            <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
        </div> -->

        <!--  -->

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
