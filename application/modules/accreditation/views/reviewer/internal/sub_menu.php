<?php
$active_sub_menu = empty($active_sub_menu) ? 'institution' : $active_sub_menu;
?>
<ul class="nav nav-tabs page-block m-t-3 m-b-3 tab-resize-nav">
    <li <?php echo $active_sub_menu == 'institution' ? 'class="active"' : '' ?>>
        <a href="/accreditation/reviewer_internal/institution">
            <?php echo lang('Institution')?>
        </a>
    </li>
    <li <?php echo $active_sub_menu == 'program' ? 'class="active"' : '' ?>>
        <a href="/accreditation/reviewer_internal/program">
            <?php echo lang('Programs')?>
        </a>
    </li>
    <li <?php echo $active_sub_menu == 'course' ? 'class="active"' : '' ?>>
        <a href="/accreditation/reviewer_internal/course">
            <?php echo lang('Courses')?>
        </a>
    </li>
</ul>