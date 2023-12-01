<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content bg-transparent border-0">
            <div class="d-flex justify-content-end position-absolute w-100 px-3 py-2">
                <a class="close float-right" data-bs-dismiss="modal" aria-label="Close" style="font-size: 32px; cursor: pointer;">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <img ng-src="<%modal_row.src%>" class="" alt="<%modal_row.alt%> image">
        </div>
    </div>
</div>
