<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <!-- Tambahkan logo di sini -->
            <img src="{{ asset("img/logo.png") }}" alt="Logo">
        </x-slot>

        <!-- Validation Errors -->
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col mb-5 gap-1">
                <h1 class="text-3xl text-center font-bold text-gray-800">Login to</h1>
                <span class="text-4xl font-bold text-indigo-600 text-center mb-5">Rumbel Mis Flora</span>
            </div>
            <div>
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input placeholder="example@gmail.com" id="email" class="block mt-1 w-full rounded-md" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>
                <p class="text-sm text-gray-500 pt-1">Masukkan emial yang telah terdaftar di Rumbel Mis Flora.</p>
            </div>

            <div class="mt-4">
                <div class="">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input placeholder="Siswa12092004" id="password" class="block mt-1 w-full rounded-md" type="password" name="password" required autocomplete="current-password" />
                </div>
                <p class="text-sm text-gray-500 pt-1">Masukkan password yang telah terdaftar di Rumbel Mis Flora.</p>
            </div>
                <button type="submit" class="px-5 py-2 text-lg font-medium mt-1 text-white w-full bg-indigo-600 rounded-md shadow-md hover:bg-indigo-800 transition duration-300">Login</button>
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
