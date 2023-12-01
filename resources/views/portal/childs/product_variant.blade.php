@extends('layouts.admin-app')

@section('main-content')

    <script type="text/javascript"
            src="{{env('APP_URL')}}/js/angular/portal/childs/product_variant_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="productVariantController">

        <div class="row">
            <div class="col-12">
                <div class="card mt-4 pb-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">
                                <span ng-show="data.id">Edit</span>
                                <span ng-hide="data.id">Add</span>
                                Product Variant</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-8">
                <div class="card w-100 mt-4">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <h2 class="mb-0 fs-exact-18">Basic information</h2>
                        </div>
                        <div class="mb-2">
                            <label for="form-product/name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="form-product/name"
                                   ng-model="data.name" ng-change="data.invalid_basic_info = true">
                        </div>
                        <div class="mb-2">
                            <label for="form-product/slug" class="form-label">Sku</label>
                            <input type="text" class="form-control" id="form-product/name"
                                   ng-model="data.sku" ng-change="data.invalid_basic_info = true">
                        </div>
                        <div class="mb-2">
                            <label for="form-product/short-description" class="form-label">
                                Short description</label>
                            <summernote ng-model="data.description" ng-change="data.invalid_basic_info = true"
                                        config="summernote_options"></summernote>
                        </div>
                        <button class="btn btn-success radius-md text-white mt-2 mb-0"
                                ng-click="action('update','basic_info')" ng-disabled="!data.invalid_basic_info">
                            Save
                        </button>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body p-4">
                        <div class="mb-3"><h2 class="mb-0 fs-exact-18">Pricing</h2></div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="form-product/price" class="form-label">Currency</label>
                                <select class="form-select py-1 px-2"
                                        ng-change="data.invalid_state = true"
                                        ng-model="data.currency"
                                        ng-options="s for s in ['Default','EUR','DOL','RUP']">
                                </select>
                            </div>
                            <div class="col">
                                <label for="form-product/price" class="form-label">Price</label>
                                <input type="text" inputmode="decimal" class="form-control"
                                       ng-model="data.price" ng-change="data.invalid_pricing = true">
                            </div>
                            <div class="col">
                                <label for="form-product/old-price" class="form-label">Original price</label>
                                <input type="text" inputmode="decimal" class="form-control"
                                       ng-model="data.original_price" ng-change="data.invalid_pricing = true">
                            </div>
                        </div>
                        {{--                        <div class="mt-2 mb-n2"><a href="#">Schedule discount</a></div>--}}
                        <button class="btn btn-success radius-md text-white mt-2 mb-0"
                                ng-click="action('update','pricing')" ng-disabled="!data.invalid_pricing">
                            Save
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card w-100 mt-4">
                    <div class="card-body p-4">
                        <div class="mb-3"><h2 class="mb-0 fs-exact-18">State</h2></div>
                        <div class="mb-3">
                            <select class="form-select py-1 px-2" ng-model="data.state"
                                    ng-change="data.invalid_state = true"
                                    ng-options="s.value as s.title for s in state_options | filter: {is_published: data.is_published}">
                            </select>
                        </div>
                        <div class="mb-2" ng-show="data.state === 'schedule'">
                            <label for="form-product/seo-title" class="form-label">New Publish date</label>
                            <input type="text" class="form-control no-past-dates-datepicker"
                                   ng-change="data.invalid_state = true"
                                   ng-model="data.next_publish_date" placeholder="dd-mm-yy">
                        </div>
                        <div class="mb-2" ng-show="data.state !== 'schedule' && data.state !== 'draft'">
                            <label for="form-product/seo-title" class="form-label w-100">Published date</label>
                            <label type="text" class="form-label font-weight-bold w-100"><%data.publish_date%></label>
                        </div>
                        <div class="mb-2"
                             ng-show="data.state !== 'schedule' && data.state === 'draft' && data.publish_date">
                            <label for="form-product/seo-title" class="form-label w-100">To be published date</label>
                            <label type="text" class="form-label font-weight-bold w-100"><%data.publish_date%></label>
                        </div>
                        <button class="btn btn-success radius-md text-white mt-2 mb-0"
                                ng-click="action('update','state')" ng-disabled="!data.invalid_state">
                            Save
                        </button>
                        <button class="btn btn-primary text-white mt-2 mb-0"
                                ng-click="publishProductVariant('')" ng-disabled="data.state !== 'active'">
                            Publish
                        </button>
                    </div>
                </div>
                <div class="card w-100 mt-4">
                    <div class="card-body p-4">
                        <div class="mb-3"><h2 class="mb-0 fs-exact-18">Master Product</h2></div>
                        <div style="margin: 0 -0.25rem;">
                            <div class="">
                                <div class="form-label d-inline-block" style="min-width: 50px;">Name : </div>
                                <div type="text" class="form-label font-weight-bold d-inline-block">
                                    <%data.master_product_.name%>
                                </div>
                            </div>
                            <div class="">
                                <div class="form-label d-inline-block" style="min-width: 50px;">Slug : </div>
                                <div type="text" class="form-label font-weight-bold d-inline-block">
                                    <%data.master_product_.slug%>
                                </div>
                            </div>
                            <div class="">
                                <div class="form-label d-inline-block" style="width: 50px;">State : </div>
                                <div type="text" class="form-label font-weight-bold d-inline-block">
                                    <%data.master_product_.state%>
                                </div>
                            </div>
                            <div class="d-inline-block m-1 product-variant-image mb-3"
                                 ng-repeat="x in data.master_product_.media">
                                <img ng-src="<%x.original_url%>" class="" alt="<%data.name%> image"
                                     ng-click="openImage(x)">
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-light mt-2 mb-0"
                                    ng-click="openLink('product?slug='+data.master_product_.slug)">
                                Back
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body px-4 mb-2">
                        <input type="file" id="file_select" class="d-none"
                               accept="image/*" ng-files="setDocument($files)">
                        <div class="mb-2"><h2 class="mb-0 fs-exact-18">Images</h2></div>
                        <div style="margin: 0 -0.25rem;">
                            <div class="d-inline-block m-1 product-variant-image"
                                 ng-repeat="x in data.media">
                                <div style="margin-top:5px; margin-left:125px; position: absolute;z-index: 10;">
                                    <div class="" style="width: 20px;height: 20px; background-color: rgba(129,129,129,0.5); border-radius: 10px;">
                                        <i class="material-icons opacity-10 text-white me-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            more_horiz</i>
                                        <div class="dropdown-menu dropdown-menu-right" style="min-width: auto; margin-top: 5px;">
                                            <a class="dropdown-item" href="#" ng-click="action('update', 'set_default_media', x.id)">Make Default</a>
                                            <a class="dropdown-item" href="#" ng-click="action('delete', 'delete_media', x.id)">Delete</a>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <img ng-src="<%x.original_url%>" class="" alt="<%data.name%> image"
                                     ng-click="openImage(x)">
                            </div>
                            <div class="d-inline-block m-1 product-variant-upload"
                                 ng-click="chooseDocument()"
                                 ng-repeat="x in [].constructor(1) track by $index">
                                <div style="margin-top:65px; margin-left:60px; position: absolute;">
                                    <i class="material-icons opacity-10 me-1">upload</i>
                                </div>
                                <img src="{{env('APP_URL')}}/assets/img/blank.webp"
                                     class="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.modals.image_modal')

    </div>

@endsection
