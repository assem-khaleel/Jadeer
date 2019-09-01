<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/11/17
 * Time: 1:24 PM
 *
 * @var $assessment_loop Orm_Al_Assessment_Loop
 *
 */

/**
 * @var $custom Orm_Al_Custom
 */

$custom = Orm_Al_Custom::get_instance($assessment_loop->get_item_id());

$reset_attachment = $this->input->post('reset_attachment');

?>
<input type="hidden" name="item_id" value="<?php echo $custom->get_id()?: -1; ?>" />
<div class="row form-group">
    <label class="col-sm-3 control-label" for="title"><?php echo lang('Custom Title'); ?></label>
    <div class="col-sm-9">
        <input class="form-control" type="text" name="title" id="title" value="<?php echo htmlfilter($custom->get_title()); ?>" />
        <?php echo Validator::get_html_error_message('title'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo Uploader::draw_file_upload($custom, 'attachment', lang('Attachment')) ?>
</div>

<div class="row form-group">
    <label class="col-sm-3 control-label" for="desc"><?php echo lang('Description'); ?></label>
    <div class="col-sm-9">
        <textarea class="form-control" name="desc" id="desc"><?php echo htmlfilter($custom->get_description()); ?></textarea>
        <?php echo Validator::get_html_error_message('desc'); ?>
    </div>
</div>