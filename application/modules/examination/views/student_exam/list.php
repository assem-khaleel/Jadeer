<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 09:45 ص
 */
/* @var $exams Orm_Tst_Exam*/
?>

<div class="col-md-12 col-lg-12 m-t-4 ">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/student_exam/filter', '/examination/student_exam', ['keyword'],'ajax_block'); ?>
        </div>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
            <thead>
            <tr>
                <td class="col-md-3"><?php echo lang('Exam Name'); ?></td>
                <td class="col-md-3"><?php echo lang('Course Name'); ?></td>
                <td class="col-md-3"><?php echo lang('Exam Date'); ?></td>
                <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php if ($exams): ?>
                <?php foreach ($exams as $exam): /* @var $exam Orm_Tst_Exam*/?>
                    <tr>
                        <td><?php echo htmlfilter($exam->get_name())?></td>
                        <td><?php echo htmlfilter($exam->get_course_obj()->get_name())?></td>
                        <td><?php echo htmlfilter($exam->get_start_date())?></td>
                        <td class="text-center">
                            <?php if ($exam->exam_can_start() && !$exam->has_answer()): ?>
                                <a href="/examination/student_exam/start_test/<?php echo (int)$exam->get_id(); ?>"
                                   class="btn  btn-block"  title="<?php echo lang('Start Exam')?>">
                                    <span class="btn-label-icon left fa fa-file-text"></span>
                                    <?php echo  lang('Start Exam')?>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Exams'); ?></h3>
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

