<?php

/** @var string $type */
$type = isset($type) ? $type : '';
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <li <?php echo ($type == 'exam' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination/student_exam" title="<?php echo lang('Exam'); ?>">
            <?php echo lang('Exam'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'assignment' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination/student_assignment" title="<?php echo lang('Assignment'); ?>">
            <?php echo lang('Assignment'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'quiz' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination/student_quiz" title="<?php echo lang('Quiz'); ?>">
            <?php echo lang('Quiz'); ?>
        </a>
    </li>
</ul>