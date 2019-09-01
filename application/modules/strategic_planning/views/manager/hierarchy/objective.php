<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/13/15
 * Time: 10:04 PM
 */
/** @var Orm_Sp_Strategy $strategy */

$level = intval($this->input->get_post('level'));
$objective_id = $this->input->get_post('objective_id');
if($objective_id) {
    $objectives = Orm_Sp_Objective::get_instance($objective_id)->get_children();
} else {
    $objectives = Orm_Sp_Objective::get_all(array('strategy_id' => $strategy->get_id()));
}
?>
<div class="m-b-1"></div>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo $objective_id ? lang('Child Objectives of') . ' (' . Orm_Sp_Objective::get_instance($objective_id)->get_title() . ')' : lang('Objectives') ?></span>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th class="col-md-6 valign-middle" rowspan="2"><?php echo lang('Title'); ?></th>
            <th class="col-md-2 text-center" colspan="3"><?php echo lang('Lead'); ?></th>
            <th class="col-md-2 text-center" colspan="3"><?php echo lang('Lag'); ?></th>
        </tr>
        <tr>
            <th class="col-md-1 text-center"><?php echo lang('Status'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Trend'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Performance'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Status'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Trend'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Performance'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($objectives as $objective) { ?>
            <tr>
                <td>
                    <?php echo htmlfilter($objective->get_title()) . ($objective->get_strategy_obj() instanceof Orm_Sp_Strategy_Institution ? '' : ' - ' . htmlfilter($objective->get_strategy_obj()->get_title())); ?>
                    <?php if($objective->get_children()) { ?>
                        <br>
                        <br>
                        <a class="btn  text-left" style="width: 150px;" data-toggle="ajaxRequest"
                           data-target="objective-container-<?php echo $level ?>"
                           href="<?php echo handle_url(array('objective_id' => $objective->get_id(), 'level' => ($level + 1))); ?>">
                            <span class="btn-label-icon left icon fa fa-sort-amount-desc"></span><?php echo lang('Sub Objectives'); ?>
                        </a>
                    <?php } ?>
                </td>
                <td class="text-center valign-middle font-size-52"><?php echo $objective->get_status_lead(); ?></td>
                <td class="text-center valign-middle font-size-52"><?php echo $objective->get_trend_lead(); ?></td>
                <td class="text-center valign-middle"><?php echo $objective->draw_gauge_lead(); ?></td>
                <td class="text-center valign-middle font-size-52"><?php echo $objective->get_status_lag(); ?></td>
                <td class="text-center valign-middle font-size-52"><?php echo $objective->get_trend_lag(); ?></td>
                <td class="text-center valign-middle"><?php echo $objective->draw_gauge_lag(); ?></td>
            </tr>
        <?php } ?>
        <?php if (empty($objectives)) { ?>
            <tr>
                <td colspan="7">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Objectives'); ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<div id="objective-container-<?php echo $level ?>"></div>