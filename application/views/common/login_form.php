<?php if (!empty($is_ajax)) { ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20"><?php echo lang('Sign In to your Account') ?></h2>
            </div>
            <div class="modal-body">
                <?php } ?>

                <?php echo form_open('/welcome/login', ' id="signin-form_id" class="panel p-a-4"'); ?>
                <fieldset class=" form-group form-group-lg">
                    <input type="text" name="email" <?php echo selenium() ?> value="<?php echo $email; ?>" id="username_id" class="form-control"
                           placeholder="<?php echo lang('User Name or Email') ?>">
                    <?php echo Validator::get_html_error_message('login_error'); ?>
                </fieldset><!-- / Username -->


                <fieldset class=" form-group form-group-lg">
                    <input type="password" name="password" <?php echo selenium() ?> id="password_id" class="form-control"
                           placeholder="<?php echo lang('Password') ?>">
                </fieldset><!-- / Password -->

                <div class="clearfix">
                    <label class="custom-control custom-checkbox pull-xs-left">
                        <input type="checkbox" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <?php echo lang('Remember me') ?>
                    </label>
                    <?php if (empty($is_ajax)) { ?>
                        <a href="#" class="font-size-12 text-muted pull-xs-right"
                           id="page-signin-forgot-link"><?php echo lang('Forgot your Password?') ?></a>
                    <?php } ?>
                </div>

                <button type="submit"
                        class="btn btn-block btn-lg m-t-3"> <?php echo lang('SIGN IN') ?></button>
                <?php echo form_close(); ?>
                <!-- / Form -->
                <?php if (!empty($is_ajax)) { ?>
            </div> <!-- /.modal-body -->
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
    <script type="text/javascript">
        $('#signin-form_id').on('submit', function () {

            $.ajax({
                type: "POST",
                url: "/welcome/login",
                data: $(this).serialize(),
                dataType: "json"
            }).done(function () {
                window.location.reload();
            }).fail(function () {
                window.location.reload();
            });

            return false;
        });
    </script>
<?php } ?>