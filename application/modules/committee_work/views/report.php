<?php /** @var $committee Orm_C_Committee */ ?>
<h2 class='m-a-0'>
    <?php echo lang('Committee Information'); ?>
</h2>
<hr>
<?php if (empty($committee)) { ?>
    <div class="alert alert-primary">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Committee has Entered'); ?>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
        <span class=" font-size-20">
            <?php echo lang('Committee Name') . ': '; ?>
        </span>
        <span class=" font-size-20 text-capitalize">
            <?php echo htmlfilter($committee->get_title()) ?>
        </span>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 text-center m-t-2 font-size-18">
            <?php echo lang('Level') . ' : '; ?>
            <span>
                   <?php
                   echo $committee->get_type(true);
                   if ($committee->get_type()) {
                       echo " (" . htmlfilter($committee->get_current_type_id_title()) . ")";
                   }
                   ?></span>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 text-center m-t-2 font-size-18">

            <?php echo lang('Committee work will take place from'); ?>
            &nbsp;
            <span
                class="label label-primary font-weight-bold"><?php echo htmlfilter($committee->get_start_date()); ?></span>
            &nbsp;
            <?php echo lang('to'); ?>
            &nbsp;
            <span
                class="label label-primary font-weight-bold"><?php echo htmlfilter($committee->get_end_date()); ?></span>
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
                                <div class="font-size-14 font-weight-bold"><?php echo lang('Members') ?></div>
                            </div>
                        </div>
                        <div class="row m-a-1">
                            <?php foreach ($committee->get_members() as $member) {
                                /* @var $member Orm_C_Committee_Member */ ?>
                                <div class="col-md-2 m-y-3">
                                    <?php if (!($member->get_is_leader())) { ?>
                                        <i class="fa fa-user text-muted"></i>
                                        &nbsp;&nbsp;
                                        <a>
                                            <strong class="text-default">
                                                <?php echo $member->get_user_name(); ?>
                                            </strong>
                                        </a>
                                    <?php } else { ?>
                                        <i class="fa fa-user text-muted"></i>
                                        &nbsp;&nbsp;
                                        <a>
                                            <strong class="text-default">
                                                <?php echo $committee->get_leader()->get_user_name(); ?>
                                            </strong>
                                        </a>
                                    <?php } ?>
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
                    <?php echo lang('Description for this Committee'); ?>:
                </h4>
                <p>
                    <?php echo xssfilter($committee->get_description()); ?>
                </p>

            </div>
        </div>
    </div>
<?php } ?>
