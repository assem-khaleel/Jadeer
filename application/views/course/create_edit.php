<?php
/* @var $course Orm_Course */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">

        <?php echo form_open("/course/save"); ?>

        <div class="form-group">
            <label class="control-label"><?php echo lang('College'); ?></label>
            <select name="college_id" class="form-control" onchange="get_departments_by_college(this);">
                <option value=""><?php echo lang('Select One'); ?></option>
                <?php foreach (Orm_College::get_all() as $college) { ?>
                    <?php $selected = (isset($college_id) && $college->get_id() == $college_id ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo (int)$college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                <?php } ?>
            </select>
            <?php echo Validator::get_html_error_message('college_id'); ?>
        </div>
        <div id="department_block">
            <?php if (!empty($college_id)): ?>
                <div class="form-group">
                    <label class="control-label"><?php echo lang('Department'); ?></label>
                    <select name="department_id" class="form-control">
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
            <label class="control-label"><?php echo lang('Name') ?> (<?php echo lang('Arabic') ?>)</label>
            <input name="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($course->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Name') ?> (<?php echo lang('English') ?>)</label>
            <input name="name_en" type="text" class="form-control"
                   value="<?php echo htmlfilter($course->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Code') ?> (<?php echo lang('Arabic') ?>)</label>
            <input name="code_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($course->get_code_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('code_ar'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Code') ?> (<?php echo lang('English') ?>)</label>
            <input name="code_en" type="text" class="form-control"
                   value="<?php echo htmlfilter($course->get_code_en()); ?>"/>
            <?php echo Validator::get_html_error_message('code_en'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Type'); ?> *</label>
            <select name="type" class="form-control">
                <option value=""><?php echo lang('Select One'); ?></option>
                <?php foreach (array('theoretical', 'practical') as $type_option) { ?>
                    <?php $selected = ($type_option == $course->get_type() ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo $type_option; ?>"<?php echo $selected; ?>><?php echo htmlfilter(lang($type_option)); ?></option>
                <?php } ?>
            </select>
            <?php echo Validator::get_html_error_message('type'); ?>
        </div>

        <!--<div class="form-group">-->
        <!--    <label class="control-label">--><?php //echo lang('Type') ?><!--</label>-->
        <!--    <input name="type" type="text" class="form-control" value="-->
        <?php //echo $course->get_type(); ?><!--"/>-->
        <!--    --><?php //echo Validator::get_html_error_message('type'); ?>
        <!--</div>-->

        <input type="hidden" name="id" value="<?php echo (int)$course->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>
