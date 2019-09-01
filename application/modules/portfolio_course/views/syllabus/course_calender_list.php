<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <?php echo lang("Topics") ?>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <a class="btn btn-sm  pull-right topic"
                   href="/portfolio_course/syllabus/edit/<?php echo $level; ?>?id=<?php echo $course_id; ?>"
                   data-toggle="ajaxModal">
                    <span class="btn-label-icon left icon fa fa-plus"
                          aria-hidden="true"> </span> <?php echo lang('Add') ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><?php echo lang('Topic Title') ?></th>
            <th><?php echo lang('Description') ?></th>
            <th><?php echo lang('Start date') ?></th>
            <th><?php echo lang('End date') ?></th>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <th class="col-md-2"><?php echo lang('Action') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $topics = Orm_Pc_Topic::get_all(['course_id' => $course_id]);
        if ($topics):
            foreach ($topics as $topic) {
                ?>
                <tr>
                    <?php /* @var $topic Orm_Pc_Topic */ ?>
                    <td><?php echo htmlfilter($topic->get_title()) ?> </td>
                    <td><?php echo htmlfilter($topic->get_description()) ?> </td>
                    <td><?php echo $topic->get_start_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($topic->get_start_date())) ?> </td>
                    <td><?php echo $topic->get_end_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($topic->get_end_date())) ?> </td>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                        <td>
                            <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($topic->get_id()) ?>?id=<?php echo $course_id; ?>"
                               data-toggle="ajaxModal" class="btn btn-sm btn-block">
                                <span class="btn-label-icon left icon fa fa-pencil-square-o"
                                      aria-hidden="true"></span> <?php echo lang('Edit') ?>
                            </a>
                            <a href="/portfolio_course/syllabus/delete/<?php echo $level ?>/<?php echo intval($topic->get_id()) ?>?id=<?php echo $course_id ?>"
                               class="btn btn-sm  btn-block" title="Delete"
                               message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction">
                                <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                <?php echo lang('Delete') ?>
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="5">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
                            <?php echo lang('There are no') . ' ' . lang('Topics'); ?>
                        </h3>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <?php echo lang("Exams, Assignments and Quizzes") ?>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><?php echo lang('Assignment Title') ?></th>
            <th><?php echo lang('Description') ?></th>
            <th><?php echo lang('type') ?></th>
            <th><?php echo lang('Start date') ?></th>
            <th><?php echo lang('End date') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $assignments = Orm_Pc_Assignment::get_all(['course_id' => $course_id]);
        if ($assignments):
            foreach ($assignments as $assignment) {
                ?>
                <tr>
                    <?php /* @var $assignment Orm_Pc_Assignment */ ?>
                    <td><?php echo htmlfilter($assignment->get_title()) ?> </td>
                    <td><?php echo htmlfilter($assignment->get_description()) ?> </td>
                    <td><?php echo $assignment->get_type() ?> </td>
                    <td><?php echo $assignment->get_start_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($assignment->get_start_date())) ?> </td>
                    <td><?php echo $assignment->get_end_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($assignment->get_end_date())) ?> </td>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="5">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
                            <?php echo lang('There are no') . ' ' . lang('Exams, Assignments and Quizzes'); ?>
                        </h3>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>