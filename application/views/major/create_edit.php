<?php
/* @var $major Orm_Major */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">
        <?php echo form_open("/major/save"); ?>
        <div class="form-group">
            <label class="control-label"><?php echo lang('Program'); ?></label>
            <select name="program_id" class="form-control">
                <option value=""><?php echo lang('Select One'); ?></option>
                <?php foreach (Orm_Program::get_all(array('id')) as $program) : ?>
                    <?php $selected = ($program->get_id() == $major->get_program_id() ? ' selected="selected"' : ''); ?>
                    <option
                            value="<?php echo (int)$program->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo Validator::get_html_error_message('program_id'); ?>
        </div>
        <div class="form-group">
            <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>
                )</label>
            <input name="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($major->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_en"> <?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <input name="name_en" type="text" class="form-control"
                   value="<?php echo htmlfilter($major->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$major->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>

