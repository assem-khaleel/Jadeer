
<div class="row">
    <div class="col-md-12">
        <?php if($clubs_stats == "My Clubs"):?>
        <h4 class=""><?php echo lang('View All'); ?> <?php echo lang('My Clubs'); ?></h4>
        <?php elseif($clubs_stats == "Invite Clubs"): ?>
        <h4><?php echo lang('View All'); ?> <?php echo lang('Invite Clubs'); ?></h4>
        <?php elseif($clubs_stats == "Subscribe Clubs"):?>
        <h4><?php echo lang('View All'); ?> <?php echo lang('Subscribe Clubs'); ?></h4>
        <?php else: ?>
        <h4><?php echo lang('View All'); ?> <?php echo lang('Member Clubs'); ?></h4>
        <?php endif;?>
        <hr>
    </div>
    <form action="/team_formation/load_more_club/<?php echo $current_status;?>" method="GET">
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group input-group-lg p-y-3">
                <input id="search_feild" type="text" name="text_my_club" class="form-control"
                       value="<?php echo $text_my_club ?: '' ?>"
                       placeholder="<?php echo lang('Search In My Club'); ?>...">
                <span class="input-group-btn">
                  <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </span>
            </div>

        </div>
    </div>
    </form>
    <?php if (!$clubs) { ?>
        <div class="list-group-item" style="overflow: auto;">
            <div class="well well-md m-a-0">
                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('club match your search'); ?></h3>
            </div>
        </div>
    <?php } else {?>
    <div id = "all_clubs">
    <?php
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
                    <?php if($current_status == 1) { ?>
                        <div class="list-group-item">
                            <p style="text-align: center;"><?php echo Orm_User::get_instance($club->get_creator())->get_full_name() ." ". lang('Invite you to join'); ?> </p>
                            <a href="#" class="widget-products-title text-default font-size-18 text-center">
                                <i title=" <?php echo htmlfilter($club->get_name()); ?>">
                                    <?php echo strlen($club->get_name()) < 10 ? htmlfilter($club->get_name()) : htmlfilter(substr($club->get_name(), 0, 10)) . '...';
                                    ?>
                                </i>
                            </a>
                        </div>
                    <?php } else { ?>
                    <a href="#" class="widget-products-title text-default font-size-20 text-center">
                        <i title=" <?php echo htmlfilter($club->get_name()); ?>">
                            <?php echo strlen($club->get_name()) < 10 ? htmlfilter($club->get_name()) : htmlfilter(substr($club->get_name(), 0, 10)) . '...';
                            ?>
                        </i>
                    </a>
                    <?php }?>
                </div>
        <?php } ?>
    </div>
</div>

            <div class="widget-timeline-centered">
                <div class="widget-timeline-section font-weight-semibold bg-primary" style="cursor: pointer;" id = "load_more">Load More...</div>
            </div>


    <?php } ?>
    <div class="clearfix"></div>
    <script>
        var num_of_page = 2;
        $('#load_more').on('click' , function (){
            var search_feild = $('#search_feild').val();
            $.get('/team_formation/get_more_clubs', {
                'page': num_of_page,
                'status' : <?php echo $current_status;?>,
                'search_feild' : search_feild
            }).done(function (result) {
                $('#all_clubs').append(result);
            });
            num_of_page ++;
        });
    </script>