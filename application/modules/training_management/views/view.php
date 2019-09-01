<?php /* @var $training Orm_Tm_Training */ ?>

<div class="clo-lg-12 col-md-12 col-sm-12 valign-middle text-center">
    <h2 class="m-t-1"><?php echo htmlfilter($training->get_name()) ?></h2>

    <ul class="list-inline">
        <li class="font-size-18 font-weight-semibold text-muted">
            <i class="fa fa-calendar" title="<?php echo lang('Training Date') ?>"></i>
            &nbsp;<?php echo htmlfilter($training->get_date()) ?>
        </li>
        <li class="font-size-18 font-weight-semibold text-muted">
            <i class="fa fa-clock-o" title="<?php echo lang('Training Duration') ?>"></i>
            &nbsp;<?php echo htmlfilter($training->get_duration()) ?>
        </li>
        <li class="font-size-18 font-weight-semibold text-muted">
            <i class="fa fa-location-arrow" title="<?php echo lang('Training Location') ?>"></i>
            &nbsp;<?php echo htmlfilter($training->get_location()) ?>
        </li>
        <li class="font-size-18 font-weight-semibold text-muted">
            <i class="fa fa-users" title="<?php echo lang('Training Organization') ?>"></i>
            &nbsp;<?php echo htmlfilter($training->get_organization()) ?>
        </li>
    </ul>
    <hr>
</div>

<div class="col-lg-6 col-md-6 col-sm-6">
    <h3 class="pull-left m-t-2  m-b-0 text-warning font-italic">
        <?php echo lang('Outlines') ?>
        <hr class="m-t-1  border-warning font-weight-bold">
    </h3>

    <p class="row m-t-2  m-b-0">
        <?php echo xssfilter($training->get_training_outline()) ?>
    </p>
</div>

<div class="well col-lg-6 col-md-6 col-sm-6">

    <h3 class="pull-left m-t-2  m-b-0 font-italic">
        <?php echo lang('Instructor Information') ?>
        <hr class="m-t-1  border-default font-weight-bold">
    </h3>

    <p class="row m-t-2  m-b-0">
        <?php echo xssfilter($training->get_instructor_information()) ?>
    </p>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 text-center">
    <h3 class="m-t-2  m-b-0 font-italic">
        <?php echo lang('General Description') ?>
        <hr class="m-t-1  border-default font-weight-bold  border-warning" style="width: 10%;">
    </h3>
    <p class="row m-t-2  m-b-0">
        <?php echo xssfilter($training->get_description()) ?>
    </p>
</div>

<?php
if (Orm_Tm_Members::get_count(['training_id' => $training->get_id(),'status'=>Orm_Tm_Members::USER_JOINED]) != 0) { ?>

    <div class="col-lg-12 col-md-12 col-sm-12">
        <h3 class="m-t-2  m-b-0 font-italic text-center">
            <?php echo lang('Members') ?>
            <hr class="m-t-1  border-default font-weight-bold  border-warning" style="width: 10%;">
        </h3>

        <div class="panel" style="background: none; border: none">
            <div class="panel-body">
                <?php foreach (Orm_Tm_Members::get_all(['training_id' => $training->get_id(),'status'=>Orm_Tm_Members::USER_JOINED]) as $member) { ?>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="list-group">
                                <a class="list-group-item">
                                    <?php echo xssfilter(Orm_User::get_instance($member->get_user_id())->get_full_name()) ?>
                                </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php } ?>
