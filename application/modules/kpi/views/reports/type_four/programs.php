<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/15/16
 * Time: 7:30 PM
 */
/** @var array $fltr */
$total_score = 0;
$programs = Orm_Program::get_all(array('college_id' => $fltr['college_id']));
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <?php echo lang('Type1: Analysis based on all Quality Metrics Standards'); ?>
        </div>
    </div>
    <div class="table-header">
        <?php $this->load->view('reports/type_one/header'); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-6"><?php echo lang('Scaled Scoring Performance') ?></th>
                <th class="col-md-1 text-center"><?php echo lang('Weights') ?></th>
                <th colspan="<?php echo count($programs); ?>" class="text-center"><?php echo lang('Performance Achievement for academic year') .' '. Orm_Semester::get_active_semester()->get_year(); ?></th>
            </tr>
            <tr>
                <th><?php echo lang('Standards') ?></th>
                <th></th>
                <?php foreach ($programs as $program) { ?>
                    <th class="text-center"><?php echo htmlfilter($program->get_name()); ?></th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php $year_scores = array(); ?>
            <?php foreach (Orm_Standard::get_all() as $standard) { ?>
                <tr>
                    <td><?php echo lang('Standard') . ' '.$standard->get_id() .': ' . htmlfilter($standard->get_title())  ?></td>
                    <td class="text-right"><?php $score = Orm_Scoring_Standard_Score::get_one(array('standard_id' => $standard->get_id()))->get_college_score(); $total_score += $score; echo $score; ?></td>
                    <?php foreach ($programs as $program) { ?>
                        <?php $year_scores[$program->get_id()] = isset($year_scores[$program->get_id()]) ? $year_scores[$program->get_id()] : 0; ?>
                        <td class="text-right"><?php $score = Orm_Scoring_Standard::get_standard_score(array('academic_year' => Orm_Semester::get_active_semester()->get_year(), 'standard_id' => $standard->get_id(),'program_id' => $program->get_id())); $year_scores[$program->get_id()] += $score; echo $score; ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            <tr class="text-bold bg-default">
                <td><?php echo lang('Standards Overall Quality Metrics'); ?></td>
                <td class="text-right"><?php echo $total_score; ?></td>
                <?php foreach ($programs as $program) { ?>
                    <td class="text-right"><?php echo $year_scores[$program->get_id()]; ?></td>
                <?php } ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>