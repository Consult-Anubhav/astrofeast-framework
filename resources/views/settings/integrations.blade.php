@extends('layouts.admin-settings')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/settings/integrations_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="integrationsController">

        <div class="row">
            <div class="col-12">
                <div class="card my-4 pb-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Integrations</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <button class="btn btn-primary text-white mb-0" ng-click="openNewIntegration()">
                    <i class="material-icons opacity-10 fspx-14">add</i>
                    New
                </button>
                <button class="btn btn-success radius-md text-white mb-0" ng-click="action('update_all')">
                    Save
                </button>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary text-uppercase d-inline">
                                API Tokens</h6>
                        </div>
                    </div>
                    <div class="card-body pt-1">
                        <div class="form-group alert"
                             style="background-color: #f8d7da;"
                             ng-show="errors">
                            <div class="w-100 text-danger pt-1" ng-repeat="error in errors">
                                <%error%>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group mb-1">
                                    <label>Note</label>
                                    <input type="text" class="form-control" autocomplete="off"
                                           ng-model="new_token.name" placeholder="Enter note ...">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-1">
                                    <label>Expiration <span class="text-danger">*</span></label>
                                    <select class="form-select py-1 px-2" ng-model="new_token.value"
                                            ng-change="updateExpiryDate()"
                                            ng-options="s.value as s.title for s in dropdowns.expiration">
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-1" ng-show="new_token.value === 0">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control no-past-dates-datepicker" placeholder="DD-MM-YYYY"
                                           ng-change="updateExpiryDate()" autocomplete="off"
                                           ng-model="new_token.select_expiry_date">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-1">
                                    <label class="w-100">Will expire on <%new_token.expiry_message%>.</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-info text-white mb-0"
                                id="generate_new"
                                ng-disabled="!(new_token.name && new_token.name.length > 4)"
                                ng-click="actionToken('new_token',new_token)">
                            Generate New
                        </button>
                        <div class="form-group alert mt-3 mb-0"
                             style="background-color: #d4edda;"
                             ng-show="new_token_result">
                            <div class="text-success"><%new_token_result.name%></div>
                            <div class="input-group pt-1">
                                <input type="text" class="form-control text-bold "
                                       id="copy-input" autocomplete="off"
                                       style="border: 1px solid !important;"
                                       ng-model="new_token_result.token">
                                <button class="input-group-text" type="button" id="copy-button"
                                        data-toggle="tooltip" data-placement="button" title="Copy to Clipboard"
                                        style="border-left: 1px solid;height: calc(100% - 5px);z-index: 10;"
                                        ng-click="copyClipboard()">
                                    <i class="material-icons opacity-10 px-2">copy</i>
                                </button>
                            </div>
                            <div class="w-100 text-success pt-1">
                                Make sure to copy your personal access token now. You won't be able to see again!
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive py-1 px-0" ng-show="tokens && tokens.length > 0">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th>Note</th>
                                <th>Expires At</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="token in tokens">
                                <td>
                                    <div class="py-1">
                                        <%token.name%>
                                    </div>
                                </td>
                                <td>
                                    <div class="py-1">
                                        <%token.expires_at | formatDateStamp%>
                                    </div>
                                </td>
                                <td>
                                    <div class="py-1">
                                        <%token.created_at%>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-round btn-outline-danger mb-0"
                                            ng-click="openActionToken('delete',token.id)">
                                        <i class="material-icons opacity-10 fspx-14">delete</i>
                                        <span class="ml-1">Delete</span>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <div class="w-100">
                                <label class="float-left"><%token.name%></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-0" ng-repeat="(key,val) in data">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary text-uppercase">
                                <%key%></h6>
                            <i class="material-icons opacity-10 text-warning mx-1"
                               style="cursor: pointer; font-size: 15px;"
                               ng-click="editIntegration(val)">edit</i>
                        </div>
                    </div>
                    <div class="card-body pt-1">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-xl-4" ng-repeat="v in val">
                                <div class="form-group">
                                    <div class="w-100">
                                        <label class="float-left"><%v.code%></label>
                                        <a href="#" class="test-link float-right"
                                           ng-if="v.test && v.test == 1" ng-click="openTestIntegration(key,v)">
                                            Test</a>
                                    </div>
                                    <input type="text" class="form-control" autocomplete="off"
                                           ng-model="v.value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <button class="btn btn-primary text-white mb-0" ng-click="openNewIntegration()">
                    <i class="material-icons opacity-10 fspx-14">add</i>
                    New
                </button>
                <button class="btn btn-success radius-md text-white mb-0" ng-click="action('update_all')">
                    Save
                </button>
            </div>
        </div>

        @include('layouts.modals.integration_modals')

    </div>

@endsection
