<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Depozit Alsafix</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('/favicon.ico') }}"/>

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ url('vendors/bundle.css') }}" type="text/css">

@yield('head')

<!-- App styles -->
    {{--<link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">--}}
    {{--<link rel="stylesheet" href="{{ url('/css/app.css') }}" type="text/css">--}}
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" type="text/css">
</head>
<body class="@yield('bodyClass')">

<!-- begin::header -->
<div class="header">

    <div>
        <ul class="navbar-nav">

            <!-- begin::navigation-toggler -->
            <li class="nav-item navigation-toggler">
                <a href="#" class="nav-link" title="Hide navigation">
                    <i data-feather="arrow-left"></i>
                </a>
            </li>
            <li class="nav-item navigation-toggler mobile-toggler">
                <a href="#" class="nav-link" title="Show navigation">
                    <i data-feather="menu"></i>
                </a>
            </li>
            <!-- end::navigation-toggler -->
        </ul>
    </div>

    <div>
        <ul class="navbar-nav">

            <!-- begin::header search -->
            <li class="nav-item">
                <a href="#" class="nav-link" title="Search" data-toggle="dropdown">
                    <i data-feather="search"></i>
                </a>
                <div class="dropdown-menu p-2 dropdown-menu-right">
                    <form action="{{route('search')}}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="searchAll" id="searchAll" placeholder="Cauta...">
                            <div class="input-group-prepend">
                                <button class="btn" type="submit" >
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- end::header search -->

            <!-- begin::header minimize/maximize -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                    <i class="maximize" data-feather="maximize"></i>
                    <i class="minimize" data-feather="minimize"></i>
                </a>
            </li>
            <!-- end::header minimize/maximize -->

            <!-- begin::user menu -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" title="Quick menu" data-toggle="dropdown">
                    <i data-feather="settings"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                    <div class="p-4 text-center d-flex justify-content-between"
                         data-backround-image="{{ url('assets/media/image/image1.jpg') }}">
                        <h6 class="mb-0">Quick Menu</h6>
                    </div>
                    <div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                    <label class="custom-control-label" for="customSwitch1">Permite notificari.</label>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch6">
                                    <label class="custom-control-label" for="customSwitch6">Enable report
                                        generation.</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <!-- end::user menu -->
        </ul>

        <!-- begin::mobile header toggler -->
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item header-toggler">
                <a href="#" class="nav-link">
                    <i data-feather="arrow-down"></i>
                </a>
            </li>
        </ul>
        <!-- end::mobile header toggler -->
    </div>

</div>
<!-- end::header -->

<!-- begin::main -->
<div id="main">

    <!-- begin::navigation -->
    <div class="navigation">

        <div class="navigation-menu-tab">
            <div>
                <div class="navigation-menu-tab-header" data-toggle="tooltip" title="{{auth()->user()->name}}"
                     data-placement="right">
                    <a href="#" class="nav-link" data-toggle="dropdown" aria-expanded="false">
                        <figure class="avatar avatar-sm">
                            <img src="{{ url(Auth::user()->gravatar) }}" class="rounded-circle" alt="avatar">
                        </figure>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                        <div class="p-3 text-center" data-backround-image="{{ url('assets/media/image/image1.jpg') }}">
                            <figure class="avatar mb-3">
                                <img src="{{ url(Auth::user()->gravatar) }}" class="rounded-circle" alt="image">
                            </figure>
                            <h6 class="d-flex align-items-center justify-content-center">
                                {{auth()->user()->name}}
                                <a href="#" class="btn btn-primary btn-sm ml-2" data-toggle="tooltip"
                                   title="Edit profile">
                                    <i data-feather="edit-2"></i>
                                </a>
                            </h6>
                            <small>Roles:
                                @foreach(auth()->user()->roles as $role)
                                    <strong class="mr-1">{{$role->role}}</strong>
                                @endforeach
                            </small>

                        </div>
                        <div class="dropdown-menu-body">
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item">Profile</a>
                                <a href="#" class="list-group-item text-danger"
                                   data-sidebar-target="#settings">Logout!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-grow-1">
                <ul>
                    <li>
                        <a @if(!request()->segment(1) || request()->segment(1) == 'receptii') class="active"
                           @endif href="#" data-toggle="tooltip" data-placement="right" title="Receptii"
                           data-nav-target="#receptii">
                            <i data-feather="folder-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a @if(request()->segment(1) == 'iesiri') class="active" @endif href="#" data-toggle="tooltip"
                           data-placement="right" title="Iesiri" data-nav-target="#iesiri">
                            <i data-feather="folder-minus"></i>
                        </a>
                    </li>
                    <li>
                        <a @if(request()->segment(1) == 'inventory') class="active" @endif href="#" data-toggle="tooltip"
                           data-placement="right" title="Inventar"
                           data-nav-target="#inventories">
                            <i data-feather="layers"></i>
                        </a>
                    </li>
                    <li>
                        <a @if(request()->segment(1) == 'skus') class="active" @endif href="#" data-toggle="tooltip"
                           data-placement="right" title="Sku's" data-nav-target="#skus">
                            <i data-feather="zap"></i>
                        </a>
                    </li>
                    <li>
                        <a @if(request()->segment(1) == 'forwarders') class="active" @endif href="#" data-toggle="tooltip"
                           data-placement="right" title="Curieri" data-nav-target="#forwarders">
                            <i data-feather="truck"></i>
                        </a>
                    </li>
                    <li>
                        <a @if(request()->segment(1) == 'logs') class="active" @endif href="#" data-toggle="tooltip"
                           data-placement="right" title="Logs" data-nav-target="#logs">
                            <i data-feather="voicemail"></i>
                        </a>
                    </li>
                    <li>
                        <a @if(request()->segment(1) == 'reports') class="active" @endif href="#" data-toggle="tooltip"
                           data-placement="right" title="Rapoarte" data-nav-target="#reports">
                            <i data-feather="clipboard"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <ul>
                    @if(auth()->user()->isAdmin())
                        <li>
                            <a href="{{route('users')}}" data-toggle="tooltip" data-placement="right" title="Settings">
                                <i data-feather="settings"></i>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{route("logout")}}" data-toggle="tooltip" data-placement="right" title="Logout">
                            <i data-feather="log-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- begin::navigation menu -->
        <div class="navigation-menu-body">

            <!-- begin::navigation-logo -->
            <div>
                <div id="navigation-logo">
                    <a href="{{ url('/') }}">
                        Depozit ALSAFIX
                    </a>
                </div>
            </div>
            <!-- end::navigation-logo -->

            <div class="navigation-menu-group">

                {{--Left side submenu for receptions--}}
                <div @if(!request()->segment(1) || request()->segment(1) == 'receptions') class="open"
                     @endif id="receptii">
                    <ul>
                        <li class="navigation-divider">Receptii</li>
                        <li>
                            <a @if(!request()->segment(1) || (request()->segment(1) == 'receptions' && request()->segment(2) == '')) class="active"
                               @endif href="{{route('receptions.index')}}">Lista receptii</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'receptions' && request()->segment(2) == 'create') class="active"
                               @endif href="{{route('receptions.create')}}">Receptie Noua</a></li>
                    </ul>
                </div>


                {{--Left side submenu for dispatches--}}
                <div @if(!request()->segment(1) || request()->segment(1) == 'dispatches') class="open"
                     @endif id="iesiri">
                    <ul>
                        <li class="navigation-divider">Iesiri</li>
                        <li>
                            <a @if(!request()->segment(1) || (request()->segment(1) == 'dispatches' && request()->segment(2) == '')) class="active"
                               @endif href="{{route('dispatches.index')}}">Lista iesiri</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'dispatches' && request()->segment(2) == 'create') class="active"
                               @endif href="{{route('dispatches.create')}}">Iesire Noua</a></li>
                    </ul>
                </div>

                {{--Left side submenu for invetories--}}
                <div @if(!request()->segment(1) || request()->segment(1) == 'inventories') class="open"
                     @endif id="inventories">
                    <ul>
                        <li class="navigation-divider">Inventare</li>
                        <li>
                            <a @if(!request()->segment(1) || (request()->segment(1) == 'inventories' && request()->segment(2) == '')) class="active"
                               @endif href="{{route('inventories.index')}}">Lista inventare</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'inventories' && request()->segment(2) == 'create') class="active"
                               @endif href="{{route('inventories.create')}}">Inventar Nou</a></li>

                        <li>
                            <a @if(request()->segment(1) == 'inventories' && request()->segment(2) == 'compareInventory') class="active"
                               @endif href="{{route('getCompareInvetory')}}">Comparatie inventar</a></li>
                    </ul>
                </div>

                {{--Left side submenu for skus--}}
                <div @if(!request()->segment(1) || request()->segment(1) == 'skus') class="open"
                     @endif id="skus">
                    <ul>
                        <li class="navigation-divider">SKU's</li>
                        <li>
                            <a @if(!request()->segment(1) || (request()->segment(1) == 'skus' && request()->segment(2) == '')) class="active"
                               @endif href="{{route('skus.index')}}">Lista</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'skus' && request()->segment(2) == 'create') class="active"
                               @endif href="{{route('skus.create')}}">SKU nou</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'skus' && request()->segment(3) == 'withDeleted') class="active"
                               @endif href="{{route('skus.withDeleted')}}">SKU sterse</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'skus' && request()->segment(3) == 'importSkuCat') class="active"
                               @endif href="{{route('skus.importSkuCat')}}">Import Sku->Cat</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'skus' && request()->segment(3) == 'importSkuUM') class="active"
                               @endif href="{{route('skus.importSkuUM')}}">Import Sku->UM</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'skus' && request()->segment(3) == 'slowMoving') class="active"
                               @endif href="{{route('skus.slowMoving')}}">Slow Moving</a></li>

                    </ul>
                </div>

                {{--Left side submenu for forwarders--}}
                <div @if(!request()->segment(1) || request()->segment(1) == 'forwarders') class="open"
                     @endif id="forwarders">
                    <ul>
                        <li class="navigation-divider">Curieri</li>
                        <li>
                            <a @if(!request()->segment(1) || (request()->segment(1) == 'forwarders' && request()->segment(2) == '')) class="active"
                               @endif href="{{route('forwarders.index')}}">Lista</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'forwarders' && request()->segment(2) == 'create') class="active"
                               @endif href="{{route('forwarders.create')}}">Curier nou</a></li>
                    </ul>
                </div>

                {{--Left side submenu for logs--}}
                <div @if(!request()->segment(1) || request()->segment(1) == 'logs') class="open"
                     @endif id="logs">

                    <ul>
                        <li class="navigation-divider">Test</li>
                        <li>
                            <a @if(!request()->segment(1) || (request()->segment(1) == 'logs' && request()->segment(2) == '')) class="active"
                               @endif href="/logs">Loguri</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'reports' && request()->segment(2) == 'two') class="active"
                               @endif href="#">?????</a></li>
                    </ul>
                </div>

                {{--Left side submenu for reports--}}
                <div @if(!request()->segment(1) || request()->segment(1) == 'reports') class="open"
                     @endif id="reports">

                    <ul>
                        <li class="navigation-divider">Rapoarte</li>
                        <li>
                            <a @if(!request()->segment(1) || (request()->segment(1) == 'reports' && request()->segment(2) == '')) class="active"
                               @endif href="/reports">Statistici</a></li>
                        <li>
                            <a @if(request()->segment(1) == 'reports' && request()->segment(2) == 'two') class="active"
                               @endif href="#">?????</a></li>
                    </ul>
                </div>


            </div>

        </div>
        <!-- end::navigation menu -->

    </div>
    <!-- end::navigation -->

    <!-- begin::main-content -->
    <div class="main-content">

    @yield('content')

    <!-- begin::footer -->
        <footer>
            <div class="container-fluid">
                <div>© 2020 ADV - Depozit Alsafix - Made by <a href="http://www.adv.ro">ADV SOFT</a></div>
                <div>
                    <nav class="nav">
                        <a href="#" class="nav-link">Help</a>
                    </nav>
                </div>
            </div>
        </footer>
        <!-- end::footer -->

    </div>
    <!-- end::main-content -->

</div>
<!-- end::main -->

<!-- Plugin scripts -->
<script src="{{ url('vendors/bundle.js') }}"></script>

@yield('script')

<!-- App scripts -->
<script src="{{ url('assets/js/app.min.js') }}"></script>




@yield('script')



</body>
</html>
