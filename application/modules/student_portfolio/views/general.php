<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/16/17
 * Time: 1:48 PM
 */
?>
<div class="row list-group-demo">
    <div class="col-sm-12">
        <ul class="list-group">
            <?php if (!empty($user->get_email())) : ?>
                <li class="list-group-item">
                    <label class="control-label"><?php echo lang('Email'); ?> : </label>
                    <?php echo htmlfilter($user->get_email()); ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($user->draw_demographics())) : ?>
                <form class="form-horizontal">
                <li class="list-group-item">
                    <label class="control-label margin-sm"><?php echo lang('Information'); ?> : </label>
                    <?php echo $user->draw_demographics(); ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($user->get_birth_date()) && $user->get_birth_date()) : ?>
                <li class="list-group-item">
                    <label class="control-label"><?php echo lang('Birth Date'); ?> : </label>
                    <?php echo htmlfilter($user->get_birth_date()); ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($user->get_phone())) : ?>
                <li class="list-group-item">
                    <label class="control-label"><?php echo lang('Phone Number'); ?> : </label>
                    <?php echo htmlfilter($user->get_phone()); ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($user->get_fax_no())) : ?>
                <li class="list-group-item">
                    <label class="control-label"><?php echo lang('Fax Number'); ?> : </label>
                    <?php echo htmlfilter($user->get_fax_no()); ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($user->get_address())) : ?>
                <li class="list-group-item">
                    <label class="control-label"><?php echo lang('Address'); ?> : </label>
                    <?php echo htmlfilter($user->get_address()); ?>
                </li>
                </form>
            <?php endif; ?>
        </ul>
    </div>
</div>
