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
            <?php echo filter_block('/examination/quiz/ajax_list', '/examination/quiz', [Orm_Campus::class, Orm_College::class, Orm_Program::class, 'keyword'],'ajax_block'); ?>
        </div>
        <div id="ajax_block">
            <div class="table-responsive m-a-0">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td class="col-md-3"><?php echo lang('Quiz Name'); ?></td>
                        <td class="col-md-3"><?php echo lang('Course Name'); ?></td>
                        <td class="col-md-1"><?php echo lang('Number of questions'); ?></td>
                        <td class="col-md-2"><?php echo lang('Exam Date'); ?></td>
                        <td class="col-md-1"><?php echo lang('Mark'); ?></td>
                        <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($quiz): ?>
                        <?php foreach ($quiz as $row): ?>
                            <tr>
                                <td><?php echo htmlfilter($row->get_name())?></td>
                                <td><?php echo htmlfilter($row->get_course_obj()->get_name())?></td>
                                <td><?php echo count($row->get_questions())?></td>
                                <td><?php echo htmlfilter($row->get_start_date())?: lang('The quiz date has not been published yet.') ?></td>
                                <td><?php echo htmlfilter($row->get_fullmark())?></td>
                                <td class="text-center">

                                <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')): ?>
                                    <a href="/examination/quiz/view/<?php echo (int)$row->get_id(); ?>" class="btn btn-block" title="<?php echo lang('View') ?>">
                                        <span class="btn-label-icon left fa fa-eye" aria-hidden="true"></span>
                                        <?php echo lang('View') ?>
                                    </a>
                                <?php endif; ?>

                                <?php if($row->can_edit()):?>
                                    <?php if($row->get_start(true) == 0): ?>
                                    <a href="/examination/quiz/create_edit/<?php echo (int)$row->get_id(); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Edit') ?>">
                                        <span class="btn-label-icon left fa fa-cog"></span>
                                        <?php echo lang('Edit')?>
                                    </a>

                                    <a href="/examination/quiz/manage/<?php echo (int)$row->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Design') ?>">
                                        <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                                        <?php echo lang('Design') ?>
                                    </a>
                                    <?php endif; ?>

                                    <a href="/examination/quiz/section_manage/<?php echo (int)$row->get_id(); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Manage Sections') ?>">
                                        <span class="btn-label-icon left fa fa-bullhorn"></span>
                                        <?php echo lang('Manage').' '.lang('Sections')?>
                                    </a>

                                    <a href="/examination/quiz/delete/<?php echo (int)$row->get_id(); ?>"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" class="btn btn-block" title="<?php echo lang('Delete') ?>">
                                        <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                        <?php echo lang('Delete') ?>
                                    </a>
                                <?php endif; ?>

                                <?php if($row->ready_to_publish()): ?>
                                <?php if($row->get_start(true) < time() && $row->get_end(true) >= time()): ?>
                                    <a href="/examination/quiz/stop/<?php echo $row->get_id(); ?>"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" class="btn btn-block" title="<?php echo lang('Stop Quiz') ?>">
                                        <span class="btn-label-icon left fa fa-bell-slash-o"></span>
                                        <?php echo lang('Stop Quiz')?>
                                    </a>
                                <?php else: ?>
                                    <a href="/examination/quiz/start/<?php echo $row->get_id(); ?>"   message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" class="btn btn-block" title="<?php echo lang('Start Quiz') ?>">
                                        <span class="btn-label-icon left fa fa-bell-o"></span>
                                        <?php echo lang('Start Quiz')?>
                                    </a>
                                <?php endif; ?>
                                <?php endif; ?>


                                <?php if(!$row->can_edit()):?>

                                    <?php if(
                                        $row->get_semester_id() == Orm_Semester::get_current_semester()->get_id()
                                     && Orm_User::get_logged_user_id() ==  $row->get_teacher_id()
                                     && Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')
                                     && $row->get_end(true)<time()
                                    ): ?>
                                    <a href="/examination/correction/students/<?php echo (int)$row->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Correction') ?>">
                                        <span class="btn-label-icon left fa fa-check" aria-hidden="true"></span>
                                        <?php echo lang('Correction') ?>
                                    </a>
                                    <?php endif; ?>

                                    <?php if($row->get_total_question_marks() == $row->get_fullmark() && $row->get_fullmark()):?>
                                    <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-report')): ?>
                                    <a href="<?php echo base_url('/examination/report/show/'. intval($row->get_id())) ?>" class="btn btn-block" title="<?php echo lang('Report') ?>">
                                        <span class="btn-label-icon left fa fa-pie-chart" aria-hidden="true"></span>
                                        <?php echo lang('Report') ?>
                                    </a>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">
                                <div class="well well-sm m-a-0">
                                    <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Data'); ?></h3>
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
</div>