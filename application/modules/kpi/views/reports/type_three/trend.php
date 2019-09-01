<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/15/16
 * Time: 6:47 PM
 */
$total_score = 0;
$years = Orm_Semester::get_last_five_years();
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
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-md-6"><?php echo lang('Scaled Scoring Performance') ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Weights') ?></th>
            <th colspan="5" class="col-md-5 text-center"><?php echo lang('Performance Achievement') ?></th>
        </tr>
        <tr>
            <th><?php echo lang('Standards') ?></th>
            <th></th>
            <?php foreach ($years as $year) { ?>
                <th class="col-md-1 text-center"><?php echo $year['year']; ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php $year_scores = array(); ?>
        <?php foreach (Orm_Standard::get_all() as $standard) { ?>
            <tr>
                <td><?php echo lang('Standard') . ' '.$standard->get_id() .': ' . htmlfilter($standard->get_title())  ?></td>
                <td class="text-right"><?php $score = Orm_Scoring_Standard_Score::get_one(array('standard_id' => $standard->get_id()))->get_college_score(); $total_score += $score; echo $score; ?></td>
                <?php foreach ($years as $year) { ?>
                    <?php $year_scores[$year['year']] = isset($year_scores[$year['year']]) ? $year_scores[$year['year']] : 0; ?>
                    <td class="text-right"><?php $score = Orm_Scoring_Standard::get_standard_score(array('academic_year' => $year['year'], 'standard_id' => $standard->get_id())); $year_scores[$year['year']] += $score; echo $score; ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
        <tr class="text-bold bg-default">
            <td><?php echo lang('Standards Overall Quality Metrics'); ?></td>
            <td class="text-right"><?php echo $total_score; ?></td>
            <?php foreach ($years as $year) { ?>
                <td class="text-right"><?php echo $year_scores[$year['year']]; ?></td>
            <?php } ?>
        </tr>
        </tbody>
    </table>
</div>