@extends('layouts.app', ['title' => __('Transaction')],['activePage' => 'transaction'])
@section('content')

@include('layouts.headers.header',
array(
'class'=>'Transaction',
'title'=>"Transaction",'description'=>'',
'icon'=>'fas fa-home',
'breadcrumb'=>array([

'text'=>'Bilan'
])))
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Transaction') }}</h3>
                        </div>
                        <div class="col-3 text-center">
                            <a href="" class="btn btn-sm btn-primary">{{__('GrandTotal')}}:- <span id="currencySymbol"></span>{{$tempData['grandTotal']}}</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('#') }}</th>
                                <th scope="col">{{ __('Nom') }}</th>
                                <th scope="col">{{ __('Photo du Client') }}</th>
                                <th scope="col">{{ __('Montant total') }}</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tempData['data'] as $sgurad)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $sgurad['user']['name'] }}</td>
                                <td><img src="{{ asset('upload')}}/{{$sgurad['user']['image'] }}" class="rounded-circle" height="50" width="50"> </td>
                                <td><span id="currencySymbol"></span>{{ $sgurad['total'] }}</td>
                                <td class="text-right"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Votre script JavaScript -->
<script>
    // Fonction pour inverser les devises sélectionnées
    function convertCurrency(action) {
        var fromSelect = document.getElementsByName('from')[0];
        var toSelect = document.getElementsByName('to')[0];

        if (action === 'invert') {
            var temp = fromSelect.value;
            fromSelect.value = toSelect.value;
            toSelect.value = temp;

            // Inverser également les symboles de devise dans le stockage local
            var tempSymbol = localStorage.getItem('fromSymbol');
            localStorage.setItem('fromSymbol', localStorage.getItem('toSymbol'));
            localStorage.setItem('toSymbol', tempSymbol);
        }

        updateCurrencySymbol();
    }

    // Fonction pour mettre à jour le symbole de la devise
    function updateCurrencySymbol() {
        var fromSelect = document.getElementsByName('from')[0];
        var toSelect = document.getElementsByName('to')[0];

        // Récupérer les symboles de devise spécifiques à cette page (adapté au foreach de la base)
        var fromSymbol = getCurrencySymbolForPage(fromSelect.value);
        var toSymbol = getCurrencySymbolForPage(toSelect.value);

        // Stockez le symbole de la devise dans le stockage local
        localStorage.setItem('fromSymbol', fromSymbol);
        localStorage.setItem('toSymbol', toSymbol);

        // Mettez à jour le contenu du span avec le symbole de la devise
        document.getElementById('currencySymbol').innerText = fromSymbol;
    }

    // Fonction pour obtenir le symbole de la devise basé sur la devise sélectionnée et la ligne spécifique
    function getCurrencySymbolForPage(currencyCode) {
        // Vous pouvez adapter cette fonction en fonction des exigences spécifiques de cette page
        // Pour cet exemple, je suppose que la devise est stockée dans une variable sgurad.currency
        // Vérifiez si la devise est définie pour cette ligne, sinon utilisez la devise sélectionnée dans le formulaire
        var sguradCurrency = typeof sgurad !== 'undefined' && sgurad.currency ? sgurad.currency : currencyCode;

        // Vous pouvez étendre cette fonction pour inclure d'autres codes de devise
        if (sguradCurrency === 'EUR') {
            return '€';
        } else if (sguradCurrency === 'USD') {
            return '$';
        }

        // Par défaut, retournez une chaîne vide
        return '';
    }

    // Attachez l'événement onchange aux listes déroulantes pour mettre à jour le symbole de la devise
    document.getElementsByName('from')[0].addEventListener('change', updateCurrencySymbol);
    document.getElementsByName('to')[0].addEventListener('change', updateCurrencySymbol);

    // Appelez la fonction initiale pour définir les symboles de devise lors du chargement de la page
    updateCurrencySymbol();

    // Récupérez les symboles de devise du stockage local et définissez-les lors du chargement de la page
    var fromSymbol = localStorage.getItem('fromSymbol');
    var toSymbol = localStorage.getItem('toSymbol');

    // Si les symboles de devise ne sont pas dans le stockage local, utilisez les valeurs par défaut basées sur la sélection initiale
    if (!fromSymbol || !toSymbol) {
        fromSymbol = getCurrencySymbolForPage(document.getElementsByName('from')[0].value);
        toSymbol = getCurrencySymbolForPage(document.getElementsByName('to')[0].value);
        localStorage.setItem('fromSymbol', fromSymbol);
        localStorage.setItem('toSymbol', toSymbol);
    }

    // Mettez à jour le contenu du span avec le symbole de la devise
    document.getElementById('currencySymbol').innerText = fromSymbol;
</script>









@endsection