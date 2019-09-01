<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/8/17
 * Time: 10:20 AM
 */
/** @var $object Orm_Institution | Orm_Unit | Orm_College | Orm_Program */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Mission'); ?></h4>
        </div>
        <?php echo form_open("/setup/mission_save", 'id="mission-form" class="form-horizontal"') ?>
        <div class="modal-body">
            <div class="form-group">
                <label for="title_english" class="col-sm-2 control-label"><?php echo lang('Mission'); ?>
                    (<?php echo lang('English'); ?>): *</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="title_english"
                              name="title_english"><?php echo htmlfilter($object->get_mission_en()); ?></textarea>
                    <?php echo Validator::get_html_error_message('title_english'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="title_arabic" class="col-sm-2 control-label"><?php echo lang('Mission'); ?>
                    (<?php echo lang('Arabic'); ?>): *</label>

                <div class="col-sm-10">
                    <textarea class="form-control" id="title_arabic"
                              name="title_arabic"><?php echo htmlfilter($object->get_mission_ar()); ?></textarea>
                    <?php echo Validator::get_html_error_message('title_arabic'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo intval($object->get_id()); ?>"/>
            <input type="hidden" name="class_type" value="<?php echo htmlfilter(get_class($object)); ?>"/>
            <button type="button" class="btn btn-sm  pull-left "
                    data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
            </button>
        </div>
        <?php  ?>
    </div>
</div>
<script>
    init_data_toggle();
    $('form#mission-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error === false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>