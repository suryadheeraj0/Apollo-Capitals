<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Two Factor Authentication Section -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Two-Factor Authentication') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('You can enable or disable two-factor authentication (OTP verification) here.') }}
                    </p>

                    <!-- Check if MFA is enabled for the user -->
                    @if (auth()->user()->is_mfa_enabled)
                        <form method="POST" action="{{ route('profile.disableMfa') }}" class="mt-4">
                            @csrf
                            <x-primary-button>
                                {{ __('Disable Two-Factor Authentication') }}
                            </x-primary-button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('profile.enableMfa') }}" class="mt-4">
                            @csrf
                            <x-primary-button>
                                {{ __('Enable Two-Factor Authentication') }}
                            </x-primary-button>
                        </form>
                    @endif

                    <!-- Display Success Message -->
                    @if (session('status') === 'mfa-enabled')
                        <div class="mt-2 text-sm text-green-600 dark:text-green-400">
                            {{ __('Two-Factor Authentication has been enabled successfully.') }}
                        </div>
                    @elseif (session('status') === 'mfa-disabled')
                        <div class="mt-2 text-sm text-green-600 dark:text-green-400">
                            {{ __('Two-Factor Authentication has been disabled successfully.') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Old Existing Profile Update Code -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
