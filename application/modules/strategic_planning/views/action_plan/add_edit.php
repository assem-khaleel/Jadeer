<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:50 AM
 */
/* @var Orm_Sp_Action_Plan $action_plan */
/* @var Orm_Sp_Strategy $strategy */
/** @var array $recommendations */
/** @var array $type_ids */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($action_plan->get_id())) {
                echo lang('Create').' '.lang('Action Plan');
            } else {
                echo lang('Edit').' '.lang('Action Plan');
            }
            ?>
        </div>
        <?php echo form_open("/strategic_planning/action_plan/add_edit?strategy_id={$strategy->get_id()}",'id="action_plan-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="initiative" class="col-sm-2 control-label"><?php echo lang('Initiative'); ?>: *</label>

                    <div class="col-sm-10">
                        <select name="initiative_id" class="form-control" id="initiative">
                            <option value=""><?php echo lang('Select One'); ?></option>
                            <?php foreach (Orm_Sp_Initiative::get_all(array('strategy_id' => $strategy->get_id())) as $key => $initiative) : ?>
                                <?php $selected = ($initiative->get_id() == $action_plan->get_initiative_id() ? 'selected="selected"' : '') ?>
                                <option
                                    value="<?php echo (int)$initiative->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($initiative->get_title()); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo Validator::get_html_error_message('initiative_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="action_plan_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_en" class="form-control"
                               value="<?php echo htmlfilter($action_plan->get_title_en()); ?>" id="action_plan_title"/>
                        <?php echo Validator::get_html_error_message('title_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="action_plan_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_ar" class="form-control"
                               value="<?php echo htmlfilter($action_plan->get_title_ar()); ?>" id="action_plan_title"/>
                        <?php echo Validator::get_html_error_message('title_ar'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="start_date" class="col-sm-2 control-label"><?php echo lang('Start Date'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="start_date" class="form-control date-picker" id="start_date"
                               readonly="readonly"
                               value="<?php echo $action_plan->get_start_date() != '0000-00-00' ? htmlfilter($action_plan->get_start_date()) : ''; ?>"/>
                        <?php echo Validator::get_html_error_message('start_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date" class="col-sm-2 control-label"><?php echo lang('End Date'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="end_date" class="form-control date-picker" id="end_date"
                               readonly="readonly"
                               value="<?php echo $action_plan->get_end_date() != '0000-00-00'  ? htmlfilter($action_plan->get_end_date()) : ''; ?>"/>
                        <?php echo Validator::get_html_error_message('end_date'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="responsible" class="col-sm-2 control-label"><?php echo lang('Responsible'); ?></label>

                    <div class="col-sm-10">
                        <select class="form-control" id="responsible" name="responsible_id">
                            <option value="0"><?php echo '-'; ?></option>
                            <?php foreach (Orm_Unit::get_all() as $unit) { ?>
                                <?php $selected = ($unit->get_id() == $action_plan->get_responsible_id() ? 'selected="selected"' : ''); ?>
                                <option
                                    value="<?php echo (int)$unit->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($unit->get_name()); ?></option>
                            <?php } ?>
                        </select>
                        <?php echo Validator::get_html_error_message('responsible_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="action_plan_budget" class="col-sm-2 control-label"><?php echo lang('Budget'); ?></label>

                    <div class="col-sm-10">
                        <input type="text" name="budget" class="form-control"
                               value="<?php echo floatval($action_plan->get_budget()); ?>" id="action_plan_budget"/>
                        <?php echo Validator::get_html_error_message('budget'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="select-multiple" class="col-sm-2 control-label"><?php echo lang('Recommendation'); ?><br><small><?php echo lang('If Any'); ?></small></label>

                    <div class="col-sm-10">
                        <select multiple="multiple" id="select-multiple" name="type_ids[]" class="form-control">
                            <?php /** @var Orm_Sp_Recommendation_Type[] $type */
                            /** @var Orm_Sp_Recommendation $recommend */ ?>
                            <?php foreach ($recommendations as $type) : ?>
                                <optgroup label="<?php echo $type[0]->get_title(); ?>">
                                    <?php foreach ($type['data'] as $recommend) : ?>
                                        <?php $selected = (in_array($recommend->get_id(), $type_ids) ? ' selected="selected"' : ''); ?>
                                        <option value="<?php echo $recommend->get_id() ?>" <?php echo $selected; ?>><?php echo htmlfilter($recommend->get_title()); ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($action_plan->get_id()); ?>">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                    <i class="fa fa-times btn-label-icon left"></i><?php echo lang('Close'); ?>
                </button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                    <i class="fa fa-floppy-o btn-label-icon left"></i><?php echo lang('Save'); ?>
                </button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();

    $("#select-multiple").select2({
        placeholder: "<?php echo lang("Select the Recommendations"); ?>"
    });
    var options = {
        todayBtn: "linked",
        orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
        format: 'yyyy-mm-dd',
        autoclose: true
    };
    $('.date-picker').datepicker(options);

    $('form#action_plan-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/action_plan/save?strategy_id=<?php echo urlencode($strategy->get_id()); ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error == false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>

<style>
    .select2-dropdown {
        z-index: 9001;
    }
</style>