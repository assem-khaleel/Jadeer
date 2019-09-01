<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>REST Server</title>
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
    .page-rest-bg {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }

    .page-rest-header,
    .page-rest-text {
        position: relative;

        padding: 0 30px;

        text-align: center;
    }

    .page-rest-header {
        width: 100%;
        padding: 20px 0;

        box-shadow: 0 4px 0 rgba(0, 0, 0, .1);
    }

    .page-rest-text {
        margin-bottom: 60px;

        color: rgba(0, 0, 0, .5);

        font-weight: 600;
    }

    .page-rest-text {
        font-size: 14px;
        text-align: left;
    }
</style>
<!-- / Custom styling -->

<div class="page-rest-bg bg-warning"></div>
<div class="page-rest-header bg-white">
    <strong>Jadeer</strong> eaa
</div>
<div class="page-rest-text">
    <h2><a href="<?php echo site_url(); ?>">Home</a></h2>

    <p>
        See the article
        <a href="http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/" target="_blank">
            http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/
        </a>
    </p>

    <p>
        Click on the links to check whether the REST server is working.
    </p>

    <ol>
        <li><a href="<?php echo site_url('api/example/users'); ?>">Users</a> - defaulting to JSON</li>
        <li><a href="<?php echo site_url('api/example/users/format/csv'); ?>">Users</a> - get it in CSV</li>
        <li><a href="<?php echo site_url('api/example/users/id/1'); ?>">User #1</a> - defaulting to JSON (users/id/1)
        </li>
        <li><a href="<?php echo site_url('api/example/users/1'); ?>">User #1</a> - defaulting to JSON (users/1)</li>
        <li><a href="<?php echo site_url('api/example/users/id/1.xml'); ?>">User #1</a> - get it in XML (users/id/1.xml)
        </li>
        <li><a href="<?php echo site_url('api/example/users/id/1/format/xml'); ?>">User #1</a> - get it in XML
            (users/id/1/format/xml)
        </li>
        <li><a href="<?php echo site_url('api/example/users/id/1?format=xml'); ?>">User #1</a> - get it in XML
            (users/id/1?format=xml)
        </li>
        <li><a href="<?php echo site_url('api/example/users/1.xml'); ?>">User #1</a> - get it in XML (users/1.xml)</li>
        <li><a id="ajax" href="<?php echo site_url('api/example/users/format/json'); ?>">Users</a> - get it in JSON
            (AJAX request)
        </li>
        <li><a href="<?php echo site_url('api/example/users.html'); ?>">Users</a> - get it in HTML (users.html)</li>
        <li><a href="<?php echo site_url('api/example/users/format/html'); ?>">Users</a> - get it in HTML
            (users/format/html)
        </li>
        <li><a href="<?php echo site_url('api/example/users?format=html'); ?>">Users</a> - get it in HTML
            (users?format=html)
        </li>
    </ol>
</div>
</body>
</html>
