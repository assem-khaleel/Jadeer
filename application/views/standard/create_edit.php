<?php
/* @var $standard Orm_Standard */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">

        <?php echo form_open("/standard/save"); ?>
        <div class="form-group">
            <label class="control-label" for="code"> <?php echo lang('Code'); ?></label>
            <input name="code" type="text" class="form-control"
                   value="<?php echo htmlfilter($standard->get_code()); ?>"/>
            <?php echo Validator::get_html_error_message('code'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="title"> <?php echo lang('Title'); ?> </label>
            <input name="title" type="text" class="form-control"
                   value="<?php echo htmlfilter($standard->get_title()); ?>"/>
            <?php echo Validator::get_html_error_message('title'); ?>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$standard->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>

