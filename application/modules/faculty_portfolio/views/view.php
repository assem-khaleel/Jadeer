<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/6/16
 * Time: 2:54 PM
 */
/** @var Orm_User_Faculty $user */
/** @var Orm_User_Faculty[] $peers */
/** @var Orm_User_Faculty[] $managers */
?>
<style>
    .portfolio {
        border: 1px solid #e5e5e5;
        display: block;
        height: 300px;
        opacity: 0.8;
        overflow: hidden;
        padding: 10px;
        transition: all 1s ease 0s;
    }
    .portfolio .profile-photo {
        border-radius: 999999px;
        display: block;
        margin: 0 auto;
        padding: 6px;
        width: 150px;
    }
    .portfolio h3 {
        color: #333;
        display: block;
        margin: 0;
        padding-bottom: 0;
        padding-top: 15px;
        text-transform: capitalize;
    }
    .portfolio p {
        color: #999;
        display: block;
        font-size: 12px;
        line-height: 16px;
        margin-top: 0;
        max-height: 65px;
        overflow: hidden;
        padding-top: 15px;
    }
    .portfolio:hover {
        box-shadow: 0 0 25px #aaa;
        opacity: 1;
        transition: all 1s ease 0s;
    }
</style>

<div class="row list-group-demo">
    <div class="col-sm-12">
        <ul class="list-group form-horizontal">
            <?php if (!empty($user->get_email())) : ?>
                <li class="list-group-item">
                    <label class="control-label"><?php echo lang('Email'); ?> : </label>
                    <?php echo htmlfilter($user->get_email()); ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($user->draw_demographics())) : ?>
                <li class="list-group-item">
                    <label class="control-label"><?php echo lang('Information'); ?> : </label>
                    <?php echo $user->draw_demographics(); ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($user->get_birth_date()) && ($user->get_birth_date() != '0000-00-00')) : ?>
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
            <?php endif; ?>
        </ul>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading bg-primary no-border">
        <span class="panel-title m-a-0"><?php echo lang('Evaluate as Peer'); ?></span>
    </div>
    <div class="panel-body">
        <?php
        if(count($peers)==0) {
            echo lang('You have no evaluation requests.');
        }
        ?>
        <?php foreach ($peers as $peer) { ?>
            <div class="portfolio col-md-6 col-md-3-offset">
                <div class="profile-photo bg-primary">
                    <img class="img-circle img-responsive" src="<?php echo htmlfilter($peer->get_avatar()); ?>">
                </div>
                <div>
                    <h3 class="text-center">
                        <a href="/faculty_portfolio/profile/<?php echo intval($peer->get_id()); ?>"><?php echo htmlfilter($peer->get_full_name()); ?></a>
                    </h3>
                    <p class="text-center">
                        <?php echo htmlfilter($peer->get_about_me()); ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading bg-primary no-border">
        <span class="panel-title m-a-0"><?php echo lang('Evaluate as Manager'); ?></span>
    </div>
    <div class="panel-body">
        <?php
        if(count($managers)==0) {
            echo lang('You have no evaluation requests.');
        }
        ?>

        <?php foreach ($managers as $manager) { ?>
            <div class="portfolio col-md-6 col-md-3-offset">
                <div class="profile-photo bg-primary">
                    <img class="img-circle img-responsive" src="<?php echo htmlfilter($manager->get_avatar()); ?>">
                </div>
                <div>
                    <h3 class="text-center">
                        <a href="/faculty_portfolio/profile/<?php echo intval($manager->get_id()); ?>"><?php echo htmlfilter($manager->get_full_name()); ?></a>
                    </h3>
                    <p class="text-center">
                        <?php echo htmlfilter($manager->get_about_me()); ?>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
