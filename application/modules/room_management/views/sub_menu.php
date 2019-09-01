<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/4/16
 * Time: 6:49 PM
 */
/** @var string $type */
$type = isset($type) ? $type : '';
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <li <?php echo($type == 'room' ? 'class="active"' : ''); ?>>
        <a href="/room_management/" class="p-y-1" title="<?php echo lang('Rooms'); ?>">
            <?php echo lang('Room Management'); ?>
        </a>
    </li>

  <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), true, 'equipments-list')):?>
    <li <?php echo($type == 'equipment' ? 'class="active"' : ''); ?>>
        <a href="/room_management/equipments" class="p-y-1" title="<?php echo lang('Equipments'); ?>">
            <?php echo lang('Equipments'); ?>
        </a>
    </li>
    <?php endif ?>
</ul>