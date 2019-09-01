<!DOCTYPE html>
<html dir="<?php echo((UI_LANG == 'arabic') ? 'rtl' : 'ltr') ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta content="www.eaa.com.as" name="author"/>

    <title><?php echo htmlfilter(Orm_Institution::get_app_name()); ?></title>
    <link rel="icon" href="<?php echo base_url(Orm_Institution::get_one()->get_favicon()); ?>" sizes="16x16">

    <?php echo Layout::draw_stylesheet(); ?>

    <script> var pxInit = []; </script>
    <?php echo Layout::draw_config(); ?>

    <!-- Get jQuery -->
    <!--[if !IE]> -->
    <script src="<?php echo base_url('/assets/jadeer/js/jquery-2.2.0.min.js'); ?>"></script>
    <!-- <![endif]-->
    <!--[if lte IE 9]>
    <script src="<?php echo base_url('/assets/jadeer/js/jquery-1.12.0.min.js'); ?>"></script>
    <![endif]-->

    <!-- added by shamaseen -->
<!--<script src="--><?php //echo base_url('/assets/pixel/js/requirejs.js'); ?><!--"></script>-->
<!--    <script src="--><?php //echo base_url('/assets/pixel/js/amd/pixeladmin/requirejs-config.js'); ?><!--"></script>-->

    <?php echo Layout::draw_javascript(); ?>

    <?php echo Layout::draw_ajax_override(); ?>

    <style>
        .progress {
            height: 21px;
            margin: 0;
        }
        .btn {
            /*white-space: normal !important;*/
            overflow: hidden;
        }
        .table .btn {
            min-width: 100px;
        }
        .table .btn-no-width {
            min-width: auto;
        }
        .table .table {
            background-color: transparent;
        }
    </style>
</head>

<body>

<?php
//flash_message
echo Validator::get_html_flash_message();
?>

<?php if (Orm_User::is_logged_in()) { ?>

    <?php $this->load->view('common/navigation'); ?>

    <?php $this->load->view('common/navbar'); ?>

<?php } ?>

<div <?php echo(Orm_User::is_logged_in() ? 'class="px-content"' : '') ?>>

    <?php if (Orm_User::is_logged_in()) { ?>

        <?php echo $this->breadcrumbs->show(); ?>

        <?php (empty($page_header) ?: print $page_header ); ?>

        <?php (empty($sub_menu) ?: $this->load->view($sub_menu)); ?>

    <?php } ?>

    <?php
    if ($content) {
        if ($content_as_html) {
            echo $content;
        } else {
            $this->load->view($content);
        }
    }
    ?>
</div>
<?php if (ENVIRONMENT == 'testing' and false) { ?>
    <footer class="px-footer p-t-0 px-footer-bottom">
        <a href="https://seal.beyondsecurity.com/vulnerability-scanner-verification/test.jplus.miralnet.com"><img src="https://seal.beyondsecurity.com/verification-images/test.jplus.miralnet.com/vulnerability-scanner-2.gif" alt="Website Security Test" border="0" /></a>
    </footer>
<?php } ?>
<script type="text/javascript">
    for (var i = 0, len = pxInit.length; i < len; i++) {
        pxInit[i].call(null);
    }
</script>
</body>
</html>