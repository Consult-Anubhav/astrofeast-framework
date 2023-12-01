@extends('layouts.admin-app')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/portal/childs/product_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="productController">

        <div class="row">
            <div class="col-12">
                <div class="card mt-4 pb-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">
                                <span ng-show="data.id">Edit</span>
                                <span ng-hide="data.id">Add</span>
                                Product</h6>
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
                            <label for="form-product/slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="form-product/name"
                                   ng-model="data.slug" ng-change="data.invalid_basic_info = true">
                        </div>
                        <div class="mb-2">
                            <label for="form-product/categories" class="form-label">Categories</label>
                            <input type="search" class="form-control"
                                   ng-model="data.category" placeholder="Add categories here"
                                   ng-change="search('Category',data.category);data.invalid_basic_info = true">
                            <div class="dropdown">
                                <div class="dropdown-menu show" style="margin-top: 5px !important;"
                                     ng-show="data.category">
                                    <a class="dropdown-item" href="#" ng-click="addCategory({name: data.category})">
                                        Add "<%data.category%>"</a>
                                    <a class="dropdown-item" href="#" ng-click="addCategory(item)"
                                       ng-repeat="item in categories track by $index">
                                        <%item.name%></a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <a href="#" ng-repeat="c in data.categories"
                               class="btn btn-sm btn-light btn-tag btn-rounded m-1 btn-category"
                               ng-click="deleteCategory(c.name);data.invalid_basic_info = true;">
                                <%c.name%>
                                <i class="material-icons opacity-10 fspx-14">close</i>
                            </a>
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
                        <div class="mb-2">
                            <h2 class="mb-3 fs-exact-18">SEO</h2>
                        </div>
                        <div class="mb-2">
                            <label for="form-product/seo-title" class="form-label">Meta title</label>
                            <input type="text" class="form-control"
                                   ng-model="data.meta_title" ng-change="data.invalid_seo = true">
                        </div>
                        <div class="mb-2">
                            <label for="form-product/seo-title" class="form-label">Meta keywords</label>
                            <input type="search" class="form-control"
                                   ng-model="data.meta_tags" placeholder="Add meta keyword here"
                                   ng-change="search('MetaTag',data.meta_tags);data.invalid_seo = true;">
                            <div class="dropdown">
                                <div class="dropdown-menu show" style="margin-top: 5px !important;"
                                     ng-show="data.meta_tags">
                                    <a class="dropdown-item" href="#" ng-click="addMetaTag(data.meta_tags)">
                                        Add "<%data.meta_tags%>"</a>
                                    <a class="dropdown-item" href="#" ng-click="addMetaTag(item.keyword)"
                                       ng-repeat="item in meta_tags track by $index">
                                        <%item.keyword%></a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <a href="#" ng-repeat="c in data.meta_keywords.split(',') track by $index"
                               class="btn btn-sm btn-light btn-tag btn-rounded m-1 btn-category"
                               ng-click="deleteMetaTag(c);data.invalid_seo = true;">
                                <%c%>
                                <i class="material-icons opacity-10 fspx-14">close</i>
                            </a>
                        </div>
                        <div class="mb-2">
                            <label for="form-product/seo-description" class="form-label">Meta description</label>
                            <textarea id="form-product/seo-description" class="form-control" rows="5"
                                      ng-model="data.meta_description" ng-change="data.invalid_seo = true"></textarea>
                        </div>
                        <button class="btn btn-success radius-md text-white mt-2 mb-0"
                                ng-click="action('update','seo')" ng-disabled="!data.invalid_seo">
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
                            <label type="text" class="form-label font-weight-bold w-100">
                                <%data.publish_date%></label>
                        </div>
                        <div class="mb-2"
                             ng-show="data.state !== 'schedule' && data.state === 'draft' && data.publish_date">
                            <label for="form-product/seo-title" class="form-label w-100">To be published date</label>
                            <label type="text" class="form-label font-weight-bold w-100">
                                <%data.publish_date%></label>
                        </div>
                        <button class="btn btn-success radius-md text-white mt-2 mb-0"
                                ng-click="action('update','state')" ng-disabled="!data.invalid_state">
                            Save
                        </button>
                        <button class="btn btn-primary text-white mt-2 mb-0"
                                ng-click="publishProduct('')" ng-disabled="data.state !== 'active'">
                            Publish
                        </button>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body px-3 mb-2">
                        <input type="file" id="file_select" class="d-none"
                               accept="image/*" ng-files="setDocument($files)">
                        <div class="mb-2"><h2 class="mb-0 fs-exact-18">Images</h2></div>
                        <div style="margin: 0 -0.25rem;">
                            <div class="d-inline-block m-1 product-variant-image"
                                 ng-repeat="x in data.media">
                                <div style="margin-top:5px; margin-left:125px; position: absolute;z-index: 10;">
                                    <div class="dropdown"
                                         style="width: 20px;height: 20px; background-color: rgba(129,129,129,0.5); border-radius: 10px;">
                                        <i class="material-icons opacity-10 text-white me-1" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            more_horiz</i>
                                        <div class="dropdown-menu" style="min-width: auto; margin-top: 5px;">
                                            <a class="dropdown-item" href="#"
                                               ng-click="action('update', 'set_default_media', x.id)">Make Default</a>
                                            <a class="dropdown-item" href="#"
                                               ng-click="action('delete', 'delete_media', x.id)">Delete</a>
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
                <div class="card mt-4">
                    <div class="card-body p-4">
                        <div class="mb-3"><h2 class="mb-0 fs-exact-18">Inventory</h2></div>
                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" ng-checked="data.stock_management"
                                       ng-click="data.stock_management = !data.stock_management; data.invalid_inventory = true">
                                <span class="form-check-label">Enable stock management</span>
                            </label>
                        </div>
                        <div class="row border-top m-0 py-3" ng-repeat="t in data.variants track by $index">
                            <span class="badge badge-sm bg-gradient-faded-primary float-right mb-2"
                                  style="cursor: pointer;"
                                  ng-click="openLink('product_variant?slug='+data.slug+'&sku='+t.sku)">
                                Variant #<%$index + 1%> - <%t.state%>
                            </span>

                            <div class="col-12 col-md-auto p-0" style="cursor: pointer;"
                                 ng-click="openLink('product_variant?slug='+data.slug+'&sku='+t.sku)">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <img ng-src="<%t.default_media%>" width="150px" height="150px"
                                         ng-show="t.default_media">
                                    <div class="border" style="width: 150px; height: 150px;"
                                         ng-hide="t.default_media"></div>
                                </div>
                            </div>
                            <div class="col-12 col-md">
                                <div class="mb-2">
                                    <label for="form-product/sku" class="form-label">SKU</label>
                                    <input type="text" class="form-control"
                                           ng-model="t.sku" ng-change="data.invalid_inventory = true">
                                </div>
                                <div class="mb-2" ng-class="{'invisible': !data.stock_management}">
                                    <label for="form-product/quantity" class="form-label">Stock quantity</label>
                                    <input type="text" inputmode="decimal" class="form-control"
                                           ng-model="t.stock" ng-change="data.invalid_inventory = true">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success radius-md text-white mt-2 mb-0"
                                ng-click="action('update','inventory')" ng-disabled="!data.invalid_inventory">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.modals.image_modal')

    </div>

@endsection
