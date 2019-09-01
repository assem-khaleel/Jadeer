<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/7/16
 * Time: 3:17 PM
 */
$social = Orm_Stp_Social::get_one(array('student_id' => Orm_User::get_logged_user_id()));
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('Social Information'); ?>
        </div>

        <?php echo form_open("/student_portfolio/social_manage",'id="social-form" class="form-horizontal"') ?>
        <div class="modal-body">
            <div class="form-group">
                <label for="facebook" class="col-sm-2 control-label"><?php echo lang('Facebook'); ?></label>
                <div class="col-sm-10">
                    <input type="text" name="facebook" class="form-control" value="<?php echo htmlfilter($social->get_facebook()); ?>" id="facebook"/>
                    <?php echo Validator::get_html_error_message('facebook'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="twitter" class="col-sm-2 control-label"><?php echo lang('Twitter'); ?></label>
                <div class="col-sm-10">
                    <input type="text" name="twitter" class="form-control" value="<?php echo htmlfilter($social->get_tweeter()); ?>" id="twitter"/>
                    <?php echo Validator::get_html_error_message('twitter'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="linkedin" class="col-sm-2 control-label"><?php echo lang('LinkedIn'); ?></label>
                <div class="col-sm-10">
                    <input type="text" name="linkedin" class="form-control" value="<?php echo htmlfilter($social->get_linkedin()); ?>" id="linkedin"/>
                    <?php echo Validator::get_html_error_message('linkedin'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>

    $("#date").datepicker({format: 'yyyy-mm-dd', autoclose: true});

    $('form#social-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == true) {
                $('#social_container').html(msg.html);
                $('#ajaxModal').modal('toggle');
                init_data_toggle();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>