<div class="footer">
    <div class="">
        <p>Copyright © Designed &amp; Developed by Kripton 2023</p>
    </div>
</div>
<!-- delete confirm modal -->
    <div class="modal fade" id="deleteConfirm" tabindex="-1" aria-hidden="true" role="dialog" style="display:none;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you, want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <form id="deleteForm" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                            <button type="button" class="btn btn-xs btn-primary" data-dismiss="modal">Close</button>
                        </form>
                    </div>

                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- status change modal -->
        <div class="modal fade" id="statusChange" tabindex="-1" aria-hidden="true" role="dialog" style="display:none;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="modalTitle">Status Change</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="AjaxModalBody">
                        <p>Select below button for set current status</p>
                    </div>
                    <div class="modal-footer">
                        <form id="statusChangeForm" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-success btn-sm" name="status" value="1">Active</button>
                      <button type="submit" class="btn btn-sm btn-danger btn-sm" name="status" value="0">Inactive</button>
                        </form>
                    </div>

                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
         <!-- Payment Request modal -->
         <div class="modal fade" id="paymentRequestApproveCanceled" tabindex="-1" aria-hidden="true" role="dialog" style="display:none;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Payment Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Select below button for set current status</p>
                    </div>
                    <div class="modal-footer">
                        <form id="paymentRequestForm" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-success btn-sm" name="status" value="2">Approved</button>
                      <button type="submit" class="btn btn-sm btn-danger btn-sm" name="status" value="0">Canceled</button>
                        </form>
                    </div>

                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
    <input type="hidden" class="markasreadUrl" value="{{route('admin.markNotification')}}">

   