<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:50 AM
 */
/* @var Orm_Sp_Activity $activity */
/* @var Orm_Sp_Strategy $item */
/** @var Orm_Sp_Project[] $projects */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!$activity->get_id()) {
                echo lang('Create').' '.lang('Activity');
            } else {
                echo lang('Edit').' '.lang('Activity');
            }
            ?>
        </div>
        <?php echo form_open("/strategic_planning/activity/add_edit?strategy_id={$strategy->get_id()}",'id="activity-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="action_plan_project" class="col-sm-2 control-label"><?php echo lang('Project'); ?>:
                        *</label>

                    <div class="col-sm-10">
                        <select class="form-control" id="activity_project" name="project_id">
                            <option value=""><?php echo lang('Select One'); ?></option>
                            <?php foreach ($projects as $project) { ?>
                                <?php $selected = $project->get_id() == $activity->get_project_id() ? 'selected="selected"' : ''; ?>
                                <option
                                    value="<?php echo intval($project->get_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($project->get_title()); ?></option>
                            <?php } ?>
                        </select>
                        <?php echo Validator::get_html_error_message('project_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="action_plan_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_en" class="form-control"
                               value="<?php echo htmlfilter($activity->get_title_en()); ?>" id="action_plan_title"/>
                        <?php echo Validator::get_html_error_message('title_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="action_plan_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_ar" class="form-control"
                               value="<?php echo htmlfilter($activity->get_title_ar()); ?>" id="action_plan_title"/>
                        <?php echo Validator::get_html_error_message('title_ar'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_date" class="col-sm-2 control-label"><?php echo lang('Start Date'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="start_date" class="form-control date-picker" id="start_date"
                               readonly="readonly"
                               value="<?php echo ($activity->get_start_date() != '0000-00-00' ? htmlfilter($activity->get_start_date()) : ''); ?>"/>
                        <?php echo Validator::get_html_error_message('start_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date" class="col-sm-2 control-label"><?php echo lang('End Date'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="end_date" class="form-control date-picker" id="end_date"
                               readonly="readonly"
                               value="<?php echo ($activity->get_end_date() != '0000-00-00' ? htmlfilter($activity->get_end_date()) : ''); ?>"/>
                        <?php echo Validator::get_html_error_message('end_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="weight" class="col-sm-2 control-label"><?php echo lang('Weight'); ?>: *</label>

                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" name="weight" class="form-control numeric-field" id="weight"
                               value="<?php echo htmlfilter($activity->get_weight()); ?>"/>
                            <span class="input-group-addon">1 - 10</span>
                        </div>
                        <?php echo Validator::get_html_error_message('weight'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="value" class="col-sm-2 control-label"><?php echo lang('Actual Performance'); ?></label>

                    <div class="col-sm-2">
                        <div class="input-group">
                            <input type="text" readonly name="value" id="value" class="form-control"
                                   value="<?php echo $activity->get_lead(); ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div
                            class="ui-slider-colors-demo ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all m-t-2"
                            aria-disabled="false" id="slider">
                            <div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min"
                                 style="width: <?php echo $activity->get_lead(); ?>%;"></div>
                            <a class="ui-slider-handle ui-state-default ui-corner-all" href="#"
                               style="left: <?php echo $activity->get_lead(); ?>%;"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($activity->get_id()); ?>">
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
     init_data_toggle();

     var _isRtl = $('html').attr('dir') === 'rtl';
     if (_isRtl) { $('#slider').wrap('<div class="slider-reversed"></div>') }
     
    $('#slider').slider({
        'min': 0,
        'max': 100,
        'step': 5,
        'value': <?php echo $activity->get_lead(); ?>,
        formatter: function(value) {
            $('input#value').val(value);
        },
        reversed: _isRtl
    });

    var options = {
        todayBtn: "linked",
        orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
        format: 'yyyy-mm-dd',
        autoclose: true
    };
    $('.date-picker').datepicker(options);

    $('form#activity-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/activity/save?strategy_id=<?php echo urlencode($strategy->get_id()); ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error === false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>