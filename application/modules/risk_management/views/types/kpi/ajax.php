<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/11/17
 * Time: 1:24 PM
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */
$kpi_category_id = $this->input->get_post('kpi_category_id');

$kpis = Orm_Kpi::get_all(array('kpi_type' => $kpi_category_id));
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
                    <input type="radio" name="type_id" <?php echo $risk_management->get_type_id() === $kpi->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($kpi->get_id()) ?>" class="px" />
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
