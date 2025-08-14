{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
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

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">


<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template"
        name="description">
    <meta
        content="admin template, ki-admin admin template, dashboard template, flat admin template, responsive admin template, web app"
        name="keywords">
    <meta content="la-themes" name="author">
    <link href="{{ asset('backend') }}/assets/images/logo/favicon.png" rel="icon" type="image/x-icon">
    <link href="{{ asset('backend') }}/assets/images/logo/favicon.png" rel="shortcut icon" type="image/x-icon">

    <title>Sign In | Flyori Travel </title>

    <!--font-awesome-css-->
    <link href="{{ asset('backend') }}/assets/vendor/fontawesome/css/all.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com/" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&amp;display=swap"
        rel="stylesheet">

    <!-- tabler icons-->
    <link href="{{ asset('backend') }}/assets/vendor/tabler-icons/tabler-icons.css" rel="stylesheet" type="text/css">

    <!-- phosphor-icon css-->
    <link href="{{ asset('backend') }}/assets/vendor/phosphor/phosphor-bold.css" rel="stylesheet">

    <!-- Bootstrap css-->
    <link href="{{ asset('backend') }}/assets/vendor/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- App css-->
    <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet" type="text/css">

    <!-- Responsive css-->
    <link href="{{ asset('backend') }}/assets/css/responsive.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="sign-in-bg">
    <div class="app-wrapper d-block">
        <div class="">
            <!-- Body main section starts -->
            <div class="container main-container">
                <div class="row main-content-box">
                    <div class="col-lg-7 image-content-box d-none d-lg-block">
                        <div class="form-container">

                            <div class="signup-bg-img">
                                <img alt="" class="img-fluid"
                                    src="{{ asset('backend') }}/assets/images/login/01.png">
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5 form-content-box">
                        <div class="form-container ">
                            <form method="POST" action="{{ route('login') }}" class="app-form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5 text-center text-lg-start">
                                            <h2 class="text-white f-w-600">Welcome To <span class="text-dark">
                                                    Flyori Travel!</span> </h2>
                                        </div>
                                    </div>

                                    {{-- <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email"
                                            name="email" :value="old('email')" required autofocus
                                            autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="current-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}""
                                                name="email" id="UserName" placeholder="enter email" type="email"
                                                required autofocus autocomplete="email">
                                            <label for="UserName">enter email</label>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    <span class="text-white">{{ $message }}</span>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                id="floatingInput" placeholder="enter password" type="password"
                                                name="password">
                                            <label for="floatingInput">Password</label>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                <span class="text-white">{{ $message }}</span>
                                            </div>
                                        @enderror
                                        {{-- @if (Route::has('password.request'))
                                            <div class="text-end ">
                                                <a class="text-dark f-w-500 text-decoration-underline"
                                                    href="{{ route('password.request') }}">Forgot password</a>
                                            </div>
                                        @endif --}}
                                    </div>


                                    <div class="col-12 mt-3">
                                        {{-- <a class="btn btn-primary btn-lg w-100" type="submit" href="index.html"
                                            role="button">Sign
                                            In</a> --}}

                                        <button class="btn btn-primary btn-lg w-100" type="submit">Sign In</button>
                                    </div>
                                </div>
                            </form>
                            @if (session('message'))
                                <script>
                                    toastr.{{ session('alert-type', 'info') }}("{{ session('message') }}");
                                </script>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Body main section ends -->
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('backend') }}/assets/js/jquery-3.6.3.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('backend') }}/assets/vendor/bootstrap/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            var toastrOptions = {
                positionClass: 'toast-top-right',
                progressBar: true,
                timeOut: 3000,
            };
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}", '', toastrOptions);
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}", '', toastrOptions);
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}", '', toastrOptions);
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}", '', toastrOptions);
                    break;
            }
        @endif
    </script>
</body>


</html>
