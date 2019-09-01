<?php
/** @var $actions Orm_Al_Action[] */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption row">
            <div class="col-md-10">
                <i class="fa fa-book"></i>
                <?php echo lang('Action'); ?>
            </div>
            <div class="col-md-2 ">
                <?php if ($assessment_loop->can_manage()) :?>
                <a href="/assessment_loop/action/add_edit?assessment_loop_id=<?php echo $assessment_loop_id; ?>" data-toggle="ajaxModal" class="btn btn-sm pull-right">
                    <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('Action'); ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (empty($actions)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Action has Entered'); ?>
            </div>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-4"><?php echo lang('Action'); ?></th>
                <th class="col-md-4"><?php echo lang('Responsible'); ?></th>
                <th class="col-md-<?php echo ($assessment_loop->can_manage())? 2: 4 ?>"><?php echo lang('Time Frame'); ?></th>
                <?php if ($assessment_loop->can_manage()) :?>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($actions)) { ?>
                <?php foreach ($actions as $action) { ?>
                    <tr>
                        <td>
                            <span><?php echo htmlfilter($action->get_action()); ?></span>
                        </td>
                        <td>
                            <span><?php echo htmlfilter($action->get_responsible()); ?></span>
                        </td>
                        <td>
                            <span><?php echo htmlfilter($action->get_time_frame()); ?></span>
                        </td>
                    <?php if ($assessment_loop->can_manage()) :?>

                        <td class="td last_column_border text-center">
                            <a class="btn btn-block" data-toggle="ajaxModal" href="/assessment_loop/action/add_edit/<?php echo intval($action->get_id()); ?>?assessment_loop_id=<?php echo $assessment_loop_id; ?>">
                                <span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                            <a class="btn btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/assessment_loop/action/delete/<?php echo intval($action->get_id()); ?>?assessment_loop_id=<?php echo $assessment_loop_id; ?>">
                                <span class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                        </td>
                    <?php endif; ?>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>