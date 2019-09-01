<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/13/15
 * Time: 10:04 PM
 */
/** @var string $type */
/** @var Orm_Sp_Strategy $strategy */
/** @var string $sp_view_content */

$fltr = $this->input->get_post('fltr');

?>
<div class="box p-a-1">

    <button aria-controls="filters" aria-expanded="false" data-target="#filters" data-toggle="collapse" type="button"
            class="btn btn-sm ">
        <span class="fa fa-filter"></span>
    </button>
    <?php echo lang('Find Strategic Planning');?>
</div>

<div id="filters" class="collapse <?php echo empty($fltr) ? '' : 'in'; ?>" style="height: auto;">
    <div class="well">
        <!-- Search form -->
        <?php echo form_open('/strategic_planning/basic_info/'.$strategy->get_id(), ['method' => 'get']) ?>
        <?php $this->load->view('/sp_filters',array($strategy->get_id(), 'action'=>form_open())) ?>
        <?php echo form_close(); ?>
        <!-- / Search form -->
    </div>
</div>

<div>
    <!-- Panel -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="panel-title text-bg"><?php echo htmlfilter($strategy->get_title()); ?> (<?php echo $strategy->get_year(); ?>)</span>
            <div class="panel-heading-controls col-sm-4">
                <a class="btn btn-sm pull-right" href="/strategic_planning/details/<?php echo (int) $strategy->get_id(); ?>">
                    <span class="btn-label-icon left"><i class="menu-icon fa fa-dashboard"></i> </span> <?php echo lang('Dashboard'); ?></a>
            </div>
        </div>
        <!-- Search results -->
        <div class="panel-body tab-content">
            <!-- Tabs -->
            <div class="search-tabs">
                <ul class="nav nav-tabs">
                    <li <?php if ($type == 'vision_mission') : ?>class="active"<?php endif; ?>>
                        <a href="/strategic_planning/basic_info/<?php echo urlencode($strategy->get_id()); ?>"
                           title="<?php echo lang('Vision & Mission'); ?>"><?php echo lang('Vision & Mission'); ?></a>
                    </li>
                    <li <?php if ($type == 'goals') : ?>class="active"<?php endif; ?>>
                        <a href="/strategic_planning/goal?strategy_id=<?php echo urlencode($strategy->get_id()); ?>"
                           title="<?php echo lang('Goals'); ?>"><?php echo lang('Goals'); ?> <span
                                    class="label label-success"><?php echo (int)$strategy->get_goals_count(); ?></span></a>
                    </li>
                    <li <?php if ($type == 'objectives') : ?>class="active"<?php endif; ?>>
                        <a href="/strategic_planning/objective?strategy_id=<?php echo urlencode($strategy->get_id()); ?>"
                           title="<?php echo lang('Objectives'); ?>"><?php echo lang('Objectives'); ?> <span
                                    class="label label-danger"><?php echo (int)$strategy->get_objective_count(); ?></span></a>
                    </li>
                    <li <?php if ($type == 'initiative') : ?>class="active"<?php endif; ?>>
                        <a href="/strategic_planning/initiative?strategy_id=<?php echo urlencode($strategy->get_id()); ?>"
                           title="<?php echo lang('Initiatives'); ?>"><?php echo lang('Initiatives'); ?> <span
                                    class="label label-primary"><?php echo (int)$strategy->get_initiative_count(); ?></span></a>
                    </li>
                    <li <?php if ($type == 'action_plan') : ?>class="active"<?php endif; ?>>
                        <a href="/strategic_planning/action_plan?strategy_id=<?php echo urlencode($strategy->get_id()); ?>"
                           title="<?php echo lang('Action Plans'); ?>"><?php echo lang('Action Plans'); ?> <span
                                    class="label label-warning"><?php echo (int)$strategy->get_action_plan_count(); ?></span></a>
                    </li>
                    <li <?php if ($type == 'project') : ?>class="active"<?php endif; ?>>
                        <a href="/strategic_planning/project?strategy_id=<?php echo urlencode($strategy->get_id()); ?>"
                           title="<?php echo lang('Projects'); ?>"><?php echo lang('Projects'); ?> <span
                                    class="label label-default"><?php echo (int)$strategy->get_project_count(); ?></span></a>
                    </li>
                    <li <?php if ($type == 'activity') : ?>class="active"<?php endif; ?>>
                        <a href="/strategic_planning/activity?strategy_id=<?php echo urlencode($strategy->get_id()); ?>"
                           title="<?php echo lang('Activities'); ?>"><?php echo lang('Activities'); ?> <span
                                    class="label label-danger"><?php echo (int)$strategy->get_activity_count(); ?></span></a>
                    </li>
                </ul>
                <!-- / .nav -->
            </div>
            <!-- / Tabs -->
        </div>
        <!-- / Search results -->
        <div class="panel-body">
            <?php $this->load->view($sp_view_content); ?>
        </div>

    </div>
    <!-- / Panel -->
</div>