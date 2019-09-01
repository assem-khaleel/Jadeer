<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $status_code ?> Error</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <link href='/assets/fonts/Open-Sans/gf.css' rel='stylesheet' type='text/css'>
    <link href='/assets/fonts/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link href='/assets/fonts/Ionicons/css/ionicons.min.css' rel='stylesheet' type='text/css'>
    <link href='/assets/pixel/css/bootstrap-dark.min.css' rel='stylesheet' type='text/css'>
    <link href='/assets/pixel/css/pixeladmin-dark.min.css' rel='stylesheet' type='text/css'>
    <link href='/assets/pixel/css/widgets-dark.min.css' rel='stylesheet' type='text/css'>
    <link href='/assets/pixel/css/themes/dark-orange.min.css' rel='stylesheet' type='text/css'>

    <!-- Get jQuery -->
    <!--[if !IE]> -->
    <script src="/assets/jadeer/js/jquery-2.2.0.min.js"></script>
    <!-- <![endif]-->
    <!--[if lte IE 9]>
    <script src="/assets/jadeer/js/jquery-1.12.0.min.js"></script>
    <![endif]-->

    <script src='/assets/pixel/js/bootstrap.min.js'></script>
    <script src='/assets/pixel/js/pixeladmin.min.js'></script>
</head>
<body>
<!-- Custom styling -->
<style>
    .page-500-bg {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }

    .page-500-header,
    .page-500-error-code,
    .page-500-subheader,
    .page-500-text {
        position: relative;

        padding: 0 30px;

        text-align: center;
    }

    .page-500-header {
        width: 100%;
        padding: 20px 0;

        box-shadow: 0 4px 0 rgba(0, 0, 0, .1);
    }

    .page-500-error-code {
        margin-top: 60px;

        color: #fff;
        text-shadow: 0 4px 0 rgba(0, 0, 0, .1);

        font-size: 120px;
        font-weight: 700;
        line-height: 140px;
    }

    .page-500-subheader,
    .page-500-text {
        margin-bottom: 60px;

        color: rgba(0, 0, 0, .5);

        font-weight: 600;
    }

    .page-500-subheader {
        font-size: 50px;
    }

    .page-500-subheader:after {
        position: absolute;
        bottom: -30px;
        left: 50%;

        display: block;

        width: 40px;
        height: 4px;
        margin-left: -20px;

        content: "";

        background: rgba(0, 0, 0, .2);
    }

    .page-500-text {
        font-size: 20px;
    }
</style>
<!-- / Custom styling -->

<div class="page-500-bg bg-danger"></div>
<div class="page-500-header bg-white">
    <strong>Jadeer</strong> eaa
</div>
<h1 class="page-500-error-code"><strong><?php echo $status_code ?></strong></h1>
<h2 class="page-500-subheader"><?php echo $heading; ?></h2>
<h3 class="page-500-text">
    <?php echo $message; ?>
</h3>
</body>
</html>