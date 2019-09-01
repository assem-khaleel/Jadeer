<?php echo form_open('/welcome/forgot_password', ' id="password-reset-form_id" class="panel p-a-4"'); ?>
<fieldset class="form-group form-group-lg">
    <input type="email" name="forget_email" id="p_email_id" class="form-control"
           placeholder="<?php echo lang('Enter your Email') ?>">
    <?php echo Validator::get_html_error_message('forget_email'); ?>
</fieldset>


<button type="submit"
        class="btn btn-block btn-lg m-t-3"><?php echo lang('SEND PASSWORD RESET LINK') ?></button>
<div class="m-t-2 text-muted">
    <a href="/welcome/login" id="page-signin-forgot-back">&larr; <?php echo lang('Back') ?></a>
</div>
<?php echo form_close(); ?>
<!-- / Form -->

<script type="text/javascript">

    init_data_toggle();

    $('#password-reset-form_id').on('submit', function () {
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#forgot-form').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });

        return false;
    });
</script>
