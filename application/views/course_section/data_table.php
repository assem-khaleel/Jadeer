<div class="table-responsive m-a-0">
    <table class="table table-bordered">
        <thead>
        <tr class="bg-primary">
            <td class="col-md-2"><?php echo lang('Section No'); ?></td>
            <td class="col-md-4"><?php echo lang('Semester'); ?></td>
            <td class="col-md-4"><?php echo lang('Teachers'); ?></td>
            <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($sections): ?>
            <?php foreach ($sections as $section) : /* @var $section Orm_Course_Section */ ?>
                <tr>
                    <td>
                        <?php echo htmlfilter($section->get_name()); ?>
                    </td>
                    <td>
                        <?php echo htmlfilter($section->get_semester_obj()->get_name()); ?>
                    </td>
                    <td>
                        <?php echo lang('Teachers'); ?>
                        <ul>
                            <?php foreach ($section->get_teachers() as $teacher) {

                                if (is_null($user_teacher = $teacher->get_user_obj())) {
                                    continue;
                                }
                                ?>
                                <li>
                                    <?php echo htmlfilter($user_teacher->get_full_name()); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </td>
                    <td class="text-center">
                        <a href="/course_section/manage/<?php echo $section->get_id(); ?>?course_id=<?php echo (int)$course->get_id(); ?>"
                           class="btn btn-block btn-sm " title="<?php echo lang('Manage'); ?>">
                                    <span class="btn-label-icon left fa fa-thumb-tack"
                                          aria-hidden="true"></span> <?php echo lang('Manage'); ?>
                        </a>
                        <a href="/course_section/students/<?php echo $section->get_id(); ?>?course_id=<?php echo (int)$course->get_id(); ?>"
                           class="btn btn-block btn-sm " title="<?php echo lang('Students'); ?>">
                                    <span class="btn-label-icon left fa fa-users"
                                          aria-hidden="true"></span> <?php echo lang('Students'); ?>
                        </a>
                        <a href="/course_section/edit/<?php echo $section->get_id(); ?>?course_id=<?php echo (int)$course->get_id(); ?>"
                           class="btn btn-block btn-sm " title="<?php echo lang('Edit'); ?>">
                                    <span class="btn-label-icon left fa fa-edit"
                                          aria-hidden="true"></span> <?php echo lang('Edit'); ?>
                        </a>
                        <a href="/course_section/delete/<?php echo $section->get_id(); ?>?course_id=<?php echo (int)$course->get_id(); ?>"
                           data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>" class="btn btn-block btn-sm"
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
                    <div class="well well-sm text-center">
                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Sections'); ?></h3>
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