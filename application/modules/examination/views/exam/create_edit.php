<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 10:32 ص
 */
/* @var $exam Orm_Tst_Exam*/

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/examination/create_edit/".($exam->get_id()?: ''), array('id' => 'exam_form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo ($exam && $exam->get_id())? lang('Edit').' '.lang('Exam'): lang('Add').' '.lang('Exam'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label" for="name_en"> <?php echo lang('Exam Name'); ?> (<?php echo lang('English'); ?>)</label>
                    <input name="name_en" type="text" id="name_en" class="form-control"
                           value="<?php echo htmlfilter($exam->get_name_en()); ?>"/>
                    <?php echo Validator::get_html_error_message('name_en'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for="name_ar"> <?php echo lang('Exam Name'); ?> (<?php echo lang('Arabic'); ?>)</label>
                    <input name="name_ar" id="name_ar" type="text" class="form-control"
                           value="<?php echo htmlfilter($exam->get_name_ar()); ?>"/>
                    <?php echo Validator::get_html_error_message('name_ar'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for="fullmark"> <?php echo lang('Exam Mark'); ?></label>
                    <input name="fullmark" id="fullmark" type="text" class="form-control"
                           value="<?php echo htmlfilter($exam->get_fullmark()); ?>"/>
                    <?php echo Validator::get_html_error_message('fullmark'); ?>
                </div>

                <?php if(!$exam->get_id()): ?>
                <div class="form-group">
                    <label class="control-label" for="course_label"><?php echo lang('Course') ?></label>
                    <input id="course_label" type="text" onclick="find_courses(this,'course_id','course_label')" readonly
                           class="form-control" value="<?php echo htmlfilter($exam->get_course_obj()->get_name()); ?>"/>
                    <input id="course_id" name="course_id" type="hidden" value="<?php echo $exam->get_course_id() ?>"/>
                    <?php echo Validator::get_html_error_message('course_id'); ?>
                </div>

                <input type="hidden" name="type" value="<?php echo $exam::TYPE_EXAM; ?>">
                <?php endif; ?>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
                </button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                </button>
            </div>


        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">

    $('#exam_form').submit(function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>
