<?php
/**
 * Created by PhpStorm.
 * User: shamaseen
 * Date: 16/05/18
 * Time: 11:40 ص
 */
?>
<div class="table-responsive m-a-0">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td class="col-md-6"><?php echo lang('Course Name'); ?></td>
            <td class="col-md-3"><?php echo lang('Number of Assignments'); ?></td>
            <td class="col-md-3 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($courses): ?>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?php echo htmlfilter($course->get_name())?></td>
                    <td><?php echo Orm_Tst_Exam::get_count(['type'=> Orm_Tst_Exam::TYPE_ASSIGNMENT ,'course_id' => $course->get_id()]) ?></td>
                    <td class="text-center">
                        <a href="/examination/assignment_bank/assignments/<?php echo (int)$course->get_id(); ?>" class="btn btn-block" title=" <?php echo lang('View').' '.lang('Assignments') ?>">
                            <span class="btn-label-icon left fa fa-eye" aria-hidden="true"></span>
                            <?php echo lang('View').' '.lang('Assignments') ?>
                        </a>
                    </td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Courses'); ?></h3>
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
