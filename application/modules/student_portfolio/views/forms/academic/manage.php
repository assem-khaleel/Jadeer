<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/7/16
 * Time: 3:17 PM
 */
$student_academic = Orm_Stp_Academic::get_one(array('user_id' => Orm_User::get_logged_user()->get_id()));
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('Academic Information'); ?>
        </div>

        <?php echo form_open("/student_portfolio/academic_manage", 'id="academic-form" class="form-horizontal"') ?>
        <div class="modal-body">
            <div class="form-group">
                <label for="advising" class="col-sm-2 control-label"><?php echo lang('Academic Advising'); ?></label>
                <div class="col-sm-10">
                    <textarea name="advising" class="form-control" id="advising"><?php echo xssfilter($student_academic->get_student_academic_advicing()); ?></textarea>
                    <?php echo Validator::get_html_error_message('advising'); ?>
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
    tinymce.remove("#advising");
    tinymce.init({
        selector: "#advising",
        height: 200,
        theme: "modern",
        menubar: false,
        statusbar: false
    });

    $('form#academic-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == true) {
                $('#academic-container').html(msg.html);
                $('#ajaxModal').modal('toggle');
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>