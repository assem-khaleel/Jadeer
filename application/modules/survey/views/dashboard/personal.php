<?php
$this->load->helper('text');

?>
<div class="panel clearfix">
    <div class="panel-heading p-a-3">
        <div class="panel-title">
            <i class="panel-title-icon fa fa-check-square-o font-size-16"></i> <?php echo lang('Surveys to Take'); ?>
        </div>
    </div>
    <div class="ps-block ps-container ps-theme-default ps-active-y" id="list_survey" style="height: 297px;">
        <?php
        $survey_evaluators = Orm_Survey_Evaluator::get_all(array('user_id' => Orm_User::get_logged_user()->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id()));
        foreach ($survey_evaluators as $evaluator) {
            ?>
            <div class="col-xs-12 p-x-1 p-y-2 b-t-1 bg-white">
                <div class="pull-xs-right font-size-16">
                    <?php if ($evaluator->get_response_status()) { ?>
                        <span class="label label-success ticket-label"><?php echo lang('Completed'); ?></span>
                    <?php } elseif($evaluator->get_survey_evaluation_obj()->is_published()) { ?>
                        <a class="btn btn-block btn-sm" href="<?php echo htmlfilter($evaluator->get_response_link()); ?>"><?php echo lang('Take Survey') ?></a>
                    <?php } ?>
                </div>
                <div class="font-size-15"><?php echo character_limiter($evaluator->get_survey_evaluation_obj()->get_survey_obj()->get_title(), 90); ?> - <?php echo character_limiter($evaluator->get_survey_evaluation_obj()->get_description(), 10); ?></div>
                <div class="text-muted font-size-14"><?php echo $evaluator->get_survey_evaluation_obj()->get_date_format() ?></div>
            </div>
            <?php
        }
        ?>
        <?php if (!count($survey_evaluators)) { ?>
            <div class="panel p-y-2 p-x-3 m-a-0 text-md-center">
                <h4 class="m-a-0"><?php echo lang("No Pending Surveys")?></h4>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    $(function() {
        $('#list_survey').perfectScrollbar();
    });
</script>