@extends('layouts.admin-settings')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/settings/dashboard_settings_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="dashboardSettingsController">

        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card-body pb-2">
                    Comming Soon ...
                </div>
            </div>
        </div>

    </div>

@endsection
