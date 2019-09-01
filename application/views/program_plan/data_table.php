<div class="table-responsive m-a-0">
    <table class="table table-bordered ">
        <thead>
        <tr>
            <th class="col-md-4"><?php echo lang('Course') ?></th>
            <th class="col-md-4"><?php echo lang('Level') ?></th>
            <th class="col-md-4 text-center"><?php echo lang('Action') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if ($plans): ?>
            <?php foreach ($plans as $plan) : /* @var $plan Orm_Program_Plan */ ?>
                <tr>
                    <td>
                        <b><?php echo htmlfilter($plan->get_course_obj()->get_name()); ?></b>
                    </td>
                    <td>
                        <b><?php echo htmlfilter($plan->get_level()); ?></b>
                    </td>
                    <td class="text-center">
                        <a href="/program_plan/edit/<?php echo $plan->get_id(); ?>?program_id=<?php echo (int)$program->get_id(); ?>"
                           class="btn btn-sm btn-block " title="<?php echo lang('Edit'); ?>">
                                    <span class="btn-label-icon left fa fa-pencil-square-o"
                                          aria-hidden="true"></span> <?php echo lang('Edit'); ?>
                        </a>
                        <a href="/program_plan/delete/<?php echo $plan->get_id(); ?>?program_id=<?php echo (int)$program->get_id(); ?>"
                           data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>" class="btn btn-sm btn-block"
                           title="<?php echo lang('Delete'); ?>">
                                    <span class="btn-label-icon left fa fa-trash-o"
                                          aria-hidden="true"></span> <?php echo lang('Delete'); ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Courses'); ?></h3>
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