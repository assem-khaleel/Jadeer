<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/25/15
 * Time: 10:06 AM
 */
/** @var Orm_Sp_Kpi[] $indicators */
/** @var array $filters */
?>
<?php if($indicators) { ?>
    <?php foreach ($indicators as $kpi) { ?>
        <tr class="alert alert-primary kpi-<?php echo $class_type == 'Orm_Sp_Objective' ? 'obj' : 'init'; ?>-<?php echo $id; ?>">
            <td <?php echo $kpi->get_class_type() == 'Orm_Sp_Objective' ? 'colspan="4"' : 'colspan="5"'; ?>>
                <div class="media">
                    <div class="pull-left"><i class="comment-avatar fa fa-key"></i></div>
                    <div class="media-body"><?php echo htmlfilter(Orm_Kpi::get_instance($kpi->get_kpi_id())->get_title()); ?></div>
                </div>
            </td>
            <td class="text-center valign-middle"><?php echo $kpi->get_status_lag(); ?></td>
            <td class="text-center valign-middle"><?php echo $kpi->get_trend_lag(); ?></td>
            <td class="text-center valign-middle"><?php echo $kpi->draw_gauge_lag(); ?></td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr class="kpi-<?php echo $class_type == 'Orm_Sp_Objective' ? 'obj' : 'init'; ?>-<?php echo $id; ?>">
        <td colspan="10">
            <div class="well well-sm m-a-0" >
                <h3 class="text-center m-a-0" ><?php echo lang('There are no') . ' ' . lang('KPIs'); ?></h3>
            </div>
        </td>
    </tr>
<?php } ?>
