
<!-- Fields Modal -->
<div class="modal fade" id="integrationModal" tabindex="-1" role="dialog" aria-labelledby="integrationModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Integration Group</h5>
                <a class="close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 20px;">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="recipient-name" class="col-form-label text-uppercase">Name:</label>
                    <input type="text" class="form-control" ng-model="integration_selected.integration_name">
                </div>
                <div>
                    <div class="form-group mb-0">
                        <label for="recipient-name" class="col-form-label text-uppercase">Fields:</label>
                    </div>
                    <div class="form-group d-inline-block" ng-repeat="t in integration_selected.fields"
                         style="width: 100%; margin-right: 25px;">
                        <div class="d-inline-block" style="width: calc(100% - 55px);">
                            <div class="d-inline-block" style="width: calc(100% - 55px);">
                                <input type="text" class="form-control d-inline-block" ng-model="t.code">
                            </div>
                            <div class="d-inline-block" style="width: 50px;">
                                <input type="text" class="form-control d-inline-block" ng-model="t.sort_order">
                            </div>
                        </div>
                        {{--                                <div class="form-check d-inline-block">--}}
                        {{--                                    <input class="form-check-input" type="checkbox" autocomplete="off"--}}
                        {{--                                           ng-true-value=1 ng-false-value=0 ng-model="t.test">--}}
                        {{--                                    <label class="form-check-label" style="line-height: 1.8">--}}
                        {{--                                        Test--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                        <label class="d-inline-block p-2" style="width: 20px;" ng-click="deleteIntegrationField($index)">
                            <i class="fa fa-trash text-danger"></i>
                        </label>
                    </div>
                </div>
                <button class="btn btn-sm btn-success" ng-click="addIntegrationField()">
                    Add</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" ng-click="action('update_integration')">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal-basic modal fade show" id="modal-delete-token" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-info" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-info-body d-flex">
                    <div class="modal-info-text">
                        <h5 class="h5 text-capitalize"><%modal_d.title%></h5>
                        <p><%modal_d.body%></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" ng-click="actionToken(modal_d.action, modal_row)"><%modal_d.title%></button>
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

