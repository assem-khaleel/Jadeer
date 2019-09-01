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
                    <span><?php echo lang('Learning Domains'); ?></span><br>
                </div>
            </div>
            <div class="list-group">
                <a href="<?php echo '/curriculum_mapping/settings/learning_domain_type'; ?>" class="list-group-item"><i class="fa  fa-tasks list-group-icon"></i><?php echo lang('Learning Domain Types'); ?></a>
            </div>
            <div class="list-group">
                <a href="<?php echo '/curriculum_mapping/settings/learning_domain'; ?>" class="list-group-item"><i class="fa  fa-tasks list-group-icon"></i><?php echo lang('Learning Domains'); ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-primary widget-profile">
            <div class="panel-heading">
                <div class="widget-profile-header">
                    <span><?php echo lang('Assessment Methods'); ?></span><br>
                </div>
            </div>
            <div class="list-group">
                <a href="<?php echo '/curriculum_mapping/settings/assessment_method'; ?>" class="list-group-item"><i class="fa  fa-tasks list-group-icon"></i><?php echo lang('Assessment Methods'); ?></a>
            </div>
        </div>
    </div>
</div>
