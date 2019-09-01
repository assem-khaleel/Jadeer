<?php

/* @var  Orm_Cm_Course_Assessment_Method[] $assessment_methods */
/* @var  Orm_Course $course */
/* @var  Orm_Course_Section[] $sections */

$course_full_mark = 0;
$student_mark = 0;

/* course full mark depends on  assessment method mark*/
$question_full_mark = 0;
foreach ($assessment_methods as $assessment_method){
    $questions = Orm_Cm_Section_Mapping_Question::get_all([]);
}


?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <?php echo htmlfilter($course->get_name()); ?>
        </div>

    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-md-4"><b><?php echo lang('Total # of student'); ?></b></th>
            <th class="col-md-4"><b><?php echo lang('Number of passed student'); ?></b></th>
            <th class="col-md-4"><b><?php echo lang('Number of Failed student'); ?></b></th>
        </tr>
        </thead>

    </table>
    <div class="table-footer">
        <div id="marks-chart" style="width: 100%; height: 300px;"></div>
        <script type="text/javascript">
            google.setOnLoadCallback(drawChart);

            google.load('visualization', '1.0', {'packages':['corechart']});


            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    [<?php echo lang('Results')?>, <?php echo lang('# of Student')?>],
                    ['<?php echo lang('Students Pass'); ?>', <?php echo $pass; ?>],
                    ['<?php echo lang('Students Fail'); ?>', <?php echo $fail; ?>],
                ]);

                var options = {
                    is3D: true,
                    pieSliceText: <?php echo lang('Option')?>,
                    fontSize: 12,
                    width:
                    sliceVisibilityThreshold: 0

                };

                var chart = new google.visualization.PieChart(document.getElementById('marks-chart'));

                chart.draw(data, options);
            }
        </script>
        <script>drawChart();window.onresize = function(){drawChart();};</script>
    </div>
</div>

