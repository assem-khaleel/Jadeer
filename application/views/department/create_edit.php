<?php
/* @var $department Orm_Department */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">

        <?php echo form_open('/department/save'); ?>
        <div class="form-group">
            <label class="control-label"><?php echo lang('College'); ?></label>
            <select name="college_id" class="form-control">
                <option value=""><?php echo lang('Select One'); ?></option>
                <?php foreach (Orm_College::get_all(array('id')) as $college) : ?>
                    <?php $selected = ($college->get_id() == $department->get_college_id() ? ' selected="selected"' : ''); ?>
                    <option value="<?php echo (int)$college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo Validator::get_html_error_message('college_id'); ?>
        </div>
        <div class="form-group">
            <label class="control-label"> <?php echo lang('Department Name') . ' (' . lang('Arabic') . ')'; ?></label>
            <input name="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($department->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>
        <div class="form-group">
            <label class="control-label">  <?php echo lang('Department Name') . ' (' . lang('English') . ')'; ?></label>
            <input name="name_en" type="text" class="form-control"
                   value="<?php echo htmlfilter($department->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$department->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>

