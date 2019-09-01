<?php

/** @var string $type */
$type = isset($type) ? $type : '';
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <li <?php echo ($type == 'exam' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination" title="<?php echo lang('Exam'); ?>">
            <?php echo lang('Exam'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'exam_bank' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination/examination_bank" title="<?php echo lang('Examination Bank'); ?>">
            <?php echo lang('Examination Bank'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'quiz' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination/quiz" title="<?php echo lang('Quiz'); ?>">
            <?php echo lang('Quiz'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'assignment' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination/assignments" title="<?php echo lang('Assignment'); ?>">
            <?php echo lang('Assignment'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'assignment_bank' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination/assignment_bank" title="<?php echo lang('Assignments Bank'); ?>">
            <?php echo lang('Assignment Bank'); ?>
        </a>
    </li>
    <li <?php echo ($type == 'question_bank' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination/question_bank" title="<?php echo lang('Question Bank'); ?>">
            <?php echo lang('Question Bank'); ?>
        </a>
    </li>

    <li <?php echo ($type == 'proctor' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="/examination/proctor" title="<?php echo lang('Student Attendees'); ?>">
            <?php echo lang('Student Attendees'); ?>
        </a>
    </li>

    <?php /* if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], true, 'examination-report')): ?>
    <li <?php echo ($type == 'report' ? 'class="active"' : ''); ?>>
        <a class="p-y-1" href="#" title="<?php echo lang('Report'); ?>">
            <?php echo lang('Report'); ?>
        </a>
    </li>
    <?php endif;*/ ?>
</ul>