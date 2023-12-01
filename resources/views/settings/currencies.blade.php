@extends('layouts.admin-settings')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/settings/currencies_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="currenciesController">

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Currencies</h6>
                        </div>
                    </div>
                    <div class="card-body pb-2">
                        Comming Soon ...
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
