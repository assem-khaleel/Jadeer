<?php
/* @var $node Orm_Node */
$id_perfix = 'node_';

$due_date = $node->get_less_due_date();

$date = '';
if ($due_date != '0000-00-00 00:00:00') {
    $date = date('Y-m-d', strtotime($due_date));
}
?>
<div class="modal-dialog modal-lg">
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
            <input type="hidden" name="id" value="<?php echo (int)$node->get_id(); ?>"/>

            <div class="form-group">
                <label for="due_date" class="control-label"><?php echo lang('Due Date'); ?></label>
                <input type="text" readonly="readonly" class="form-control" id="due_date" name="due_date" value="<?php echo $date; ?>">
                <?php echo Validator::get_html_error_message('due_date'); ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left"
                    data-dismiss="modal"><span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <button type="submit" id="save" class="btn pull-right" data-toggle="init_data_toggle"
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-floppy-o"></span><?php echo lang('Save Changes'); ?></button>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script type="text/javascript">
    init_data_toggle();

    $("#node_form").submit(function () {

        $.ajax({
            type: "POST",
            url: "/accreditation/save_due_date",
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.status) {
                //$('#ajaxModal').modal('toggle');
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });

        return false;
    });

    $(document).ready(function () {
        <?php
        $parent_due_date = $node->get_parent_obj()->get_less_due_date();

        $date = '';
        if ($parent_due_date != '0000-00-00 00:00:00') {
            $date = date('Y-m-d', strtotime($parent_due_date));
        }
        ?>
        $("#due_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '<?php echo $node->get_year() ?>-01-01'<?php echo ($date ? ", endDate: '{$date}'" : '') ?>
        });
    });

</script>
