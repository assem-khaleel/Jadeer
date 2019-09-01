<?php
/* @var $node Orm_Node */
?>
<?php if(!$word) { ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <?php $parent_node = Orm_Node::get_instance($node->get_parent_id()); ?>
                <h4 class="modal-title"><?php echo($parent_node->get_id() ? htmlfilter($parent_node->get_name()) : ''); ?></h4>
                <div class="clearfix"></div>
            </div>
            <div class="modal-body no-arabic">
                <?php echo $node->draw_all_report(); ?>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
<?php } else { ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php echo htmlfilter($node->get_name()); ?></title>
            <?php if(!empty($test_word)) { ?>
                <link href="<?php echo $theme_path; ?>/css/word<?php echo $rtl; ?>.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css"/>
            <?php } ?>
        </head>
        <body>
            <?php echo $node->draw_all_report(); ?>
        </body>
    </html>
<?php } ?>
