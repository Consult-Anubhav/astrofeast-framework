
{{-- Add / Edit Staff Modal --}}

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editStaffModal" aria-hidden="true"
     id="editStaffModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-4">
            <h5 class="mb-4 text-primary" ng-show="modal_row.id">Edit Staff</h5>
            <h5 class="mb-4 text-primary" ng-hide="modal_row.id">Add Staff</h5>
            <div class="alert alert-light text-danger"
                 role="alert" ng-show="errors.length > 0">
                <ul class="list-unstyled mb-0">
                    <li ng-repeat="error in errors"><%error%></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 form-group mb-0">
                    <label class="font-weight-bold w-100">Full Name :
                        <input type="text" class="form-control"
                               placeholder="Enter full name" autocomplete="off"
                               ng-change="modal_row.is_invalidated = 1"
                               ng-model="modal_row.name"/>
                    </label>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 form-group mb-0">
                    <label class="font-weight-bold w-100">Email Address :
                        <input type="text" class="form-control"
                               placeholder="Enter email address" autocomplete="off"
                               ng-change="modal_row.is_invalidated = 1"
                               ng-model="modal_row.email"/>
                    </label>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 form-group mb-0">
                    <label class="font-weight-bold w-100">Status :</label>
                    <label class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch"
                               ng-change="modal_row.is_invalidated = 1"
                               ng-true-value="1" ng-value-false="0"
                               ng-model="modal_row.is_active"/>
                        <label class="form-check-label" ng-if="modal_row.is_active == 1">Active</label>
                        <label class="form-check-label" ng-if="modal_row.is_active == 0">Inactive</label>
                    </label>
                </div>
                <div class="col-12 form-group mb-0">
                    <label class="font-weight-bold w-100">Roles :</label>
                    <ul class="list-group mb-2">
                        <li class="list-group-item p-0" ng-repeat="item in modal_row.roles_arr track by $index">
                            <div class="form-group mb-0 px-2 d-flex justify-content-between align-items-center">
                                <select class="form-select px-2 d-inline-block w-100 border-0 text-select"
                                        style="width:calc(100% - 40px)!important;"
                                        ng-class="item.id !== null ? '' : 'text-lightgray'"
                                        style="min-width: 80px;" ng-model="item.id"
                                        ng-change="modal_row.is_invalidated = 1"
                                        ng-options="role.id as role.title for role in displayRoles(dropdowns.roles,modal_row.roles_arr,item.id)">
                                    <option class="option" value="">None</option>
                                </select>
                                <i class="material-icons opacity-10 fspx-14 cursor-pointer p-1 icon-delete-style"
                                   ng-click="deleteRole($index)">delete</i>
                            </div>
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-sm btn-light mb-2"
                            ng-hide="dropdowns.roles.length <= modal_row.roles_arr.length"
                            ng-click="addRole()">
                        <i class="material-icons opacity-10 fspx-14">add</i>
                        Add
                    </button>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary mb-2 text-white"
                            ng-disabled="!modal_row.is_invalidated"
                            ng-click="action(modal_row, modal_id, 'update')">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
