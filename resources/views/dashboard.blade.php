@extends('layouts.app',['activePage' => 'dashboard'])

@section('content')
<style>
    .active {
        color: gold;
    }
</style>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row pb-5">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Clients')}} </h5>
                                    <span class="h2 font-weight-bold mb-0">{{$data['user']}}</span>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Depuis le mois dernier</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Concierges de Parkings')}} </h5>
                                    <span class="h2 font-weight-bold mb-0">{{$data['owner']}}</span>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-user-secret"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Depuis la semain derniere</span>
                            </p> --}}
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title text-uppercase text-muted mb-0"> {{__('Plans achetés')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$data['buy']}}</span>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                <span class="text-nowrap">Depuis le mois dernier</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Places de Parking')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$data['space']}}</span>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                <span class="text-nowrap">Depuis le mois dernier</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class=" col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title text-uppercase text-muted mb-0">
                                        {{__('Espaces verifiés')}}
                                    </h5>
                                    <span class="h2 font-weight-bold mb-0">{{$data['verified_space']}}</span>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-shape bg-pink text-white rounded-circle shadow">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                <span class="text-nowrap">Depuis la semaine derniere</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Réservations')}}
                                    </h5>
                                    <span class="h2 font-weight-bold mb-0">{{$data['booking']}}</span>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                        <i class="fas fa-cart-plus"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                <span class="text-nowrap">Depuis hier</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-9">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{__('Réservations du mois')}}</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$data['month_booking']}}</span>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- <p class="mt-3 mb-0 text-muted text-sm">
                                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                <span class="text-nowrap">Depuis le mois dernier</span>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid mt--7">

    <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{__('Concierges de Parking')}}</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ url('parkingOwner') }}" class="btn btn-sm btn-primary">{{__('Voir tout')}}</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{__('Nom du Concierge')}}</th>
                                <th scope="col">{{__('Espace Total')}}</th>
                                <th scope="col">{{__('Total Booking')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($owner_data as $item)

                            <tr>
                                <th scope="row">
                                    {{$item['name']}}
                                </th>
                                <td>
                                    {{$item['total_space']}}
                                </td>

                                <td>
                                    {{$item['total_booking']}}
                                </td>
                            </tr> @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{__('Clients')}}</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ url('parkingUser') }}" class="btn btn-sm btn-primary">{{__('Voir tout')}}</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{__('Client')}}</th>
                                <th scope="col">{{__('Réservation')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_data as $item)

                            <tr>
                                <th scope="row">
                                    {{$item['name']}}
                                </th>
                                <td>
                                    {{$item['total_booking']}}

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{__('Espaces verifiés')}}</h3>
                        </div>
                        {{-- <div class="col text-right">
                            <a href="{{ url('parkingOwner') }}" class="btn btn-sm btn-primary">Voir tout</a>
                    </div> --}}
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{__('Nom')}}</th>
                            <th scope="col">{{__('Toutes les réservations')}}</th>
                            <th scope="col">{{__('Total des gains')}}</th>
                            <th scope="col">{{__('Evaluation')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($space_data as $item)

                        <tr>
                            <th scope="row">
                                {{$item['title']}}
                            </th>
                            <td>
                                {{$item['total_booking']}}
                            </td>
                            <td>
                                <span id="currencySymbol"></span>{{$item['total_earning']}}
                            </td>
                            <td>

                                <div class="product-rating mb-1">
                                    @for ($i = 1; $i <= 5; $i++) <i class="fas fa-star {{$i<=$item['avg_rating'] ? 'active' : ''}}"></i>
                                        @endfor
                                </div>
                            </td>
                        </tr> @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">{{__('Installations de Parking')}}</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{ url('facilities') }}" class="btn btn-sm btn-primary">{{__('Voir tout')}}</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{__('Nom')}}</th>
                            <th scope="col">{{__('Image')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facilities_data as $item)

                        <tr>
                            <th scope="row">
                                {{$item['title']}}
                            </th>
                            <td>
                                <img src="{{ asset('upload')}}/{{$item->image }}" class="rounded-circle" height="50" width="50" style="object-fit: cover">

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
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






@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush