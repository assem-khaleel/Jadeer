<style>
    .page-signin-header {
        box-shadow: 0 2px 2px rgba(0, 0, 0, .05), 0 1px 0 rgba(0, 0, 0, .05);
    }

    .page-signin-header .btn {
        position: absolute;
        top: 12px;
        right: 15px;
    }

    html[dir="rtl"] .page-signin-header .btn {
        right: auto;
        left: 15px;
    }

    .page-signin-container {
        width: auto;
        margin: 30px 10px;
    }

    .page-signin-container form {
        border: 0;
        box-shadow: 0 2px 2px rgba(0, 0, 0, .05), 0 1px 0 rgba(0, 0, 0, .05);
    }

    @media (min-width: 544px) {
        .page-signin-container {
            width: 350px;
            margin: 60px auto;
        }
    }

    .page-signin-social-btn {
        width: 40px;
        padding: 0;
        line-height: 40px;
        text-align: center;
        border: none !important;
    }

    #page-signin-forgot-form {
        display: none;
    }
</style>

<div class="page-signin-header p-a-2 text-sm-center bg-default">
    <img src="<?php echo Orm_Institution::get_app_logo() ?>" width="100px">
</div>

<!-- Sign In form -->

<div class="page-signin-container" id="page-signin-form">
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20"><?php echo lang('Sign In to your Account') ?></h2>

    <?php $this->load->view('common/login_form'); ?>

    <div class="text-xs-center">
        <?php
        $language_key = UI_LANG == 'arabic' ? 'english' : 'arabic';
        ?>
        <a href="/language/change/<?php echo $language_key; ?>" class="btn btn-rounded">
            <span><?php echo lang($language_key); ?></span>
        </a>
    </div>
</div>

<!-- / Sign In form -->

<!-- Reset form -->

<div class="page-signin-container" id="page-signin-forgot-form">
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20"><?php echo lang('Password reset'); ?></h2>

    <div id="forgot-form">
        <?php $this->load->view('common/forget_password_form'); ?>
    </div>
</div>

<!-- / Reset form -->

<div class="px-responsive-bg">
    <div class="px-responsive-bg-overlay"
         style="background: transparent url('<?php echo Orm_Institution::get_university_login_bg() ?>') no-repeat scroll center center / cover; opacity: 0.5;"></div>
</div>

<script>
    pxInit.push(function () {
        $(function () {

            $('#page-signin-forgot-link').on('click', function (e) {
                e.preventDefault();

                $('#page-signin-form').css({display: 'none'});
                $('#page-signin-forgot-form').css({display: 'block'});

                $(window).trigger('resize');
            });

            $('#page-signin-forgot-back').on('click', function (e) {
                e.preventDefault();

                $('#page-signin-form').css({display: 'block'});
                $('#page-signin-forgot-form').css({display: 'none'});

                $(window).trigger('resize');
            });

            $('[data-toggle="tooltip"]').tooltip();
        });
    });
</script>
