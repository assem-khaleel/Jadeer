<?php
/* @var $assignment Orm_Tst_Exam*/
?>

<div class="col-md-12 col-lg-12 m-t-4 ">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/exam/filter', '/examination/student_assignment', ['keyword'],'ajax_block'); ?>
        </div>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
            <thead>
            <tr>
                <td class="col-md-3"><?php echo lang('Assignment Name'); ?></td>
                <td class="col-md-3"><?php echo lang('Course Name'); ?></td>
                <td class="col-md-3"><?php echo lang('Assignment Date'); ?></td>
                <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php if ($assignments): ?>
                <?php foreach ($assignments as $assignment): /* @var $assignment Orm_Tst_Exam*/?>
                    <tr>
                        <td><?php echo htmlfilter($assignment->get_name())?></td>
                        <td><?php echo htmlfilter($assignment->get_course_obj()->get_name())?></td>
                        <td><?php echo htmlfilter($assignment->get_start_date())?></td>
                        <td class="text-center">
                    <?php if ($assignment->is_published() && $assignment->get_end(true)>=time()): ?>
                        <a href="/examination/student_assignment/view_assignment/<?php echo $assignment->get_id(); ?>" class="btn  btn-block"><i
                                    class="btn-label-icon left fa fa-tasks"></i><?php echo lang('View').' '.lang('Assignment') ?></a>
                    <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Assignments'); ?></h3>
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