<?php
/* @var $user Orm_User_Alumni */
?>
<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
    <div class="col-sm-9">
        <select id="college_block" name="college_id" class="form-control" onchange="get_departments_by_college(this, 0, 1);">
            <option value=""><?php echo lang('All College') ?></option>
            <?php
            foreach (Orm_College::get_all() as $college) {
                $selected = ($college->get_id() == $user->get_college_id() ? 'selected="selected"' : '');
                ?>
                <option value="<?php echo (int)$college->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($college->get_name()) ?></option>
                <?php
            }
            ?>
        </select>
        <?php echo Validator::get_html_error_message('college_id'); ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Department') ?></label>
    <div class="col-sm-9">
        <select id="department_block" name="department_id" class="form-control" onchange="get_programs_by_department(this, 0, 1);">
            <option value=""><?php echo lang('All Department') ?></option>
            <?php
            if (!empty($user->get_college_id())) {
                foreach (Orm_Department::get_all(array('college_id' => $user->get_college_id())) as $department) {
                    $selected = ($department->get_id() == $user->get_department_id() ? 'selected="selected"' : '');
                    ?>
                    <option value="<?php echo (int)$department->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($department->get_name()) ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <?php echo Validator::get_html_error_message('department_id'); ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Program') ?></label>
    <div class="col-sm-9">
        <select id="program_block" name="program_id" class="form-control">
            <option value=""><?php echo lang('All Program') ?></option>
            <?php
            if (!empty($user->get_department_id())) {
                foreach (Orm_Program::get_all(array('department_id' => $user->get_department_id())) as $program) {
                    $selected = ($program->get_id() == $user->get_program_id() ? 'selected="selected"' : '');
                    ?>
                    <option value="<?php echo (int)$program->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($program->get_name()) ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <?php echo Validator::get_html_error_message('program_id'); ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Graduated') ?></label>
    <div class="col-sm-9">
        <select class="form-control" name="graduated">
            <option value=""><?php echo lang('Not Specified') ?></option>
            <?php for ($i = date("Y"); $i >= 2001; $i--) { ?>
                <?php $selected = $user->get_graduated() == $i ? 'selected="selected"' : ''; ?>
                <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo ($i - 1) . ' / ' . ($i); ?> -
                    (<?php echo ($i - 579 - 1) . ' / ' . ($i - 579); ?>)
                </option>
            <?php } ?>
        </select>
        <?php echo Validator::get_html_error_message('graduated'); ?>
    </div>
</div>