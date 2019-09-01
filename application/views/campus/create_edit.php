<?php
/* @var $campus Orm_Campus */

//echo "<pre>"; print_r($campus); die();
?>

<div class="col-md-9 col-lg-10">
    <div class="well">
        <?php echo form_open("/campus/save"); ?>

        <div class="form-group">
            <label class="control-label" for="name_en"> <?php echo lang('Name'); ?> (<?php echo lang('English'); ?>)</label>
            <input name="name_en" type="text" class="form-control"
                   value="<?php echo htmlfilter($campus->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>)</label>
            <input name="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($campus->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$campus->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>

    </div>
</div>

