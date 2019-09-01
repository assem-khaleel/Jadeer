<?php
/** @var $assignment_obj Orm_Pc_Assignment */
?>
<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">
                <?php echo $assignment_obj->get_id()?lang('Edit').' '.lang('Assignment/Exam Information'):lang('Add').' '.lang('Assignment/Exam Information');?>
            </h4>
        </div>
        <?php echo form_open("/portfolio_course/assignment/addEditAssignment/{$level}/{$assignment_obj->get_id()}?id={$course_id}", ['method' => 'post', "class" => 'inline-form', "id" => "addEditAssignment", 'enctype' => "multipart/form-data"]) ?>
        <div class="padding-sm-hr">
            <div class="modal-body">
                <div class="row form-group">
                    <label for="title_en" class="control-label"><?php echo lang('Title') ?> (<?php echo lang('English') ?>):</label>
                    <input type="text" name="title_en" id="editEn" class="form-control"
                           placeholder="<?php echo lang('Title') ?> (<?php echo lang('English') ?>)"
                           value="<?php echo $assignment_obj->get_title_en() ?>"/>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="control-label"><?php echo lang('Title') ?> (<?php echo lang('Arabic') ?>):</label>
                    <input type="text" name="title_ar" id="editAr" class=" form-control"
                           placeholder="<?php echo lang('Title') ?> (<?php echo lang('Arabic') ?>)"
                           value="<?php echo $assignment_obj->get_title_ar() ?>"/>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>
                <div class="row form-group">
                    <label for="desc_en" class="control-label"><?php echo lang('Description') ?> (<?php echo lang('English') ?>):</label>
                    <textarea type="text" name="desc_en" id="descEn" class=" form-control"
                              placeholder="<?php echo lang('Description') ?> (<?php echo lang('English') ?>)"><?php echo $assignment_obj->get_description_en() ?></textarea>
                    <?php echo Validator::get_html_error_message('desc_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="desc_ar" class="control-label"><?php echo lang('Description') ?> (<?php echo lang('Arabic') ?>):</label>
                    <textarea type="text" name="desc_ar" id="descAr" class=" form-control"
                              placeholder="<?php echo lang('Description') ?> (<?php echo lang('Arabic') ?>)"><?php echo $assignment_obj->get_description_ar() ?></textarea>
                    <?php echo Validator::get_html_error_message('desc_ar'); ?>
                </div>
                <div class="row form-group">
                    <label for="type" class="control-label"><?php echo lang('Type') ?>:</label>
                    <select name="type" class="form-control" id="grid-input-2">
                        <?php
                        foreach ($assTypes as $val => $text) {
                            $selected = ($val == $assignment_obj->get_type()) ? 'selected' : '';
                            echo "<option value=" . $val . " $selected >" . lang($text) . "</option>";
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('type'); ?>
                </div>
                <div class="row form-group">
                    <label for="start" class="control-label"><?php echo lang('Start Date') ?>:</label>
                    <input type="text" name="start" class="form-control" id="editStart"
                           placeholder="<?php echo lang('Start Date') ?>"
                           value="<?php echo (empty( $assignment_obj->get_start_date()) || $assignment_obj->get_start_date() == '0000-00-00 00:00:00' ||  $assignment_obj->get_start_date() == '1970-01-01 00:00:00') ? '' : date('Y-m-d', strtotime($assignment_obj->get_start_date())) ?>"/>
                    <?php echo Validator::get_html_error_message('start'); ?>
                </div>
                <div class="row form-group">
                    <label for="end" class="control-label"><?php echo lang('End Date') ?>:</label>
                    <input type="text" name="end" class="form-control" id="editEnd"
                           placeholder="<?php echo lang('End Date') ?>"
                           value="<?php echo (empty( $assignment_obj->get_end_date()) || $assignment_obj->get_end_date() == '0000-00-00 00:00:00' ||  $assignment_obj->get_end_date() == '1970-01-01 00:00:00') ? '' : date('Y-m-d', strtotime($assignment_obj->get_end_date()))?>"/>
                    <?php echo Validator::get_html_error_message('end'); ?>
                </div>

                <?php
                $output_html = '<a href="/portfolio_course/assignment/download/'.intval($assignment_obj->get_id()).'/'.$level.'/assignment?id='.$course_id.'" target="_blank" >' . lang('Download') . '</a>';
                echo Uploader::draw_file_upload($assignment_obj, 'file_path', lang('Attachment'),$output_html);
                ?>
            </div>
        </div>
        <div class="modal-footer">
            <div class=" text-right">
                <button type="button" class="btn pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i
                            class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>><span
                        class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<script>

    $('.custom-file').pxFile();

    $('#addEditAssignment').on('submit', function (e) {
        e.preventDefault();


        var files = $(":file:enabled", this);

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        if(files.length) {
            $ajaxProp['files']  = files;
            $ajaxProp['iframe'] =  true;
        }

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });

    });

    //addEditAssignment

    $('#editStart').datepicker({
        calendarWeeks: true,
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayBtn: 'linked',
        clearBtn: true,
        todayHighlight: true,
        daysOfWeekHighlighted: '1',
        orientation: 'auto right',
        beforeShowMonth: function (date) {
            if (date.getMonth() === 8) {
                return false;
            }
        },
        beforeShowYear: function (date) {
            if (date.getFullYear() === 2014) {
                return false;
            }
        }
    });
    $('#editEnd').datepicker({
        calendarWeeks: true,
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayBtn: 'linked',
        clearBtn: true,
        todayHighlight: true,
        daysOfWeekHighlighted: '1',
        orientation: 'auto right',
        beforeShowMonth: function (date) {
            if (date.getMonth() === 8) {
                return false;
            }
        },
        beforeShowYear: function (date) {
            if (date.getFullYear() === 2014) {
                return false;
            }
        }
    });
</script>