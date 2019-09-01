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
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-2">
    <li <?php echo($type == 'personal' ? 'class="active"' : ''); ?>>
        <a href="/training_management/" class="p-y-1" title="<?php echo lang('Personal'); ?>">

            <?php
            if(Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){
                echo lang('General Training');
            }else{
                echo lang('Personal Training');
            }

            ?>
        </a>
    </li>
    <?php if(!Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){?>
        <li <?php echo($type == 'general' ? 'class="active"' : ''); ?>>
            <a href="/training_management/training_general" class="p-y-1" title="<?php echo lang('General'); ?>">
                <?php echo lang('General Training'); ?>
            </a>
        </li>
    <?php } ?>

</ul>