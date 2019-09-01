<?php
/** @var $level_obj Orm_Kpi_Level_Settings */

?>

<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <?php echo form_open("/kpi/manage_level_settings/"); ?>
    <div class="panel panel-primary panel-dark widget-profile">
        <div class="panel-heading">
            <div class="widget-profile-bg-icon"><i class="fa fa-gears"></i></div>
            <div class="widget-profile-header">
                <span><?php echo lang('KPI Achievements Level'); ?></span>
            </div>
        </div>
        <div class="panel-body">
            <div class="row form-group">
                <label for="label-en" class="col-sm-3 control-label">
                    <?php echo lang('Level Label'); ?> (<?php echo lang('English'); ?>)
                </label>
                <div class="col-sm-9">
                    <input type="text" name="label_en" id="label-en" class="form-control"
                           placeholder="<?php echo lang('Level Label'); ?> (<?php echo lang('English'); ?>)"
                           value="<?php echo $level_obj->get_label_en(); ?>"/>
                    <?php echo Validator::get_html_error_message('label_en'); ?>
                </div>
            </div>
            <div class="row form-group">
                <label for="label-ar" class="col-sm-3 control-label">
                    <?php echo lang('Level Label'); ?> (<?php echo lang('Arabic'); ?>)
                </label>
                <div class="col-sm-9">
                    <input type="text" name="label_ar" id="label-ar" class="form-control"
                           placeholder="<?php echo lang('Level Label'); ?> (<?php echo lang('Arabic'); ?>)"
                           value="<?php echo $level_obj->get_label_ar(); ?>"/>
                    <?php echo Validator::get_html_error_message('label_ar'); ?>
                </div>
            </div>
            <div class="row form-group">
                <label for="label-number" class="col-sm-3 control-label">
                    <?php echo lang('Number of Levels'); ?>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="level" id="label-number" class="form-control"
                           placeholder="<?php echo lang('Number of Levels'); ?>"
                           value="<?php echo $level_obj->get_level(); ?>"/>
                    <small class="text-muted"><?php echo lang('Warning, Changing this number will affect the saved levels in each KPI') ?></small>
                    <?php echo Validator::get_html_error_message('level'); ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="widget-profile-counters">
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn pull-right"
                        <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>