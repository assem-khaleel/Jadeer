<div class="table-responsive m-a-0">

    <table class="table table-striped table-bordered">
        <thead>
        <tr class="bg-primary">
            <td class="col-md-10">
                <b><?php echo lang('Name') ?></b>
            </td>
            <td class="col-md-2 text-center">
                <b><?php echo lang('Action') ?></b>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
//       echo '<pre>';
//        print_r($programs);die();
        if ($programs) {
            foreach ($programs as $program){
                /* @var $program Orm_Program */
                ?>
                <tr>
                    <td>
                        <h5 class="m-t-0"><?php echo htmlfilter($program->get_name()); ?></h5>
                        <ul>
                            <li>
                                <i><?php echo lang('College'); ?></i> : <?php echo htmlfilter($program->get_department_obj()->get_college_obj()->get_name()); ?>
                            </li>
                            <li>
                                <i><?php echo lang('Department'); ?></i> : <?php echo htmlfilter($program->get_department_obj()->get_name()); ?>
                            </li>
                        </ul>
                    </td>

                    <td class="text-center">
                        <a href="/report/program_report/view_reports/<?php echo intval($program->get_id()); ?>" class="btn btn-block"><i class="btn-label-icon left fa fa-eye"></i><?php echo lang('View').' ' .lang('Reports'); ?></a>
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

</div>
<?php if ($pager) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>