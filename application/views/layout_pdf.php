<!DOCTYPE html>
<html dir="<?php echo((UI_LANG == 'arabic') ? 'rtl' : 'ltr') ?>">
<head>
    <meta charset="utf-8">

    <?php echo Layout::draw_stylesheet(); ?>

    <?php echo Layout::draw_javascript(); ?>

    <style>
        body {
            background-color: #FFF !important;
        }
        thead, tfoot {
            display: table-row-group;
        }

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
<?php
$pdf_options = $this->config->item('wk_pdf_options');
$dpi = isset($pdf_options['dpi']) ? $pdf_options['dpi'] : 96;
?>
<body style="width: <?php echo floor(8.26 * $dpi); ?>px;">
<?php
if ($content) {
    if ($content_as_html) {
        echo $content;
    } else {
        $this->load->view($content);
    }
}
?>
</body>
</html>