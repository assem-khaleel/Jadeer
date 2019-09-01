<table class="table table-striped table-bordered">
    <thead>
    <tr class="bg-primary">
        <td class="col-md-8">
            <b><?php echo lang('Name') ?></b>
        </td>

        <td class="col-md-4 text-center">
            <b><?php echo lang('Action') ?></b>
        </td>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($programs) {
        foreach ($programs as $program) {
            /* @var $program Orm_Program */
            ?>
            <tr>
                <td>
                    <b><?php echo htmlfilter($program->get_name()); ?></b>
                    <ul>
                        <li>
                            <i><?php echo lang('College'); ?></i>
                            : <?php echo htmlfilter($program->get_department_obj()->get_college_obj()->get_name()); ?>
                        </li>
                        <li>
                            <i><?php echo lang('Department'); ?></i>
                            : <?php echo htmlfilter($program->get_department_obj()->get_name()); ?>
                        </li>
                    </ul>
                </td>
                <td class="text-center">
                    <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY],false, 'program_tree-manage')) { ?>
                    <a href="/program_tree/edit/<?php echo intval($program->get_id()); ?>"
                       class="btn  btn-block">
                        <i class="btn-label-icon left fa fa-pencil"></i>
                        <?php echo lang('Manage').' '.lang('Tree'); ?>
                    </a>
                    <?php } ?>
                    <a href="/program_tree/view/<?php echo intval($program->get_id()); ?>"
                       class="btn  btn-block"><i
                            class="btn-label-icon left fa fa-eye"></i><?php echo lang('View').' '.lang('Tree'); ?></a>
                </td>
            </tr>
        <?php }
    } else { ?>
        <tr>
            <td colspan="4">
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Programs'); ?></h3>
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php if ($pager) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>