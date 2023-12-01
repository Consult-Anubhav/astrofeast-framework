@extends('layouts.admin-settings')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/settings/roles_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="rolesController">

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                            <h6 class="text-white text-capitalize ps-3">All Roles</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="d-flex justify-content-end px-3">
                                <button type="submit" class="btn btn-primary text-white mt-1 mb-2"
                                        ng-click="editModal({},'editStaffModal')">
                                    <i class="material-icons opacity-10 fspx-14">add</i>
                                    New</button>
                            </div>
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Title
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        level
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width: 100px;">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data">
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0" style="white-space: pre-line;"><%t.title%></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0" style="white-space: pre-line;"><%t.level ? t.level : '-'%></p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success" ng-show="t.is_active === 1">Active</span>
                                        <span class="badge badge-sm bg-gradient-secondary" ng-show="t.is_active !== 1">Inactive</span>
                                    </td>
                                    <td data-title="Action : " class="align-middle">
                                        <div class="">
                                            <button class="btn btn-round btn-sm btn-warning d-inline-block mb-0"
                                                    ng-click="editModal(t,'editStaffModal')">
                                                <i class="material-icons opacity-10 fspx-14">edit</i>
                                                <span class="ml-1">Edit</span>
                                            </button>
                                            <button class="btn btn-round btn-sm btn-danger d-inline-block mb-0"
                                                    ng-click="action(t, modal_id, 'delete')">
                                                <i class="material-icons opacity-10 fspx-14">delete</i>
                                                <span class="ml-1">Delete</span>
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

        @include('layouts.modals.roles_modals')

    </div>


@endsection
