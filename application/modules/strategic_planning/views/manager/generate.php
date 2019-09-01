<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/20/15
 * Time: 2:12 PM
 */

/* @var Orm_Sp_Strategy $strategy */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('Create').' '.lang('a Strategy'); ?>
        </div>
        <?php echo form_open("",'id="strategy-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="start_year" class="col-sm-2 control-label"><?php echo lang('From (Year)'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="start_year" class="form-control"
                               value="<?php echo htmlfilter($strategy->get_start_year()); ?>" id="start_year"/>
                        <?php echo Validator::get_html_error_message('start_year'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="for_year" class="col-sm-2 control-label"><?php echo lang('To (Year)'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="for_year" class="form-control"
                               value="<?php echo htmlfilter($strategy->get_year()); ?>" id="for_year"/>
                        <?php echo Validator::get_html_error_message('for_year'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc_en" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                        (<?php echo lang('English'); ?>): </label>

                    <div class="col-sm-10">
                        <textarea name="desc_en" class="form-control"
                                  id="desc_en"><?php echo htmlfilter($strategy->get_description_en()); ?></textarea>
                        <?php echo Validator::get_html_error_message('desc_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc_ar" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                        (<?php echo lang('Arabic'); ?>): </label>

                    <div class="col-sm-10">
                        <textarea name="desc_ar" class="form-control"
                                  id="desc_ar"><?php echo htmlfilter($strategy->get_description_ar()); ?></textarea>
                        <?php echo Validator::get_html_error_message('desc_ar'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo $strategy->get_id(); ?>">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
                </button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    $('form#strategy-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/strategic_planning/generate',
            type: 'POST',
            data: $('#strategy-form').serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error === false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
        return false;
    });
</script>