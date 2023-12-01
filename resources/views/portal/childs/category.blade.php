@extends('layouts.admin-app')

@section('main-content')

    <script type="text/javascript" src="{{env('APP_URL')}}/js/angular/portal/category_controller.js"></script>

    <div class="container-fluid p-4" ng-app="Astrofeast" ng-controller="categoryController">

        <div class="row">
            <div class="col-12">
                <div class="card mt-4 pb-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Edit Category</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="card w-100 mt-4">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <h2 class="mb-0 fs-exact-18">Basic information</h2>
                        </div>
                        <div class="mb-2">
                            <label for="form-product/name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="form-product/name"
                                   value="Name Screwdriver SCREW150">
                        </div>
                        <div class="mb-2">
                            <label for="form-product/slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="form-product/name"
                                   value="Slug Screwdriver SCREW150">
{{--                            <div class="input-group mb-3">--}}
{{--                                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text" id="basic-addon2">@example.com</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div id="form-product/slug-help" class="form-text">
                                Unique human-readable product identifier. No longer than 255 characters.
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="form-product/short-description" class="form-label">Short
                                description</label>
                            <textarea id="form-product/short-description" class="form-control"
                                      rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body p-4">
                        <div class="mb-3"><h2 class="mb-2 fs-exact-18">Search engine optimization</h2>
                            <div class="text-muted">Provide information that will help improve the snippet and
                                bring your product to the top of search engines.
                            </div>
                        </div>
                        <div class="mb-2"><label for="form-product/seo-title" class="form-label">Page
                                title</label><input type="text" class="form-control" id="form-product/seo-title"></div>
                        <div class="mb-2"><label for="form-product/seo-description" class="form-label">Meta
                                description</label><textarea id="form-product/seo-description" class="form-control"
                                                             rows="2"></textarea></div>
                    </div>
                </div>

            </div>


            <div class="col-4">
                <div class="card w-100 mt-4">
                    <div class="card-body p-4">
                        <div class="mb-3"><h2 class="mb-0 fs-exact-18">Visibility</h2></div>
                        <div class="mb-2"><label class="form-check"><input type="radio"
                                                                           class="form-check-input"
                                                                           name="status"><span
                                    class="form-check-label">Published</span></label><label
                                class="form-check"><input type="radio" class="form-check-input"
                                                          name="status" checked=""><span
                                    class="form-check-label">Scheduled</span></label><label
                                class="form-check mb-0"><input type="radio" class="form-check-input"
                                                               name="status"><span
                                    class="form-check-label">Hidden</span></label>
                        </div>
                        <div class="mb-2"><label for="form-product/seo-title" class="form-label">Publish
                                date</label><input type="text" class="form-control datepicker-here"
                                                   id="form-product/publish-date" data-auto-close="true"
                                                   data-language="en"></div>
                    </div>
                </div>
                <div class="card w-100 mt-4" data-select2-id="6">
                    <div class="card-body p-4" data-select2-id="5">
                        <div class="mb-3"><h2 class="mb-0 fs-exact-18">Parent category</h2></div>
                        <select class="sa-select2 form-select select2-hidden-accessible px-2 mb-2" data-select2-id="1"
                                tabindex="-1" aria-hidden="true">
                            <option data-select2-id="11">[None]</option>
                            <option selected="" data-select2-id="3">Tools</option>
                            <option data-select2-id="12">Screwdrivers</option>
                            <option data-select2-id="13">Chainsaws</option>
                            <option data-select2-id="14">Hand tools</option>
                            <option data-select2-id="15">Machine tools</option>
                            <option data-select2-id="16">Power machinery</option>
                            <option data-select2-id="17">Measurements</option>
                            <option data-select2-id="18">Power tools</option>
                        </select><span
                            class="select2 select2-container select2-container--default select2-container--below"
                            dir="ltr" data-select2-id="2" style="width: 100%;"><span class="selection"><span
                                    class="select2-selection select2-selection--single" role="combobox"
                                    aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false"
                                    aria-labelledby="select2-ek8w-container"><span class="select2-selection__rendered"
                                                                                   id="select2-ek8w-container"
                                                                                   role="textbox" aria-readonly="true"
                                                                                   title="Tools">Tools</span><span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span
                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                        <div class="form-text">Select a category that will be the parent of the current one.</div>
                    </div>
                </div>
                <div class="card w-100 mt-4">
                    <div class="card-body p-4">
                        <div class="mb-3"><h2 class="mb-0 fs-exact-18">Image</h2></div>
                        <div class="border p-4 d-flex justify-content-center mb-2">
                            <div class="max-w-20x"><img src="images/products/product-7-320x320.jpg" class="w-100 h-auto"
                                                        width="320" height="320" alt=""></div>
                        </div>
                        <div class="mb-2"><a href="#" class="me-3 pe-2">Replace image</a><a href="#"
                                                                                                  class="text-danger me-3 pe-2">Remove
                                image</a></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
