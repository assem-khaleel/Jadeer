<?php /* @var $manual Orm_Manual */ ?>
<?php echo form_open("/manual/save"); ?>
    <div class="row form-group">
        <label class="col-sm-2 control-label" for="label-ar"><?php echo lang('Label') ?> (<?php echo lang('Arabic')?>):</label>
        <div class="col-sm-10">
            <input type="text" name="label_ar" id="label-ar" class="form-control"
                   value="<?php echo htmlfilter($manual->get_label_arabic()); ?>">
            <?php echo Validator::get_html_error_message('label_ar'); ?>
        </div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label" for="label-en"><?php echo lang('Label') ?> (<?php echo lang('English')?>):</label>
        <div class="col-sm-10">
            <input type="text" name="label_en" id="label-en" class="form-control"
                   value="<?php echo htmlfilter($manual->get_label_english()); ?>">
            <?php echo Validator::get_html_error_message('label_en'); ?>
        </div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label" for="link-ar"><?php echo lang('Link') ?> (<?php echo lang('Arabic')?>):</label>
        <div class="col-sm-10">
            <input type="text" name="link_ar" id="link-ar" class="form-control"
                   value="<?php echo htmlfilter($manual->get_link_arabic()); ?>">
            <?php echo Validator::get_html_error_message('link_ar'); ?>
        </div>
    </div>
    <div class="row form-group">
        <label class="col-sm-2 control-label" for="link-en"><?php echo lang('Link') ?> (<?php echo lang('English')?>):</label>
        <div class="col-sm-10">
            <input type="text" name="link_en" id="link-en" class="form-control"
                   value="<?php echo htmlfilter($manual->get_link_english()); ?>">
            <?php echo Validator::get_html_error_message('link_en'); ?>
        </div>
    </div>

    <input type="hidden" name="id" value="<?php echo (int)$manual->get_id(); ?>">

    <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
        <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
        <?php echo lang('Save Changes'); ?>
    </button>
<?php echo form_close(); ?>