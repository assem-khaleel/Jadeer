<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="form-signin-heading m-a-0"><?php echo lang('Change Password') ?></h3>
        </div>
        <div class="modal-body">
            <?php echo form_open('', ' id="form_signin" method="post"'); ?>
            <div class="form-group">
                <label class="sr-only" for="inputOldPassword"><?php echo lang('Old Password') ?></label>
                <input type="password" name="old_password" placeholder="<?php echo lang('Old Password') ?>"
                       class="form-control" id="inputOldPassword">
                <?php echo Validator::get_html_error_message('old_password'); ?>
            </div>
            <div class="form-group">
                <label class="sr-only" for="inputNewPassword"><?php echo lang('New Password') ?></label>
                <input type="password" name="new_password" placeholder="<?php echo lang('New Password') ?>"
                       class="form-control" id="inputNewPassword">
                <?php echo Validator::get_html_error_message('new_password'); ?>
            </div>
            <div class="form-group">
                <label class="sr-only" for="inputConfirmPassword"><?php echo lang('Confirm Password') ?></label>
                <input type="password" name="confirm_password" placeholder="<?php echo lang('Confirm Password') ?>"
                       class="form-control" id="inputConfirmPassword">
                <?php echo Validator::get_html_error_message('confirm_password'); ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-block " <?php echo data_loading_text() ?>><span
                            class="btn-label-icon left"><i
                                class="fa fa-floppy-o"></i></span><?php echo lang('Change') ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script type="text/javascript">
    $('#form_signin').on('submit', function () {

        $.ajax({
            type: "POST",
            url: "/user/change_password",
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });

        return false;
    });
</script>