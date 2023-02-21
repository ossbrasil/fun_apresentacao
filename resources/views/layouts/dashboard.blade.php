<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Dashboard - @yield('title')</title>

    <!-- links -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::to('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ URL::to('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::to('assets/dashboard/dist/css/adminlte.min.css') }}">
    <!-- end of links -->

    <!-- jQuery -->
    <script src="{{ URL::to('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ URL::to('assets/dashboard/dist/img/AdminLTELogo.png') }}"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/dashboard" class="nav-link">Bem Vindo - {{ Auth::user()->name }}</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">{{ $newsMessages }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @foreach ($lastThreeMessages as $messages)
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            {{ $messages->name }}

                                            @if ($messages['label'] == 'important')
                                                <span class="float-right text-sm text-warning">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            @elseif ($messages['label'] == 'offers')
                                                <span class="float-right text-sm text-light">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            @elseif ($messages['label'] == 'complaint')
                                                <span class="float-right text-sm text-danger">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            @elseif ($messages['label'] == 'suggestion')
                                                <span class="float-right text-sm text-primary">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            @elseif ($messages['label'] == 'compliment')
                                                <span class="float-right text-sm text-success">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            @else
                                                <span class="float-right text-sm text-secondary">
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            @endif

                                        </h3>
                                        <p class="text-sm">{{ $messages->subject }}</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>
                        @endforeach
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{-- {{ __('Logout') }} --}}
                        <i class="fas fa-sign-out-alt"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ URL::to('assets/dashboard/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Dashboard</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ URL::to('assets/dashboard/dist/img/user2-160x160.jpg') }}"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item mb-2">
                            <a href="{{ route('dashboard-home') }}" class="nav-link @yield('dashboard-li')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Contact -->
                        <li class="nav-item @yield('nav-contact-open')">
                            <a href="#" class="nav-link @yield('nav-contact-ul')">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    Contatos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard-contact') }}" class="nav-link @yield('nav-contact-li-show')">
                                        <i class="far fa-eye mr-2 ml-4"></i>
                                        <p>Ver todos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard-contact-create') }}"
                                        class="nav-link @yield('nav-contact-li-create')">
                                        <i class="fas fa-plus mr-2 ml-4"></i>
                                        <p>Cadastrar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- users -->
                        <li class="nav-header">Configurações</li>
                        <li class="nav-item">
                            <a href="/" class="nav-link @yield('perfil-li')">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>Perfil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link @yield('info-li')">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>Informações</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link @yield('info-li')">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Website Info</p>
                            </a>
                        </li>
                        <!-- end users -->

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="https://wesley-alves.com">Wesley - Admin</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.1
            </div>
        </footer>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- Bootstrap -->
    <script src="{{ URL::to('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ URL::to('assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::to('assets/dashboard/dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ URL::to('assets/dashboard/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ URL::to('assets/dashboard/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::to('assets/dashboard/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ URL::to('assets/dashboard/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ URL::to('assets/dashboard/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL::to('assets/dashboard/dist/js/pages/dashboard2.js') }}"></script>

</body>

</html>
