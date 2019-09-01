<?php
/**
 * Created by PhpStorm.
 * User: abdelqader osama
 * Date: 1/4/17
 * Time: 10:56 AM
 *
 */
$tab = isset($tab) ? $tab : 'details';
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <li <?php echo ($tab == 'details' ? 'class="active"' : ''); ?>>
        <a href="/meeting_minutes/details/<?php echo (int) $meeting->get_id();?>" class="p-y-1" title="<?php echo lang('Details'); ?>">
            <?php echo lang('Details'); ?>
        </a>
    </li>
<li <?php echo ($tab == 'objective' ? 'class="active"' : ''); ?>>
        <a href="/meeting_minutes/objective/<?php echo (int) $meeting->get_id();?>" class="p-y-1" title="<?php echo lang('Objectives'); ?>">
            <?php echo lang('Objectives'); ?>
        </a>
    </li>
    <li <?php echo ($tab == 'attendance' ? 'class="active"' : ''); ?>>
        <a href="/meeting_minutes/attendance/<?php echo (int) $meeting->get_id();?>" class="p-y-1" title="<?php echo lang('Attendance'); ?>">
            <?php echo lang('Attendance'); ?>
        </a>
    </li>
    <li <?php echo ($tab == 'agenda' ? 'class="active"' : ''); ?>>
        <a href="/meeting_minutes/agenda/<?php echo (int) $meeting->get_id();?>" class="p-y-1" title="<?php echo lang('Agenda'); ?>">
            <?php echo lang('Agenda'); ?>
        </a>
    </li>
    <li <?php echo ($tab == 'minutes' ? 'class="active"' : ''); ?>>
        <a href="/meeting_minutes/minutes/<?php echo (int) $meeting->get_id();?>" class="p-y-1" title="<?php echo lang('Meeting Minutes'); ?>">
            <?php echo lang('Meeting Minutes'); ?>
        </a>
    </li>
    <li <?php echo ($tab == 'action' ? 'class="active"' : ''); ?>>
        <a href="/meeting_minutes/action/<?php echo (int) $meeting->get_id();?>" class="p-y-1" title="<?php echo lang('Action'); ?>">
            <?php echo lang('Action'); ?>
        </a>
    </li>
    <li <?php echo ($tab == 'reference' ? 'class="active"' : ''); ?>>
        <a href="/meeting_minutes/reference/<?php echo (int) $meeting->get_id();?>" class="p-y-1" title="<?php echo lang('Reference'); ?>">
            <?php echo lang('Reference'); ?>
        </a>
    </li>
</ul>

<br>