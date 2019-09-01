<?php
/* @var Orm_Sp_Project $project */
/** @var Orm_Sp_Action_Plan[] $action_plans */
/** @var Orm_Sp_Strategy $strategy */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($project->get_id())) {
                echo lang('Create').' '.lang('Project');
            } else {
                echo lang('Edit').' '.lang('Project');
            }
            ?>
        </div>

        <?php echo form_open("/strategic_planning/project/add_edit?strategy_id={$strategy->get_id()}",'id="project-form" class="form-horizontal"') ?>
            <div class="modal-body">

                <?php if($strategy->get_parent_id()) { ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="parent_id"><?php echo lang('Parent Project'); ?></label>

                        <div class="col-sm-10">
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value=""><?php echo lang('Select One'); ?></option>
                                <?php foreach (Orm_Sp_Project::get_all(array('strategy_id' => $strategy->get_parent_id())) as $key => $parent_project) : ?>
                                    <?php $selected = ($parent_project->get_id() == $project->get_parent_id() ? 'selected="selected"' : '') ?>
                                    <option
                                        value="<?php echo (int)$parent_project->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($parent_project->get_title()); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo Validator::get_html_error_message('parent_id'); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label for="action_plan_id"
                           class="col-sm-2 control-label"><?php echo lang('Action Plan'); ?>: *</label>

                    <div class="col-sm-10">
                        <select name="action_plan_id" class="form-control" id="action_plan_id">
                            <option value=""><?php echo lang('Select One'); ?></option>
                            <?php foreach ($action_plans as $action_plan) { ?>
                                <?php $selected = ($action_plan->get_id() == $project->get_action_plan_id() ? 'selected="selected"' : '') ?>
                                <option
                                    value="<?php echo (int)$action_plan->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($action_plan->get_title()); ?></option>
                            <?php } ?>
                        </select>
                        <?php echo Validator::get_html_error_message('action_plan_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_title_en" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="en_title" class="form-control"
                               value="<?php echo htmlfilter($project->get_title_en()); ?>" id="project_title_en"/>
                        <?php echo Validator::get_html_error_message('en_title'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project_title_ar" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="ar_title" class="form-control"
                               value="<?php echo htmlfilter($project->get_title_ar()); ?>" id="project_title_ar"/>
                        <?php echo Validator::get_html_error_message('ar_title'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_date" class="col-sm-2 control-label"><?php echo lang('Start Date'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="start_date" class="form-control date-picker" id="start_date"
                               readonly="readonly"
                               value="<?php echo $project->get_start_date() != '0000-00-00' ? htmlfilter($project->get_start_date()) : ''; ?>"/>
                        <?php echo Validator::get_html_error_message('start_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date" class="col-sm-2 control-label"><?php echo lang('End Date'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="end_date" class="form-control date-picker" id="end_date"
                               readonly="readonly"
                               value="<?php echo $project->get_end_date() != '0000-00-00' ? htmlfilter($project->get_end_date()) : ''; ?>"/>
                        <?php echo Validator::get_html_error_message('end_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="budget" class="col-sm-2 control-label"><?php echo lang('Budget'); ?>:</label>

                    <div class="col-sm-10">
                        <input type="text" name="budget" class="form-control"
                               value="<?php echo htmlfilter($project->get_budget()); ?>" id="budget"/>
                        <?php echo Validator::get_html_error_message('budget'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="resources" class="col-sm-2 control-label"><?php echo lang('Resources'); ?>:</label>

                    <div class="col-sm-10">
                        <textarea name="resources" class="form-control"
                                  id="resources"><?php echo htmlfilter($project->get_resources()); ?></textarea>
                        <?php echo Validator::get_html_error_message('resources'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc_en" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                        (<?php echo lang('English'); ?>): </label>

                    <div class="col-sm-10">
                        <textarea name="desc_en" class="form-control"
                                  id="desc_en"><?php echo htmlfilter($project->get_desc_en()); ?></textarea>
                        <?php echo Validator::get_html_error_message('desc_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc_ar" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                        (<?php echo lang('Arabic'); ?>): </label>

                    <div class="col-sm-10">
                        <textarea name="desc_ar" class="form-control"
                                  id="desc_ar"><?php echo htmlfilter($project->get_desc_ar()); ?></textarea>
                        <?php echo Validator::get_html_error_message('desc_ar'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($project->get_id()); ?>">
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
     init_data_toggle();
    var options = {
        todayBtn: "linked",
        orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
        format: 'yyyy-mm-dd',
        autoclose: true
    };
    $('.date-picker').datepicker(options);

    $('form#project-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/project/save?strategy_id=<?php echo urlencode($strategy->get_id()); ?>',
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