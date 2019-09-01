<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/6/16
 * Time: 2:54 PM
 */
/** @var Orm_User_Student[] $users */
/** @var string $pager */
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

<div class="note note-primary clearfix">
    <div class="pull-left">
        <button aria-controls="filters" aria-expanded="false" data-target="#filters" data-toggle="collapse" type="button" class="btn btn-sm collapsed">
            <span class="fa fa-filter"></span>
        </button>
        <?php echo lang('Search'); ?>
    </div>
</div>

<form class="form-horizontal">
    <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
        <div class="well">
            <?php
            echo Orm_User::draw_common_filters();
            echo Orm_User_Student::draw_filters();
            ?>

            <div class="clearfix">
                <a class="btn pull-left " href="/student_portfolio"><span class="btn-label-icon left"><i class="fa fa-recycle"></i></span><?php echo lang('Reset'); ?></a>
                <button class="btn pull-right " type="submit" <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-filter"></i></span><?php echo lang('Filters'); ?></button>
            </div>
        </div>
    </div>
</form>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="m-a-0"><?php echo lang('Student Portfolios'); ?></h2>
    </div>
    <div class="panel-body">
        <?php if($users) { ?>
            <?php foreach($users as $key => $user) { ?>
                <div class="portfolio col-md-3">
                    <div class="profile-photo bg-primary">
                        <img class="img-circle img-responsive" src="<?php echo htmlfilter($user->get_avatar()); ?>">
                    </div>
                    <div>
                        <h3 class="text-center">
                            <a href="/student_portfolio/profile/<?php echo intval($user->get_id()); ?>"><?php echo htmlfilter($user->get_full_name()); ?></a>
                        </h3>
                        <p class="text-center">
                            <?php echo htmlfilter($user->get_about_me()); ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <?php if($pager) { ?>
        <div class="panel-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
</div>