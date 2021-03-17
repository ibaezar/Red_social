<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Red social</title>

        <!--FAVICON-->
        <link rel="shortcut icon" type="image/png" href="{{ asset('/img/logo-ib.png') }}">
        <link rel="shortcut icon" sizes="192x192" href="{{ asset('/img/logo-ib.png') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Brush+Script&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('icomoon/style.css')}}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
        <script src="{{asset('js/scripts.js')}}" defer></script>
    
    </head>
    <body class="font-sans antialiased" style="background-color: #f3f4f6">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class="col-12 col-md-6 col-img-index">
                            <div class="img-index">
                                <img src="{{asset('img/fondo-index.png')}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <x-jet-authentication-card>
                                
                                <x-slot name="logo">
                                </x-slot>

                                <div class="logo-index">
                                    <img src="{{asset('img/logo-ib.png')}}" width="60px">
                                    <h3>Red social</h3>
                                    <div class="clearfix"></div>
                                </div>
                        
                                <x-jet-validation-errors class="mb-4" />
                        
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif
                        
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                        
                                    <div>
                                        <x-jet-label for="email" value="Correo electrónico" />
                                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                    </div>
                        
                                    <div class="mt-4">
                                        <x-jet-label for="password" value="Contraseña" />
                                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                    </div>
                        
                                    <div class="block mt-4">
                                        <label for="remember_me" class="flex items-center">
                                            <x-jet-checkbox id="remember_me" name="remember" />
                                            <span class="ml-2 text-sm text-gray-600">Recordar mi cuenta</span>
                                        </label>
                                    </div>
                        
                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                ¿Olvidaste tu contraseña?
                                            </a>
                                        @endif
                        
                                        <x-jet-button class="ml-4">
                                            Iniciar sesión
                                        </x-jet-button>
                                    </div>
                                </form>

                                <hr>

                                <div>
                                    <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
                                </div>
                            </x-jet-authentication-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>