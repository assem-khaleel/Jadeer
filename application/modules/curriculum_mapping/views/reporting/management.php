<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/4/16
 * Time: 6:58 PM
 */
?>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-header">
                    <span><?php echo lang('Course Assessment Matrix'); ?></span><br>
                </div>
            </div>
            <div class="list-group">
                <a href="<?php echo '/curriculum_mapping/reporting/course_assessment_rubric'; ?>" class="list-group-item"><i class="fa  fa-tasks list-group-icon"></i><?php echo lang('Course Assessment Matrix'); ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-header">
                    <span><?php echo lang('Student Assessment Matrix'); ?></span><br>
                </div>
            </div>
            <div class="list-group">
                <a href="<?php echo '/curriculum_mapping/reporting/student_assessment_rubric'; ?>" class="list-group-item"><i class="fa  fa-tasks list-group-icon"></i><?php echo lang('Student Assessment Matrix'); ?></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary panel-dark widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-header">
                    <span><?php echo lang('Learning Domains Dashboard'); ?></span><br>
                </div>
            </div>
            <div class="list-group">
                <a href="<?php echo '/curriculum_mapping/reporting/outcomes'; ?>" class="list-group-item"><i class="fa  fa-tasks list-group-icon"></i><?php echo lang('Learning Domains Dashboard'); ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary panel-dark widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-header">
                    <span><?php echo lang('Assessment Methods Dashboard'); ?></span><br>
                </div>
            </div>
            <div class="list-group">
                <a href="<?php echo '/curriculum_mapping/reporting/assessment_methods'; ?>" class="list-group-item"><i class="fa  fa-tasks list-group-icon"></i><?php echo lang('Assessment Methods Dashboard'); ?></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary panel-dark widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-header">
                    <span><?php echo lang('Learning Domains Indirect Assessment Results Dashboard'); ?></span><br>
                </div>
            </div>
            <div class="list-group">
                <a href="<?php echo '/curriculum_mapping/reporting/qualitative'; ?>" class="list-group-item"><i class="fa  fa-tasks list-group-icon"></i><?php echo lang('Learning Outcomes Indirect Assessment Dashboard'); ?></a>
            </div>
        </div>
    </div>
</div>