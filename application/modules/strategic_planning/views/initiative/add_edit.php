<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:50 AM
 */
/* @var $initiative Orm_Sp_Initiative */
/* @var $strategy Orm_Sp_Strategy */
/* @var $item Orm_Sp_Strategy */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($initiative->get_id())) {
                echo lang('Create').' '.lang('Initiative');
            } else {
                echo lang('Edit').' '.lang('Initiative');
            }
            ?>
        </div>
        <?php echo form_open("/strategic_planning/initiative/add_edit?strategy_id={$strategy->get_id()}",'id="initiative-form" class="form-horizontal"') ?>
            <div class="modal-body">
                
                <div class="form-group">
                    <label for="objective_id" class="col-sm-2 control-label"><?php echo lang('Objective'); ?>: *</label>

                    <div class="col-sm-10">
                        <select name="objective_id" id="objective_id" class="form-control">
                            <option value=""><?php echo lang('Select One'); ?></option>
                            <?php foreach (Orm_Sp_Objective::get_all(array('strategy_id' => $strategy->get_id())) as $key => $objective) : ?>
                                <?php $selected = ($objective->get_id() == $initiative->get_objective_id() ? 'selected="selected"' : '') ?>
                                <option
                                    value="<?php echo (int)$objective->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($objective->get_title()); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo Validator::get_html_error_message('objective_id'); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="initiative_code" class="col-sm-2 control-label"><?php echo lang('Code'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="initiative_code" class="form-control"
                               value="<?php echo htmlfilter($initiative->get_code()); ?>" id="initiative_code"/>
                        <?php echo Validator::get_html_error_message('initiative_code'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="initiative_title_en" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_en" class="form-control"
                               value="<?php echo htmlfilter($initiative->get_title_en()); ?>"
                               id="initiative_title_en"/>
                        <?php echo Validator::get_html_error_message('title_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="initiative_title_ar" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_ar" class="form-control"
                               value="<?php echo htmlfilter($initiative->get_title_ar()); ?>"
                               id="initiative_title_ar"/>
                        <?php echo Validator::get_html_error_message('title_ar'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="responsible" class="col-sm-2 control-label"><?php echo lang('Responsible'); ?></label>

                    <div class="col-sm-10">
                        <select class="form-control" id="responsible" name="owner_id">
                            <option value="0"><?php echo '-'; ?></option>
                            <?php foreach (Orm_Unit::get_all() as $unit) { ?>
                                <?php $selected = ($unit->get_id() == $initiative->get_owner_id() ? 'selected="selected"' : ''); ?>
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
                               value="<?php echo $initiative->get_start_date() != '0000-00-00' ? htmlfilter($initiative->get_start_date()) : ''; ?>"/>
                        <?php echo Validator::get_html_error_message('start_date'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date" class="col-sm-2 control-label"><?php echo lang('End Date'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="text" name="end_date" class="form-control date-picker" id="end_date"
                               readonly="readonly"
                               value="<?php echo $initiative->get_end_date() != '0000-00-00' ? htmlfilter($initiative->get_end_date()) : ''; ?>"/>
                        <?php echo Validator::get_html_error_message('end_date'); ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($initiative->get_id()); ?>">
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

    $('form#initiative-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/initiative/save?strategy_id=<?php echo urlencode($strategy->get_id()); ?>',
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