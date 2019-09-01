<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 7/10/17
 * Time: 11:36 AM
 * * /** @var $club Orm_Tf_Club
 * * /** @var $allPosts Orm_Tf_Post
 */
?>
<style>
    .userImage {
        border-radius: 50%;
        height: 50px;
        width: 50px;
    }
</style>
<div class="px-content" style="padding: 20px 20px 0 20px;">
    <div class="page-header m-b-0 b-b-0 text-xs-center bg-default"
         style="background-image: url('<?php echo  ($club->get_cover() ?  : '/assets/jadeer/img/club/club_cover_dummy.jpeg'); ?>');height:300px;background-size: cover">
        <h1 class="m-b-1 p-t-4 font-size-28 font-weight-bold"><?php echo htmlfilter($club->get_name()); ?></h1><br>
        <span class="font-size-18 font-weight-semibold"><?php echo str_replace(["<p>", "</p>"]  , " " ,$club->get_description()); ?></span>

    </div>
    <div class="page-wide-block">
        <div class="box m-a-0 valign-middle border-radius-0 text-xs-center font-size-14">
            <ul class=" nav nav-tabs nav-justified">
                <li class="active">
                    <a href="#wallDiv" class="box-cell  p-x-1 p-y-2 text-white bg-info" data-toggle="tab">
                        <i class="fa fa-square">&nbsp <?php echo lang('Wall') ?></i></a></li>
                <li><a href="#memberDiv" class="box-cell  p-x-1 p-y-2 text-white bg-primary" data-toggle="tab"><i
                                class="fa fa-users">&nbsp <?php echo lang('Members') ?></i></a></li>
                <li><a href="#infoDiv" class="box-cell p-x-1 p-y-2 text-white bg-default" data-toggle="tab"><i
                                class="fa fa-info">&nbsp <?php echo lang('Info') ?></i></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="tab-content tab-content-bordered">
    <div class="tab-pane fade in active" id="wallDiv">
        <?php $approval_post = Orm_Tf_Club::get_one(['id'=>$club->get_id()]);

        if ($approval_post->get_approval_post() == Orm_Tf_Club::POST_BY_ANYONE):?>
            <a class="btn btn-block bg-success m-a-1"
               href="/team_formation/add_edit_post/<?php echo (int)$club->get_id(); ?>" data-toggle="ajaxModal"><span
                        class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add').' '.lang('Post'); ?></a>
        <?php  elseif ($approval_post->get_approval_post() == Orm_Tf_Club::POST_NEED_PERMISSION && Orm_Tf_User_Club::get_one(['user_id'=>Orm_User::get_logged_user_id(),'club_id'=>$club->get_id(),'is_admin'=>Orm_Tf_User_Club::USER_ADMIN])):?>
            <a class="btn btn-block bg-success m-a-1"
               href="/team_formation/add_edit_post/<?php echo (int)$club->get_id(); ?>" data-toggle="ajaxModal"><span
                        class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add').' '.lang('Post'); ?></a>
        <?php   elseif ($approval_post->get_approval_post() == Orm_Tf_Club::POST_ADMIN && Orm_Tf_User_Club::get_count(['user_id'=>Orm_User::get_logged_user_id(),'club_id'=>$club->get_id(),'is_admin'=>Orm_Tf_User_Club::USER_ADMIN]) || $approval_post->get_creator() == Orm_User::get_logged_user_id()):?>
            <a class="btn btn-block bg-success m-a-1"
               href="/team_formation/add_edit_post/<?php echo (int)$club->get_id(); ?>" data-toggle="ajaxModal"><span
                        class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add').' '.lang('Post'); ?></a>
        <?php
        endif;
        ?>

        <div class="widget-timeline widget-timeline-centered">
            <div class="widget-timeline-section font-weight-semibold bg-primary"><?php echo lang('Now');?></div>
            <?php foreach ($allPosts as $onePost) { /** $onePost Orm_Tf_Post*/?>

                <div class="widget-timeline-item <?php
                if ($onePost->get_id() % 2 == 0) {
                    echo "left";
                } else {
                    echo "right";
                } ?>">
                    <div class="widget-timeline-info">
                        <div class="widget-timeline-bullet bg-primary"></div>
                        <div class="widget-timeline-time bg-primary"><?php echo date("H:i:s", strtotime($onePost->get_date_created())); ?></div>
                    </div>
                    <div class="panel">
                        <?php if($onePost->get_creator() == Orm_User::get_logged_user_id() || $club->get_creator() == Orm_User::get_logged_user_id()): ?>
                        <a class="btn btn-sm pull-right" data-toggle="deleteAction"
                           href="/team_formation/delete/<?php echo (int)$onePost->get_id() ?>"><span
                                    class="fa fa-remove"></span></a>
                            <a class="btn btn-sm pull-right" style="margin-right: 1%;" href="/team_formation/add_edit_post/<?php echo (int)$club->get_id(); ?>/<?php echo (int)$onePost->get_id() ?>"
                               data-toggle="ajaxModal">
                                <span class="fa fa-edit">
                            </a>
                        <?php endif; ?>
                        <div class="panel-body">
                            <div>
                                <img class = "userImage" src="<?php echo Orm_User::get_instance($onePost->get_creator())->get_avatar(); ?>">
                                <span style="margin-left: 2%;"><b><?php echo Orm_User::get_instance($onePost->get_creator())->get_full_name(); ?></b></span>
                            </div>

                            <br>
                            <br>
                            <p><?php echo $onePost->get_content(); ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>

    <div class="tab-pane fade in " id="memberDiv">
        <div class="table-primary">
            <div class="table-header">
                <div class="table-caption m-b-1">
                    <?php echo $club->get_name(). ' ' . lang('Members') ; ?>
                </div>
            </div>
            <?php if (!empty($members)) { ?>
                <div class="table-responsive m-a-0">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-lg-3"><?php echo lang('Member Name'); ?></th>
                            <th class="col-lg-3"><?php echo lang('Member Type'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($members as $member) { ?>
                            <?php $member_info = Orm_User::get_instance($member->get_user_id()); ?>
                            <tr>
                                <td>
                                    <img class = "userImage" src="<?php echo $member_info->get_avatar(); ?>">
                                    <span style="text-align: center;"><?php echo $member_info->get_full_name(); ?></span>
                                    <br>
                                    <?php if($member->get_is_admin() == Orm_Tf_User_Club::USER_ADMIN): ?>
                                        <span class="label label-primary"><?php echo lang('Admin');?></span>
                                    <?php endif; ?>
                                </td>

                                <td>
                            <span
                                    class="font-weight-bold"><?php echo lang($member_info->get_class_type())?></span>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($pager) { ?>
                    <div class="table-footer">
                    <div class="table-footer">
                        <?php echo $pager ?>
                    </div>
                <?php } ?>
            <?php } else {?>
                <tr>
                    <td colspan="4">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('members in this club'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>


        </div>

    </div>

    <div class="tab-pane fade in " id="infoDiv">

        <h3 class="p-t-4 text-xs-center"><?php echo lang('Club Creator');?></h3>
        <?php $creator_info = Orm_User::get_instance($club->get_creator()); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel box">
                    <div class="page-about-us-team-avatar box-cell p-y-3 p-l-3 valign-middle" style="width: 20%;">
                        <img src="<?php echo $creator_info->get_avatar(); ?>" width="150px" height="200px" alt=""
                             class="border-round">
                    </div>
                    <div class="box-cell p-y-2 p-x-3 valign-top" style="padding-top: 4% !important;">
                        <div class="font-size-14"><strong><?php echo $creator_info->get_full_name(); ?></strong></div>
                        <p class="text-muted font-size-11 font-weight-semibold"><?php echo lang($creator_info->get_class_type()); ?></p>
                        <p>
                            <?php echo $creator_info->get_about_me();?>
                    </div>
                </div>
            </div>
        </div>
        <h3 class=" text-xs-center"><?php echo lang('The club policies');?></h3>
        <div class="row">
            <div class="col-md-12">
                <div class="panel box">
                    <p>
                        <?php echo $club->get_policies(); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.acceptMember').click(function () {
        $.get('/team_formation/accept_member', {
            'user_id': $(this).parent().parent().find('#user_id').val(),
            'club_id': $(this).parent().parent().find('#club_id').val()
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
    $('.deleteMember').click(function () {
        $.get('/team_formation/delete_member', {
            'user_id': $(this).parent().parent().find('#user_id').val(),
            'club_id': $(this).parent().parent().find('#club_id').val()
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>