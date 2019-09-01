<?php
/* @var $objective Orm_Sp_Objective */
/* @var $strategy Orm_Sp_Strategy */
/* @var $perspective string */
?>
<style>
    .select2-container {
        z-index: 1000000;
    }
</style>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($objective->get_id())) {
                echo lang('Create').' '.lang('Objective');
            } else {
                echo lang('Edit').' '.lang('Objective');
            }
            ?>
        </div>
        <?php echo form_open("/strategic_planning/objective/save?strategy_id={$strategy->get_id()}", array("id"=>"objective-form", "class"=>"form-horizontal")) ?>
            <div class="modal-body">
                <?php if($strategy->get_parent_id()) { ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="parent_id"><?php echo lang('Parent Objective'); ?>:</label>

                        <div class="col-sm-10">
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value=""><?php echo lang('Select One'); ?></option>
                                <?php foreach (Orm_Sp_Objective::get_all(array('strategy_id' => $strategy->get_parent_id())) as $key => $obj) : ?>
                                    <?php $selected = ($obj->get_id() == $objective->get_parent_id() ? 'selected="selected"' : '') ?>
                                    <option
                                        value="<?php echo (int)$obj->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($obj->get_title()); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo Validator::get_html_error_message('parent_id'); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="goal_id"><?php echo lang('Goal'); ?>:</label>

                    <div class="col-sm-10">
                        <select name="goal_id" id="goal_id" class="form-control">
                            <option value=""><?php echo lang('Select One'); ?></option>
                            <?php foreach (Orm_Sp_Goal::get_all(array('strategy_id' => $strategy->get_id())) as $key => $goal) : ?>
                                <?php $selected = ($goal->get_id() == $objective->get_goal_id() ? 'selected="selected"' : '') ?>
                                <option
                                    value="<?php echo (int)$goal->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($goal->get_title()); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo Validator::get_html_error_message('goal_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="obj_code" class="col-sm-2 control-label"><?php echo lang('Code'); ?>: *</label>

                    <div class="col-sm-10">
                        <input name="obj_code" id="obj_code" class="form-control"
                               value="<?php echo $objective->get_code(); ?>">
                        <?php echo Validator::get_html_error_message('obj_code'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="objective_title" class="col-sm-2 control-label"><?php echo lang('Objective Title'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_en" class="form-control"
                               value="<?php echo htmlfilter($objective->get_title_en()); ?>"
                               id="objective_title"/>
                        <?php echo Validator::get_html_error_message('title_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="objective_title" class="col-sm-2 control-label"><?php echo lang('Objective Title'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_ar" class="form-control"
                               value="<?php echo htmlfilter($objective->get_title_ar()); ?>" id="objective_title"/>
                        <?php echo Validator::get_html_error_message('title_ar'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="objective_title" class="col-sm-2 control-label"><?php echo lang('Perspectives'); ?> *</label>
                    <?php $objective_perspectives = array_column(Orm_Sp_Objective_Perspective::get_model()->get_all(array('objective_id' => $objective->get_id()),0 , 0, array(), Orm::FETCH_ARRAY), 'perspective'); ?>
                    <div class="col-sm-10">

                        <select id="perspectives" name="perspectives[]" multiple="multiple" class="form-control" data-placeholder="<?php echo lang('Select').'...' ?>">
<!--                            <option value="">--><?php //echo lang('Select Perspective') ?><!--</option>-->
                            <?php
                            foreach (Orm_Sp_Perspective::get_all() as $perspective) {
                                $selected = in_array($perspective->get_id(), $objective_perspectives) ? 'selected="selected"' : '';
                                ?>
                                <option value="<?php echo (int) $perspective->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($perspective->get_name()) ?></option>
                                <?php
                            }
                            ?>
                        </select>

                        <?php echo Validator::get_html_error_message('perspectives'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="responsible" class="col-sm-2 control-label"><?php echo lang('Responsible'); ?></label>

                    <div class="col-sm-10">
                        <select class="form-control" id="responsible" name="owner_id">
                            <option value="0"><?php echo '-'; ?></option>
                            <?php foreach (Orm_Unit::get_all() as $unit) { ?>
                                <?php $selected = ($unit->get_id() == $objective->get_owner_id() ? 'selected="selected"' : ''); ?>
                                <option
                                    value="<?php echo (int)$unit->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($unit->get_name()); ?></option>
                            <?php } ?>
                        </select>
                        <?php echo Validator::get_html_error_message('owner_id'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_date" class="col-sm-2 control-label"><?php echo lang('Start Date'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="start_date" class="form-control date-picker" id="start_date"
                               readonly="readonly"
                               value="<?php echo $objective->get_start_date() != '0000-00-00' ? htmlfilter($objective->get_start_date()) : ''; ?>"/>
                        <?php echo Validator::get_html_error_message('start_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date" class="col-sm-2 control-label"><?php echo lang('End Date'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="end_date" class="form-control date-picker" id="end_date"
                               readonly="readonly"
                               value="<?php echo $objective->get_end_date() != '0000-00-00'  ? htmlfilter($objective->get_end_date()) : ''; ?>"/>
                        <?php echo Validator::get_html_error_message('end_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="objective_budget" class="col-sm-2 control-label"><?php echo lang('Budget'); ?>:</label>

                    <div class="col-sm-10">
                        <input type="text" name="budget" class="form-control" id="objective_budget" value="<?php echo floatval($objective->get_budget()); ?>"/>
                        <?php echo Validator::get_html_error_message('budget'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="en_description"><?php echo lang('Description'); ?>
                        (<?php echo lang('English'); ?>):</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="en_description"
                                  name="description_en"><?php echo htmlfilter($objective->get_description_en()); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="ar_description"><?php echo lang('Description'); ?>
                        (<?php echo lang('Arabic'); ?>):</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="ar_description"
                                  name="description_ar"><?php echo htmlfilter($objective->get_description_ar()); ?></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($objective->get_id()); ?>">
                <button type="button" class="btn btn-sm pull-left" data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();

    var options = {
        todayBtn: "linked",
        orientation: $('body').hasClass('right-to-left') ? 'auto right' : 'auto auto',
        format: 'yyyy-mm-dd',
        autoclose: true
    };
    $('.date-picker').datepicker(options);

    $('form#objective-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
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

    $('#perspectives').select2();
</script>