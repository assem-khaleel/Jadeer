<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/4/16
 * Time: 6:49 PM
 */
/** @var string $type */
/** @var Orm_Program $programs */

$type = isset($type) ? $type : '';
?>
<div id="positionProgram" class="m-t-1">
    <div class="alert alert-primary no-print text-center m-a-0">
        <strong><?php echo  lang("College").': '. htmlfilter($programs->get_department_obj()->get_college_obj()->get_name()); ?> </strong><br />
        <strong><?php echo  lang("Program").': '. htmlfilter($programs->get_name()); ?> </strong>
    </div>
</div>

<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY],false, 'program_tree-manage')) { ?>
    <li <?php echo ($type == 'edit' ? 'class="active"' : ''); ?>>
        <a href="/program_tree/edit/<?php echo $id?>" class="p-y-1" title="<?php echo lang('Manage').' '.lang('Tree'); ?>">
            <?php echo lang('Manage').' '.lang('Tree'); ?>
        </a>
    </li>
    <?php } ?>

    <li <?php echo ($type == 'view' ? 'class="active"' : ''); ?>>
        <a href="/program_tree/view/<?php echo $id?>" class="p-y-1" title="<?php echo lang('View').' '.lang('Tree'); ?>">
            <?php echo lang('View').' '.lang('Tree'); ?>
        </a>
    </li>
</ul>