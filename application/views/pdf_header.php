<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        *, *::after, *::before {
            box-sizing: border-box;
        }

        body, html {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 13px;
            line-height: 1.61539;
            color: #444;
        }

        .p-a-1 {
            padding: 10px !important;
        }

        .row {
            margin-left: -11px;
            margin-right: -11px;
        }

        .row::after, .row::before {
            display: table;
            content: " ";
        }

        .row::after {
            clear: both;
        }

        .col-md-9 {
            width: 75%;
            float: left;
            min-height: 1px;
            padding-left: 11px;
            padding-right: 11px;
        }

        .col-md-3 {
            width: 25%;
            float: left;
            min-height: 1px;
            padding-left: 11px;
            padding-right: 11px;
        }

        .pull-right {
            float: right !important;
        }

        img {
            vertical-align: middle;
            border: 0;
        }
    </style>
</head>
<body>
<div class="row p-a-1">
    <div class="col-md-9">
        <?php echo(empty($header) ? Orm_Institution::get_university_name() : $header) ?>
    </div>
    <div class="col-md-3">
        <img src="<?php echo base_url(Orm_Institution::get_university_logo('english')) ?>" style="height: 50px;"
             class="pull-right">
    </div>
</div>
</body>
</html>