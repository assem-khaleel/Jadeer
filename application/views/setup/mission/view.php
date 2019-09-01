<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/9/17
 * Time: 9:28 AM
 *
 * @var $object Orm_College
 */
?>
<div class="panel text-xs-center">
    <div class="panel-body">
        <p class="p-y-1"><i class="fa fa-bullseye font-size-46 line-height-1 text-primary"></i></p>
        <p><strong><?php echo lang('Mission'); ?></strong></p>
        <p class="m-b-4"> <?php echo htmlfilter($object->get_mission()); ?></p>
        <?php if (Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-mission')) { ?>
            <a href="/setup/mission_add_edit/<?php echo get_class($object) ?>/<?php echo intval($object->get_id()) ?>"
               data-toggle="ajaxModal" class="btn">
                <?php echo lang('Edit'); ?>
            </a>
        <?php } ?>
    </div>
</div>
