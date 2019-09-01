<?php /** @var Orm_Fp_Static $static */ ?>
<div class="form-group">
    <label><?php echo htmlfilter($static->get_input()->get_input_label_en()) ?></label>
    <input type="text" class="form-control date" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][english]" value="<?php echo htmlfilter($static->get_result()->get_input_value_en()) ?>" />
    
    <?php echo Validator::get_html_error_message("ids_{$static->get_input()->get_id()}_english"); ?>
    <input type="hidden" name="ids[<?php echo intval($static->get_input()->get_id()) ?>][id]" value="<?php echo intval($static->get_result()->get_id()) ?>">

    <script>
        $(document).ready(function () {
            $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
        });
    </script>
</div> 

