<?php
/** @var $work_obj Orm_Pc_Student_Work */

switch ($type){
    case 1:
        $datatype = 'student projects';
        $title_en = $work_obj->get_title_en();
        $title_ar = $work_obj->get_title_ar();
        break;
    case 2:
        $datatype = 'Project grading guideline';
        $title_en = $work_obj->get_grading_guideline_en();
        $title_ar = $work_obj->get_grading_guideline_ar();
        break;
    default:
        $datatype = 'Student Work';
        $title_en = '';
        $title_ar = '';
        break;
}

?>
<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <?php echo form_open("/portfolio_course/student_work/addEditWork/{$type}/{$work_obj->get_id()}?id={$course_id}" ,['method'=>'post',"class"=>'inline-form', "id"=>"addEditWork", 'en'])?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php echo $work_obj->get_id() ? lang('Edit').' '.lang($datatype) : lang('Add').' '.lang($datatype) ?></h4>
        </div>
        <div class="padding-sm-hr">
            <div class="modal-body">
                <?php if($type == 1){ ?>
                    <?php
                    $output_html = '<a href="/portfolio_course/student_work/downloadProjects/'.intval($work_obj->get_id()).'?id='.$course_id.'" target="_blank" >' . lang('Download') . '</a>';
                    echo Uploader::draw_file_upload($work_obj, 'student_project_file', lang('Attachment'),$output_html);
                    ?>
                <?php } ?>
                <div class="row form-group">
                    <label for="title_en" class="control-label"><?php echo lang('Text') ?> (<?php echo lang('English') ?>):</label>
                    <textarea type="text" name="title_en" class="form1 form-control select2-input" placeholder="<?php echo lang('Text') ?> (<?php echo lang('English') ?>)" ><?php echo $title_en ?></textarea>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="control-label"><?php echo lang('Text') ?> (<?php echo lang('Arabic') ?>):</label>
                    <textarea type="text" name="title_ar" class="form1 form-control select2-input" placeholder="<?php echo lang('Text') ?> (<?php echo lang('Arabic') ?>)"><?php echo $title_ar ?></textarea>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>

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

    $('.custom-file').pxFile();

    $('#addEditWork').on('submit', function (e) {
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