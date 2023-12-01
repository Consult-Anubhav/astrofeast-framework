
{{-- Add / Edit Permissions Modal --}}

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editPermissionsModal" aria-hidden="true"
     id="editPermissionsModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-4">
            <h5 class="mb-4 text-primary">Edit Permissions</h5>
            <div class="alert alert-light text-danger"
                 role="alert" ng-show="errors.length > 0">
                <ul class="list-unstyled mb-0">
                    <li ng-repeat="error in errors"><%error%></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12 form-group mb-0">
                    <label class="font-weight-bold w-100">Role :
                        <input type="text" class="form-control" disabled
                               placeholder="Enter full name" autocomplete="off"
                               ng-model="modal_row.title"/>
                    </label>
                </div>
                <div class="col-12 form-group mb-0">
                    <label class="font-weight-bold w-100 mb-0">Modules:</label>
                    <div class="table-responsive p-0 mb-2"
                         style="border: 1px solid #f0f2f5; border-radius: 10px;">
                        <table class="table table-less align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="border-0"></th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center"
                                    colspan="3">
                                    Permissions
                                </th>
                                <th class="border-0"></th>
                            </tr>
                            <tr class="text-center">
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Title
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Read
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Write
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Delete
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="item in modal_row.permissions_arr track by $index">
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="form-select px-2 d-inline-block border-0 text-select"
                                                ng-class="item.id !== null ? '' : 'text-lightgray'"
                                                style="min-width: 80px;" ng-model="item.id"
                                                ng-change="modal_row.is_invalidated = 1"
                                                ng-options="module.id as module.title for module in displayModules(dropdowns.modules,modal_row.permissions_arr,item.id)">
                                            <option class="option" value="">None</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center form-check p-0" ng-show="item.id">
                                        <input class="form-check-input" type="checkbox" autocomplete="off"
                                               style="margin-left: 0!important;"
                                               ng-true-value="1" ng-false-value="0"
                                               ng-change="modal_row.is_invalidated = 1;"
                                               ng-model="item.read"/>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center form-check p-0" ng-show="item.id">
                                        <input class="form-check-input" type="checkbox" autocomplete="off"
                                               style="margin-left: 0!important;"
                                               ng-true-value="1" ng-false-value="0"
                                               ng-change="modal_row.is_invalidated = 1;"
                                               ng-model="item.write"/>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center form-check p-0" ng-show="item.id">
                                        <input class="form-check-input" type="checkbox" autocomplete="off"
                                               style="margin-left: 0!important;"
                                               ng-true-value="1" ng-false-value="0"
                                               ng-change="modal_row.is_invalidated = 1;"
                                               ng-model="item.delete"/>
                                    </div>
                                </td>
                                <td data-title="Action : ">
                                    <div class="d-flex justify-content-center">
                                        <i class="material-icons opacity-10 fspx-14 cursor-pointer p-1 icon-delete-style"
                                           ng-click="deletePermission($index)">delete</i>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-sm btn-light mb-2"
                            ng-hide="dropdowns.modules.length <= modal_row.permissions_arr.length"
                            ng-click="addPermission()">
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
