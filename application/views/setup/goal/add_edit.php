<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/8/17
 * Time: 10:20 AM
 */
/** @var $object Orm_Institution | Orm_Unit | Orm_College | Orm_Program */
/** @var $goal Orm_Institution_Goal | Orm_Unit_Goal | Orm_College_Goal | Orm_Program_Goal */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Goal'); ?></h4>
        </div>
        <?php echo form_open("/setup/goal_add_edit/" . htmlfilter(get_class($object)) . "/" . intval($object->get_id()) . "/" . intval($goal->get_id()), 'id="goal-form" class="form-horizontal"') ?>
        <div class="modal-body">
            <div class="form-group">
                <label for="goal_title_en" class="col-sm-3 control-label">
                    <?php echo lang('Goal'); ?> (<?php echo lang('English'); ?>): *
                </label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="goal_title_en"
                              name="title_english"><?php echo htmlfilter($goal->get_title_en()); ?></textarea>
                    <?php echo Validator::get_html_error_message('title_english'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="goal_title_ar" class="col-sm-3 control-label">
                    <?php echo lang('Goal'); ?> (<?php echo lang('Arabic'); ?>): *
                </label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="goal_title_ar"
                              name="title_arabic"><?php echo htmlfilter($goal->get_title_ar()); ?></textarea>
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
    $('form#goal-form').submit(function (e) {
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