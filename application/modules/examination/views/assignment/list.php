<?php
/* @var $assignment Orm_Tst_Exam*/
?>

<div class="col-md-12 col-lg-12 m-t-4">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/examination/assignments/ajax_list', '/examination/assignments', [Orm_Campus::class, Orm_College::class, Orm_Program::class, 'keyword'],'ajax_block'); ?>
        </div>
        <div id="ajax_block">
            <div class="table-responsive m-a-0">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="col-md-3"><?php echo lang('Assignment Name'); ?></td>
                        <td class="col-md-3"><?php echo lang('Course Name'); ?></td>
                        <td class="col-md-1"><?php echo lang('Number of questions'); ?></td>
                        <td class="col-md-2"><?php echo lang('Assignment Date'); ?></td>
                        <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($assignments): ?>
                        <?php foreach ($assignments as $assignment): /* @var $assignment Orm_Tst_Exam*/?>
                            <tr>
                                <td><?php echo htmlfilter($assignment->get_name())?></td>
                                <td><?php echo htmlfilter($assignment->get_course_obj()->get_name())?></td>
                                <td><?php echo count($assignment->get_questions())?></td>
                                <td><?php echo htmlfilter($assignment->get_start_date())?></td>
                                <td class="text-center">

                                    <?php if($assignment->can_edit() && $assignment->get_semester_id() == Orm_Semester::get_current_semester()->get_id()){ ?>
                                    <?php if($assignment->get_start(true) == 0): ?>
                                    <a href="/examination/assignments/manage/<?php echo (int)$assignment->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Design') ?>">
                                        <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                                        <?php echo lang('Design') ?>
                                    </a>

                                    <a href="/examination/assignments/create_edit/<?php echo $assignment->get_id(); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Edit') ?>">
                                        <span class="btn-label-icon left fa fa-cog"></span>
                                        <?php echo  lang('Edit')?>
                                    </a>
                                    <?php endif; ?>

                                    <?php if($assignment->ready_to_publish()): ?>
                                    <?php if($assignment->get_start(true) == 0): ?>
                                    <a href="/examination/assignments/publish/<?php echo $assignment->get_id(); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Publish') ?>">
                                        <span class="btn-label-icon left fa fa-bell-o"></span>
                                        <?php echo lang('Publish')?>
                                    </a>
                                    <?php else: ?>
                                    <a href="/examination/assignments/unpublish/<?php echo $assignment->get_id(); ?>"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" class="btn btn-block" title="<?php echo lang('Unpublish') ?>">
                                        <span class="btn-label-icon left fa fa-bell-slash-o"></span>
                                        <?php echo lang('Unpublish')?>
                                    </a>
                                    <?php endif; ?>
                                    <?php endif; ?>

                                        <a href="/examination/assignments/delete/<?php echo (int)$assignment->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Delete') ?>"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction">
                                            <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                            <?php echo lang('Delete') ?>
                                        </a>
                                    <?php } ?>


                                    <?php if(!$assignment->check_end() && $assignment->get_semester_id()==Orm_Semester::get_current_semester()->get_id()): ?>
                                    <?php   if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')): ?>
                                    <a href="/examination/assignments/section_manage/<?php echo $assignment->get_id(); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Manage').' '.lang('Sections')?>">
                                        <span class="btn-label-icon left fa fa-bullhorn"></span>
                                        <?php echo lang('Manage').' '.lang('Sections')?>
                                    </a>
                                    <?php   endif; ?>
                                    <?php endif; ?>


                                    <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')): ?>
                                    <a href="/examination/assignments/view_exam/<?php echo (int)$assignment->get_id(); ?>" class="btn btn-block" title="<?php echo lang('View') ?>">
                                        <span class="btn-label-icon left fa fa-eye" aria-hidden="true"></span>
                                        <?php echo lang('View') ?>
                                    </a>
                                    <?php endif; ?>
                                    <?php if($attch = $assignment->get_attachment()): ?>
                                        <a href="<?php echo $attch ?>" class="btn btn-block" title="<?php echo lang('View File') ?>">
                                            <span class="btn-label-icon left fa fa-download"></span>
                                            <?php echo lang('View File') ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if(!$assignment->can_edit()){ ?>

                                        <?php if($assignment->get_semester_id() == Orm_Semester::get_current_semester()->get_id()): ?>
                                        <?php if(
                                                Orm_User::get_logged_user_id() ==  $assignment->get_teacher_id()
                                             && Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')
                                             && $assignment->get_end(true)<time()
                                        ): ?>
                                            <a href="/examination/correction/students/<?php echo (int)$assignment->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Correction') ?>">
                                                <span class="btn-label-icon left fa fa-check" aria-hidden="true"></span>
                                                <?php echo lang('Correction') ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if($assignment->get_total_question_marks() == $assignment->get_fullmark() && $assignment->get_fullmark()):?>
                                        <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-report')): ?>
                                        <a href="<?php echo base_url('/examination/report/show/'. intval($assignment->get_id())) ?>" class="btn btn-block" title="<?php echo lang('View') ?>">
                                            <span class="btn-label-icon left fa fa-pie-chart" aria-hidden="true"></span>
                                            <?php echo lang('Report') ?>
                                        </a>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    <?php } ?>


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
</div>