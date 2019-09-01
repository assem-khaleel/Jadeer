<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/4/16
 * Time: 6:49 PM
 */
/** @var string $type */
$type = isset($type) ? $type : '';

?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php if ( !Orm_User::check_credential(array(Orm_User::USER_STUDENT), TRUE)):?>

    <li <?php echo($type == 'settings' ? 'class="active"' : ''); ?>>
        <a href="/award_management/" class="p-y-1" title="<?php echo lang('Settings'); ?>">
            <?php echo lang('Award Settings'); ?>
        </a>
    </li>
    <?php endif ?>

        <li <?php echo($type == 'winner' ? 'class="active"' : ''); ?>>
            <a href="/award_management/winner" class="p-y-1" title="<?php echo lang('Winner'); ?>">
                <?php echo lang('Award Winner'); ?>
            </a>
        </li>

        <li <?php echo($type == 'candidate' ? 'class="active"' : ''); ?>>
            <a href="/award_management/candidate" class="p-y-1" title="<?php echo lang('Candidate'); ?>">
                <?php echo lang('Award Candidate'); ?>
            </a>
        </li>
</ul>