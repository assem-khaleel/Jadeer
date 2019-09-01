<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 7/10/17
 * Time: 1:56 PM
 */
/** @var Orm_Tf_Club $result */
/** @var Orm_Tf_User_Club $userClub */
?>
<style>
    .request_to_join{
        width: 90% !important;
        padding-right: 0px !important;
    }
</style>
<div class="row el-element-overlay m-b-40">
    <div class="col-md-12">
        <h4><?php echo lang('Discover Club'); ?></h4>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="/team_formation/discover/" method="GET" class="input-group input-group-lg p-y-3">
                <input type="text" name="text" class="form-control" value="<?php echo $searchText ?>"
                       placeholder="<?php echo lang('Search For Club'); ?>...">
                <span class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-search"></i></button>
        </span>
            </form>
        </div>
    </div>
    <?php
    if (empty($results) && !empty($searchText)) { ?>
        <hr class="page-wide-block m-t-0 b-t-2">
        <div class="alert alert-default alert-dark">
                <h4 class="alert-heading"><?php echo lang('No results found for'); ?>
                    "<?php echo htmlfilter($searchText) ?>".</h4>
        </div>
    <?php } else { ?>
    <div class="tab-content p-y-0">
        <?php if (!empty($results)) {
            foreach ($results as $result) { ?>
                <div class="widget-products-item col-xs-12 col-sm-6 col-md-3 col-xl-2">
                    <a href="#" class="widget-products-image">
                        <img src="<?php echo $result->get_logo()?: '/assets/jadeer/img/club/user_logo.png' ?>" width="200px" height="200px">
                        <span class="widget-products-overlay inverted">
                <span class="widget-products-overlay-content-middle">
                  <div class="widget-products-overlay-content-inner">
                    <span class="col-xs-6 p-r-3 request_to_join">
                        <button type="button"
                         class="btn btn-lg btn-primary btn-block p-x-0 b-a-0 joinClub"><?php echo lang('Request to join clubs') ?>
                        </button>
                    </span>
                       <input type="hidden" value="<?php echo intval($result->get_id()) ?>" id="club_id">
                            <input type="hidden" value="" id="id">
                  </div>
                </span>

              </span>
                    </a>
                    <a href="#" class="widget-products-title"><?php echo strlen($result->get_name()) < 10 ? htmlfilter($result->get_name()) : htmlfilter(substr($result->get_name(), 0, 18)) . '...'//18 ?></a>
                    <div class="widget-products-footer text-muted">
                        <i class="fa fa-user "></i> <?php echo $result->countClub_members();?>

                        <i class="fa fa-comments p-l-1" style="padding-left: 95px !important;"></i> <?php echo $result->countClub_posts(); ?>
                    </div>
                </div>
            <?php }
        } else { ?>
            <tr>
                <td colspan="4">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('clubs to discover'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </div>
    <?php } ?>

</div>
<script type="text/javascript">
    $('.joinClub').click(function (e) {
        e.preventDefault();
        $.get('/team_formation/join_club', {
            'club_id': $('#club_id').val()
        }).done(function (success) {
           if(success.success){
               window.location.reload();
           }
        });
    });
</script>