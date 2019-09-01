<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/14/16
 * Time: 3:16 PM
 */
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <?php echo lang('Reports'); ?>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-9"><?php echo lang('Report Name'); ?></th>
            <th class="col-md-2"><?php echo lang('View') ?></th>
        </tr>
        </thead>
        <tbody>
        <tr class="bg-primary">
            <td colspan="3"><?php echo lang('Accreditation KPIs') ?></td>
        </tr>
        <tr>
            <td>1</td>
            <td><?php echo lang('Accreditation KPIs Trend Report'); ?></td>
            <td><a href="/kpi/report/<?php echo Orm_Kpi::KPI_LIST_REPORT_HISTORICAL ?>" class="btn btn-block"><i class="btn-label-icon left fa fa-eye"></i><?php echo lang('View'); ?></a> </td>
        </tr>
        <tr>
            <td>2</td>
            <td><?php echo lang('Accreditation KPIs Details Report'); ?></td>
            <td><a href="/kpi/report/<?php echo Orm_Kpi::KPI_LIST_REPORT_DETAILS ?>" class="btn btn-block "><i class="btn-label-icon left fa fa-eye"></i><?php echo lang('View'); ?></a> </td>
        </tr>
        <tr>
            <td>3</td>
            <td><?php echo lang('Accreditation KPIs Benchmarks Report'); ?></td>
            <td><a href="/kpi/report/<?php echo Orm_Kpi::KPI_LIST_REPORT_NORMAL ?>" class="btn btn-block "><i class="btn-label-icon left fa fa-eye"></i><?php echo lang('View'); ?></a> </td>
        </tr>
        <tr class="bg-primary">
            <td colspan="3"><?php echo lang('Strategic KPIs') ?></td>
        </tr>
        <tr>
            <td>4</td>
            <td><?php echo lang('Strategic KPIs Trend Report'); ?></td>
            <td><a href="/kpi/report/<?php echo Orm_Kpi::KPI_LIST_REPORT_HISTORICAL ?>/0/1" class="btn btn-block "><i class="btn-label-icon left fa fa-eye"></i><?php echo lang('View'); ?></a> </td>
        </tr>
        <tr>
            <td>5</td>
            <td><?php echo lang('Strategic KPIs Details Report'); ?></td>
            <td><a href="/kpi/report/<?php echo Orm_Kpi::KPI_LIST_REPORT_DETAILS ?>/0/1" class="btn btn-block "><i class="btn-label-icon left fa fa-eye"></i><?php echo lang('View'); ?></a> </td>
        </tr>
        <tr>
            <td>6</td>
            <td><?php echo lang('Strategic KPIs Benchmarks Report'); ?></td>
            <td><a href="/kpi/report/<?php echo Orm_Kpi::KPI_LIST_REPORT_NORMAL ?>/0/1" class="btn btn-block "><i class="btn-label-icon left fa fa-eye"></i><?php echo lang('View'); ?></a> </td>
        </tr>
        </tbody>
    </table>
</div>