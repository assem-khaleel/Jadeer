<?php
/**
 * Created by PhpStorm.
 * User: basel
 * Date: 13/10/15
 * Time: 10:39 PA
 */
/* @var $sp_kpi Orm_Sp_Kpi */
/* @var Orm_Kpi $qms_kpi */
/* @var $strategy Orm_Sp_Strategy */

$filters = array('academic_year' => Orm_Semester::get_active_semester()->get_year());

switch ($strategy->get_item_class()) {
    case 'Orm_Sp_Strategy_Institution':
        $kpi_type = Orm_Kpi_Detail::TYPE_INSTITUTION;
        $college_id = 0;
        break;
    case 'Orm_Sp_Strategy_College':
        $kpi_type = Orm_Kpi_Detail::TYPE_COLLEGE;
        $filters['college_id'] = $strategy->get_item_id();
        $college_id = $strategy->get_item_id();
        break;
    case 'Orm_Sp_Strategy_Program':
        $filters['program_id'] = $strategy->get_item_id();
        $college_id = Orm_Program::get_instance($strategy->get_item_id())->get_department_obj()->get_college_obj()->get_id();
        $kpi_type = Orm_Kpi_Detail::TYPE_PROGRAM;
        break;
    default:
        $kpi_type = Orm_Kpi_Detail::TYPE_INSTITUTION;
        $college_id = 0;
        break;
}
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('Select KPI'); ?>
        </div>
        <?php echo form_open("/strategic_planning/lag_kpi/save_kpi?strategy_id={$strategy->get_id()}",'id="kpi-form" class="form-horizontal"') ?>
        <div class="modal-body">
            <div class="form-group">
                <?php echo Validator::get_html_error_message_no_arrow('band'); ?>
            </div>
            <div class="form-group">
                <label for="category-id" class="col-sm-2 control-label"><?php echo lang('Category'); ?>: </label>

                <div class="col-sm-10">
                    <select name="category_id" id="category-id" class="form-control">
                        <option value=""><?php echo lang('Select One'); ?></option>
                        <?php foreach (Orm_Kpi::get_categories() as $cat_key => $cat_title) { ?>
                            <?php $selected = $cat_key == $sp_kpi->get_kpi_obj()->get_category_id() ? 'selected="selected"' : ''; ?>
                            <option value="<?php echo $cat_key ?>" <?php echo $selected; ?>><?php echo $cat_title; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="type-kpi" class="col-sm-2 control-label"><?php echo lang('KPI'); ?>: *</label>

                <div class="col-sm-10">
                    <select name="kpi_id" id="type-kpi" class="form-control">
                        <option value="0"><?php echo lang('Select One'); ?></option>
                        <?php foreach (Orm_Kpi::get_all(array('category_id' => $sp_kpi->get_kpi_obj()->get_category_id(), 'college_id' => $college_id)) as $KPI) { ?>
                            <?php $selected = ($KPI->get_id() == $sp_kpi->get_kpi_id() ? 'selected="selected"' : ''); ?>
                            <option value="<?php echo $KPI->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($KPI->get_code() . '. ' . substr($KPI->get_title(), 0, 100) . '...'); ?></option>
                        <?php } ?>
                    </select>
                    <?php echo Validator::get_html_error_message('kpi_id'); ?>
                    <?php echo Validator::get_html_error_message('type_id'); ?>
                </div>
            </div>
            <div id="kpi-value" class="<?php echo $sp_kpi->get_id() ? 'form-group' : ''; ?>">
                <?php if ($sp_kpi->get_kpi_id()) {
                    $info = $sp_kpi->get_kpi_obj()->get_info($kpi_type, $filters);
                    ?>
                    <label class="col-sm-2 control-label"><?php echo lang('KPI Value'); ?>: </label>
                    <div class="col-sm-10"><input type="text" class="form-control" readonly value="<?php echo $info['actual_benchmarks'] ?>"></div>
                <?php } ?>
            </div>
            <div class="form-group">
                <label for="polarity" class="col-sm-2 control-label"><?php echo lang('KPI Polarity'); ?>: *</label>

                <div class="col-sm-10">
                    <select class="form-control" name="polarity" id="polarity">
                        <option
                            value="1" <?php echo $sp_kpi->get_polarity() == Orm_Sp_Kpi::KPI_POLARITY_POSITIVE ? 'selected="selected"' : ''; ?>><?php echo lang('Positive'); ?></option>
                        <option
                            value="2" <?php echo $sp_kpi->get_polarity() == Orm_Sp_Kpi::KPI_POLARITY_NEGATIVE ? 'selected="selected"' : ''; ?>><?php echo lang('Negative'); ?></option>
                    </select>
                    <?php echo Validator::get_html_error_message('polarity'); ?>
                </div>
            </div>
            <div id="kpi-band"></div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo intval($sp_kpi->get_id()); ?>">
            <input type="hidden" name="type_id" value="<?php echo intval($sp_kpi->get_type_id()); ?>">
            <input type="hidden" name="class_type" value="<?php echo $sp_kpi->get_class_type(); ?>">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-save"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    <?php if ($sp_kpi->get_id() || $sp_kpi->get_kpi_id()) { ?>
    kpiChanged(<?php echo $sp_kpi->get_kpi_id() ?>);
    <?php } ?>
    init_data_toggle();
    $('form#kpi-form').submit(function (e) {
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
    $("#category-id").change(function () {
        if ($(this).val()) {
            $.ajax({
                url: '/strategic_planning/lag_kpi/search_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=' + $(this).val(),
                type: 'POST',
                dataType: 'JSON'
            }).done(function (data) {
                var KPIs = $('#type-kpi');
                KPIs.children('option:not(:first)').remove();
                $.each(data.result, function (i, item) {
                    KPIs.append($("<option></option>")
                        .attr("value", item.id)
                        .text(item.title));
                });
            });
        }
    });

    $('#type-kpi').change(function () {kpiChanged($(this).val())});

    function kpiChanged(kpi_id) {
        $('#kpi-band').addClass('form-loading');
        $.ajax({
            url: '/strategic_planning/lag_kpi/get_kpi/' + kpi_id + '/'+ <?php echo $strategy->get_id() ?>,
            type: 'POST',
            dataType: 'JSON'
        }).done(function (data) {
            $('#kpi-value').html('<label class="col-sm-2 control-label"><?php echo lang('KPI Value'); ?>: </label><div class="col-sm-10"><input type="text" class="form-control" readonly value="'+ data.actual_benchmarks +'"></div>').addClass('form-group');
        });
        $('#kpi-band').load('/strategic_planning/lag_kpi/get_kpi_levels/' + kpi_id + '/'+ <?php echo $sp_kpi->get_id() ?>, function () {
            $('#kpi-band').removeClass('form-loading');
        });
    }
</script>