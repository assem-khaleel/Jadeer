<?php
/** @var $recommendation Orm_Acc_Visit_Reviewer_Recommendation  */
/** @var $action_plan Orm_Acc_Visit_Reviewer_Action_Plan  */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/accreditation/reviewer_visit/action_add_edit/{$type}/{$type_id}/{$recommendation_id}/{$action_plan->get_id()}", 'id="action_form"'); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Add').' '.lang('Action Plan'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="description" class="control-label"><?php echo lang('Description') ?>:</label>
                <textarea type="text" name="description" id="description" class="form-control" rows="5" placeholder="<?php echo lang('Description'); ?>"><?php echo $action_plan->get_description() ?></textarea>
                <?php echo Validator::get_html_error_message('description'); ?>
            </div>
            <div class="form-group">
                <label for="due_date" class="control-label"><?php echo lang('Due Date') ?>:</label>
                <input type="text" id="due_date" name="due_date" class="form-control date-range" placeholder="<?php echo lang('Due Date'); ?>" value="<?php echo in_array($action_plan->get_due_date(), ['','0000-00-00', '1970-01-01']) ? '' : date('Y-m-d', strtotime($action_plan->get_due_date())) ?>">
                <?php echo Validator::get_html_error_message('due_date'); ?>
            </div>

            <?php echo Orm_User_Staff::draw_find_users('responsible', $action_plan->get_responsible(), lang('Responsible')) ?>

            <div class="form-group">
                <label for="progress" class="control-label"><?php echo lang('Progress') ?>:</label>
                <input type="text" name="progress" id="progress" class="form-control" placeholder="<?php echo lang('Progress'); ?>" value="<?php echo $action_plan->get_progress() ?>">
                <?php echo Validator::get_html_error_message('progress'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left" data-dismiss="modal">
                <span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn pull-right" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-save"></span><?php echo lang('Save'); ?>
            </button>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $('#action_form').submit(function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
        }).done(function (msg) {
            $('#ajaxModalDialog').html(msg);
        }).fail(function () {
            window.location.reload();
        });
    });

    $(".date-range").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: '<?php echo date('Y-m-d'); ?>'
    });
</script>