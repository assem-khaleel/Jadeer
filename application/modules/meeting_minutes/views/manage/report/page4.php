<?php
/** @var $meeting Orm_Mm_Meeting */
?>
<h2 class="m-t-1"><?php echo lang('Action') ?></h2>
<table class="table table-bordered">
    <thead>
    <tr>
        <th class="col-sm-3"><?php echo lang('Owner Name'); ?></th>
        <th class="col-sm-7"><?php echo lang('Action'); ?></th>
        <th class="col-sm-2"><?php echo lang('Due Date'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($meeting->get_action() as $action) { ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($action->get_owner_name()); ?></span>
            </td>
            <td>
                <span><?php echo xssfilter($action->get_action()); ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($action->get_due()); ?></span>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>