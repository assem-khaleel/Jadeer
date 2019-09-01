<?php
/** @var $reviewer Orm_Acc_Independent_Reviewer */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/accreditation/reviewer_independent/reviewer_add_edit/{$reviewer->get_type()}/{$reviewer->get_type_id()}/{$reviewer->get_id()}", 'id="reviewer_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Add').' '.lang('Reviewer'); ?></h4>
        </div>
        <div class="modal-body">
            <?php echo Orm_User_Staff::draw_find_users('reviewer_id', $reviewer->get_reviewer_id(), lang('Reviewer')) ?>

            <?php echo Uploader::draw_file_upload($reviewer, 'cv_attachment', lang('CV Attachment')) ?>

            <div class="form-group">
                <label class="control-label"><?php echo lang('CV Text') ?>:</label>
                <textarea name="cv_text" id="cv_text" ><?php echo xssfilter($reviewer->get_cv_text()); ?></textarea>
                <?php echo Validator::get_html_error_message('cv_text'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left" data-dismiss="modal">
                <span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn pull-right" >
                <span class="btn-label-icon left fa fa-save"></span><?php echo lang('Save'); ?>
            </button>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    tinymce.remove("#cv_text");
    tinymce.init({
        selector: "#cv_text",
        plugins : "paste",
        paste_use_dialog : false,
        paste_auto_cleanup_on_paste : true,
        paste_convert_headers_to_strong : false,
        paste_strip_class_attributes : "all",
        paste_remove_spans : true,
        paste_remove_styles : true,
        paste_retain_style_properties : "",
        height: 200,
        theme: "modern",
        menubar: false,
        statusbar: false
    });

    $('#reviewer_form').submit(function(e){
        e.preventDefault();

        var $_ajax_option = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        var files = $(":file:enabled", this);

        if(files.length) {
            $_ajax_option['files']  = files;
            $_ajax_option['iframe'] =  true;
        }

        $.ajax($_ajax_option).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });
    });
</script>