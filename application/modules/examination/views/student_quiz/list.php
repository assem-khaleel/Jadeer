<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 09:45 ص
 */
/* @var $quiz Orm_Tst_Exam[] */
?>

<div class="col-md-12 col-lg-12 m-t-4 ">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/examination/student_quiz', '/examination/student_quiz', ['keyword'],'ajax_block'); ?>
        </div>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
            <thead>
            <tr>
                <td class="col-md-3"><?php echo lang('Quiz Name'); ?></td>
                <td class="col-md-3"><?php echo lang('Course Name'); ?></td>
                <td class="col-md-3"><?php echo lang('Quiz Date'); ?></td>
                <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php if ($quiz): ?>
                <?php foreach ($quiz as $row): ?>
                    <tr>
                        <td><?php echo htmlfilter($row->get_name())?></td>
                        <td><?php echo htmlfilter($row->get_course_obj()->get_name())?></td>
                        <td><?php echo htmlfilter($row->get_start_date())?></td>
                        <td class="text-center">
                            <?php if ($row->get_start(true) < time() && $row->get_end(true) >= time()): ?>
                                <a href="/examination/student_quiz/start/<?php echo (int)$row->get_id(); ?>"
                                   class="btn  btn-block"  title="<?php echo lang('Start Quiz')?>">
                                    <span class="btn-label-icon left fa fa-file-text"></span>
                                    <?php echo  lang('Start Quiz')?>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang("Quiz's"); ?></h3>
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

