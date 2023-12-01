<div class="modal-basic modal fade show" id="modal-action" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-info" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-info-body d-flex">
                    <div class="modal-info-text">
                        <h5 class="h5"><%modal_d.title%></h5>
                        <p><%modal_d.body%></p>
                    </div>
                </div>
                <div class="form-group mt-3" ng-show="modal_d.action === 'reschedule'">
                    <input type="text" class="form-control no-past-dates-datepicker" placeholder="Select Date"
                           ng-model="filters.reschedule_date" onkeydown="return false" required>
                </div>
                <div class="form-group" ng-show="modal_d.action === 'reschedule'">
                    <input type="text" class="form-control clockpicker" placeholder="Select Time"
                           ng-model="filters.reschedule_time" onkeydown="return false" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-dismiss="modal"
                        ng-if="modal_d.button === 'success'" ng-click="action(modal_d.action, modal_row)"><%modal_d.title%></button>
                <button type="button" class="btn btn-warning text-dark btn-sm" data-bs-dismiss="modal"
                        ng-if="modal_d.button === 'warning'" ng-click="action(modal_d.action, modal_row)"><%modal_d.title%></button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                        ng-if="modal_d.button === 'danger'" ng-click="action(modal_d.action, modal_row)"><%modal_d.title%></button>

                <button type="button" class="btn btn-warning text-dark btn-sm" data-bs-dismiss="modal"
                        ng-if="modal_d.button === 'for_what'" ng-click="action(modal_d.action, modal_row)"><%modal_d.title%></button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                        ng-if="modal_d.button === 'cancel_order'" ng-click="cancelOrder(modal_row)"><%modal_d.title%></button>

                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
