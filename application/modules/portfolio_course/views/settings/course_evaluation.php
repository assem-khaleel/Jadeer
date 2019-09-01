<?php
if (License::get_instance()->check_module('survey')) {
Modules::load('survey');
$surveys = Orm_Survey::get_all(['type'=>Orm_Survey::TYPE_STUDENTS]);
$selected_survey = Orm_Pc_Settings::get_one(array('entity_key' => Orm_Pc_Settings::ENTITY_COURSE_SURVEY));

?>
<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <?php echo form_open('/portfolio_course/pc_settings/save'); ?>
    <div class="panel panel-primary panel-dark widget-profile">
        <div class="panel-heading">
            <div class="widget-profile-bg-icon"><i class="fa fa-gears"></i></div>
            <div class="widget-profile-header">
                <span><?php echo lang('Surveys'); ?></span>
            </div>
        </div>
        <div class="widget-profile-counters">
            <div class="form-group">
                <label for="jq-validation-select" class="col-sm-3 control-label"><?php echo lang('Select Survey'); ?></label>
                <div class="col-sm-9">
                    <select class="form-control" id="jq-validation-select" name="entity_value">
                        <option value=""><?php echo lang('Not Selected'); ?></option>
                        <?php
                        /* @var $surveys Orm_Survey[] */
                        foreach($surveys as $survey) {
                            $selected = $selected_survey->get_entity_value() == $survey->get_id() ? 'selected="selected"' : '';
                            ?>
                            <option value="<?php echo intval($survey->get_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($survey->get_title()); ?></option>
                        <?php } ?>
                    </select>
                    <?php echo Validator::get_html_error_message('entity_value'); ?>
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
        <input type="hidden" name="entity_key" value="<?php echo Orm_Pc_Settings::ENTITY_COURSE_SURVEY; ?>"/>
    </div>
    <?php echo form_close(); ?>
</div>
<?php } ?>