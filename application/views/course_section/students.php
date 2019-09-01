<?php
/* @var $course Orm_Course */
/* @var $section Orm_Course_Section */
?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <h4 class="m-t-0">
                <?php echo htmlfilter($section->get_name()) . ' - ' . htmlfilter($course->get_name()); ?>
            </h4>
            <?php
            $extra_html = form_hidden('course_id', $course->get_id());
            echo filter_block(
                '/course_section/student_filter' . $section->get_id() . '?course_id=' . $course->get_id(),
                '/course_section/students/' . $section->get_id() . '?course_id=' . $course->get_id(),
                ['keyword'], 'ajax_block', $extra_html
            );
            ?>
        </div>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr class="bg-primary">
                    <td class="col-md-10"><?php echo lang('Student name'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($students): ?>
                    <?php foreach ($students as $student) : /* @var $student Orm_Course_Section_Student */ ?>
                        <tr>
                            <td>
                                <?php echo htmlfilter($student->get_user_obj()->get_full_name()); ?>
                            </td>
                            <td class="text-center">
                                <a href="/course_section/student_delete/<?php echo $student->get_id(); ?>?course_id=<?php echo (int)$course->get_id(); ?>"
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
                            <div class="well well-sm text-center">
                                <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Students'); ?></h3>
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
    </div>
</div>
