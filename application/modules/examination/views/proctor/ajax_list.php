<?php
/**
 * Created by PhpStorm.
 * User: shamaseen
 * Date: 16/05/18
 * Time: 12:10 م
 */
?>
 <div class="table-responsive m-a-0">
<table class="table table-bordered">
    <thead>
    <tr>
        <td class="col-md-3"><?php echo lang('Exam Name'); ?></td>
        <td class="col-md-3"><?php echo lang('Course Name'); ?></td>
        <td class="col-md-3"><?php echo lang('Exam Date'); ?></td>
        <td class="col-md-3 text-center"><?php echo lang('Actions'); ?></td>
    </tr>
    </thead>
    <tbody>
    <?php if ($exams): ?>
        <?php foreach ($exams as $exam): /* @var $exam Orm_Tst_Exam*/?>
            <tr>
                <td><?php echo htmlfilter($exam->get_name()); ?>
                    <?php if($exam->get_end(true)<time()): ?>
                    <span class="label label-tag label-warning"><?php echo lang('Passed') ?></span>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlfilter($exam->get_course_obj()->get_name()); ?></td>
                <td><?php echo htmlfilter($exam->get_start_date())?></td>
                <td class="text-center">
                    <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')): ?>
                    <a href="/examination/proctor/exam_student_attendance/<?php echo intval($exam->get_id()); ?>" class="btn  btn-block"><i class="btn-label-icon left fa fa-users"></i><?php echo  lang('Student Attendance')?></a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="10">
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Exams assigned to you'); ?></h3>
                </div>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</div>
<?php if (!empty($pager)) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>
