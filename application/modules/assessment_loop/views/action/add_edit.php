<?php
/** @var $action Orm_Al_Action */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("assessment_loop/action/save?assessment_loop_id=".$assessment_loop_id, array('id' => 'action-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Actions'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label" for="action_en"> <?php echo lang('Action'); ?> (<?php echo lang('English'); ?>)</label>
                    <textarea class="form-control" id="action_en" name="action_en"><?php echo htmlfilter($action->get_action_en())?></textarea>
                    <?php echo Validator::get_html_error_message('action_en'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label" for="action_ar"> <?php echo lang('Action'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <textarea class="form-control" id="action_ar" name="action_ar"><?php echo htmlfilter($action->get_action_ar())?></textarea>
                    <?php echo Validator::get_html_error_message('action_ar'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label" for="responsible_en"> <?php echo lang('Responsible'); ?>
                        (<?php echo lang('English'); ?>)</label>
                    <textarea class="form-control" id="responsible_en" name="responsible_en"><?php echo htmlfilter($action->get_responsible_en())?></textarea>
                    <?php echo Validator::get_html_error_message('responsible_en'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label" for="responsible_ar"> <?php echo lang('Responsible'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <textarea class="form-control" id="responsible_ar" name="responsible_ar"><?php echo htmlfilter($action->get_responsible_ar())?></textarea>
                    <?php echo Validator::get_html_error_message('responsible_ar'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label" for="time_frame_en"> <?php echo lang('Time Frame'); ?>
                        (<?php echo lang('English'); ?>)</label>
                    <input class="form-control" id="time_frame_en" name="time_frame_en" value="<?php echo htmlfilter($action->get_time_frame_en())?>">
                    <?php echo Validator::get_html_error_message('time_frame_en'); ?>
                </div>
                <div class="form-group">
                    <label class="control-label" for="time_frame_ar"> <?php echo lang('Time Frame'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <input class="form-control" id="time_frame_ar" name="time_frame_ar" value="<?php echo htmlfilter($action->get_time_frame_ar())?>">
                    <?php echo Validator::get_html_error_message('time_frame_ar'); ?>
                </div>
                <input type="hidden" name="id" value="<?php echo intval($action->get_id())?>">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#action-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>