<?php
/** @var $calender_obj Orm_Pc_Topic */
?>

<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php echo $calender_obj->get_id() ? lang('Edit').' '.lang('Topics') : lang('Add').' '.lang('Topics')?></h4>
        </div>
        <?php echo form_open("/portfolio_course/syllabus/edit/{$level}/{$calender_obj->get_id()}?id={$course_id}", ['method' => 'post', "class" => 'inline-form', "id" => "addEditCalender", 'en']) ?>
        <div class="padding-sm-hr">
            <div class="modal-body">
                <div class="row form-group">
                    <label for="title_en" class="control-label"><?php echo lang('Topic Title') ?> (<?php echo lang('English') ?>):</label>
                    <input type="text" name="title_en" id="editEn" class="form-control"
                           placeholder="<?php echo lang('Topic Title') ?> (<?php echo lang('English') ?>)"
                           value="<?php echo $calender_obj->get_title_en(); ?>"/>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="control-label"><?php echo lang('Topic Title') ?> (<?php echo lang('Arabic') ?>):</label>
                    <input type="text" name="title_ar" id="editAr" class=" form-control"
                           placeholder="<?php echo lang('Topic Title') ?> (<?php echo lang('Arabic') ?>)"
                           value="<?php echo $calender_obj->get_title_ar(); ?>"/>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>
                <div class="row form-group">
                    <label for="desc_en" class="control-label"><?php echo lang('Description') ?> (<?php echo lang('English') ?>):</label>
                    <textarea type="text" name="desc_en" id="descEn" class=" form-control"
                              placeholder="<?php echo lang('Description') ?> (<?php echo lang('English') ?>)"><?php echo $calender_obj->get_description_en(); ?></textarea>
                    <?php echo Validator::get_html_error_message('desc_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="desc_ar" class="control-label"><?php echo lang('Description') ?> (<?php echo lang('Arabic') ?>):</label>
                    <textarea type="text" name="desc_ar" id="descAr" class=" form-control"
                              placeholder="<?php echo lang('Description') ?> (<?php echo lang('Arabic') ?>)"><?php echo $calender_obj->get_description_ar(); ?></textarea>
                    <?php echo Validator::get_html_error_message('desc_ar'); ?>
                </div>
                <div class="row form-group">
                    <label for="start" class="control-label"><?php echo lang('Start Date') ?>:</label>
                    <input type="text" name="start" class="form-control" id="editStart"
                           placeholder="<?php echo lang('Start Date') ?>"
                           value="<?php echo ($calender_obj->get_start_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($calender_obj->get_start_date()))) ?>"/>
                    <?php echo Validator::get_html_error_message('start'); ?>
                </div>
                <div class="row form-group">
                    <label for="end" class="control-label"><?php echo lang('End Date') ?>:</label>
                    <input type="text" name="end" class="form-control" id="editEnd"
                           placeholder="<?php echo lang('End Date') ?>"
                           value="<?php echo $calender_obj->get_end_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($calender_obj->get_end_date())); ?>"/>
                    <?php echo Validator::get_html_error_message('end'); ?>
                </div>
                <div class="modal-footer">
                    <div class=" text-right">
                        <button type="button" class="btn pull-left " data-dismiss="modal"><span
                                class="btn-label-icon left"><i
                                    class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                        <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>><span
                                class="btn-label-icon left"><i
                                    class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<script>
    $('#addEditCalender').on('submit', function (e) {
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


    $('#editEnd, #editStart').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        calendarWeeks: true,
        clearBtn: true,
        todayBtn: 'linked',
        todayHighlight: true,
        orientation: 'auto right'
    });

</script>