<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/8/17
 * Time: 10:20 AM
 */
/** @var $object Orm_Institution | Orm_Unit | Orm_College | Orm_Program */
/** @var $objective Orm_Institution_Objective | Orm_Unit_Objective | Orm_College_Objective | Orm_Program_Objective */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Objective'); ?></h4>
        </div>
        <?php echo form_open("/setup/objective_add_edit/" . htmlfilter(get_class($object)) . "/" . intval($object->get_id()) . "/" . intval($objective->get_id()), 'id="objective-form" class="form-horizontal"') ?>
        <div class="modal-body">
            <div class="form-group">
                <label for="title_english" class="col-sm-3 control-label">
                    <?php echo lang('Objective'); ?> (<?php echo lang('English'); ?>): *
                </label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="title_english"
                              name="title_english"><?php echo htmlfilter($objective->get_title_en()); ?></textarea>
                    <?php echo Validator::get_html_error_message('title_english'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="title_arabic" class="col-sm-3 control-label">
                    <?php echo lang('Objective'); ?> (<?php echo lang('Arabic'); ?>): *
                </label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="title_arabic"
                              name="title_arabic"><?php echo htmlfilter($objective->get_title_ar()); ?></textarea>
                    <?php echo Validator::get_html_error_message('title_arabic'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span
                        class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span
                        class="btn-label-icon left fa fa-floppy-o"></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();
    $('form#objective-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize()
        }).done(function (html) {
            $('#ajaxModalDialog').html(html);
        });
    });
</script>