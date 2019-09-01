<?php
$recommendations = Orm_Acc_Visit_Reviewer_Recommendation::get_all(['type' => $type, 'type_id' => $type_id]);
?>

<div class="panel">

    <div class="panel-body p-a-4 b-b-4 bg-white darken">
        <div class="box m-a-0 border-radius-0 bg-white darken">
            <div class="box-row valign-middle">

                <div class="box-cell col-md-8">

                    <div class="display-inline-block m-r-3 valign-middle">
                        <div class="text-muted"><strong><?php echo lang($type); ?></strong></div>
                        <div class="font-size-15 font-weight-bold line-height-1"><?php echo lang('Recommendations'); ?></div>
                    </div>

                    <!-- Spacer -->
                    <div class="m-t-3 visible-xs visible-sm"></div>

                    <div class="display-inline-block p-l-1 b-l-3 valign-middle font-size-12 text-muted">
                        <div>&ensp;</div>
                        <div><?php echo htmlfilter(Orm_Acc_Visit_Reviewer::get_type_element($type, $type_id)->get_name()) ?></div>
                        <div>&ensp;</div>
                    </div>
                </div>

                <!-- Spacer -->
                <div class="m-t-3 visible-xs visible-sm"></div>

                <div class="box-cell col-md-4">
                    <div class="pull-md-right font-size-15">
                        <div class="text-muted font-size-13 line-height-1"><strong><?php echo lang('Date'); ?></strong></div>
                        <strong><?php echo date('Y-m-d') ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php if($recommendations) { ?>
    <?php foreach ($recommendations as $recommendation) { ?>

        <div class="panel">
            <div class="page-forum-thread-title panel-title clearfix">
                <span class="font-weight-bold"><?php echo lang('Recommendation'); ?></span>
                <hr class="bg-info">
                <span class="font-size-13 text-muted"><?php echo lang('by'); ?></span> <?php echo htmlfilter($recommendation->get_reviewer_obj()->get_full_name()) ?>
                <span class="font-size-13 pull-right"><span class="label label-info"><?php echo htmlfilter($recommendation->get_date_added()) ?></span></span>
            </div>

            <hr>

            <div class="panel-body font-size-14">
                <?php echo xssfilter($recommendation->get_recommendation()) ?>
            </div>

            <?php if($details) { ?>
                <div class="panel-footer p-a-1">
                    <?php foreach ($recommendation->get_action_plans() as $action_plan) { ?>
                        <div class="panel m-a-1">
                            <div class="page-forum-thread-title panel-title">
                                <span class="font-weight-bold"><?php echo lang('Action Plan'); ?></span>&nbsp;<?php echo $action_plan->get_status() ?>
                            </div>

                            <hr>

                            <div class="panel-body font-size-14">
                                <p>
                                    <?php echo nl2br(htmlfilter($action_plan->get_description())) ?>
                                </p>
                            </div>

                            <div class="panel-footer bg-white darken clearfix">
                                <div class="box m-y-1 bg-transparent">
                                    <div class="box-row">
                                        <div class="box-cell col-md-4">
                                            <div class="box-container">
                                                <div class="box-row">
                                                    <div class="box-cell" style="width: 30px;">
                                                        <img src="<?php echo htmlfilter($action_plan->get_user_obj()->get_avatar()) ?>" alt="" class="border-round" style="width: 100%;">
                                                    </div>
                                                    <div class="box-cell p-l-1">
                                                        <div class="line-height-1"><span class="font-size-11 text-muted"><?php echo lang('by'); ?></span> <strong><?php echo htmlfilter($action_plan->get_user_obj()->get_full_name()) ?></strong></div>
                                                        <span class="font-size-11 text-muted"><?php echo htmlfilter($action_plan->get_date_added()) ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="m-y-1 visible-xs visible-sm">
                                        <div class="box-cell col-md-4">
                                            <div class="font-size-11 text-muted line-height-1"><?php echo lang('Responsible'); ?></div>
                                            <strong><?php echo htmlfilter($action_plan->get_responsible_obj()->get_full_name()) ?></strong>
                                        </div>
                                        <hr class="m-y-1 visible-xs visible-sm">
                                        <div class="page-forum-thread-counters box-cell col-md-4 text-xs-center">
                                            <div class="box-container">
                                                <div class="box-row">
                                                    <div class="box-cell">
                                                        <div class="font-size-14 line-height-1"><strong><?php echo htmlfilter($action_plan->get_due_date()) ?></strong></div>
                                                        <div class="font-size-11 text-muted"><?php echo lang('Due Date'); ?></div>
                                                    </div>
                                                    <div class="box-cell b-l-1">
                                                        <div class="font-size-14 line-height-1"><strong><?php echo htmlfilter($action_plan->get_progress()) ?>%</strong></div>
                                                        <div class="font-size-11 text-muted"><?php echo lang('Progress'); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } else { ?>
    <h3 class="m-a-0"><?php echo lang("There are no") . ' ' . lang('Recommendations'); ?></h3>
<?php } ?>