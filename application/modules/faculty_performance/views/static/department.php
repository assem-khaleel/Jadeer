<?php
/** @var Orm_Fp_Static $static */
$college_id = Orm_Department::get_instance($static->get_result()->get_input_value_en())->get_college_id() ?: $this->input->get_post("college_id_{$static->get_input()->get_id()}");
$department_id = $static->get_result()->get_input_value_en();
?>

<div class="form-group">
    <label><?php echo lang('College') ?></label>
    <select id="college_block" name="college_id_<?php echo intval($static->get_input()->get_id()) ?>" class="form-control" onchange="get_departments_by_college(this, 1, 1);">
        <option value=""><?php echo lang('All College') ?></option>
        <?php
        foreach (Orm_College::get_all() as $college) {
            $selected = ($college->get_id() == $college_id ? 'selected="selected"' : '');
            ?>
            <option value="<?php echo (int)$college->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($college->get_name()) ?></option>
            <?php
        }
        ?>
    </select>
    <?php echo Validator::get_html_error_message("ids_{$static->get_input()->get_id()}_college"); ?>
</div>

<div class="form-group">
    <label><?php echo lang('Department') ?></label>
    <select id="department_block" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][english]" class="form-control">
        <option value=""><?php echo lang('All Department') ?></option>
        <?php
        if (!empty($college_id)) {
            foreach (Orm_Department::get_all(array('college_id' => $college_id)) as $department) {
                $selected = ($department->get_id() == $department_id ? 'selected="selected"' : '');
                ?>
                <option value="<?php echo (int)$department->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($department->get_name()) ?></option>
                <?php
            }
        }
        ?>
    </select>
    <?php echo Validator::get_html_error_message("ids_{$static->get_input()->get_id()}_department"); ?>
    <input type="hidden" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][id]" value="<?php echo intval($static->get_result()->get_id())?>">
</div>