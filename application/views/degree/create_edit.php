<?php
/* @var $degree Orm_Degree */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">

        <?php echo form_open("/degree/save"); ?>
        <div class="form-group">
            <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>
                )</label>
            <input name="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($degree->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_en"> <?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <input name="name_en" type="text" class="form-control"
                   value="<?php echo htmlfilter($degree->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo lang('Gender') ?></label>

            <div class="col-sm-9">
                <?php
                foreach (Orm_Degree::$degree_list as $key => $is_graduate) {
                    $selected = ($key == $degree->get_is_undergraduate() ? 'checked="checked"' : '');
                    ?>
                    <div class="radio">
                        <label>
                            <input type="radio" class="px"
                                   value="<?php echo $key ?>" <?php echo $selected ?> name="is_undergraduate">
                            <span class="lbl"><?php echo lang($is_graduate) ?></span>
                        </label>
                    </div>
                <?php } ?>
                <?php echo Validator::get_html_error_message('is_undergraduate'); ?>
            </div>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$degree->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>

