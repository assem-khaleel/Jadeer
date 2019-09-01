<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/13/15
 * Time: 10:04 PM
 */
/** @var Orm_Sp_Strategy $strategy */

$level = intval($this->input->get_post('level'));
$project_id = $this->input->get_post('project_id');
if($project_id) {
    $projects = Orm_Sp_Project::get_instance($project_id)->get_children();
} else {
    $projects = Orm_Sp_Project::get_all(array('strategy_id' => $strategy->get_id()));
}
?>
<div class="m-b-1"></div>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Projects') ?></span>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th class="col-md-6 valign-middle"><?php echo lang('Project Name') ?></th>
            <th class="col-md-2 text-center"><?php echo lang('Status') ?></th>
            <th class="col-md-2 text-center"><?php echo lang('Trend') ?></th>
            <th class="col-md-2 text-center"><?php echo lang('Performance') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($projects as $project) { ?>
        <tr>
            <td>
                <?php
                $strategy_obj = $project->get_action_plan_obj()->get_initiative_obj()->get_objective_obj()->get_strategy_obj();
                echo htmlfilter($project->get_title()) . ($strategy_obj instanceof Orm_Sp_Strategy_Institution ? '' : ' - ' . htmlfilter($strategy_obj->get_title()));
                ?>
                <?php if($project->get_children()) { ?>
                    <br>
                    <br>
                    <a class="btn  text-left" style="width: 150px;" data-toggle="ajaxRequest"
                       data-target="project-container-<?php echo $level ?>"
                       href="<?php echo handle_url(array('project_id' => $project->get_id(), 'type' => 'project', 'level' => ($level + 1))); ?>">
                        <span class="btn-label-icon left icon fa fa-sort-amount-desc"></span><?php echo lang('Sub Projects'); ?>
                    </a>
                <?php } ?>
            </td>
            <td class="text-center valign-middle font-size-52"><?php echo $project->get_status_lead() ?></td>
            <td class="text-center valign-middle font-size-52"><?php echo $project->get_trend_lead() ?></td>
            <td class="text-center valign-middle"><?php echo $project->draw_gauge_lead() ?></td>
        </tr>
        <?php } ?>
        <?php if (empty($projects)) { ?>
            <tr>
                <td colspan="7">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Projects'); ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div id="project-container-<?php echo $level ?>"></div>