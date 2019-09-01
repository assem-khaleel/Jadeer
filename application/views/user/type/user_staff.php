<?php
/* @var $user Orm_User_Staff */
?>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Role') ?></label>
    <div class="col-sm-9">
        <select id="role_id" name="role_id" class="form-control">
            <option value=""><?php echo lang('All Role') ?></option>
            <?php
            foreach (Orm_Role::get_all() as $role) {
                $selected = ($role->get_id() == $user->get_role_id() ? 'selected="selected"' : '');
                ?>
                <option value="<?php echo (int)$role->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($role->get_name()) ?></option>
                <?php
            }
            ?>
        </select>
        <?php echo Validator::get_html_error_message('role'); ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Unit') ?></label>
    <div class="col-sm-9">
        <select id="role_id" name="unit_id" class="form-control">
            <option value="0"><?php echo lang('All Unit') ?></option>
            <?php
            foreach (Orm_Unit::get_all() as $unit) {
                $selected = ($unit->get_id() == $user->get_unit_id() ? 'selected="selected"' : '');
                ?>
                <option value="<?php echo (int)$unit->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($unit->get_name()) ?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label" for="campus_id"><?php echo lang('Campus') ?></label>
    <div class="col-sm-9">
        <select id="campus_id" name="campus_id" class="form-control" onchange="get_colleges_by_campus(this, 0, 1);">
            <option value="0"><?php echo lang('All Campuses') ?></option>
            <?php
            foreach (Orm_Campus::get_all() as $campus) {
                $selected = ($campus->get_id() == $user->get_campus_id() ? 'selected="selected"' : '');
                ?>
                <option value="<?php echo $campus->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($campus->get_name()) ?></option>
                <?php
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
    <div class="col-sm-9">
        <select id="college_block" name="college_id" class="form-control" onchange="get_departments_by_college(this, 0, 1);">
            <option value="0"><?php echo lang('All College') ?></option>
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
        <select id="department_block" name="department_id" class="form-control" onchange="get_programs_by_department(this, 0,1);">
            <option value="0"><?php echo lang('All Department') ?></option>
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
            <option value="0"><?php echo lang('All Program') ?></option>
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
    <label class="col-sm-3 control-label"><?php echo lang('Service Time') ?></label>
    <div class="col-sm-9">
        <input type="text" class="form-control" name="service_time"
               value="<?php echo htmlfilter($user->get_service_time()); ?>"/>
        <?php echo Validator::get_html_error_message('service_time'); ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Job Position') ?></label>
    <div class="col-sm-9">
        <select name="job_position" class="form-control">
            <?php
            foreach (Orm_User_Staff::$job_positions as $key => $job_position) {
                $selected = ($key == $user->get_job_position() ? 'selected="selected"' : '');
                ?>
                <option value="<?php echo htmlfilter($key) ?>" <?php echo $selected ?>><?php echo htmlfilter(lang($job_position)) ?></option>
                <?php
            }
            ?>
        </select>
        <?php echo Validator::get_html_error_message('job_position'); ?>
    </div>
</div>

