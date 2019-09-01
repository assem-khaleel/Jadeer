<?php
/* @var $node Orm_Node */
$id_perfix = 'node_';
?>
<style>.mce-floatpanel { position: fixed; }</style>
    <div class="modal-dialog modal-lg" id="modal_dialog_form" confirm="true" message="<?php echo lang("You will lose your changes when closing the form without saving.<\br><\br>Are you sure you want to continue?") ?>" >
        <div class="modal-content">
            <?php echo form_open('', 'id="node_form"'); ?>
            <div class="modal-header">
                <div class="pull-right">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <?php echo $node->header_actions(); ?>
                </div>
                <div class="pull-left">
                    <?php $parent_node = Orm_Node::get_instance($node->get_parent_id()); ?>
                    <h4 class="modal-title"><?php echo($parent_node->get_id() ? htmlfilter($parent_node->get_name()) : ''); ?></h4>
                    <br>
                    <h5 class="modal-title"><?php echo htmlfilter($node->get_name()); ?></h5>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-body no-arabic">
                <?php echo $node->draw_properties(); ?>
                <input type="hidden" id="node_id" name="id" value="<?php echo (int)$node->get_id(); ?>"/>
                <input type="hidden" name="is_finished" id="is_finished"
                       value="<?php echo (int)$node->get_is_finished(); ?>"/>

                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left"
                        data-dismiss="modal"><?php echo lang('Close'); ?></button>
                <?php if ($node->check_if_editable()): ?>
                    <?php if ($node->get_is_finished()): ?>
                        <button type="submit" id="save_and_finished" class="btn pull-right"
                            <?php echo data_loading_text() ?>>
                            <i class="btn-label-icon left fa fa-floppy-o"></i>
                            <?php echo lang('Save'); ?>
                        </button>
                    <?php else : ?>
                        <button type="submit" id="save" class="btn pull-right"
                            <?php echo data_loading_text() ?>>
                            <i class="btn-label-icon left fa fa-floppy-o"></i>
                            <?php echo lang('Save Changes'); ?>
                        </button>
                        <button type="submit" id="save_and_finished" class="btn pull-right"
                            <?php echo data_loading_text() ?>>
                            <i class="btn-label-icon left fa fa-floppy-o"></i>
                            <?php echo lang('Save & Finish'); ?>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="clearfix"></div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
<?php if ($node->check_if_editable()): ?>
    <script type="text/javascript">
        init_data_toggle();

        $('#save_and_finished').click(function () {
            $('#is_finished').val(1);
        });

        $("#node_form").submit(function () {

            $('#modal_dialog_form').attr('message', "<?php echo lang("Are you sure you want to apply changes to the form?") ?>");

            $.ajax({
                type: "POST",
                url: "/accreditation/save",
                data: $(this).serialize(),
                dataType: "json"
            }).done(function (msg) {

                $('button[data-loading-text]').button('reset');

                if (msg.status) {

                    $('#item_<?php echo $id_perfix . $node->get_id(); ?>').replaceWith(msg.html_node);

                    if ($('#children_<?php echo $id_perfix . $node->get_id(); ?>').length) {
                        if ($('#children_<?php echo $id_perfix . $node->get_id(); ?>').is(':visible')) {
                            $('#item_<?php echo $id_perfix . $node->get_id(); ?>').children('.tree-leaf').attr('class', 'tree-branch tree-collapse');
                        } else {
                            $('#item_<?php echo $id_perfix . $node->get_id(); ?>').children('.tree-leaf').attr('class', 'tree-branch tree-expand');
                        }
                    }

                    init_tree_actions();
                    $('#ajaxModal').modal('toggle');
                    var str = "<?php echo preg_replace("/\s+/", " ", nl2br(lang('You will lose your changes when closing the form without saving.<\br><\br>Are you sure you want to continue?'))); ?>";

                    str = str.replace(/(?:\r\n|\r|\n)/g, '<br>');
                    $('#modal_dialog_form').attr('message', str);

                } else {
                    $('#ajaxModalDialog').html(msg.html);
                }
            }).fail(function () {
                window.location.reload();
            });

            return false;
        });

    </script>
<?php endif; ?>