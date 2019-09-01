<div class="col-md-offset-4 col-md-4 well">
    <?php echo form_open("/eaa/authenticate"); ?>

        <div class="form-group">
            <label class="control-label"><?php echo lang('User Name')?></label>
            <input name="user" type="text" class="form-control" value="<?php echo htmlfilter(isset($user) ? $user : ''); ?>"/>
            <?php echo Validator::get_html_error_message('user'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Password')?></label>
            <input name="password" type="password" class="form-control" />
            <?php echo Validator::get_html_error_message('password'); ?>
        </div>

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-sign-in" aria-hidden="true"></span>
            <?php echo lang('login'); ?>
        </button>

    <?php echo form_close(); ?>
</div>
