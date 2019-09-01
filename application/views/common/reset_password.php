<!-- Page background -->
<div id="page-signin-bg">
    <!-- Background overlay -->
    <div class="overlay"></div>
    <!-- Replace this with your bg image -->
    <img src="/assets/demo/signin-bg-4.jpg" alt="">
</div>
<!-- / Page background -->

<!-- Container -->
<div class="signin-container">

    <!-- Right side -->
    <div class="signin-form">

        <!-- Form -->
        <?php echo form_open('/welcome/reset_password/' . $token, ' id="signin-form_id"'); ?>
        <div class="signin-text">
            <span><?php echo lang('Reset Password') ?></span>
        </div> <!-- / .signin-text -->

        <div class="form-group w-icon">
            <input type="password" name="new_password" id="password_id" class="form-control input-lg"
                   placeholder="<?php echo lang('New Password') ?>">
            <span class="fa fa-lock signin-form-icon"></span>
        </div> <!-- / Password -->
        <?php echo Validator::get_html_error_message('new_password'); ?>

        <div class="form-group w-icon">
            <input type="password" name="new_password_confirm" id="password_id" class="form-control input-lg"
                   placeholder="<?php echo lang('Confirm Password') ?>">
            <span class="fa fa-lock signin-form-icon"></span>
        </div> <!-- / Password -->
        <?php echo Validator::get_html_error_message('new_password_confirm'); ?>

        <div class="form-actions">
            <input type="submit" value="<?php echo lang('RESET') ?>" class="signin-btn bg-primary">
        </div> <!-- / .form-actions -->
        <?php echo form_close(); ?>
        <!-- / Form -->

        <!-- "Sign In with" block -->
        <div class="signin-with">
            <?php foreach ($this->config->item('languages') as $lang_key => $lang_value) { ?>
                <a href="/language/change/<?php echo $lang_key; ?>" class="signin-with-btn"
                   style="background:#4f6faa;background:rgba(79, 111, 170, .8);">
                    <span><?php echo lang($lang_key); ?></span> <?php echo lang('Language'); ?>
                </a>
            <?php } ?>
        </div>
        <!-- / "Sign In with" block -->

    </div>
    <!-- Right side -->
</div>
<!-- / Container -->