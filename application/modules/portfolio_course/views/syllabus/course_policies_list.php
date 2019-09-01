<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Grading") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">

                   <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($policy->get_id()) ?>?id=<?php echo $course_id; ?>&dataType=Grading"
                      data-toggle="ajaxModal" class="btn btn-sm  grading">
                       <span class="btn-label-icon left icon fa fa-pencil-square-o"
                             aria-hidden="true"></span> <?php echo $policy->get_grading() ? lang('Edit') : lang('Add') ?>
                   </a>
                   </span>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo htmlfilter($policy->get_grading()) ?>
        <?php if (empty($policy->get_grading())) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Grading Policies'); ?>
                </h3>
            </div>
        <?php } ?>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading vertical">
        <div class="panel-title">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Attendance") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                    <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($policy->get_id()) ?>?id=<?php echo $course_id; ?>&dataType=Attendance"
                       data-toggle="ajaxModal" class="btn btn-sm  grading">
                       <span class="btn-label-icon left icon fa fa-pencil-square-o"
                             aria-hidden="true"></span> <?php echo $policy->get_attendance()? lang('Edit'): lang('Add') ?>
                   </a>
                   </span>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo htmlfilter($policy->get_attendance()) ?>
        <?php if (empty($policy->get_attendance())) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Attendance Policies'); ?>
                </h3>
            </div>
        <?php } ?>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Lateness") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                   <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($policy->get_id()) ?>?id=<?php echo $course_id; ?>&dataType=Lateness"
                      data-toggle="ajaxModal" class="btn btn-sm  grading">
                       <span class="btn-label-icon left icon fa fa-pencil-square-o"
                             aria-hidden="true"></span> <?php echo $policy->get_lateness() ? lang('Edit') : lang('Add') ?>
                   </a>
                   </span>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo htmlfilter($policy->get_lateness()) ?>
        <?php if (empty($policy->get_lateness())) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Lateness Policies'); ?>
                </h3>
            </div>

        <?php } ?>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Class participation") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                   <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($policy->get_id()) ?>?id=<?php echo $course_id; ?>&dataType=participation"
                      data-toggle="ajaxModal" class="btn btn-sm  grading">
                       <span class="btn-label-icon left icon fa fa-pencil-square-o"
                             aria-hidden="true"></span> <?php echo $policy->get_class_participation() ? lang('Edit') : lang('Add') ?>
                   </a>
                   </span>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo htmlfilter($policy->get_class_participation()) ?>
        <?php if (empty($policy->get_class_participation())) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Class Participation Policies'); ?>
                </h3>
            </div>
        <?php } ?>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Missed Exam") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                    <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($policy->get_id()) ?>?id=<?php echo $course_id; ?>&dataType=MissedExam"
                       data-toggle="ajaxModal" class="btn btn-sm  grading">
                       <span class="btn-label-icon left icon fa fa-pencil-square-o"
                             aria-hidden="true"></span> <?php echo $policy->get_missed_exam() ? lang('Edit') : lang('Add'); ?>
                   </a>
                   </span>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo htmlfilter($policy->get_missed_exam()) ?>
        <?php if (empty($policy->get_missed_exam())) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Missed Exam Policies'); ?>
                </h3>
            </div>
        <?php } ?>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Missed Assignment") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                    <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($policy->get_id()) ?>?id=<?php echo $course_id; ?>&dataType=MissedAssignment"
                       data-toggle="ajaxModal" class="btn btn-sm  grading">
                       <span class="btn-label-icon left icon fa fa-pencil-square-o"
                             aria-hidden="true"></span> <?php echo $policy->get_missed_assignment() ? lang('Edit') : lang('Add') ?>
                   </a>
                   </span>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo htmlfilter($policy->get_missed_assignment()) ?>
        <?php if (empty($policy->get_missed_assignment())) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Missed Assignment Policies'); ?>
                </h3>
            </div>
        <?php } ?>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Academic dishonesty") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                    <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($policy->get_id()) ?>?id=<?php echo $course_id; ?>&dataType=dishonesty"
                       data-toggle="ajaxModal" class="btn btn-sm  grading">
                       <span class="btn-label-icon left icon fa fa-pencil-square-o"
                             aria-hidden="true"></span> <?php echo $policy->get_academic_dishonesty() ?  lang('Edit') : lang('Add') ?>
                   </a>
                   </span>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo htmlfilter($policy->get_academic_dishonesty()) ?>
        <?php if (empty($policy->get_academic_dishonesty())) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Academic Dishonesty Policies'); ?>
                </h3>
            </div>
        <?php } ?>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Academic plagiarism") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                    <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($policy->get_id()) ?>?id=<?php echo $course_id; ?>&dataType=plagiarism"
                       data-toggle="ajaxModal" class="btn btn-sm  grading">
                       <span class="btn-label-icon left icon fa fa-pencil-square-o"
                             aria-hidden="true"></span> <?php echo $policy->get_academic_plagiarism() ? lang('Edit') : lang('Add') ?>
                   </a>
                   </span>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <?php echo htmlfilter($policy->get_academic_plagiarism()) ?>
        <?php if (empty($policy->get_academic_plagiarism())) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Academic Plagiarism Policies'); ?>
                </h3>
            </div>
        <?php } ?>
    </div>
</div>