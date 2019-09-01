<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/30/17
 * Time: 2:13 PM
 */

?>
<?php /** @var $award Orm_Wa_Award */ ?>
<h2 class='m-a-0'>
    <?php echo lang('Award Information'); ?>
</h2>
<hr>
<?php if (empty($award)) { ?>
    <div class="alert alert-primary">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Award has Entered'); ?>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
        <span class=" font-size-20">
            <?php echo lang('Award Name') . ': '; ?>
        </span>
            <span class=" font-size-20 text-capitalize">
            <?php echo htmlfilter($award->get_name()) ?>
        </span>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 text-center m-t-2 font-size-18">
            <?php echo lang('Level') . ' : '; ?>
            <span>
                   <?php
                   echo $award->get_level(true);
                   if ($award->get_level()) {
                       echo " ( " . htmlfilter($award->get_level_title()) . " )";
                   }
                   ?></span>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 text-center m-t-2 font-size-18">

            <?php echo lang('Award Date'); ?>
            <span
                class="label label-primary font-weight-bold"><?php echo htmlfilter(date('Y-m-d',strtotime($award->get_date()))); ?></span>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 m-b-1">
            <div class="panel panel-primary">
                <div class="box-row">
                    <div class="box-container">
                        <div class="box-cell p-a-3 valign-middle bg-primary">
                            <i class="box-bg-icon middle right font-size-29 ion-ios-people"></i>
                            <div class="font-size-14 font-weight-bold"><?php echo lang('Winner') ?></div>
                        </div>
                    </div>
                    <div class="row m-a-1">
                        <?php foreach ($award->get_winners() as $member) {
                            /* @var $member Orm_Wa_Winner_Award */ ?>
                            <div class="col-md-2 m-y-3">

                                <i class="fa fa-user text-muted"></i>
                                &nbsp;&nbsp;
                                <a>
                                    <strong class="text-default">
                                        <?php echo $member->get_user()->get_full_name(); ?>
                                    </strong>
                                </a>

                            </div>
                        <?php } ?>

                        <?php if (count($award->get_winners()) == 0) { ?>
                            <div class="alert alert-default">
                                <div class="m-b-1">
                                    <?php echo lang('There are no') . ' ' . lang('Winner for this award'); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 m-b-1">
            <div class="panel panel-primary">
                <div class="box-row">
                    <div class="box-container">
                        <div class="box-cell p-a-3 valign-middle bg-primary">
                            <i class="box-bg-icon middle right font-size-29 ion-ios-people"></i>
                            <div class="font-size-14 font-weight-bold"><?php echo lang('Candidates') ?></div>
                        </div>
                    </div>
                    <div class="row m-a-1">
                        <?php foreach ($award->get_candidates() as $member) {
                            /* @var $member Orm_Wa_Candidate_User */ ?>
                            <div class="col-md-2 m-y-3">

                                <i class="fa fa-user text-muted"></i>
                                &nbsp;&nbsp;
                                <a>
                                    <strong class="text-default">
                                        <?php echo $member->get_user()->get_full_name(); ?>
                                    </strong>
                                </a>

                            </div>
                        <?php } ?>
                        <?php if (count($award->get_candidates()) == 0) { ?>
                            <div class="alert alert-default">
                                <div class="m-b-1">
                                    <?php echo lang('There are no') . ' ' . lang('Candidate for this award'); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="well">
                <h4 class="m-y-2 text-primary ">
                    <?php echo lang('Description for this Award'); ?>:
                </h4>
                <p>
                    <?php echo xssfilter($award->get_description()); ?>
                </p>

            </div>
        </div>
    </div>
<?php } ?>

