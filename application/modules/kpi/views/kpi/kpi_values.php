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
            <?php echo lang('KPI Benchmarks'); ?><br>
            <?php echo htmlfilter($kpi->get_title()); ?>
        </div>
        <?php echo form_open('/kpi/save_values', 'id="kpi-values-form"') ?>
            <div class="modal-body">
                <?php echo $kpi->draw_html($type, $fltr); ?>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo htmlfilter($kpi->get_id()); ?>">
                <input type="hidden" name="kpi_type" value="<?php echo htmlfilter($type) ?>">
                <input type="hidden" name="college_id" value="<?php echo htmlfilter(isset($fltr['college_id']) ? $fltr['college_id'] : 0); ?>">
                <input type="hidden" name="program_id" value="<?php echo htmlfilter(isset($fltr['program_id']) ? $fltr['program_id'] : 0); ?>">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>> <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
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
    function removeExternal(elem)
    {
        $(elem).parents('tr').remove();
    }
</script>