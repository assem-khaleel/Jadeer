<?php
/** @var $assessment_plan Orm_Cm_Assessment_Plan
 * @var $program_id int */
?>
<?php $this->load->view('course/links',array('course_id' => $course_id)); ?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Course Assessment Plan'); ?></span>
        <a href="/curriculum_mapping/course/assessment_plan_add_edit/" data-toggle="ajaxModal" class="btn pull-right" >
            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Create').' '.lang('Assessment Plan'); ?>
           </a>
    </div>
    <?php $assessment_plans = Orm_Cm_Assessment_Plan::get_all(); ?>
    <?php if($assessment_plans) { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-1">#</th>
                <th class="col-md-2"><?php echo lang('Assessment Plan'); ?></th>
                <th class="col-md-6"><?php echo lang('Course Assessment Method'); ?></th>
                <th class="col-md-3"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($assessment_plans as $key => $assessment_plan) { ?>
                <tr>
                    <td><span class="label label-primary"><?php echo ($key + 1); ?></span></td>
                    <td>
                        <b>
                            <?php echo htmlfilter($assessment_plan->get_name()); ?>
                        </b>
                    </td>
                    <td>
                        <?php if($assessment_plan->get_map()): ?>
                            <ul class="list-group m-a-0 bg-primary">
                        <?php foreach ($assessment_plan->get_map() as $method) {
                            /** @var $method Orm_Cm_Assessment_Plan_Map */
                            ?>
                            <li class="list-group-item no-border-hr padding-xs-hr">
                                <?php echo $method->get_method_obj()->get_text()?>
                            </li>
                        <?php } ?>
                            </ul>
                        <?php else: ?> <li class="list-group-item well well-sm m-a-0">
                            <?php echo lang("Not specified Assessment Methods")?>
                        </li>
                <?php endif; ?>
                    </td>
                    <td>
                        <a href="/curriculum_mapping/course/assessment_plan_method_add_edit/<?php echo intval($course_id); ?>/<?php echo intval($assessment_plan->get_id()); ?>" data-toggle="ajaxModal" class="btn  btn-block" >
                            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Manage').' '.lang('Assessment Methods'); ?>
                        </a>
                   <a href="/curriculum_mapping/course/assessment_plan_add_edit/<?php echo intval($assessment_plan->get_id()); ?>" data-toggle="ajaxModal" class="btn  btn-block" >
                            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Edit'); ?>
                        </a>
                   <a href="/curriculum_mapping/course/assessment_plan_delete/<?php echo intval($assessment_plan->get_id()); ?>" title="Delete" data-toggle="deleteAction" class="btn btn-block" >
                            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Delete'); ?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-dafualt">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Assessment Plans'); ?>
            </div>
        </div>
    <?php } ?>
</div>