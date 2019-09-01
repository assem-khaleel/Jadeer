<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/6/16
 * Time: 10:09 PM
 */
/** @var Orm_Stp_Social $social */
/** @var int $user_id */
?>
<div class="box p-a-1 clearfix">
    <div class="pull-left">
        <b><?php echo lang('Social'); ?></b>
    </div>
    <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="pull-right">
            <a href="/student_portfolio/social_manage" data-toggle="ajaxModal" class="btn btn-sm "><i class="btn-label-icon left fa fa-gear"></i><?php echo lang('Manage')?></a>
        </div>
    <?php } ?>
</div>
<ul class="list-group">
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Facebook'); ?>: </label>
        <?php if($social->get_facebook()) { ?>
            <a href="<?php echo prep_url($social->get_facebook()) ?>" style="width: 100px;" class="btn  btn-sm pull-right btn-facebook" target="_blank"><i class="fa fa-facebook btn-label-icon left"></i><?php echo lang('Facebook'); ?></a>
        <?php } else { ?>
            <?php echo '-'; ?>
        <?php } ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Twitter'); ?>: </label>
        <?php if($social->get_tweeter()) { ?>
            <a href="<?php echo prep_url($social->get_tweeter()) ?>" style="width: 100px;" class="btn  btn-sm pull-right" target="_blank"><i class="fa fa-twitter btn-label-icon left"></i><?php echo lang('twitter'); ?></a>
        <?php } else { ?>
            <?php echo '-'; ?>
        <?php } ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('LinkedIn'); ?>: </label>
        <?php if($social->get_linkedin()) { ?>
            <a href="<?php echo prep_url($social->get_linkedin()) ?>" style="width: 100px;" class="btn  btn-sm pull-right" target="_blank"><i class="fa fa-linkedin btn-label-icon left"></i><?php echo lang('LinkedIn'); ?></a>
        <?php } else { ?>
            <?php echo '-'; ?>
        <?php } ?>
    </li>
</ul>
