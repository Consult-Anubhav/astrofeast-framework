@extends('layouts.admin-settings')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/settings/permissions_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="permissionsController">

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Role Permissions</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Role
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Module Permissions
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 "
                                        style="width: 100px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data">
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{env('APP_URL')}}/assets/img/small-logos/github.svg"
                                                     class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><%t.title%></h6>
                                                {{--                                                <p class="text-xs text-secondary mb-0"><%t.email%></p>--}}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0" style="white-space: pre-line;">
                                            <%t.permissions%></p>
                                    </td>
                                    <td data-title="Action : " class="align-middle">
                                        <div class="">
                                            <button class="btn btn-round btn-sm btn-warning d-inline-block mb-0"
                                                    ng-click="editModal(t,'editPermissionsModal')">
                                                <i class="material-icons opacity-10 fspx-14">edit</i>
                                                <span class="ml-1">Edit</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.modals.permissions_modals')

    </div>

@endsection
