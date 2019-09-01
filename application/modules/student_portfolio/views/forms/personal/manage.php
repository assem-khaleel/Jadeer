<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/7/16
 * Time: 3:17 PM
 */
/** @var Orm_Stp_Personal $personal */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('Personal Information'); ?>
        </div>

        <?php echo form_open("/student_portfolio/personal_manage",'id="personal-form" class="form-horizontal"') ?>
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('Resume'); ?> *</label>
                <div class="col-md-10">
                    <label class="custom-file px-file" id="resume">
                        <input type="file" name="resume" class="custom-file-input">
                        <span class="custom-file-control form-control"> <?php echo lang('Attachment'); ?></span>
                        <div class="px-file-buttons">
                            <button type="button" class="btn px-file-clear"><?php echo lang('Clear') ?></button>
                            <button type="button" class="btn btn-primary px-file-browse"><?php echo lang('Browse') ?></button>
                        </div>
                    </label>
                    <?php echo Validator::get_html_error_message('resume'); ?>
                    <?php
                $file = $personal->get_resume() && file_exists(FCPATH . $personal->get_resume());

                if($file) {

                    
                       echo  '<a href="' . htmlfilter($personal->get_resume()) . '" target="_blank" >' . lang('Download') . '</a>';      
                }
                ?>
                </div>
            </div>
            <div class="form-group">
                <label for="goals" class="col-sm-2 control-label"><?php echo lang('Goals'); ?></label>
                <div class="col-sm-10">
                    <textarea name="goals" class="form-control" id="goals"><?php echo xssfilter($personal->get_personal_goals()); ?></textarea>
                    <?php echo Validator::get_html_error_message('goals'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="hobbies" class="col-sm-2 control-label"><?php echo lang('Hobbies'); ?></label>
                <div class="col-sm-10">
                    <textarea name="hobbies" class="form-control" id="hobbies"><?php echo xssfilter($personal->get_hobbies()); ?></textarea>
                    <?php echo Validator::get_html_error_message('hobbies'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left "
                    data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>

    $('.custom-file').pxFile();

    tinymce.remove("#goals");
    tinymce.init({
        selector: "#goals",
        height: 200,
        theme: "modern",
        menubar: false,
        statusbar: false
    });
    tinymce.remove("#hobbies");
    tinymce.init({
        selector: "#hobbies",
        height: 200,
        theme: "modern",
        menubar: false,
        statusbar: false
    });

    $("#personal-form").submit(function() {
        $.ajax(this.action, {
            data: $(this).serializeArray(),
            files: $(":file", this),
            iframe: true,
            dataType: "json"
        }).complete(function(data) {

            var msg = data.responseJSON;

            if (msg.status == true) {
                $('#personal_container').html(msg.html);
                $('#ajaxModal').modal('toggle');
                init_data_toggle();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
        return false;
    });
</script>