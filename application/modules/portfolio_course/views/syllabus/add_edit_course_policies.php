<?php
/** @var $policies_obj Orm_Pc_Course_Policies */

switch ($dataType) {
    case "Grading":
        $title_en = $policies_obj->get_grading_en();
        $title_ar = $policies_obj->get_grading_ar();
        $modal_title = 'Grading';
        break;
    case "Attendance":
        $title_en = $policies_obj->get_attendance_en();
        $title_ar = $policies_obj->get_attendance_ar();
        $modal_title = 'Attendance';
        break;
    case "Lateness":
        $title_en = $policies_obj->get_lateness_en();
        $title_ar = $policies_obj->get_lateness_ar();
        $modal_title = 'Lateness';
        break;
    case "participation":
        $title_en = $policies_obj->get_class_participation_en();
        $title_ar = $policies_obj->get_class_participation_ar();
        $modal_title = 'Participation';
        break;
    case "MissedExam":
        $title_en = $policies_obj->get_missed_exam_en();
        $title_ar = $policies_obj->get_missed_exam_ar();
        $modal_title = 'Missed Exam';
        break;
    case "MissedAssignment":
        $title_en = $policies_obj->get_missed_assignment_en();
        $title_ar = $policies_obj->get_missed_assignment_ar();
        $modal_title = 'Missed Assignment';
        break;
    case "dishonesty":
        $title_en = $policies_obj->get_academic_dishonesty_en();
        $title_ar = $policies_obj->get_academic_dishonesty_ar();
        $modal_title = 'Dishonesty';
        break;
    case "plagiarism":
        $title_en = $policies_obj->get_academic_plagiarism_en();
        $title_ar = $policies_obj->get_academic_plagiarism_ar();
        $modal_title = 'Plagiarism';
        break;
    default:
        $title_en = '';
        $title_ar = '';
        $modal_title = '';
        break;


}

?>

<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="title"><?php echo $title_en && $title_ar ? lang("Edit") . ' ' . lang($modal_title) : lang("Add") . ' ' . lang($modal_title) ?></h4>
        </div>
        <?php echo form_open("/portfolio_course/syllabus/edit/{$level}/{$policies_obj->get_id()}?id={$course_id}&dataType={$dataType}", ['method' => 'post', "class" => 'inline-form', "id" => "addEditPolicies", 'en']) ?>
        <div class="padding-sm-hr">
            <div class="modal-body">

                <div class="row form-group">
                    <label for="title_en" class="control-label"><?php echo lang('Text') ?> (<?php echo lang('English') ?>):</label>
                    <textarea type="text" name="title_en" id="editEn" class="form1 form-control select2-input"
                              placeholder="<?php echo lang('Text') ?> (<?php echo lang('English') ?>)"><?php echo $title_en; ?></textarea>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="control-label"><?php echo lang('Text') ?> (<?php echo lang('Arabic') ?>):</label>
                    <textarea type="text" name="title_ar" id="editAr" class="form1 form-control select2-input"
                              placeholder="<?php echo lang('Text') ?> (<?php echo lang('Arabic') ?>)"><?php echo $title_ar; ?></textarea>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row form-group">
                <div class=" text-right">
                    <button type="button" class="btn pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i
                                class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                    <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>><span
                            class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $('#addEditPolicies').on('submit', function (e) {
        e.preventDefault();
        var files = $(":file:enabled", this);
        if (files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: $(":file:enabled", this),
                iframe: true,
                dataType: 'JSON'
            }).complete(function (data) {
                handle_response(data.responseJSON);
            });
        } else {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'JSON'
            }).done(function (msg) {
                handle_response(msg);
            });
        }

        function handle_response(msg) {
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }
    });

</script>