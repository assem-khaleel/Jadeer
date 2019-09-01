<?php

/** @var string $type */
$type = isset($type) ? $type : '';
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <li <?php echo ($type == 'course_evaluation' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/portfolio_course/course_evaluation?id=<?php echo $id?>" title="<?php echo lang('Evaluation'); ?>">
            <?php echo lang('Course Evaluation'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'syllabus' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/portfolio_course/syllabus?id=<?php echo $id?>" title="<?php echo lang('Syllabus'); ?>">
            <?php echo lang('Syllabus'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'teaching_material' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/portfolio_course/teaching_material?id=<?php echo $id?>" title="<?php echo lang('Teaching Materials'); ?>">
            <?php echo lang('Teaching Materials'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'support_material' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/portfolio_course/support_material?id=<?php echo $id?>" title="<?php echo lang('Support Materials'); ?>">
            <?php echo lang('Support Materials'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'assignment' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/portfolio_course/assignment?id=<?php echo $id?>" title="<?php echo lang('Assignments'); ?>">
            <?php echo lang('Assignments'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'student_work' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/portfolio_course/student_work?id=<?php echo $id?>" title="<?php echo lang('Student Work'); ?>">
            <?php echo lang('Student Work'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'reporting' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/portfolio_course/reporting?id=<?php echo $id?>" title="<?php echo lang('Reporting'); ?>">
            <?php echo lang('Reporting'); ?>
        </a>
    </li>
</ul>