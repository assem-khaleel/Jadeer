<?php
/** @var $assessment_method Orm_Cm_Course_Assessment_Method[] */
/** @var $clo Orm_Cm_Course_Learning_Outcome[] */
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span
                class="font-size-15 font-weight-semibold"><?php echo lang("Instructional and assessment methods") ?></span>
        </div>
    </div>
    <div class="panel-body">
        <?php foreach ($assessment_method as $value) { ?>
            <div><?php echo htmlfilter($value->get_text()) ?></div>
            <hr/>
        <?php } ?>
        <?php if (empty($assessment_method)) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Assessment Methods'); ?>
                </h3>
            </div>
        <?php } ?>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Course Learning Outcome (CLO)") ?></span>
        </div>
    </div>
    <div class="panel-body">
        <?php
        /* @var $value Orm_Cm_Course_Learning_Outcome */
        foreach ($clo as $value) {
            ?>
            <div><?php echo htmlfilter($value->get_text()) ?></div>
            <hr/>
        <?php } ?>
        <?php if (empty($clo)) { ?>
            <div class="well well-sm m-a-0">
                <h3 class="m-a-0 text-center">
                    <?php echo lang('There are no') . ' ' . lang('Learning Outcomes'); ?>
                </h3>
            </div>
        <?php } ?>
    </div>
</div>
