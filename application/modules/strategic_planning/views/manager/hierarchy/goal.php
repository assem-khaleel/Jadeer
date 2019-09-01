<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/13/15
 * Time: 10:04 PM
 */
/** @var Orm_Sp_Strategy $strategy */

$level = intval($this->input->get_post('level'));
$goal_id = $this->input->get_post('goal_id');
if($goal_id) {
    $goals = Orm_Sp_Goal::get_instance($goal_id)->get_children();
} else {
    $goals = Orm_Sp_Goal::get_all(array('strategy_id' => $strategy->get_id()));
}
?>
<div class="m-b-1"></div>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo $goal_id ? lang('Child Goals of') . ' (' . Orm_Sp_Goal::get_instance($goal_id)->get_title() . ')' : lang('Goals') ?></span>
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
        <?php foreach($goals as $goal) { ?>
            <tr>
                <td>
                    <?php echo htmlfilter($goal->get_title()) . ($goal->get_strategy_obj() instanceof Orm_Sp_Strategy_Institution ? '' : ' - ' . htmlfilter($goal->get_strategy_obj()->get_title())); ?>
                    <?php if($goal->get_children()) { ?>
                        <br>
                        <br>
                        <a class="btn  text-left" style="width: 150px;" data-toggle="ajaxRequest"
                           data-target="goal-container-<?php echo $level ?>"
                           href="<?php echo handle_url(array('goal_id' => $goal->get_id(), 'type' => 'goal', 'level' => ($level + 1))); ?>">
                            <span class="btn-label-icon left icon fa fa-sort-amount-desc"></span><?php echo lang('Sub Goals'); ?>
                        </a>
                    <?php } ?>
                </td>
                <td class="text-center valign-middle font-size-52"><?php echo $goal->get_status_lead(); ?></td>
                <td class="text-center valign-middle font-size-52"><?php echo $goal->get_trend_lead(); ?></td>
                <td class="text-center valign-middle"><?php echo $goal->draw_gauge_lead(); ?></td>
                <td class="text-center valign-middle font-size-52"><?php echo $goal->get_status_lag(); ?></td>
                <td class="text-center valign-middle font-size-52"><?php echo $goal->get_trend_lag(); ?></td>
                <td class="text-center valign-middle"><?php echo $goal->draw_gauge_lag(); ?></td>
            </tr>
        <?php } ?>
        <?php if (empty($goals)) { ?>
            <tr>
                <td colspan="7">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Goals'); ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div id="goal-container-<?php echo $level ?>"></div>