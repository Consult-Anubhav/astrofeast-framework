
{{-- Add / Edit Roles Modal --}}

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editRoleModal" aria-hidden="true"
     id="editStaffModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-4">
            <h5 class="mb-4 text-primary" ng-show="modal_row.id">Edit Role</h5>
            <h5 class="mb-4 text-primary" ng-hide="modal_row.id">Add Role</h5>
            <div class="alert alert-light text-danger"
                 role="alert" ng-show="errors.length > 0">
                <ul class="list-unstyled mb-0">
                    <li ng-repeat="error in errors"><%error%></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 form-group mb-0">
                    <label class="font-weight-bold w-100">Title :
                        <input type="text" class="form-control"
                               placeholder="Enter full name" autocomplete="off"
                               ng-change="modal_row.is_invalidated = 1"
                               ng-model="modal_row.title" />
                    </label>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 form-group mb-0">
                    <label class="font-weight-bold w-100">Level :
                        <input type="text" class="form-control"
                               placeholder="Enter email address" autocomplete="off"
                               ng-change="modal_row.is_invalidated = 1"
                               ng-model="modal_row.level" />
                    </label>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 form-group mb-0">
                    <label class="font-weight-bold w-100">Status :</label>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch"
                               ng-change="modal_row.is_invalidated = 1"
                               ng-model="modal_row.is_active"
                               ng-true-value="1" ng-value-false="0" />
                        <label class="form-check-label" ng-if="modal_row.is_active == 1">Active</label>
                        <label class="form-check-label" ng-if="modal_row.is_active == 0">Inactive</label>
                    </label>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary mb-2 text-white"
                            ng-disabled="!modal_row.is_invalidated"
                            ng-click="action(modal_row, modal_id, 'update')">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
