@extends('layouts.admin-app')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/portal/dashboard_controller.js"></script>

    <div class="container-fluid py-4 px-0" ng-app="Astrofeast" ng-controller="dahsboardController">

        <div class="container-fluid p-4 mt-3">

            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    Comming Soon ...
{{--                    <div class="card">--}}
{{--                        <div class="card-header p-3 pt-2">--}}
{{--                            <div--}}
{{--                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">--}}
{{--                                <i class="material-icons opacity-10">weekend</i>--}}
{{--                            </div>--}}
{{--                            <div class="text-end pt-1">--}}
{{--                                <p class="text-sm mb-0 text-capitalize">Sales</p>--}}
{{--                                <h4 class="mb-0">$103,430</h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <hr class="dark horizontal my-0">--}}
{{--                        <div class="card-footer p-3">--}}
{{--                            <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than--}}
{{--                                yesterday--}}
{{--                            </p>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>

        </div>

@endsection
