
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-header">
                    <span><?php echo lang('Course Learning Outcomes'); ?></span>
                </div>
                <div class="pull-right">
                    <span class="label label-default pull-right" title="<?php echo lang('Number Of Course Learning Outcomes')?>">
                        <?php echo (int) $clo_count?>
                    </span>
                </div>
            </div>
            <div class="list-group">
                <a href="<?php echo "/report/course_report/xmatrix/{$course_id}"; ?>" class="list-group-item"><i class="fa  fa fa-map-signs list-group-icon"></i><?php echo lang('X-Matrix'); ?></a>
            </div>
            <div class="list-group">
                <a href="<?php echo "/report/course_report/assessment_loop/{$course_id}/clo"; ?>" class="list-group-item"><i class="fa  fa-circle-o-notch list-group-icon"></i><?php echo lang('Assessment Loop'); ?></a>
            </div>
            <div class="list-group">
                <a href="<?php echo "/report/course_report/assessment_metric/{$course_id}"; ?>" class="list-group-item"><i class="fa  fa-calculator list-group-icon"></i><?php echo lang('Assessment Metric'); ?></a>
            </div>
        </div>
    </div>
</div>
