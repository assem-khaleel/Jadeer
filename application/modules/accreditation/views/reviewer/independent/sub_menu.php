<?php
$active_sub_menu = empty($active_sub_menu) ? 'institution' : $active_sub_menu;
?>
<ul class="nav nav-tabs page-block m-t-3 m-b-3 tab-resize-nav">
    <?php if ($is_admin || Orm_Acc_Independent_Reviewer::can_manege(Orm_Acc_Independent_Reviewer::TYPE_INSTITUTION)){ ?>
        <li <?php echo $active_sub_menu == 'institution' ? 'class="active"' : '' ?>>
            <a href="/accreditation/reviewer_independent/institution">
                <?php echo lang('Institution')?>
            </a>
        </li>
    <?php } ?>
    <?php if ($is_admin || Orm_Acc_Independent_Reviewer::can_manege(Orm_Acc_Independent_Reviewer::TYPE_PROGRAM)){ ?>
        <li <?php echo $active_sub_menu == 'program' ? 'class="active"' : '' ?>>
            <a href="/accreditation/reviewer_independent/program">
                <?php echo lang('Programs')?>
            </a>
        </li>
    <?php } ?>
</ul>