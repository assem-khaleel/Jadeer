<div class="table-responsive m-a-0">
    <table class="table table-bordered">
        <thead>
        <tr>
            <td class="col-md-3"><?php echo lang('Name'); ?></td>
            <td class="col-md-2"><?php echo lang('Degree'); ?></td>
            <td class="col-md-4"><?php echo lang('College'); ?> & <?php echo lang('Department'); ?></td>
            <td class="col-md-3 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($programs): ?>
            <?php foreach ($programs as $program): ?>
                <tr>
                    <td>
                        <?php echo htmlfilter($program->get_name()); ?>
                    </td>
                    <td>
                        <?php echo htmlfilter($program->get_degree_obj()->get_name()); ?>
                    </td>
                    <td>
                        <b><?php echo lang('College'); ?>
                            :</b> <?php echo htmlfilter($program->get_department_obj()->get_college_obj()->get_name()); ?>
                        <br>
                        <b><?php echo lang('Department'); ?>
                            :</b> <?php echo htmlfilter($program->get_department_obj()->get_name()); ?>
                    </td>
                    <td class="text-center">
                        <a href="/program_plan?program_id=<?php echo (int)$program->get_id(); ?>"
                           class="btn btn-sm btn-block" title="<?php echo lang('Program Plan') ?>">
                                    <span class="btn-label-icon left fa fa-tasks"
                                          aria-hidden="true"></span> <?php echo lang('Plan') ?>
                        </a>
                        <a href="/program/vision_mission/<?php echo (int)$program->get_id(); ?>"
                           class="btn btn-sm  btn-block" title="<?php echo lang('Vision & Mission'); ?>">
                                    <span class="btn-label-icon left fa fa-tasks"
                                          aria-hidden="true"></span> <?php echo lang('Vision & Mission'); ?>
                        </a>
                        <a href="/program_goal?program_id=<?php echo (int)$program->get_id(); ?>"
                           class="btn btn-sm  btn-block" title="<?php echo lang('Goals') ?>">
                                    <span class="btn-label-icon left fa fa-tasks"
                                          aria-hidden="true"></span> <?php echo lang('Goals') ?>
                        </a>
                        <a href="/program_objective?program_id=<?php echo (int)$program->get_id(); ?>"
                           class="btn btn-sm  btn-block" title="<?php echo lang('Objectives') ?>">
                                    <span class="btn-label-icon left fa fa-tasks"
                                          aria-hidden="true"></span> <?php echo lang('Objectives') ?>
                        </a>
                        <a href="/program/edit/<?php echo (int)$program->get_id(); ?>"
                           class="btn btn-sm  btn-block" title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit"
                                          aria-hidden="true"></span> <?php echo lang('Edit') ?>
                        </a>
                        <a href="/program/delete/<?php echo (int)$program->get_id(); ?>"
                           class="btn btn-sm  btn-block" title="<?php echo lang('Delete') ?>"
                           data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>">
                                    <span class="btn-label-icon left fa fa-trash-o"
                                          aria-hidden="true"></span> <?php echo lang('Delete') ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Programs'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php if (!empty($pager)): ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php endif; ?>