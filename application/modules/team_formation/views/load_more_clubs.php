
<?php
    if(isset($clubs)){
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
                                onclick="location.href = '/team_formation/delete_club/<?php echo intval($club->get_id()) ?>';">
                           <i class="fa fa-trash-o" title=" <?php echo lang('Delete') ?>"></i>
                        </button>
                    </span>
                  </div>
                </span>
              </span>
        </a>
        <a href="#" class="widget-products-title text-default font-size-20 text-center">
            <i title=" <?php echo htmlfilter($club->get_name()); ?>">
                <?php echo strlen($club->get_name()) < 10 ? htmlfilter($club->get_name()) : htmlfilter(substr($club->get_name(), 0, 10)) . '...';
                ?>
            </i>
        </a>
    </div>
<?php }
    }elseif (isset($clubs_to_join)){
        foreach ($clubs_to_join as $club) { ?>
        <div class="widget-products-item col-lg-2 col-md-2 col-sm-4 col-xs-12" style="">
            <a href="#" class="widget-products-image">
                <img style=" min-height: 146.8px;"  src="<?php echo $club->get_club()->get_logo() ?: '/assets/jadeer/img/club/user_logo.png' ?>">
                <span class="widget-products-overlay inverted">
                    <span class="widget-products-overlay-content-middle">
                      <div class="widget-products-overlay-content-inner">
                        <span class="col-xs-6 p-l-3"><button type="button"
                                                             onclick="location.href = '/team_formation/club_info/';"
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
                <p style="text-align: center;"><?php echo Orm_User::get_instance($club->get_user_id())->get_full_name()." ".lang('Request to join'); ?></p>
                <a href="#" class="widget-products-title text-default font-size-18 text-center">
                    <i title=" <?php echo htmlfilter($club->get_club()->get_name()); ?>">
                        <?php echo strlen($club->get_club()->get_name()) < 10 ? htmlfilter($club->get_club()->get_name()) : htmlfilter(substr($club->get_club()->get_name(), 0, 10)) . '...';
                        ?>
                    </i>
                </a>
            </div>
        </div>
    <?php }
    }
?>