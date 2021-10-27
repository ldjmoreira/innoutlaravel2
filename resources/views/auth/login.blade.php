<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comum.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">



    <title>Prontuario Eletrônico V1.0</title>
</head>
<body>
    
    <form class="form-login" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-card card">
            <div class="card-header">
                <i class="icofont-first-aid mr-2"></i>
                <span class="font-weight-bold ">P</span>
                  <span class="font-weight-light">rontuario</span>
                  <span class="font-weight-bold ">E</span>
                  <span class="font-weight-light">letrônico</span>
            <!--    <span class="font-weight-bold mx-2">N'</span>-->
                <i class="icofont-first-aid ml-2"></i>
            </div>
            
            <div class="card-body">
               
                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" 
                    class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-lg btn-primary">
                    {{ __('Login') }}
                </button>
    
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>

        </div>
    </form>
    
</body>
</html>