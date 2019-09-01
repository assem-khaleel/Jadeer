<?php
/** @var int $category */
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <li <?php if ($category == Orm_Kpi::KPI_ACCREDITATION) : ?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/kpi?c=<?php echo Orm_Kpi::KPI_ACCREDITATION; ?>" title="<?php echo lang('Accreditation KPIs'); ?>"><?php echo lang('Accreditation KPIs'); ?></a>
    </li>
    <li <?php if ($category == Orm_Kpi::KPI_STRATEGIC) : ?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/kpi?c=<?php echo Orm_Kpi::KPI_STRATEGIC; ?>" title="<?php echo lang('Strategic KPIs'); ?>"><?php echo lang('Strategic KPIs'); ?></a>
    </li>
    <li <?php if ($category == Orm_Kpi::KPI_REPORTS) : ?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/kpi/reports" title="<?php echo lang('Reporting'); ?>"><?php echo lang('Reporting'); ?></a>
    </li>
    <li <?php if ($category == Orm_Kpi::KPI_LEVEL_SETTINGS) : ?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/kpi/manage_level_settings" title="<?php echo lang('Settings'); ?>"><?php echo lang('Settings')?></a>
    </li>
</ul>