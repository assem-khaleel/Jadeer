<?php /** @var Orm_Fp_Static $static */ ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group" dir="ltr">
            <label><?php echo htmlfilter($static->get_input()->get_input_label_en()) ?></label>
            <textarea class="form-control" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][english]"><?php echo htmlfilter($static->get_result()->get_input_value_en()) ?></textarea>
            <?php echo Validator::get_html_error_message("ids_{$static->get_input()->get_id()}_english"); ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group" dir="rtl">
            <label><?php echo htmlfilter($static->get_input()->get_input_label_ar()) ?></label>
            <textarea class="form-control" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][arabic]"><?php echo htmlfilter($static->get_result()->get_input_value_ar()) ?></textarea>
            <?php echo Validator::get_html_error_message("ids_{$static->get_input()->get_id()}_arabic"); ?>
        </div>
    </div>
    <input type="hidden" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][id]" value="<?php echo intval($static->get_result()->get_id())?>">
</div>