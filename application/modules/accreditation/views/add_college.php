<?php
/* @var $node Orm_Node */
$id_perfix = 'node_';
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('', 'id="add_program_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Add').' '.lang('College'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label"><?php echo lang('College'); ?></label>
                <select name="college_id" class="form-control">
                    <option value=""><?php echo lang('Select One'); ?></option>
                    <?php foreach (Orm_College::get_all() as $college) { ?>
                        <?php $selected = (isset($college_id) && $college->get_id() == $college_id ? 'selected="selected"' : ''); ?>
                        <option
                            value="<?php echo (int)$college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                    <?php } ?>
                </select>
                <?php echo Validator::get_html_error_message('college_id'); ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left"
                    data-dismiss="modal"><span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn pull-right"
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add'); ?></button>
        </div>
        <input type="hidden" name="id" value="<?php echo (int)$node->get_id(); ?>"/>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->

<script type="text/javascript">
    $('#add_program_form').on('submit', function () {

        $.ajax({
            type: "POST",
            url: "/accreditation/save_college",
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });
        return false;
    });
</script>