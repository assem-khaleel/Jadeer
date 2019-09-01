<?php
/* @var $user Orm_User */;
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="form-signin-heading m-a-0"><?php echo lang('About Me') ?></h3>
        </div>
        <div class="modal-body">
            <?php echo form_open('', ' id="form_about_me" method="post"'); ?>
            <div class="form-group">
                <textarea name="about_me" class="form-control"
                          id="about_me"><?php echo $user->get_about_me(); ?></textarea>
                <?php echo Validator::get_html_error_message('about_me'); ?>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-block "
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i
                                class="fa fa-floppy-o"></i></span><?php echo lang('Save') ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script type="text/javascript">
    $('#form_about_me').on('submit', function () {

        $.ajax({
            type: "POST",
            url: "/user/about_me",
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