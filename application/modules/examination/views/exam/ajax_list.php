<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 09:45 ص
 */
/* @var $exams Orm_Tst_Exam*/
?>
<div class="table-responsive m-a-0" >
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td class="col-md-3"><?php echo lang('Exam Name'); ?></td>
            <td class="col-md-3"><?php echo lang('Course Name'); ?></td>
            <td class="col-md-1"><?php echo lang('Number of questions'); ?></td>
            <td class="col-md-2"><?php echo lang('Exam Date'); ?></td>
            <td class="col-md-1"><?php echo lang('Mark'); ?></td>
            <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($exams): ?>
            <?php foreach ($exams as $exam): /* @var $exam Orm_Tst_Exam*/?>
                <tr>
                    <td><?php echo htmlfilter($exam->get_name())?></td>
                    <td><?php echo htmlfilter($exam->get_course_obj()->get_name())?></td>
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

                        <?php if($exam->can_edit()):?>
                            <?php if($exam->get_start(true)==0): ?>
                                <a href="/examination/create_edit/<?php echo (int)$exam->get_id(); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-cog"></span>
                                    <?php echo lang('Edit')?>
                                </a>
                                <a href="/examination/manage/<?php echo (int)$exam->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Design') ?>">
                                    <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                                    <?php echo lang('Design') ?>
                                </a>

                                <a href="/examination/delete/<?php echo (int)$exam->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Delete') ?>"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction">
                                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                    <?php echo lang('Delete') ?>
                                </a>
                            <?php endif; ?>

                            <?php if($exam->ready_to_publish()): ?>
                                <?php if($exam->get_start(true)==0): ?>
                                    <a href="/examination/publish/<?php echo (int)$exam->get_id(); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Publish') ?>">
                                        <span class="btn-label-icon left fa fa-bell-o"></span>
                                        <?php echo lang('Publish')?>
                                    </a>
                                <?php else: ?>
                                    <a href="/examination/unpublish/<?php echo (int)$exam->get_id(); ?>"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" class="btn btn-block" title="<?php echo lang('Unpublish') ?>">
                                        <span class="btn-label-icon left fa fa-bell-slash-o"></span>
                                        <?php echo lang('Unpublish')?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php endif; ?>
                        <?php if(!$exam->check_end() && $exam->get_semester_id()==Orm_Semester::get_current_semester()->get_id()): ?>
                            <?php   if($exam->get_teacher_id() == Orm_user::get_logged_user_id() && Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')): ?>
                                <a href="/examination/proctor_manage/<?php echo (int)$exam->get_id(); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Proctors') ?>">
                                    <span class="btn-label-icon left fa fa-user"></span>
                                    <?php echo lang('Proctors')?>
                                </a>

                                <a href="/examination/section_manage/<?php echo (int)$exam->get_id(); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Manage').' '.lang('Sections') ?>">
                                    <span class="btn-label-icon left fa fa-bullhorn"></span>
                                    <?php echo lang('Manage').' '.lang('Sections') ?>
                                </a>

                            <?php   endif; ?>
                        <?php endif; ?>

                        <?php if(!$exam->can_edit() ):?>
                            <?php   if($exam->get_semester_id() == Orm_Semester::get_current_semester()->get_id()): ?>
                                <?php       if($exam->exam_can_start() && $exam->is_monitor(Orm_User::get_logged_user_id())): ?>
                                    <a href="/examination/proctor/exam_student_attendance/<?php echo (int)$exam->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Student Attendance') ?>">
                                        <span class="btn-label-icon left fa fa-users" aria-hidden="true"></span>
                                        <?php echo lang('Student Attendance') ?>
                                    </a>
                                <?php       endif; ?>

                                <?php       if(
                                    Orm_User::get_logged_user_id() ==  $exam->get_teacher_id()
                                    && Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')
                                    && $exam->get_end(true)<time()
                                ): ?>
                                    <a href="/examination/correction/students/<?php echo (int)$exam->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Correction') ?>">
                                        <span class="btn-label-icon left fa fa-check" aria-hidden="true"></span>
                                        <?php echo lang('Correction') ?>
                                    </a>
                                <?php       endif; ?>
                            <?php   endif; ?>

                            <?php   if($exam->get_total_question_marks() == $exam->get_fullmark() && $exam->get_fullmark()):?>
                                <?php       if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-report')): ?>
                                    <a href="<?php echo base_url('/examination/report/show/'. intval($exam->get_id())) ?>" class="btn btn-block" title="<?php echo lang('Report') ?>">
                                        <span class="btn-label-icon left fa fa-pie-chart" aria-hidden="true"></span>
                                        <?php echo lang('Report') ?>
                                    </a>
                                <?php       endif; ?>
                            <?php   endif; ?>
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