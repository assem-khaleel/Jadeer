<?php
/* @var $plan Orm_Program_Plan */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">
        <?php echo form_open("/program_plan/save?program_id={$program->get_id()}", array('id' => 'program-plan-form')); ?>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Course') ?></label>
            <input id="course_label" type="text" onclick="find_courses(this,'course_id','course_label')" readonly
                   class="form-control" value="<?php echo htmlfilter($plan->get_course_obj()->get_name()); ?>"/>
            <input id="course_id" name="course_id" type="hidden" value="<?php echo (int)$plan->get_course_id() ?>"/>
            <?php echo Validator::get_html_error_message('course_id'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Level') ?></label>
            <select name="level" id="level" class="form-control">
                <option value=""><?php echo lang('Select Level'); ?></option>
                <?php for ($i = 1; $i <= 12; $i++) { ?>
                    <option value="<?php echo $i ?>" <?php echo($plan->get_level() == $i ? 'selected="selected"' : '') ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
            <?php echo Validator::get_html_error_message('level'); ?>
        </div>
        <div class="form-group">
            <label class="control-label" for="credit_hours"><?php echo lang('Credit Hours') ?></label>
            <input id="credit_hours" type="text" name="credit_hours" class="form-control" value="<?php echo htmlfilter($plan->get_credit_hours()) ?>" >
            <?php echo Validator::get_html_error_message('credit_hours'); ?>
        </div>

        <div class="form-group">
            <input name="is_required"
                   type="radio" <?php echo $plan->get_is_required() ? 'checked="checked"' : '' ?> value="1"/>
            <label class="control-label" for="is_required"> <?php echo lang('Required'); ?></label>

            <input name="is_required"
                   type="radio" <?php echo !$plan->get_is_required() ? 'checked="checked"' : '' ?> value="0"/>
            <label class="control-label" for="is_required"> <?php echo lang('Elective'); ?></label>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$plan->get_id(); ?>">

        <button type="submit" class="btn" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-floppy-o" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $('#program-plan-form').submit(function(e){
        e.preventDefault();
        var $that = $(this);
        $.get('/welcome/refresh_token', function(data) {

            $('input[name=csrf_test_name').val(data);
            $that.unbind().submit();
        });
        return false;
    });
</script>