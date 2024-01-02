<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white rtl_sidebar" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ url('owner/logout') }}" >
            <img src="{{ url('upload/'.$adminSetting->logo) }}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{url('upload/',Auth::guard('owner')->user()->image )}}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Bienvenue!') }}</h6>
                    </div>
                    <a href="{{ url('owner/profile') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Mon profil') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('owner/logout') }}" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Déconnexion') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'dashboard' ? 'active' : '' }}" href="{{ url('owner/dashboard') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Tableau de board') }}
                    </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link  {{ $activePage == 'bookuser' ? 'active' : '' }}" href="{{ url('owner/bookuser') }}">
                <i class="ni ni-bus-front-12 text-warning"></i> {{ __('Client reservé') }}
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ $activePage == 'space_zone' ? 'active' : '' }}" href="{{ url('owner/space_zone') }}">
                        <i class="ni ni-single-02 text-success"></i> {{ __('Zone Spatiale') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ $activePage == 'spaces' ? 'active' : '' }}" href="{{ url('owner/spaces') }}">
                        <i class="ni fas fa-parking"></i> {{ __('Espace de Parking') }}
                    </a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link  {{ $activePage == 'subscription' ? 'active' : '' }}" href="{{ url('owner/subscription') }}">
                        <i class="ni ni-circle-08 text-danger"></i> {{ __('Souscription') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ $activePage == 'subscription_history' ? 'active' : '' }}" href="{{ url('owner/subscription_history') }}">
                        <i class="ni ni-single-copy-04 text-info"></i> {{ __('Historique des Souscription') }}
                    </a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link  {{ $activePage == 'transection' ? 'active' : '' }}" href="{{ url('owner/transection') }}">
                        <i class="ni ni-briefcase-24 text-warning"></i> {{ __('Transaction') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ $activePage == 'parkingimages' ? 'active' : '' }}" href="{{ url('owner/parkingimages') }}">
                        <i class="ni ni-image text-info"></i> {{ __('Images') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ $activePage == 'review' ? 'active' : '' }}" href="{{ url('owner/review') }}">
                        <i class="ni ni-satisfied text-dark"></i> {{ __('Avis') }}
                    
                    </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link  {{ $activePage == 'setting' ? 'active' : '' }}" href="{{ url('owner/setting') }}">
                <i class="ni ni-settings-gear-65 text-success"></i> {{ __('Paramètres') }}
                </a>
                </li>
            </ul>
        </div>
    </div>
</nav>