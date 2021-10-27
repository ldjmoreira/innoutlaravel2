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
    

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/icofont.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/comum.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    <title>In N' Out</title>
</head>
<body>
    <header class="header">
        <div class="logo">
            <i class="icofont-travelling mr-2"></i>
            <span class="font-weight-light">In </span>
            <span class="font-weight-bold mx-2">N'</span>
            <span class="font-weight-light">Out</span>
            <i class="icofont-runner-alt-1 ml-2"></i>
        </div>
        <div class="menu-toggle mx-3">
        <i class="fas fa-angle-left"></i>
            
        </div>
        <div class="spacer"></div>
        <div class="dropdown">
            <div class="dropdown-button">
                <img class="avatar" 
                    src="<?= "http://www.gravatar.com/avatar.php?gravatar_id="
                 ?>" alt="user">
                <span class="ml-3">
                    <?= Auth::user()->name ?>
                </span>
                <i class="icofont-simple-down mx-2"></i>
            </div>
            <div class="dropdown-content">
                <ul class="nav-list">
                    <li class="nav-item">
                       
                        <a href="logout.php">
                            <i class="icofont-logout mr-2"></i>
                            administração
                        </a>

                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="icofont-logout mr-2"></i>
                            sair
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </li>
                    
                </ul>
            </div>
        </div>  
    </header>
    <aside class="sidebar">
        
        <nav class="menu mt-3">
                <ul class="nav-list">
        
        
                    <li class="nav-item @if(request()->is('admin/Day_records'))nav-selected @endif">
                        <a href="{{ route('Day_records') }}">
                            <i class="icofont-ui-check mr-2"></i>
                            Registrar Ponto
                        </a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/Monthly_report'))nav-selected @endif">
                        <a href="{{ route('Monthly_report') }}">
                            <i class="icofont-ui-calendar mr-2"></i>
                            Relatório Mensal
                        </a>
                    </li>
                  <!--   <?php //if($user->is_admin): ?> fontawsome -->
                    <li class="nav-item @if(request()->is('admin/Manager_report'))nav-selected @endif">
                        <a href="{{ route('Manager_report') }}">
                            <i class="icofont-chart-histogram mr-2"></i>
                            Relatório Gerencial
                        </a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/Page_users'))nav-selected @endif">
                        <a href="{{ route('Page_users') }}">
                            <i class="icofont-users mr-2"></i>
                            Usuários
                        </a>
                    </li>
                    <?php// endif ?>
                </ul>
            </nav>
            <div class="sidebar-widgets">
                <div class="sidebar-widget">
                    <i class="icon icofont-hour-glass text-primary"></i>
                    <div class="info">
                        <span class="main text-primary">

                        </span>
                        <span class="label text-muted">Horas Trabalhadas</span>
                    </div>
                </div>
                <div class="division my-3"></div>
                <div class="sidebar-widget">
                    <i class="icon icofont-ui-alarm text-danger"></i>
                    <div class="info">
                        <span class="main text-danger">
                            
                        </span>
                        <span class="label text-muted">Hora de Saída</span>
                    </div>
                </div>
            </div>
        </aside>
        <main class="content">
            @include('flash::message')
            @yield('content')
        </main>
        <footer class="footer">
            <span>Desenvolvido com</span>
                <span><i class="icofont-heart text-danger mx-1"></i></span>
                <span>por COD<span class="text-danger">3</span>R</span>
            
        </footer>
</body>
</html>