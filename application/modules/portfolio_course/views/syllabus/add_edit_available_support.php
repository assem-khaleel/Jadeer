<?php
/** @var $support_obj Orm_Pc_Support_Service */

?>

<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">
                <?php echo $support_obj->get_id()?lang('Edit').' '.lang('Available Support Service'):lang('Add').' '.lang('Available Support Service')?>
            </h4>
        </div>
        <?php echo form_open("/portfolio_course/syllabus/edit/{$level}/{$support_obj->get_id()}?id={$course_id}", ['method' => 'post', "class" => 'inline-form', "id" => "addEditSupport", 'en']) ?>
        <div class="padding-sm-hr">
            <div class="modal-body">

                <div class="row form-group">
                    <label for="title_en"
                           class="control-label"><?php echo lang('Available Support service') ?> (<?php echo lang('English') ?>):</label>
                    <textarea type="text" name="title_en" id="editEn" class="form1 form-control select2-input"
                              placeholder="<?php echo lang('Available Support service') ?> (<?php echo lang('English') ?>)"><?php echo $support_obj->get_available_support_service_en(); ?></textarea>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="control-label">
                        <?php echo lang('Available Support service') ?> (<?php echo lang('Arabic') ?>):</label>
                    <textarea type="text" name="title_ar" id="editAr" class="form1 form-control select2-input"
                              placeholder="<?php echo lang('Available Support service') ?> (<?php echo lang('Arabic') ?>)"><?php echo $support_obj->get_available_support_service_ar(); ?></textarea>
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