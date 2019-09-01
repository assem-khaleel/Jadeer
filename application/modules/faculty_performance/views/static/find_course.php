<?php 
/** @var Orm_Fp_Static $static */ 
$id = "ids_{$static->get_input()->get_id()}_english";
?>
<div class="form-group">
    <label class="control-label"><?php echo htmlfilter($static->get_input()->get_input_label_en()) ?></label>

    <input id="<?php echo $id ?>_label" type="text" onclick="find_courses(this,'<?php echo $id ?>','<?php echo $id ?>_label')" readonly class="form-control" value="<?php echo htmlfilter(Orm_Course::get_instance($static->get_result()->get_input_value_en())->get_name()) ?>" />
    <input id="<?php echo $id ?>" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][english]" type="hidden" value="<?php echo intval($static->get_result()->get_input_value_en()) ?>"/>
    
    <?php echo Validator::get_html_error_message($id); ?>
    <input type="hidden" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][id]" value="<?php echo intval($static->get_result()->get_id())?>">
</div>


