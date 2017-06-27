<div class="modal fade animated zoomInDown" id="recover-password" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Recover Password</h4>
            </div>
            <form action="{{ route('password.email') }}" method="post" id="form-reset-password">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="ajax_result"></div>
                    <input class="form-control" type="text" name="email" placeholder="Enter your email to continue"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->