
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-header">
                    <span><?php echo lang('Program Learning Outcomes'); ?></span>
                </div>
                <div class="pull-right">
                    <span class="label label-default pull-right" title="<?php echo lang('Number Of Program Learning Outcomes')?>">
                        <?php echo (int) $plo_count?>
                    </span>
                </div>
            </div>

            <div class="list-group">
                <a href="<?php echo "/report/program_report/xmatrix/{$program_id}"; ?>" class="list-group-item"><i class="fa  fa fa-map-signs list-group-icon"></i><?php echo lang('X-Matrix'); ?></a>
            </div>
            <div class="list-group">
                <a href="<?php echo "/report/program_report/ipamatrix/{$program_id}"; ?>" class="list-group-item"><i class="fa  fa fa-map list-group-icon"></i><?php echo lang('IPMA-Matrix'); ?></a>
            </div>
            <div class="list-group">
                <a href="<?php echo "/report/program_report/assessment_loop/{$program_id}"; ?>/plo" class="list-group-item"><i class="fa  fa-circle-o-notch list-group-icon"></i><?php echo lang('Assessment Loop'); ?></a>
            </div>
            <div class="list-group">
                <a href="<?php echo "/report/program_report/assessment_metric/{$program_id}"; ?>" class="list-group-item"><i class="fa  fa-calculator list-group-icon"></i><?php echo lang('Assessment Metric'); ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-header">
                    <span><?php echo lang('Program Objectives'); ?></span>
                </div>
                <div class="pull-right">
                    <span class="label label-default pull-right" title="<?php echo lang('Number Of Program Objectives')?>">
                        <?php echo (int) $objective_counts?>
                    </span>
                </div>
            </div>
            <div class="list-group">
                <a href="<?php echo "/report/program_report/obj_xmatrix/{$program_id}"; ?>" class="list-group-item"><i class="fa  fa fa-map-signs list-group-icon"></i><?php echo lang('X-Matrix'); ?></a>
            </div>
            <div class="list-group">
                <a href="<?php echo "/report/program_report/assessment_loop/{$program_id}/objective"; ?>/objective" class="list-group-item"><i class="fa  fa-circle-o-notch list-group-icon"></i><?php echo lang('Assessment Loop'); ?></a>
            </div>
            <div class="list-group">
                <a href="<?php echo "/report/program_report/obj_assessment_metric/{$program_id}"; ?>" class="list-group-item"><i class="fa  fa-calculator list-group-icon"></i><?php echo lang('Assessment Metric'); ?></a>
            </div>
        </div>
    </div>
</div>
<?php if(Orm_General_Report::get_obj()){
    $this->load->view('program_report/tree',$program_id);
    ?>

<?php } ?>



