<?php
/* @var $college Orm_College */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">
        <?php echo form_open("/college/save"); ?>

        <div class="form-group">
            <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>
                )</label>
            <input name="name_ar" id="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($college->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_en"> <?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <input name="name_en" type="text" id="name_en" class="form-control"
                   value="<?php echo htmlfilter($college->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <div class="form-group">
            <label for="component" class="control-label"><?php echo lang('Campus'); ?></label>
            <?php foreach (Orm_Campus::get_all() as $campus) { ?>
                <div class="checkbox">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="campus_ids[]"
                               value="<?php echo $campus->get_id() ?>" <?php echo in_array($campus->get_id(), $college->get_campus_ids()) ? 'checked="checked"' : '' ?>>
                        <span class="custom-control-indicator"></span>
                        <?php echo htmlfilter($campus->get_name()); ?>
                    </label>
                </div>
            <?php } ?>
            <?php echo Validator::get_html_error_message('campus_ids'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="unit_id"> <?php echo lang('Vice Rectorate'); ?></label>
            <select name="unit_id" id="unit_id" class="form-control">
                <option value=""><?php echo lang('Not Applicable'); ?></option>
                <?php foreach (Orm_Unit::get_all(array('class_type' => Orm_Unit_Vice_Rector::class)) as $unit) { ?>
                    <?php $selected = $unit->get_id() == $college->get_unit_id() ? 'selected="selected"' : ''; ?>
                    <option value="<?php echo $unit->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($unit->get_name()); ?></option>
                <?php } ?>
            </select>
            <?php echo Validator::get_html_error_message('unit_id'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="land_area"> <?php echo lang('Land Area'); ?></label>
            <input name="land_area" id="land_area" type="text" class="form-control"
                   value="<?php echo htmlfilter($college->get_area()); ?>"/>
            <?php echo Validator::get_html_error_message('land_area'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="building_size"> <?php echo lang('Building Size'); ?></label>
            <input name="building_size" id="building_size" type="text" class="form-control"
                   value="<?php echo htmlfilter($college->get_size()); ?>"/>
            <?php echo Validator::get_html_error_message('building_size'); ?>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$college->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>

    </div>
</div>


