<?php
/** @var Orm_Sp_Project[] $projects */
/* @var Orm_Sp_Strategy $item */
/** @var array $fltr */
/** @var string $pager */
/** @var int $type */
?>
<div class="table-primary table-responsive p-a-2">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Project'); ?></span>

        <div class="panel-heading-controls col-sm-4">
            <a class="btn btn-sm pull-right" data-toggle="ajaxModal"
               href="/strategic_planning/project/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>"><span
                    class="btn-label-icon left"><i class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create'); ?></a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-lg-4"><?php echo lang('Action Plan'); ?></th>
            <th class="col-lg-5"><?php echo lang('Title'); ?></th>
            <th class="col-lg-3"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($projects as $project) { ?>
            <tr class="odd gradeX">
                <td><?php echo htmlfilter($project->get_action_plan_obj()->get_title()); ?></td>
                <td><?php echo htmlfilter($project->get_title()); ?></td>
                <td class="text-center">
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/project/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($project->get_id()); ?>"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/project/remove?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($project->get_id()); ?>"
                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                class="fa fa-remove"></i></span><?php echo lang('Delete'); ?></a>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/risk_tab/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($project->get_id()); ?>&type=Orm_Sp_Project"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-bug"></i></span><?php echo lang('Risk'); ?></a>
                </td>
            </tr>
        <?php } ?>
        <?php if (empty($projects)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Projects'); ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if (!empty($pager)) { ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>
<script>
    function after_modal() {
        init_data_toggle();
    }
</script>