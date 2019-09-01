<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/11/17
 * Time: 1:24 PM
 *
 * @var $assessment_metric Orm_Am_Assessment_Metric
 *
 */
?>
<div class="row form-group">
    <label class="col-sm-3 control-label"><?php echo lang('KPI Category'); ?></label>
    <div class="col-sm-9">
        <select name="extra_data[kpi_category_id]" class="form-control" onchange="select_kpis();">
            <option value="-1"><?php echo lang('Select One'); ?></option>
            <?php
            foreach(Orm_Kpi::get_categories() as $category_key => $category) {
                $selected = (!is_null($assessment_metric->get_item_from_extra_data('kpi_category_id')) && $category_key == $assessment_metric->get_item_from_extra_data('kpi_category_id')) ? 'selected="selected"' : '';
                ?>
                <option value="<?php echo $category_key ?>" <?php echo $selected ?> ><?php echo $category ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="table-primary m-a-0">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('KPI Result') ?></span>
    </div>
    <table class="table table-striped m-a-0" id="kpis_result">
        <?php echo $assessment_metric->ajax() ; ?>
    </table>
</div>

<script>
    function select_kpis() {
        $.ajax({
            type: "POST",
            url: '/assessment_metric/ajax',
            data: $('#assessment-metric-form').serialize(),
        }).done(function (html) {
            $('#kpis_result').html(html);
        });
    }
</script>