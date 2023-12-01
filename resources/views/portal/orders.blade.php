@extends('layouts.admin-app')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/portal/orders_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="ordersController">

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Orders</h6>
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
