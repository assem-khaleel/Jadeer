<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 10/09/17
 * Time: 10:43
 */

/**
 * @var $full_mark int
 * @var $students  Orm_Cm_Section_Student_Assessment[]
 */




$title_arr = [];
$title_arr[] = '1-'.(intval($full_mark/2)-($full_mark%($full_mark/2)? 0: 1));
if($full_mark>4){
    $title_arr[] = (intval($full_mark/2)+($full_mark%($full_mark/2)? 1:0 )).'-'.($full_mark/2-1+intval($full_mark/2*.33)?:2);
    $title_arr[] = ($full_mark/2+intval($full_mark/2*.33)?:2).'-'.($full_mark/2-1+intval($full_mark/2*.66)?:3);
    $title_arr[] = ($full_mark/2+intval($full_mark/2*.66)?:3).'-'.$full_mark;
}
else {
    $title_arr[] = intval($full_mark/2).'-'.$full_mark;
}

$students_count       = count($students);
$count_passed         = intval($full_mark/2) + ($full_mark % 2);
$data_set             = [];
$count_passed_student = 0;
$count_low_scour      = 0;
$count_high_scour     = 0;

foreach($title_arr as $key=>$row) {

    $between_mark = explode('-', $row);

    $between_mark[0] = isset($between_mark[0])? $between_mark[0]: 0;
    $between_mark[1] = isset($between_mark[1])? $between_mark[1]: 0;

    $data_set[$key] = 0;

    foreach($students as $student) {
        if($student->get_score() >= $between_mark[0] &&  $student->get_score() <= $between_mark[1]) {
            $data_set[$key] +=1;
        }
    }
}


foreach($students as $student) {

    if($student->get_score() >= $count_passed) {
        $count_passed_student += 1;
    }

    if($student->get_score() >= (intval($full_mark/2) + ($full_mark % 2)) &&  $student->get_score() <= intval($full_mark*0.75)) {
        $count_low_scour += 1;
    }

    if($student->get_score() >= intval($full_mark*0.75) &&  $student->get_score() <= $full_mark) {
        $count_high_scour += 1;
    }
}


$percentage_passed_student = 0;
$percentage_low_scour      = 0;
$percentage_low_scour      = 0;

if($students_count!=0) {

    $percentage_passed_student = round($count_passed_student / $students_count, 5) *100;
    $percentage_low_scour      = round($count_low_scour / $students_count, 5) *100;
    $percentage_high_scour     = round($count_high_scour / $students_count, 5) *100;
}

$title_x = json_encode($title_arr);
$data_x = json_encode($data_set);

?>

<div class="row">
<style>
    canvas {
        max-height: 400px;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>
<div class="col-xs-12 col-sm-6 col-sm-offset-3">
    <canvas id="normal_distribution"></canvas>
</div>
<script>
    var color = Chart.helpers.color;
    var barChartData = {
        labels: <?php echo $title_x ?>,
        datasets: [{
            label: "<?php echo lang('Student Marks'); ?>",
            backgroundColor: color('#FF0000').alpha(0.5).rgbString(),
            borderColor: '#FF0000',
            fill: false,
            borderWidth: 1,
            data: <?php echo $data_x ?>
        }]
    };

    $(document).ready(function() {
        var ctx = document.getElementById("normal_distribution").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text:'<?php echo lang('Normal Distribution Chart'); ?>'
                }
            }
        });

    });

</script>

    <div class="col-xs-12 col-sm-4">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                    <?php echo lang('No. of Student Passed') ?>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-y-2">
                    <div class="easy-pie-chart" data-suffix="" data-percent="<?php echo $percentage_passed_student ?>" data-max-value="<?php echo $students_count ?>"><span class="font-size-14 font-weight-light"></span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                    <?php echo lang('No. of Student with Low Scores') ?>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-y-2">
                    <div class="easy-pie-chart" data-suffix="" data-percent="<?php echo $percentage_low_scour ?>" data-max-value="<?php echo $students_count ?>"><span class="font-size-14 font-weight-light"></span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                    <?php echo lang('No. of Student with High Scores') ?>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-y-2">
                    <div class="easy-pie-chart" data-suffix="" data-percent="<?php echo $percentage_high_scour ?>" data-max-value="<?php echo $students_count ?>"><span class="font-size-14 font-weight-light"></span></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    var config = {
        animate: 2000,
        scaleColor: false,
        lineWidth: 4,
        lineCap: 'square',
        size: 90,
        trackColor: 'rgba(0, 0, 0, .09)',
        onStep: function(_from, _to, currentValue) {
            var value = $(this.el).attr('data-max-value') * currentValue / 100;

            $(this.el)
                .find('> span')
                .text(Math.round(value) + $(this.el).attr('data-suffix'));
        }
    };

    $('.easy-pie-chart')
        .easyPieChart($.extend({}, config, { barColor: '#72B159'}));

</script>