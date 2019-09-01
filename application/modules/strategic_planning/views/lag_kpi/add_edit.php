<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:50 AM
 */
/* @var $lag_kpi Orm_Sp_Lag_Kpi */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($lag_kpi->get_id())) {
                echo lang('Create').' '.lang('Lag Kpi');
            } else {
                echo lang('Edit').' '.lang('Lag Kpi');
            }
            ?>
        </div>
        <?php echo form_open("",'id="lag_kpi-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo lang('Objective'); ?></label>

                    <div class="col-sm-10">
                        <select name="objective_id" class="form-control">
                            <option value=""><?php echo lang('Select One'); ?></option>
                            <?php foreach (Orm_Sp_Objective::get_all() as $key => $objective) : ?>
                                <?php $selected = ($objective->get_id() == $lag_kpi->get_objective_id() ? 'checked="checked"' : '') ?>
                                <option
                                    value="<?php echo (int)$objective->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($objective->get_title()); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo Validator::get_html_error_message('objective_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo lang('Initiative'); ?></label>

                    <div class="col-sm-10">
                        <select name="initiative_id" class="form-control">
                            <option value=""><?php echo lang('Select One'); ?></option>
                            <?php foreach (Orm_Sp_Initiative::get_all() as $key => $initiative) : ?>
                                <?php $selected = ($initiative->get_id() == $lag_kpi->get_initiative_id() ? 'checked="checked"' : '') ?>
                                <option
                                    value="<?php echo (int)$initiative->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($initiative->get_title()); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo Validator::get_html_error_message('initiative_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="kpi_input" class="col-sm-2 control-label"><?php echo lang('KPI'); ?>:</label>

                    <div class="col-sm-10">
                        <input type="text" name="kpi_id" class="form-control"
                               value="<?php echo htmlfilter($lag_kpi->get_kpi_id()); ?>" id="kpi_input"/>
                        <?php echo Validator::get_html_error_message('kpi_id'); ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($lag_kpi->get_id()); ?>">
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
     init_data_toggle();
    $('form#lag_kpi-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/lag_kpi/save',
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