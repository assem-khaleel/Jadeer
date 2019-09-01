<div class="table-responsive m-a-0">
    <table class="table table-bordered">
        <thead>
        <tr>
            <td class="col-md-5"><?php echo lang('Name'); ?></td>
            <td class="col-md-1"><?php echo lang('Code'); ?></td>
            <td class="col-md-4"><?php echo lang('College'); ?> & <?php echo lang('Department'); ?></td>
            <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($courses): ?>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td>
                        <?php echo htmlfilter($course->get_name()); ?>
                    </td>
                    <td>
                        <?php echo htmlfilter($course->get_code()); ?>
                    </td>
                    <td>
                        <b><?php echo lang('College'); ?>
                            :</b> <?php echo $course->get_department_id() ? htmlfilter($course->get_department_obj()->get_college_obj()->get_name()) : lang('N/A'); ?>
                        <br>
                        <b><?php echo lang('Department'); ?>
                            :</b> <?php echo $course->get_department_id() ? htmlfilter($course->get_department_obj()->get_name()) : lang('N/A'); ?>
                    </td>
                    <td class="text-center">
                        <a href="/course_section?course_id=<?php echo (int)$course->get_id(); ?>"
                           class="btn btn-sm  btn-block"
                           title="<?php echo lang('Course Sections') ?>">
                                    <span class="btn-label-icon left fa fa-tasks"
                                          aria-hidden="true"></span> <?php echo lang('Sections') ?>
                        </a>
                        <a href="/course/edit/<?php echo (int)$course->get_id(); ?>"
                           class="btn btn-sm  btn-block" title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-pencil-square-o"
                                          aria-hidden="true"></span> <?php echo lang('Edit') ?>
                        </a>
                        <a href="/course/delete/<?php echo (int)$course->get_id(); ?>"
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
                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Courses'); ?></h3>
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