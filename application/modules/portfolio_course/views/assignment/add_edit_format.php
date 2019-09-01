<?php
/** @var $format_obj Orm_Pc_Format */
switch ($fileType){
    case 'assignment':
        $dataType = 'Assignment format' ;

        break;
    case 'homework':
        $dataType = 'Homework problems';

        break;
    case 'laboratory':
        $dataType = 'Laboratory experiment format';

        break;
    case 'exercise':
        $dataType = 'In-class exercises format';

        break;
    default:
        $dataType = 'Assignment - Format Information';

        break;
}
?>
<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <?php echo form_open("/portfolio_course/assignment/addEditFormat/{$level}/{$fileType}/{$format_obj->get_id()}?id={$course_id}", ['method' => 'post', "class" => 'inline-form', "id" => "addEditSupport", 'en', 'enctype' => "multipart/form-data"]) ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php echo $format_obj->get_id() ? lang('Edit').' '.lang($dataType): lang('Add').' '.lang($dataType)?></h4>
        </div>
        <div class="padding-sm-hr">
            <div class="modal-body">
                <?php    switch ($fileType) {
                    case "assignment":
                        $output_html = '<a href="/portfolio_course/assignment/download/'.intval($format_obj->get_id()).'/'.$level.'/assignment?id='.$course_id.'" target="_blank" >' . lang('Download') . '</a>';
                        echo Uploader::draw_file_upload($format_obj, 'assignment_format_file', lang('Attachment'),$output_html);
                        echo'<input type="hidden" value="'. $format_obj->get_assignment_format_file().'" name="file_exist">';
                        break;
                    case "homework":
                        $output_html = '<a href="/portfolio_course/assignment/download/'.intval($format_obj->get_id()).'/'.$level.'/homework?id='.$course_id.'" target="_blank" >' . lang('Download') . '</a>';
                        echo Uploader::draw_file_upload($format_obj, 'homework_format_file', lang('Attachment'),$output_html);
                        echo'<input type="hidden" value="'. $format_obj->get_homework_format_file().'" name="file_exist">';

                        break;
                    case "laboratory":
                        $output_html = '<a href="/portfolio_course/assignment/download/'.intval($format_obj->get_id()).'/'.$level.'/laboratory?id='.$course_id.'" target="_blank" >' . lang('Download') . '</a>';
                        echo Uploader::draw_file_upload($format_obj, 'lab_experiment_format_file', lang('Attachment'),$output_html);
                        echo'<input type="hidden" value="'. $format_obj->get_lab_experiment_format_file().'" name="file_exist">';
                        break;
                    case "exercise":
                        $output_html = '<a href="/portfolio_course/assignment/download/'.intval($format_obj->get_id()).'/'.$level.'/exercise?id='.$course_id.'" target="_blank" >' . lang('Download') . '</a>';
                        echo Uploader::draw_file_upload($format_obj, 'class_exercise_format_file', lang('Attachment'),$output_html);
                        echo'<input type="hidden" value="'. $format_obj->get_class_exercise_format_file().'" name="file_exist">';
                        break;
                }
                ?>
                <div class="row form-group">
                    <label for="title_en" class="control-label"><?php echo lang('Title') ?> (<?php echo lang('English') ?>):</label>
                    <textarea type="text" name="title_en" class="form1 form-control select2-input"
                              placeholder="<?php echo lang('Title') ?> (<?php echo lang('English') ?>)"><?php echo $format_obj->get_file_name_en() ?></textarea>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="control-label"><?php echo lang('Title') ?> (<?php echo lang('Arabic') ?>):</label>
                    <textarea type="text" name="title_ar" class="form1 form-control select2-input"
                              placeholder="<?php echo lang('Title') ?> (<?php echo lang('Arabic') ?>)"><?php echo $format_obj->get_file_name_ar() ?></textarea>
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

    $('#addEditSupport').on('submit', function (e) {
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