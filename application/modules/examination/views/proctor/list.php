<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 01/05/17
 * Time: 04:56 م
 * @var $exams Orm_Tst_Exam[]
 */
/* @var $exams Orm_Tst_Exam*/
?>

<div class="col-md-12 col-lg-12 m-t-4 ">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/examination/proctor/ajax_list', '/examination/proctor', [Orm_Campus::class, Orm_College::class, Orm_Program::class, 'keyword'],'ajax_block'); ?>
        </div>
        <div id="ajax_block">
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
        </div>
    </div>
</div>


