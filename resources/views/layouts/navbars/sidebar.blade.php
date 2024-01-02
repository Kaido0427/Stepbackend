<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white rtl_sidebar" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}" >
            <img src="{{ url('upload/'.$adminSetting->logo) }}" class="navbar-brand-img" alt="..." style="margin-top: -20px;width:50px;height:5000px;">
            </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none"style=" position: relative; 
        top:100px;
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('upload') }}/default.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
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
        <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Tableau de board') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'facilities' ? 'active' : '' }}" href="{{ url('facilities') }}">
                        <i class="ni ni-spaceship text-info"></i> {{ __('Installations de Parking') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'vehicleType' ? 'active' : '' }}" href="{{ url('vehicle_type') }}">
                        <i class="ni ni-spaceship text-info"></i> {{ __('Type de Vélo') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'parkingOwner' ? 'active' : '' }}" href="{{ url('parkingOwner') }}">
                        <i class="ni ni-circle-08 text-danger"></i> {{ __('Concierges de Parking') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'parkingUser' ? 'active' : '' }}" href="{{ url('parkingUser') }}">
                        <i class="ni ni-single-02 text-success"></i> {{ __('Client De Parking') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'parkingUser' ? 'active' : '' }}" href="{{ url('transaction') }}">
                        <i class="ni ni-single-02 text-success"></i> {{ __('Transactions') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'subscription' ? 'active' : '' }}" href="{{ url('subscription') }}">
                        <i class="ni ni-briefcase-24 text-warning"></i> {{ __('Abonnement') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'buyer_history' ? 'active' : '' }}" href="{{ url('subscription_history') }}">
                        <i class="ni ni-cart text-info"></i> {{ __('Liste d\'acheteurs') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'pp' ? 'active' : '' }}" href="{{ url('pp') }}">
                        <i class="ni ni-world-2 text-primary"></i> {{ __('Politique de confidentialité') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'language' ? 'active' : '' }}" href="{{ url('languages') }}">
                        <i class="ni ni-diamond text-warning"></i> {{ __('Langues') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'template' ? 'active' : '' }}" href="{{ url('notification_template') }}">
                        <i class="ni ni-single-copy-04 text-danger"></i> {{ __('Modèles de notifications') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'tc' ? 'active' : '' }}" href="{{ url('tc') }}">
                        <i class="ni ni-settings-gear-65 text-success"></i> {{ __('Termes et Conditions') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'faq' ? 'active' : '' }}" href="{{ url('faq') }}">
                        <i class="ni ni-settings-gear-65 text-success"></i> {{ __('FAQ') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'contactus' ? 'active' : '' }}" href="{{ url('contactus') }}">
                        <i class="ni ni-settings-gear-65 text-success"></i> {{ __('Nous Contacter') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'website_content' ? 'active' : '' }}" href="{{ url('website_content') }}">
                        <i class="ni ni-settings-gear-65 text-success"></i> {{ __('Contenu du site web') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ $activePage == 'setting' ? 'active' : '' }}" href="{{ url('setting') }}">
                        <i class="ni ni-settings-gear-65 text-success"></i> {{ __('Paramètres') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>