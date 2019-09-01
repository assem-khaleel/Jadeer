<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 03/05/17
 * Time: 09:45 ص
 */

?>

<div class="col-md-12 col-lg-12 m-t-4 ">
    <div class="table-primary">
        <div class="table-header">

            <?php echo filter_block('/exam/filter', '/examination/correction/students/'.$exam->get_id(), ['keyword'],'ajax_block'); ?>
        </div>
        <div class="table-responsive m-a-0">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td class="col-md-2"><?php echo lang('Student Number'); ?></td>
                    <td class="col-md-5"><?php echo lang('Student Name'); ?></td>
                    <td class="col-md-3"><?php echo lang('Status'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php
                /** @var $exam Orm_Tst_Exam */
                $question_count = count($exam->get_questions());

                foreach ($students as $student): /* @var $student Orm_Course_Section_Student*/?>
                    <tr>
                        <td><?php echo htmlfilter($student->get_user_id())?></td>
                        <td><?php echo htmlfilter($student->get_user_obj()->get_full_name())?></td>
                        <td><?php echo htmlfilter($question_count==Orm_Tst_Exam_Student_Mark::get_count(['user_id'=>$student->get_user_id(), 'exam_id'=>$exam->get_id()])? lang('Done'): '') ?></td>
                        <td class="text-center">
                            <a href="<?php
                                echo base_url('/examination/correction/check_answers/'.$exam->get_id().'/'.$student->get_user_id());
                            ?>" class="btn btn-block" title="<?php echo lang('Check Answers') ?>">
                                <span class="btn-label-icon left fa fa-check"></span>
                                <?php echo lang('Check Answers')?>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
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