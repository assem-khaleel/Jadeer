<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 6/29/15
 * Time: 12:04 PM
 */
/** @var array $fltr */
/** @var Orm_Kpi $kpi */
/** @var int $type */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('KPI Benchmarks'); ?>
        </div>
        <?php echo form_open('/kpi/save_step_2', 'id="kpi-values-form"') ?>
            <div class="modal-body">
                <div class="table-primary">
                    <div class="table-header">
                        <span class="table-caption"><?php echo lang('External Benchmarks')?></span>
                    </div>
                    <div class="panel-heading-controls col-sm-4">
                        <button type="button" onclick="addExternal(0);" class="btn"><span class="btn-label-icon left"><i class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Add')?></button>
                    </div>
                    <table class="table" id="level-0">
                        <thead>
                            <tr>
                                <th><?php echo lang('Name')?></th>
                                <th><?php echo lang('Value')?>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo htmlfilter($kpi->get_id()); ?>">
                <input type="hidden" name="kpi_type" value="<?php echo htmlfilter($type) ?>">
                <input type="hidden" name="college_id" value="<?php echo htmlfilter(isset($fltr['college_id']) ? $fltr['college_id'] : 0); ?>">
                <input type="hidden" name="program_id" value="<?php echo htmlfilter(isset($fltr['program_id']) ? $fltr['program_id'] : 0); ?>">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save & Next'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();
    $('form#kpi-values-form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: '/kpi/save_values',
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
    function after_delete_action(element, msg)
    {
        if (msg.error == 0)
        {
            element.remove();
        }
    }
    function addExternal(id)
    {
        var table = $('#level-' + id);
        var row = '<tr><td><input class="form-control" name="external_title[]"></td><td><input class="form-control" name="external_value[]"></td></tr>';
        var last_tr = $('#level-' + id + ' > tbody > tr:last');
        if (last_tr.length > 0)
        {
            last_tr.after(row);
        }
        else
        {
            $('#level-' + id + ' > tbody').append(row);
        }
        return false;
    }
</script>