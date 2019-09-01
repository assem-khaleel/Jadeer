<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo  lang("Exams, Assignments and Quizzes") ?></span>
        <?php if($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){?>
            <a class="btn btn-sm pull-right"  href="/portfolio_course/assignment/addEditAssignment/<?php echo $level?>?id=<?php echo $course_id?>" data-toggle="ajaxModal" >
                <span class="btn-label-icon left fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add') ?>
            </a>
        <?php }?>
    </div>
    <table class="table table-striped table-bordered" border="0">
        <thead>
        <tr>
            <th><?php echo lang('Title') ?></th>
            <th><?php echo lang('Description') ?></th>
            <th><?php echo lang('type') ?></th>
            <th class="col-md-1"><?php echo lang('Start date') ?></th>
            <th class="col-md-1"><?php echo lang('End date') ?></th>
            <th class="col-md-2"><?php echo lang('Attachment') ?></th>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){ ?>
                <th class="col-md-2"><?php echo lang('Action') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if($assignments):
            if(count($assignments))
                foreach ($assignments as $assignment) {?>
                    <?php /* @var $assignment Orm_Pc_Assignment*/ ?>
                    <tr>
                        <td><?php echo  htmlfilter($assignment->get_title()) ?></td>
                        <td><?php echo  htmlfilter($assignment->get_description()) ?></td>
                        <td><?php echo  lang($assTypes[$assignment->get_type()]) ?></td>
                        <td><?php echo  $assignment->get_start_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($assignment->get_start_date())) ?> </td>
                        <td><?php echo  $assignment->get_end_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($assignment->get_end_date())) ?> </td>
                        <td>
                            <?php if($assignment->get_file_path()): ?>
                            <a href="/portfolio_course/assignment/download/<?php echo intval($assignment->get_id()) ?>/<?php echo $level ?>/assignment?id=<?php echo $course_id?>"
                               target="_blank" class="btn btn-block btn-sm pull-right"><i class="btn-label-icon left fa fa-download"></i><?php echo lang('Download') ?></a>
                            <?php endif; ?>
                        </td>
                        <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){ ?>
                            <td>
                                <a class="btn btn-sm btn-block" href="/portfolio_course/assignment/addEditAssignment/<?php echo $level?>/<?php echo intval($assignment->get_id()) ?>?id=<?php echo $course_id?>" data-toggle="ajaxModal" >
                                    <span class="btn-label-icon left fa fa-pencil-square-o" aria-hidden="true"></span><?php echo lang('Edit') ?>
                                </a>
                                <a class="btn btn-sm btn-block" href="/portfolio_course/assignment/deleteAssignment/<?php echo $level?>/<?php echo intval($assignment->get_id()) ?>?id=<?php echo $course_id?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" >
                                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                    <?php echo lang('Delete') ?>
                                </a>
                            </td>
                        <?php } ?>

                    </tr>
                <?php } ?>
        <?php else:?>
            <tr>
                <td colspan="7">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
<?php echo lang('There are no') . ' ' . lang('Exams, Assignments and Quizzes'); ?>
                        </h3>
                    </div>
                </td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
    <div class="table-footer"></div>
</div>