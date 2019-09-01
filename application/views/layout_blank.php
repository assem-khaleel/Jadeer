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

    <script>var pxInit = [];</script>

    <!-- Get jQuery -->
    <!--[if !IE]> -->
    <script src="<?php echo base_url('/assets/jadeer/js/jquery-2.2.0.min.js'); ?>"></script>
    <!-- <![endif]-->
    <!--[if lte IE 9]>
    <script src="<?php echo base_url('/assets/jadeer/js/jquery-1.12.0.min.js'); ?>"></script>
    <![endif]-->

    <?php echo Layout::draw_javascript(); ?>

    <?php echo Layout::draw_config(); ?>

    <?php echo Layout::draw_ajax_override(); ?>

    <style>
        thead, tfoot {
            display: table-row-group;
        }
    </style>
</head>

<body>

<?php
if ($content) {
    if ($content_as_html) {
        echo $content;
    } else {
        $this->load->view($content);
    }
}
?>

<script type="text/javascript">
    for (var i = 0, len = pxInit.length; i < len; i++) {
        pxInit[i].call(null);
    }
</script>

</body>
</html>