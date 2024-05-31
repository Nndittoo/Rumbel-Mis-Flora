<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- Tambahkan logo di sini -->
            <img src="{{ asset("img/logo (2).png") }}" alt="Logo">
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col mb-5 gap-1">
                <h1 class="text-3xl text-center font-semibold text-gray-800">Welcome to</h1>
                <span class="text-4xl font-bold text-indigo-600 text-center mb-5">Rumbel Mis Flora</span>
            </div>
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input placeholder="example@gmail.com" id="email" class="block mt-1 w-full rounded-md" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full rounded-md" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-indigo-600 rounded">
                    <label for="remember" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
                </div>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-button class="mt-4 w-full">
                {{ __('Log in') }}
            </x-button>
        </form>
    </x-authentication-card>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if ($errors->any())
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: `
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        `,
                    });
                @endif
            });
        </script>
    @endpush
</x-guest-layout>
