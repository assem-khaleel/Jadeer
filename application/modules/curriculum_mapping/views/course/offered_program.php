<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/24/16
 * Time: 11:24 AM
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/course/offered_program/{$course_id}", array('id' => 'offered-program-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Offered Program'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="title" class="col-md-2 control-label"><?php echo lang('Program'); ?>:</label>
                <div class="col-md-10">
                    <select name="program_id" class="form-control">
                        <option value=""><?php echo lang('Select Program'); ?></option>
                        <?php foreach(Orm_Program::get_all(array('college_id' => Orm_Course::get_instance($course_id)->get_department_obj()->get_college_id())) as $program) { ?>
                            <option value="<?php echo $program->get_id() ?>"><?php echo htmlfilter($program->get_name()) ?></option>
                        <?php } ?>
                    </select>
                    <?php echo Validator::get_html_error_message('program_id'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">

    $('#offered-program-form').on('submit', function (e) {
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