<?php /** @var Orm_Fp_Static $static */ ?>
<div class="form-group" >
    <label><?php echo htmlfilter($static->get_input()->get_input_label_en()) ?></label>
    <select class="form-control" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][english]" >
        <option value=""><?php echo lang('Select One'); ?></option>
        <?php foreach (Orm_Semester::get_all() as $semester) { ?>
            <?php $selected = $semester->get_id() == $static->get_result()->get_input_value_en() ? 'selected="selected"' : '' ?>
            <option value="<?php echo intval($semester->get_id()); ?>" <?php echo $selected ?>><?php echo htmlfilter($semester->get_name()); ?></option>
        <?php } ?>
    </select>
    <?php echo Validator::get_html_error_message("ids_{$static->get_input()->get_id()}_english"); ?>
    <input type="hidden" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][id]" value="<?php echo intval($static->get_result()->get_id())?>">
</div>