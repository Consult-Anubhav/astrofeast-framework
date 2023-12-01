@extends('layouts.admin-settings')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/settings/addresses_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="addressesController">

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Addresses</h6>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-regions-tab" data-bs-toggle="tab" ng-click="getRegions()"
                                   href="#nav-regions" role="tab" aria-controls="nav-regions" aria-selected="true">Regions</a>
                                <a class="nav-item nav-link" id="nav-provinces-tab" data-bs-toggle="tab" ng-click="getProvinces()"
                                   href="#nav-provinces" role="tab" aria-controls="nav-provinces" aria-selected="false">Provinces</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-bs-toggle="tab" ng-click="getAddresses()"
                                   href="#nav-addresses" role="tab" aria-controls="nav-addresses" aria-selected="false">Addresses</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-regions" role="tabpanel" aria-labelledby="nav-regions-tab">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                >Region / Country</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                >Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                style="width: 100px;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="t in pagination.data">
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm d-inline-block"><%t.name%></h6>
                                                    <p class="text-xs text-secondary mb-0 d-inline-block"><%t.id%> +<%t.phonecode%></p>
                                                </div>
{{--                                                <h6 class="mb-0 text-sm ng-binding">India</h6>--}}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success" ng-show="t.is_active">Active</span>
                                                <span class="badge badge-sm bg-gradient-warning" ng-hide="t.is_active">Blocked</span>
                                            </td>
                                            <td data-title="Action : " class="align-middle">
                                                <div class="">
                                                    <button class="btn btn-round btn-sm btn-outline-danger d-inline-block mb-0"
                                                            ng-click="editModal(t)" ng-show="t.is_active">
                                                        <i class="material-icons opacity-10 fspx-14">block</i>
                                                        <span class="ml-1">Block</span>
                                                    </button>
                                                    <button class="btn btn-round btn-sm btn-outline-success d-inline-block mb-0"
                                                            ng-click="editModal(t)" ng-hide="t.is_active">
                                                        <i class="material-icons opacity-10 fspx-14">add_circle</i>
                                                        <span class="ml-1">Activate</span>
                                                    </button>
                                                    <button class="btn btn-round btn-sm btn-danger d-inline-block mb-0"
                                                            ng-click="deleteModal(t, null, 'delete')">
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
                            <div class="tab-pane fade" id="nav-provinces" role="tabpanel" aria-labelledby="nav-provinces-tab">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            >Province</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            >Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                                style="width: 100px;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="t in pagination.data">
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm d-inline-block"><%t.name%></h6>
                                                    <p class="text-xs text-secondary text-uppercase mb-0 d-inline-block"><%t.code%> - <%t.type%></p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success" ng-show="t.is_active">Active</span>
                                                <span class="badge badge-sm bg-gradient-warning" ng-hide="t.is_active">Blocked</span>
                                            </td>
                                            <td data-title="Action : " class="align-middle">
                                                <div class="">
                                                    <button class="btn btn-round btn-sm btn-outline-warning d-inline-block mb-0"
                                                            ng-click="editModal(t)" ng-show="t.is_active">
                                                        <i class="material-icons opacity-10 fspx-14">block</i>
                                                        <span class="ml-1">Block</span>
                                                    </button>
                                                    <button class="btn btn-round btn-sm btn-outline-success d-inline-block mb-0"
                                                            ng-click="editModal(t)" ng-hide="t.is_active">
                                                        <i class="material-icons opacity-10 fspx-14">add_circle</i>
                                                        <span class="ml-1">Activate</span>
                                                    </button>
                                                    <button class="btn btn-round btn-sm btn-danger d-inline-block mb-0"
                                                            ng-click="deleteModal(t, null, 'delete')">
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
                            <div class="tab-pane fade" id="nav-addresses" role="tabpanel" aria-labelledby="nav-addresses-tab">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            >Address</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="120px"
                                            >Customers</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="t in pagination.data">
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm d-inline-block"><%t.country_id%> - <%t.name%> - <%t.type%></h6>
                                                    <p class="text-xs text-secondary text-uppercase mb-0 d-inline-block"><%t.address%>, <%t.address2%></p>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs text-secondary text-uppercase mb-0 d-inline-block"><%t.customers%></p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer" ng-show="pagination.data.length > 0">

                        <!-- pagination area -->
                        <ul class="pagination d-inline-block">
                            <li class="paginate_button page-item">
                                <a href="#"
                                   ng-click="pagination.current_page > 1 ? getRegions(pagination.current_page - 1) : ''">
                                    <i class="material-icons opacity-10 fspx-14">keyboard_double_arrow_left</i>
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page > 2">
                                <a href="#" ng-class="pagination.current_page === 1 ? 'active' : ''"
                                   ng-click="goPaginateData(1)">1
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page > 3">
                                <a href="#">...
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page > 1">
                                <a href="#"
                                   ng-click="goPaginateData(pagination.current_page - 1)"><%pagination.current_page-1%>
                                </a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" class="active"
                                   ng-click="goPaginateData(pagination.current_page)"><%pagination.current_page%>
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page < pagination.last_page">
                                <a href="#"
                                   ng-click="goPaginateData(pagination.current_page + 1)">
                                    <%pagination.current_page+1%>
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page < pagination.last_page - 2">
                                <a href="#">...
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page < pagination.last_page - 1">
                                <a href="#"
                                   ng-class="pagination.current_page === pagination.last_page ? 'active' : ''"
                                   ng-click="goPaginateData(pagination.last_page)">
                                    <%pagination.last_page%>
                                </a>
                            </li>
                            <li class="paginate_button page-item mr-2">
                                <a href="#"
                                   ng-click="pagination.current_page < pagination.last_page ? goPaginateData(pagination.current_page + 1) : ''">
                                    <i class="material-icons opacity-10 fspx-14">keyboard_double_arrow_right</i>
                                </a>
                            </li>
                            <li class="paginate_button page-item">
                                <a style=" padding: 0 !important; border: 0 !important;">
                                    <select class="form-select" style="height: 44px; padding: 0 10px;"
                                            ng-change="calcPaginateData()"
                                            ng-options="p as p for p in page_size"
                                            ng-model="new_per_page">
                                    </select>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
