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

            <?php echo filter_block('/examination/examination_bank/exams/'.$course_id, '/examination/examination_bank/exams/'.$course_id, ['keyword'],'ajax_block'); ?>
        </div>
        <div class="table-responsive m-a-0">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td class="col-md-2"><?php echo lang('Year'); ?></td>
                    <td class="col-md-3"><?php echo lang('Exam Name'); ?></td>
                    <td class="col-md-2"><?php echo lang('Number of questions'); ?></td>
                    <td class="col-md-2"><?php echo lang('Exam Date'); ?></td>
                    <td class="col-md-1"><?php echo lang('Mark'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($exams): ?>
                    <?php foreach ($exams as $exam): /* @var $exam Orm_Tst_Exam*/?>
                        <tr>
                            <td><?php
                                if($year = (int) $exam->get_start(true)) {
                                    echo date('Y', $year);
                                }
                                else {
                                    echo '---';
                                }

                                ?></td>
                            <td><?php echo htmlfilter($exam->get_name())?></td>
                            <td><?php echo count($exam->get_questions())?></td>
                            <td><?php echo htmlfilter($exam->get_start_date())?></td>
                            <td><?php echo htmlfilter($exam->get_fullmark())?></td>
                            <td class="text-center">
                            <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')): ?>
                                <a href="/examination/view_exam/<?php echo (int)$exam->get_id(); ?>" class="btn btn-block" title="<?php echo lang('View') ?>">
                                    <span class="btn-label-icon left fa fa-eye" aria-hidden="true"></span>
                                    <?php echo lang('View') ?>
                                </a>
                            <?php endif; ?>


                            <?php if(!$exam->can_edit() && $exam->get_total_question_marks() == $exam->get_fullmark() && $exam->get_fullmark()):?>
                                <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-report')): ?>
                                <a href="<?php echo base_url('/examination/report/show/'. intval($exam->get_id())) ?>" class="btn btn-block" title="<?php echo lang('Report') ?>">
                                    <span class="btn-label-icon left fa fa-pie-chart" aria-hidden="true"></span>
                                    <?php echo lang('Report') ?>
                                </a>
                                <?php endif; ?>
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