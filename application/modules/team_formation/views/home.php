<?php
/** @var $clubs Orm_Tf_Club[] */
?>
<form action="/team_formation/index/" method="GET">
    <div class="row">
        <div class="col-md-12">
            <h4 class=""><?php echo lang('My Clubs'); ?></h4>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group input-group-lg p-y-3">
                    <input type="text" name="text_my_club" class="form-control"
                           value="<?php echo $text_my_club ?: '' ?>"
                           placeholder="<?php echo lang('Search In My Club'); ?>...">
                <span class="input-group-btn">
                  <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </span>
                </div>

            </div>
        </div>
        <?php if (!$clubs) { ?>
            <div class="list-group-item" style="overflow: auto;">
                <div class="well well-md m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('club created'); ?></h3>
                </div>
            </div>
        <?php }else{
            foreach ($clubs as $club) { ?>
                    <div class="widget-products-item col-lg-2 col-md-2 col-sm-4 col-xs-12" style="">
                        <a href="#" class="widget-products-image">
                            <img style=" min-height: 146.8px;"  src="<?php echo $club->get_logo() ?: '/assets/jadeer/img/club/user_logo.png' ?>">
                            <span class="widget-products-overlay inverted">
                <span class="widget-products-overlay-content-middle">
                  <div class="widget-products-overlay-content-inner">
                    <span class="col-xs-6 p-l-3">
                        <button type="button" class="btn btn-lg btn-block p-x-0 b-a-0"
                                onclick="location.href = '/team_formation/club_info/<?php echo intval($club->get_id()) ?>'">
                        <i class="fa fa-eye" title=" <?php echo lang('Detail') ?>"></i>
                        </button>
                    </span>
                    <span class="col-xs-6 p-r-3">
                        <button type="button" class="btn btn-lg btn-primary btn-block p-x-0 b-a-0"
                                onclick="location.href = '/team_formation/delete_club/<?php echo intval($club->get_id()) ?>/true';">
                           <i class="fa fa-trash-o" title=" <?php echo lang('Delete') ?>"></i>
                        </button>
                    </span>
                  </div>
                </span>
              </span>
                        </a>
                        <a href="#" class="widget-products-title text-default font-size-18 text-center">
                            <i title=" <?php echo htmlfilter($club->get_name()); ?>">
                                <?php echo strlen($club->get_name()) < 10 ? htmlfilter($club->get_name()) : htmlfilter(substr($club->get_name(), 0, 10)) . '...';
                                ?>
                            </i>
                        </a>
                    </div>
                <?php } ?>
            <?php if($count_clubs > 5) {?>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" >
                    <div id="view_more">
                        <div class="panel box">
                            <div class="box-row">
                                <div class="box-cell col-sm-4 p-a-3 valign-middle" id="view_more_info">
                                    <a href="/team_formation/load_more_club/<?php echo Orm_Tf_User_Club::CLUB_FOR_ME?>" class="font-size-16">
                                        <i class="fa fa-eye"></i>&nbsp;&nbsp;<strong><?php echo lang('View all'); ?></strong>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>

        <?php } ?>

        <div class="clearfix"></div>
        <div class="col-md-12">
            <h4><?php echo lang('Member in clubs'); ?></h4>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group input-group-lg p-y-3">
                    <input type="text" name="text_Member_club" class="form-control"
                           value="<?php echo $text_Member_club ?: '' ?>"
                           placeholder="<?php echo lang('Search In Subscribe Club'); ?>...">

                    <span class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-search"></i></button>
        </span>
                </div>
            </div>
        </div>
        <?php if (!$memberClubs) { ?>
            <div class="list-group-item" style="overflow: auto;">
                <div class="well well-md m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('clubs to join'); ?></h3>
                </div>
            </div>

        <?php }else{
            foreach ($memberClubs as $club) { /** @var $club Orm_Tf_Club */ ?>
                    <div class="widget-products-item col-lg-2 col-md-2 col-sm-4 col-xs-12" style="">
                        <a href="#" class="widget-products-image">
                            <img style=" min-height: 146.8px;"  src="<?php echo $club->get_logo() ?: '/assets/jadeer/img/club/user_logo.png' ?>">
                            <span class="widget-products-overlay inverted">
                <span class="widget-products-overlay-content-middle">
                  <div class="widget-products-overlay-content-inner">
                    <span class="col-xs-6 p-l-3">
                        <button type="button" class="btn btn-lg btn-block p-x-0 b-a-0"
                                onclick="location.href = '/team_formation/club_info/<?php echo intval($club->get_id());?>'">
                        <i class="fa fa-eye" title=" <?php echo lang('Detail') ?>"></i>
                        </button>
                    </span>
                    <span class="col-xs-6 p-r-3">
                        <button type="button" class="btn btn-lg btn-primary btn-block p-x-0 b-a-0"
                                onclick="location.href = '/team_formation/leave_club/<?php echo Orm_Tf_User_Club::get_one(['club_id' =>$club->get_id() , 'user_id' => Orm_User::get_logged_user_id()])->get_id(); ?>'">
                           <i class="fa fa-trash-o" title=" <?php echo lang('Leave Club') ?>"></i>
                        </button>
                    </span>
                  </div>
                </span>
              </span>
                        </a>
                        <a href="#" class="widget-products-title text-default font-size-18 text-center">
                            <i title=" <?php echo htmlfilter($club->get_name()); ?>">
                                <?php echo strlen($club->get_name()) < 10 ? htmlfilter($club->get_name()) : htmlfilter(substr($club->get_name(), 0, 10)) . '...';
                                ?>
                            </i>
                        </a>
                    </div>
                <?php } ?>
            <?php if($count_memberClubs > 5) {?>
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" >
                    <div id="view_more">
                        <div class="panel box">
                            <div class="box-row">
                                <div class="box-cell col-sm-4 p-a-3 valign-middle" id="view_more_info">
                                    <a href="/team_formation/load_more_club/<?php echo Orm_Tf_User_Club::CLUB_MEMEBER;?>" class="font-size-16">
                                        <i class="fa fa-eye"></i>&nbsp;&nbsp;<strong><?php echo lang('View all'); ?></strong>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <h4><?php echo lang('Invite to join clubs'); ?></h4>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group input-group-lg p-y-3">
                    <input type="text" name="text_invited_club" class="form-control"
                           value="<?php echo $text_invited_club ?: '' ?>"
                           placeholder="<?php echo lang('Search In Invite Club'); ?>...">

                <span class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-search"></i></button>

                </div>
                </span>
            </div>
        </div>
        <?php if (!$inviteClubs) { ?>
            <div class="list-group-item" style="overflow: auto;">
                <div class="well well-md m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('clubs you invited to'); ?></h3>
                </div>
            </div>
        <?php }else{
        foreach ($inviteClubs as $club) { /** @var $club Orm_Tf_Club*/ ?>
                <div class="widget-products-item col-lg-2 col-md-2 col-sm-4 col-xs-12" id="club_<?php echo $club->get_id();?>">
                    <a href="#" class="widget-products-image">
                        <img style=" min-height: 146.8px;"  src="<?php echo $club->get_logo() ?: '/assets/jadeer/img/club/user_logo.png' ?>">
                        <span class="widget-products-overlay inverted">
                <span class="widget-products-overlay-content-middle">
                  <div class="widget-products-overlay-content-inner">
                   <span class="col-xs-6 p-l-3"><button type="button"
                                                        onclick="location.href = '/team_formation/accept_member_invitation/<?php echo $club->get_id();?>'"
                                                        class="btn btn-lg btn-block p-x-0 b-a-0" style="font-size: 12px;"><?php echo lang('Accept'); ?></button>
                    </span>
                    <span class="col-xs-6 p-r-3"><button type="button"
                                                         onclick="location.href = '/team_formation/refuse_invitation/<?php echo $club->get_id();?>'"
                                                         class="btn btn-lg btn-primary btn-block p-x-0 b-a-0" style="font-size: 12px;"><?php echo lang('Decline'); ?></button>
                    </span>
                  </div>
                </span>
              </span>
                    </a>
                    <div class="list-group-item">
                        <p style="text-align: center;"><?php echo Orm_User::get_instance($club->get_creator())->get_full_name() ." ". lang('Invite you to join'); ?> </p>
                        <a href="#" class="widget-products-title text-default font-size-18 text-center">
                            <i title=" <?php echo htmlfilter($club->get_name()); ?>">
                                <?php echo strlen($club->get_name()) < 10 ? htmlfilter($club->get_name()) : htmlfilter(substr($club->get_name(), 0, 10)) . '...';
                                ?>
                            </i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        <?php if($count_inviteClubs > 5) {?>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" >
                <div id="view_more">
                    <div class="panel box">
                        <div class="box-row">
                            <div class="box-cell col-sm-4 p-a-3 valign-middle" id="view_more_info">
                                <a href="/team_formation/load_more_club/<?php echo Orm_Tf_User_Club::CLUB_FOR_JOIN;?>" class="font-size-16">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;<strong><?php echo lang('View all'); ?></strong>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?>

        <div class="clearfix"></div>

        <div class="col-md-12">
            <h4><?php echo lang('Request to join clubs'); ?></h4>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group input-group-lg p-y-3">
                    <input type="text" name="text_Subscribe_club" class="form-control"
                           value="<?php echo $text_Subscribe_club ?: '' ?>"
                           placeholder="<?php echo lang('Search In Subscribe Club'); ?>...">

                <span class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-search"></i></button>

        </span>
                </div>
            </div>
        </div>
        <?php if (!$subscribeClubs) { ?>
            <div class="list-group-item" style="overflow: auto;">
                <div class="well well-md m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('clubs you requested to join'); ?></h3>
                </div>
            </div>
        <?php }else{
        foreach ($subscribeClubs as $club) {  /** @var $club  Orm_Tf_User_Club*/ ?>
                <div class="widget-products-item col-lg-2 col-md-2 col-sm-4 col-xs-12" style="">
                    <a href="#" class="widget-products-image">
                        <img style=" min-height: 146.8px;"  src="<?php echo $club->get_club()->get_logo() ?: '/assets/jadeer/img/club/user_logo.png' ?>">
                        <span class="widget-products-overlay inverted">
                <span class="widget-products-overlay-content-middle">
                  <div class="widget-products-overlay-content-inner">
                    <span class="col-xs-6 p-l-3"><button type="button"
                                                         onclick="location.href = '/team_formation/accept_member/<?php echo $club->get_id(); ?>';"
                                                         class="btn btn-lg btn-block p-x-0 b-a-0" style="font-size: 12px;"><?php echo lang('Accept') ?></button>
                    </span>
                    <span class="col-xs-6 p-r-3"><button type="button"
                                                         class="btn btn-lg btn-primary btn-block p-x-0 b-a-0 joinClub" style="font-size: 12px;"><?php echo lang('Decline') ?></button>
                    </span>

                  </div>
                </span>
              </span>
                    </a>

                    <div class="list-group-item">
                        <p style="text-align: center;"><?php echo Orm_User::get_instance($club->get_user_id())->get_full_name()." ".lang('Request to join clubs'); ?></p>
                        <a href="#" class="widget-products-title text-default font-size-18 text-center">
                            <i title=" <?php echo htmlfilter($club->get_club()->get_name()); ?>">
                                <?php echo strlen($club->get_club()->get_name()) < 10 ? htmlfilter($club->get_club()->get_name()) : htmlfilter(substr($club->get_club()->get_name(), 0, 10)) . '...';
                                ?>
                            </i>
                        </a>
                    </div>

                </div>
        <?php } ?>
        <?php if($count_subscribeClubs > 5) {?>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12" >
                <div id="view_more">
                    <div class="panel box">
                        <div class="box-row">
                            <div class="box-cell col-sm-4 p-a-3 valign-middle" id="view_more_info">
                                <a href="/team_formation/load_more_club/<?php echo Orm_Tf_User_Club::CLUB_SUBSCRIBE;?>" class="font-size-16">
                                    <i class="fa fa-eye"></i>&nbsp;&nbsp;<strong><?php echo lang('View all'); ?></strong>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php }
        } ?>


        <div class="col-md-12">
            <h4><?php echo lang('Most active clubs'); ?></h4>
            <hr>
        </div>
        <div class="row"></div>
        <?php if (!$activeClubs) { ?>
            <div class="list-group-item" style="overflow: auto;">
                <div class="well well-md m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Most active clubs'); ?></h3>
                </div>
            </div>

        <?php }else{
            $tempArr = [];
            foreach ($activeClubs as $club) /** @var $club Orm_Tf_Post*/ { ?>
                <?php if(!in_array($club->get_club_id() ,$tempArr )): ?>
                    <div class="widget-products-item col-lg-2 col-md-2 col-sm-4 col-xs-12" style="">
                        <a href="#" class="widget-products-image">
                            <img style=" min-height: 146.8px;"  src="<?php echo $club->get_club()->get_logo() ?: '/assets/jadeer/img/club/user_logo.png' ?>">
                            <span class="widget-products-overlay inverted">
                <span class="widget-products-overlay-content-middle">
                  <div class="widget-products-overlay-content-inner">
                    <span class="col-xs-6 p-l-3" style="margin-left: 23%;">
                        <button type="button" class="btn btn-lg btn-block p-x-0 b-a-0"
                                onclick="location.href = '/team_formation/club_info/<?php echo intval($club->get_club()->get_id()) ?>'">
                        <i class="fa fa-eye" title=" <?php echo lang('Detail') ?>"></i>
                        </button>
                    </span>
                  </div>
                </span>
              </span>
                        </a>
                        <div class="list-group-item">
                            <p style="text-align: center;"><?php echo lang('Last post at')." ".$club->get_date_created(); ?></p>
                            <a href="#" class="widget-products-title text-default font-size-18 text-center">
                                <i title=" <?php echo htmlfilter($club->get_club()->get_name()); ?>">
                                    <?php echo strlen($club->get_club()->get_name()) < 10 ? htmlfilter($club->get_club()->get_name()) : htmlfilter(substr($club->get_club()->get_name(), 0, 10)) . '...';
                                    ?>
                                </i>
                            </a>
                        </div>
                    </div>
            <?php
             endif;
                $tempArr[] = $club->get_club_id();
            }
        } ?>

</form>
<script type="text/javascript">
    $('.joinClub').click(function () {
        $.get('/team_formation/join_club', {
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

<style>

    #view_more{
        background-color: rgb(77, 87, 98);
        height:150px;
        display:inline-table;
        text-align: center;
        vertical-align: middle;
    }

    #view_more_info a{
        color:white;
    }

    #view_more_info:hover{
        background-color:rgb(143, 143, 143);
        transition: background .3s;
    }

    /*#view_more_info:hover a{*/
      /*color:rgb(45, 53, 61);*/

    /*}*/

</style>