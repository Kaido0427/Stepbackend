<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('home') }}"></a>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            {{-- <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" placeholder="Search" type="text">
                </div>
            </div> --}}
        </form>
        <!-- User -->
       
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            @php
            $language=App\Language::get();
            @endphp
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        @if(session()->get('lngimage'))
                        <span>
                            <img src="{{ asset('upload')}}/{{session()->get('lngimage')}}" class="rounded-circle" height="50px" width="50px" style="object-fit:cover">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold text-capitalize">{{app()->getLocale()}}</span>
                        </div>
                        @else
                        <span>
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/english.png" class="rounded-circle" height="50px" width="50px" style="object-fit:cover">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold text-capitalize">{{ __('Français')}}</span>
                        </div>
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Langue!') }}</h6>
                    </div>
                    @foreach ($language as $lng )
                    <a href="{{ url('selectlanguage',$lng->id) }}" class="dropdown-item">
                        <span><img src="{{ asset('upload')}}/{{$lng['image'] }}" class="rounded-circle" height="50px" width="50px" style="object-fit:cover"></span>
                        <span class="text-capitalize">{{$lng['name'] }}</span>
                    </a>
                    @endforeach
                </div>
            </li>
        </ul>
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        {{-- <span >
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg">
                        </span> --}}
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Mon profil') }}</span>
                    </a>
                    {{-- <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Paramètres') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activité') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a> --}}
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Déconexion') }}</span>
                    </a>
                </div>
            </li>
        </ul>
         <!-- devise -->
         <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="currencyDropdown" role="button" data-toggle="dropdown">
                    Devise
                </a>
                <div class="dropdown-menu">
                    <!-- Formulaire -->
                    <form method="POST" action="{{ route('convert') }}">
                        @csrf
                        <div class="dropdown-item">
                            <label>Convertir de</label>
                            <select name="from" class="form-control">
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <div class="dropdown-item">
                            <label>Convertir vers</label>
                            <select name="to" class="form-control">
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                            </select>
                        </div>
                        <button type="submit" onclick="convertCurrency('invert')" class="dropdown-item">Convertir</button>
                    </form>
                </div>
            </li>
        </ul>

    </div>

</nav>
<script>
    // Fonction pour inverser les devises sélectionnées
    function convertCurrency(action) {
        var fromSelect = document.getElementsByName('from')[0];
        var toSelect = document.getElementsByName('to')[0];

        if (action === 'invert') {
            var temp = fromSelect.value;
            fromSelect.value = toSelect.value;
            toSelect.value = temp;
        }

        updateCurrencySymbol();
    }

    // Fonction pour mettre à jour le symbole de la devise
    function updateCurrencySymbol() {
        var fromSelect = document.getElementsByName('from')[0];
        var toSelect = document.getElementsByName('to')[0];

        var fromSymbol = getCurrencySymbol(fromSelect.value);
        var toSymbol = getCurrencySymbol(toSelect.value);

        // Stockez le symbole de la devise dans le stockage local
        localStorage.setItem('fromSymbol', fromSymbol);
        localStorage.setItem('toSymbol', toSymbol);

        // Mettez à jour le contenu du span avec le symbole de la devise
        document.getElementById('currencySymbol').innerText = fromSymbol;
    }

    // Fonction pour obtenir le symbole de la devise
    function getCurrencySymbol(currencyCode) {
        // Vous pouvez étendre cette fonction pour inclure d'autres codes de devise
        if (currencyCode === 'EUR') {
            return '€';
        } else if (currencyCode === 'USD') {
            return '$';
        }

        // Par défaut, retournez une chaîne vide
        return '';
    }

    // Attachez l'événement onchange aux listes déroulantes pour mettre à jour le symbole de la devise
    document.getElementsByName('from')[0].addEventListener('change', updateCurrencySymbol);
    document.getElementsByName('to')[0].addEventListener('change', updateCurrencySymbol);

    // Récupérez les symboles de devise du stockage local et définissez-les lors du chargement de la page
    var fromSymbol = localStorage.getItem('fromSymbol');
    var toSymbol = localStorage.getItem('toSymbol');

    // Si les symboles de devise ne sont pas dans le stockage local, utilisez les valeurs par défaut basées sur la sélection initiale
    if (!fromSymbol || !toSymbol) {
        fromSymbol = getCurrencySymbol(document.getElementsByName('from')[0].value);
        toSymbol = getCurrencySymbol(document.getElementsByName('to')[0].value);
        localStorage.setItem('fromSymbol', fromSymbol);
        localStorage.setItem('toSymbol', toSymbol);
    }

    // Mettez à jour le contenu du span avec le symbole de la devise
    document.getElementById('currencySymbol').innerText = fromSymbol;
</script>