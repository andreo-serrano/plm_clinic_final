<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-input-label for="login_option" :value="__('Login as')" />
                <!-- <select id="login_option" name="login_option" class="block mt-1 w-full rounded-md border border-gray-300">
                    <option value="patient">Patient</option>
                    <option value="doctor">Doctor</option>
                    <option value="nurse">Nurse</option> -->
                    <!-- Add more options as needed -->
                <!-- </select> -->
            <x-input-error :messages="$errors->get('login_option')" class="mt-2" />
        </div>
        <br>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('PLM Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Multifactor Code -->
        <div class="flex items-end mt-4 gap-2">
            <div class="grow">
                <x-input-label for="code" :value="__('Multifactor Code')" />
                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus autocomplete="code" />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <x-primary-button type="button" class="py-3" id="codebtn">Send</x-primary-button>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<!-- Your existing script with modifications -->
<script>
    $(document).ready(function () {
        // ... your existing code ...

        // Send code button click event
        $('#codebtn').click(function () {
            sendCode();
        });

        // Function to send verification code
        function sendCode() {
            let code = $('#code').val();
            let email = $('#email').val();

            $.ajax({
                url: '/sendcode',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    code: code,
                    email: email,
                  
                },
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Verification code sent successfully. Please check your email.",
                    });

                },
                error: function (error) {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "An error has occurred. Please try again later.",
                    });
                }
            });
        }
    });
</script>

