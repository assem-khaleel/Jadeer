<?php
/** @var $actions Orm_Al_Action[] */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption row">
            <div class="col-md-10">
                <h4 class='m-a-0'><?php echo lang('Action'); ?></h4>
            </div>
        </div>
    </div>
    <?php if (empty($actions)) { ?>
        <div class="alert alert-primary">
            <div class="m-b-1">
               <?php echo lang('There are no') . ' ' . lang('Action has Entered'); ?>
            </div>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-5"><?php echo lang('Action'); ?></th>
                <th class="col-md-4"><?php echo lang('Responsible'); ?></th>
                <th class="col-md-3"><?php echo lang('Time Frame'); ?></th>
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
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>