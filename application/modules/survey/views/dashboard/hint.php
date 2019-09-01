<?php
$survey_evaluators = Orm_Survey_Evaluator::get_all(array('survey_in' => array(6,7),'user_id' => Orm_User::get_logged_user()->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id()));

if ($survey_evaluators) {
    foreach ($survey_evaluators as $evaluator) {
        if(!$evaluator->get_response_status()) {
            ?>
            <div class="alert alert-dark alert-danger">
                <strong><?php echo lang('Warning'); ?></strong> <?php echo lang('Please click on survey to fill your survey'); ?>
                <a class="btn btn-sm pull-right" href="<?php echo htmlfilter($evaluator->get_response_link()); ?>"><?php echo lang('survey') ?></a>
            </div>
            <?php
        }
    }
}
?>