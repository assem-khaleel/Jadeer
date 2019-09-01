<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 11/19/15
 * Time: 11:15 AM
 */
/** @var Orm_Kpi[] $KPIs */
/** @var array $filters */
/** @var int $type */
/** @var int $category */?>
<div class="row">

<?php foreach ($KPIs as $key => $KPI) {?>
    <div class="col-md-6">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12">
                        <span class="label label-primary"><?php echo htmlfilter($KPI->get_view_code()); ?></span>
                        <?php echo htmlfilter($KPI->get_title()) ?>
                        <span class="label label-default"><?php echo htmlfilter($KPI->get_unit_obj()->get_name()); ?></span>
                    </div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell">
                    <div id="hero-graph"><?php echo $KPI->draw_trend_analysis($type, $filters); ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($key !== 0 && $key%2 !== 0) { ?>
        </div>
        <div class="row">
    <?php } ?>
<?php } ?>
</div>
<?php if (!count($KPIs)) { ?>
    <div class="box p-a-1">
        <h4 class="m-t-0"><?php echo lang('No KPIs'); ?></h4>
        <p><?php echo lang('There is no') . ' ' . Orm_Kpi::get_category_by_id($category); ?></p>
    </div>
<?php } ?>
