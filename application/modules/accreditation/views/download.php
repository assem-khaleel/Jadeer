<?php
/* @var $node Orm_Node */
$id_perfix = 'node_';
?>
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <?php echo form_open('', 'id="node_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php $parent_node = Orm_Node::get_instance($node->get_parent_id()); ?>
            <h4 class="modal-title"><?php echo($parent_node->get_id() ? htmlfilter($parent_node->get_name()) : ''); ?></h4>
            <br>
            <h5 class="modal-title"><?php echo htmlfilter($node->get_name()); ?></h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6" style="text-align: center;">
<!--                    <a href="/accreditation/pdf/--><?php //echo $node->get_id(); ?><!--" class="btn btn-lg"><span-->
<!--                            class="filetypes x2 filetypes-pdf" aria-hidden="true"></span></a>-->

                    <a href="/accreditation/pdf/<?php echo (int)$node->get_id(); ?>" class="btn btn-lg"><span
                            class="fa fa-3x fa-file-pdf-o" aria-hidden="true"></span></a>
                </div>
                <div class="col-sm-6" style="text-align: center;">
<!--                    <a href="/accreditation/word/--><?php //echo $node->get_id(); ?><!--" class="btn btn-lg"><span-->
<!--                            class="filetypes x2 filetypes-doc" aria-hidden="true"></span></a>-->

                    <a href="/accreditation/word/<?php echo (int)$node->get_id(); ?>" class="btn btn-lg"><span
                            class="fa fa-3x fa-file-word-o" aria-hidden="true"></span></a>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left"
                    data-dismiss="modal"><span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->