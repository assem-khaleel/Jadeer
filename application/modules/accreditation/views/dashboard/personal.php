<?php $chart = array(); ?>
<div class="panel box bg-white text-default">
    <div class="box-row">
        <div class="box-cell p-x-3 p-y-1">
            <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Accreditation Progress') . ' ' . lang('For') . ' ' . lang('Current Year'); ?></div>
        </div>
    </div>
    <div class="box-row">
        <div id="accreditation-progress"></div>
        <?php
        foreach (Orm_Node_Log::get_progress(Orm_User::get_logged_user_id()) as $log) {
            $year = $log['log_year'];
            $month = $log['log_month']-1;
            $chart[] = "[new Date({$year},{$month},1),{$log['number']}]";
        }
        ?>
        <script>

            if (typeof google.visualization === 'undefined') {
                google.load('visualization', '1', {'packages':['corechart', 'line']});
                google.setOnLoadCallback(drawAccreditationTrend);
            } else {
                drawAccreditationTrend();
            }

            function drawAccreditationTrend() {

                var data = new google.visualization.DataTable();
                data.addColumn('date', '<?php echo lang('Month'); ?>');
                data.addColumn('number', '<?php echo lang('Achievement'); ?>');

                data.addRows([<?php echo implode(',',$chart); ?>]);

                var options = {
                    legend:{position:'none'},
                    hAxis: {
                        title: '<?php echo lang('Time')?>',
                        gridlines: { count: 12 }
                    },
                    vAxis: {
                        title: '<?php echo lang('Achievement'); ?>',
                        viewWindow: {
                            min: 0
                        }
                    }
                };

                var chart = new google.visualization.LineChart(document.getElementById('accreditation-progress'));

                chart.draw(data, options);
            }
            $(window).resize(function(){
                drawAccreditationTrend();
            });
        </script>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?php $assessor_nodes = Orm_Node_Assessor::get_nodes(); ?>
        <?php if($assessor_nodes) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('Accreditation To Fill'); ?></span>
            </div>
            <?php foreach ($assessor_nodes as $node) : ?>
            <div class="panel-body">
                <div class="box panel p-y-2 p-x-3 m-a-0">
                    <div class="box-cell col-md-12 valign-middle text-md-center">
                        <!-- Reset container's height by wrapping in a div -->
                        <div class="widget-pricing widget-pricing-expanded">
                            <div class="widget-pricing-inner row p-x-1">
                                <div class="widget-pricing-plan"><a href="/accreditation/item/<?php echo (int)$node->get_id(); ?>"><?php echo htmlfilter($node->get_name()); ?></a></div>
                                <div class="widget-pricing-section p-a-2 bg-white darker m-t-1">
                                    <div class="row">
                                        <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6">
                                            <div class="font-size-11"><?php echo $node->get_progress_bar(80) ?></div>
                                            <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Progress'); ?></div>
                                        </div>
                                        <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6 b-l-1">
                                            <div class="font-size-11"><?php echo $node->get_review_bar(80) ?></div>
                                            <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Review'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-pricing-section m-t-1">
                                    <span class="font-size-11 text-muted"><?php echo $node->get_days_remaining(); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php } else { ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('Accreditation To Fill'); ?></span>
            </div>
            <div class="panel-body">
                <div class="box panel p-y-2 p-x-3 m-a-0">
                    <div class="box-cell col-md-12 valign-middle text-md-center">
                        <!-- Reset container's height by wrapping in a div -->
                        <div class="widget-pricing widget-pricing-expanded">
                            <div class="widget-pricing-inner row p-x-1">
                                <div class="widget-pricing-plan">
                                    <h4 class="m-a-0"><?php echo lang('You have nothing to fill'); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="col-md-6">
        <?php $reviewer_nodes = Orm_Node_Reviewer::get_nodes(); ?>
        <?php if($reviewer_nodes) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('Accreditation To Review'); ?></span>
            </div>
            <?php foreach ($reviewer_nodes as $node) : ?>
            <div class="panel-body">
                <div class="box panel p-y-2 p-x-3 m-a-0">
                    <div class="box-cell col-md-12 valign-middle text-md-center">
                        <!-- Reset container's height by wrapping in a div -->
                        <div class="widget-pricing widget-pricing-expanded">
                            <div class="widget-pricing-inner row p-x-1">
                                <div class="widget-pricing-plan"><a href="/accreditation/item/<?php echo $node->get_id(); ?>"><?php echo $node->get_name(); ?></a></div>
                                <div class="widget-pricing-section p-a-2 bg-white darker m-t-1">
                                    <div class="row">
                                        <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6">
                                            <div class="font-size-11"><?php echo $node->get_progress_bar(80) ?></div>
                                            <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Progress'); ?></div>
                                        </div>
                                        <div class="col-xs-6 col-md-12 col-lg-12 col-xl-6 b-l-1">
                                            <div class="font-size-11"><?php echo $node->get_review_bar(80) ?></div>
                                            <div class="font-size-11 text-muted line-height-1 text-md-center"><?php echo lang('Review'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-pricing-section m-t-1">
                                    <span class="font-size-11 text-muted"><?php echo $node->get_days_remaining(); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php } else { ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('Accreditation To Review'); ?></span>
            </div>
            <div class="panel-body">
                <div class="box panel p-y-2 p-x-3 m-a-0">
                    <div class="box-cell col-md-12 valign-middle text-md-center">
                        <!-- Reset container's height by wrapping in a div -->
                        <div class="widget-pricing widget-pricing-expanded">
                            <div class="widget-pricing-inner row p-x-1">
                                <div class="widget-pricing-plan">
                                    <h4 class="m-a-0"><?php echo lang('You have nothing to review'); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>