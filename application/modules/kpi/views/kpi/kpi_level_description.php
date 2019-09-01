<?php
/** @var array $fltr */
/** @var Orm_Kpi_Level_Description $level_obj
 * @var Orm_Kpi $kpi */
/** @var int $type */
/** @var Orm_Kpi_Level_Settings $settings */

$descriptions = Orm_Kpi_Level_Description::get_kpi_descriptions($kpi->get_id());
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('Level Description'); ?><br>
            <?php  ?>
        </div>
        <?php echo form_open("/kpi/manage_level_desc/{$kpi->get_id()}", ["id"=>"kpi-values-form"]) ?>
        <div class="modal-body">
            <table class="table">
                <thead>
                <tr>
                    <th class="col-md-2"><?php echo lang('Level'); ?></th>
                    <th class="col-md-10"><?php echo lang('Description'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 1; $i <= $settings->get_level(); $i++) { ?>
                    <tr>
                        <td><input class="form-control" name="level[<?php echo $i ?>][title]" value="<?php echo isset($descriptions[$i]['title']) ? htmlfilter($descriptions[$i]['title']) : ($settings->get_label() . ' ' . $i); ?>"></td>
                        <td><input class="form-control" name="level[<?php echo $i ?>][description]" value="<?php echo isset($descriptions[$i]['description']) ? htmlfilter($descriptions[$i]['description']) : ''; ?>"></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="">
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
            url: $(this).attr('action'),
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