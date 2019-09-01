<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/4/17
 * Time: 10:56 AM
 *
 * @var $assessment_metric Orm_Am_Assessment_Metric
 * @var $all_component Orm_Am_Metric_Item[]
 */
$final_result=0;
?>
<div class="col-md-12 col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="well well-sm">
                <?php echo $assessment_metric->draw() ?>
            </div>
        </div>
    </div>
    <div class="table-primary">
        <div class="table-header">
            <div class="table-caption m-b-1">
                <?php echo htmlfilter(Orm_Program::get_instance($assessment_metric->get_program_id())->get_name()); ?>
                <div class="panel-heading-controls col-sm-4">
                    <a class="btn btn-sm pull-right"
                       href="/assessment_metric/pdf/<?php echo urlencode($assessment_metric->get_id()); ?>">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span> <?php echo lang('PDF') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <table class="table">
        <tbody>
        <tr>
            <td class="col-md-1"><?php echo lang('Component'); ?> (<?php echo lang('English') ?>)</td>
            <?php foreach ($all_component as $one_component){?>
                <td class="col-md-1"><?php echo $one_component->get_component_en()?></td>
            <?php }?>
        </tr>
        <tr>
            <td class="col-md-1"><?php echo lang('Component'); ?>(<?php echo lang('Arabic') ?>)</td>
            <?php foreach ($all_component as $one_component){?>
                <td class="col-md-1"><?php echo $one_component->get_component_ar()?></td>
            <?php }?>

        </tr>

        <tr>
            <td class="col-md-1"><?php echo lang('Course'); ?></td>
            <?php foreach ($all_component as $one_component){?>
                <td class="col-md-1"><?php echo Orm_Course::get_instance($one_component->get_course_id())->get_name()?></td>
            <?php }?>
        </tr>
        <tr>
            <td class="col-md-1"><?php echo lang('Component Value'); ?></td>
            <?php foreach ($all_component as $one_component){?>
                <td class="col-md-1"><?php echo $one_component->get_high_score()?></td>
            <?php }?>

        </tr>
        <tr>
            <td class="col-md-1"><?php echo lang('Assessment Weight'); ?></td>
            <?php foreach ($all_component as $one_component){?>
                <td class="col-md-1"><?php echo $one_component->get_weight()?></td>
            <?php }?>

        </tr>
        <tr>
            <td class="col-md-1"><?php echo lang('Average'); ?></td>
            <?php foreach ($all_component as $one_component){?>
                <td class="col-md-1"><?php echo $one_component->get_average()?></td>
            <?php }?>
        </tr>
        <tr>
            <td class="col-md-1"><?php echo lang('Result'); ?></td>
            <?php
            $sum_weight = 0;
            foreach ($all_component as $one_component) {
                $weight = $one_component->get_weight();
                $sum_weight += $weight;
            }
            foreach ($all_component as $one_component) {
                $final_result += $one_component->get_result();

                if($sum_weight == 100){?>

                    <td class="col-md-1"><?php echo $one_component->get_result() ?>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                google.charts.load('current', {'packages':['corechart']});
                                google.charts.setOnLoadCallback(drawStuff);

                                function drawStuff() {
                                    var data = new google.visualization.arrayToDataTable([
                                        ['Element', "<?php echo lang('Value')?>"],
                                        ["<?php echo lang('Final Result')?>",  <?php echo $final_result;?>],
                                        ["<?php echo lang('Target')?>",  <?php echo $assessment_metric->get_target(); ?>]
                                    ]);

                                    var options = {
                                        title: "<?php echo lang('Final Result VS Target')?>",
                                        width: "100%",
                                        height: "100%",
                                        legend: { position: 'none' },
                                        chart: { title: "<?php echo lang('Final Result VS Target')?>"},
                                        bars: 'horizontal',
                                        axes: {
                                            x: {
                                                0: { side: 'top', label: "<?php echo lang('Value')?>"}
                                            }
                                        },
                                        bar: { groupWidth: "10%" }
                                    };

                                    var chart = new google.visualization.BarChart(document.getElementById('columnchart_values'));
                                    chart.draw(data, options);
                                };
                            })

                        </script>
                    </td>
                <?php }else{
                    $final_result = lang('N/A');?>
                    <td class="col-md-1"><?php echo lang('N/A') ?></td>
                <?php }
            }
            ?>
        </tr>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo lang('Warning') ?>
                !</strong> <?php echo lang('Sum of Assessment Weight Should be 100 to View The Result and Final Result') ?>
        </div>
        </tbody>
    </table>
    <div class="row">
        <div class="col-lg-4">
            <div id="columnchart_values" style="height: 300px; ">

        </div>
        </div>
        <div class="col-lg-4">
        <div class="panel  panel-primary">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('Weakness'); ?></span>
            </div>
            <div class="panel-body">
                <span><?php echo !(empty(xssfilter($assessment_metric->get_weakness())))?xssfilter($assessment_metric->get_weakness()):lang('There are no') . ' ' . lang('Weakness has Entered'); ?></span>
            </div>
        </div>
        </div>
        <div class="col-lg-4">
            <div class="panel  panel-primary">
                <div class="panel-heading">
                    <span class="panel-title"><?php echo lang('Strength'); ?></span>
                </div>
                <div class="panel-body">
                    <span><?php echo !(empty(xssfilter($assessment_metric->get_strength())))?xssfilter($assessment_metric->get_strength()):lang('There are no') . ' ' . lang('Strength has Entered'); ?></span>
                </div>
            </div>
        </div>


       <?php
       $color = '#b88777';
        if($final_result > $assessment_metric->get_target()){
            $color ='#62ab46';
        }
        if($final_result == $assessment_metric->get_target()){
            $color ='#FF9933';

        }
       if($final_result < $assessment_metric->get_target()){
           $color ='#df402d';
       }
       ?>

    </div>

</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>