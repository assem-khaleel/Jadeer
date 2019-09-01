<?php
/* @var Orm_As_Agency $agency */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">
        <?php echo form_open("/accreditation/status_settings/agency_save", array('class' => 'form-horizontal')); ?>

        <div class="form-group">
            <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>
                )</label>
            <input name="name_ar" id="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($agency->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_en"> <?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <input name="name_en" type="text" id="name_en" class="form-control"
                   value="<?php echo htmlfilter($agency->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <div class="form-group">
            <label for="component" class="control-label"><?php echo lang('Accredited Years'); ?></label>
            <input name="accredited_years" type="number" class="form-control" value="<?php echo (int)$agency->get_accredited_years(); ?>"/>
            <?php echo Validator::get_html_error_message('accredited_years'); ?>
        </div>
        <?php $before = explode(' ', $agency->get_notify_before()); ?>
        <div class="form-group">
            <div class="col-md-12">
                <label class="control-label" for="unit_id"> <?php echo lang('Notification Before'); ?></label>

            </div>
            <div class="p-l-0 col-md-8 col-lg-9">
                <input name="before" type="number" class="form-control" value="<?php echo isset($before[0]) && !empty($before[0]) ? (int)$before[0] : ''; ?>"/>
                <?php echo Validator::get_html_error_message('before'); ?>
            </div>
            <div class="col-md-4 col-lg-3">
                <?php foreach (array('months', 'years') as $kind) { ?>
                    <?php $checked = isset($before[1]) && !empty($before[1]) && $before[1] == $kind ? ' checked="checked"' : ''; ?>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" class="px" value="<?php echo $kind; ?>"<?php echo $checked; ?> id="radio-<?php echo $kind; ?>" name="kind">
                            <span class="lbl"><?php echo lang($kind); ?></span>
                        </label>
                    </div>
                <?php } ?>
                <?php echo Validator::get_html_error_message('kind'); ?>
            </div>

        </div>




        <input type="hidden" name="id" value="<?php echo (int)$agency->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>

    </div>
</div>

<?php echo '</div>'; ?>
