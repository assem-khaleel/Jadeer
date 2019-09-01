<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/11/17
 * Time: 1:24 PM
 *
 * @var $assessment_loop Orm_Al_Assessment_Loop
 *
 */
$extra_data = $this->input->get_post('extra_data');

$kpi_category_id = (isset($extra_data['kpi_category_id']) ? $extra_data['kpi_category_id'] : null);

if(is_null($kpi_category_id)) {
    $kpi_category_id = $assessment_loop->get_item_from_extra_data('kpi_category_id');
}

if(is_null($kpi_category_id)) {
    $kpi_category_id = -1;
}

$kpis = Orm_Kpi::get_all(array('category_id' => $kpi_category_id));
?>
<tbody>
<?php if(empty($kpis)) { ?>
    <tr>
        <td colspan="2">
            <div class="alert alert-warning m-a-0">
                <?php echo lang('Please choose KPI Category / No KPIs found.') ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <?php foreach ($kpis as $kpi) { ?>
        <tr>
            <td class="col-lg-2">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="item_id" <?php echo $assessment_loop->get_item_id() === $kpi->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($kpi->get_id()) ?>" class="px" />
                    <span class="lbl"><?php echo htmlfilter($kpi->get_view_code()) ?>&ensp;</span>
                </label>
            </td>
            <td class="col-lg-10">
                <?php echo (($kpi->get_category_id() == Orm_Kpi::KPI_ACCREDITATION && $kpi->get_ncaaa() == Orm_Kpi::KPI_NCAAA) ? "<span class='label label-primary'>" . lang('NCAAA') . "</span>" : '') ?>
                <?php echo htmlfilter($kpi->get_title()) ?>
                <span class='label label-default'><?php echo htmlfilter($kpi->get_unit_obj()->get_name())?></span>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
