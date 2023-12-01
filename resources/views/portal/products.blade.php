@extends('layouts.admin-app')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/portal/products_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="productsController">

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Products</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-2">
                        <div class="table-responsive p-0">
                            <div class="d-flex justify-content-end px-3">
                                <button type="submit" class="btn btn-primary text-white mt-1 mb-2"
                                        ng-click="editModal({},'editStaffModal')">
                                    <i class="material-icons opacity-10 fspx-14">add</i>
                                    New
                                </button>
                            </div>
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Product
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Stock
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        State
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width: 100px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data">
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <img src="<%t.default_media%>"
                                                     class="avatar avatar-sm me-3 border-radius-lg"
                                                     ng-show="t.default_media">
                                                <div class="avatar avatar-sm me-3 border border-radius-lg"
                                                     ng-hide="t.default_media"></div>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><%t.name%></h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    Slug: <span class="font-weight-bold"><%t.slug%></span></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-secondary text-xs font-weight-bold">
                                        <span ng-show="t.master_stock > 0"><%t.master_stock%> In Stock</span>
                                        <span ng-show="t.master_unit_backorder > 0">Back Order</span>
                                        <span ng-show="t.master_unit_preorder > 0">Pre Order</span>
                                        <span ng-show="!(t.master_stock > 0)">Out of Stock</span>
                                        <span>for <%t.variants_count%> variants</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-secondary"><%t.state%></span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center h-100">
                                            <button class="btn btn-round btn-sm btn-warning d-inline-block mb-0 mr-1"
                                                    ng-click="openLink('product?slug='+t.slug)">
                                                <i class="material-icons opacity-10 fspx-14">edit</i>
                                                <span class="ml-1">Edit</span>
                                            </button>
                                            <button class="btn btn-round btn-sm btn-danger d-inline-block mb-0"
                                                    ng-click="">
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

    </div>

@endsection
