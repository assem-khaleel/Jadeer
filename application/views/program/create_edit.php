<?php
/* @var $program Orm_Program */

$college_id = isset($college_id) ? $college_id : $program->get_department_obj()->get_college_id();
$department_id = isset($department_id) ? $department_id : $program->get_department_id();

?>
<div class="col-md-9 col-lg-10">
    <div class="well">
        <?php echo form_open('/program/save'); ?>
        <div class="form-group">
            <label class="control-label" for="college_id"><?php echo lang('College'); ?></label>
            <select name="college_id" id="college_id" class="form-control" onchange="get_departments_by_college(this);">
                <option value=""><?php echo lang('Select One'); ?></option>
                <?php foreach (Orm_College::get_all() as $college) { ?>
                    <?php $selected = (isset($college_id) && $college->get_id() == $college_id ? 'selected="selected"' : ''); ?>
                    <option
                            value="<?php echo (int)$college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                <?php } ?>
            </select>
            <?php echo Validator::get_html_error_message('college_id'); ?>
        </div>
        <div id="department_block">
            <?php if (!empty($college_id)): ?>
                <div class="form-group">
                    <label class="control-label" for="department_id"><?php echo lang('Department'); ?></label>
                    <select name="department_id" id="department_id" class="form-control">
                        <option value=""><?php echo lang('Select One'); ?></option>
                        <?php foreach (Orm_Department::get_all(array('college_id' => $college_id)) as $department) { ?>
                            <?php $selected = (isset($department_id) && $department->get_id() == $department_id ? 'selected="selected"' : ''); ?>
                            <option
                                    value="<?php echo (int)$department->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($department->get_name()); ?></option>
                        <?php } ?>
                    </select>
                    <?php echo Validator::get_html_error_message('department_id'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="degree_id"><?php echo lang('Degree'); ?></label>
            <select name="degree_id" id="degree_id" class="form-control">
                <option value=""><?php echo lang('Select One'); ?></option>
                <?php foreach (Orm_Degree::get_all(array('id')) as $degree) : ?>
                    <?php $selected = ($degree->get_id() == $program->get_degree_id() ? ' selected="selected"' : ''); ?>
                    <option
                            value="<?php echo (int)$degree->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($degree->get_name()); ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo Validator::get_html_error_message('degree_id'); ?>
        </div>
        <div class="form-group">
            <label class="control-label" for="name_ar"><?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>
                )</label>
            <input name="name_ar" id="name_ar" type="text" class="form-control"
                   value="<?php echo $program->get_name_ar(); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_en"><?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <input name="name_en" type="text" id="name_en" class="form-control"
                   value="<?php echo $program->get_name_en(); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$program->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>

