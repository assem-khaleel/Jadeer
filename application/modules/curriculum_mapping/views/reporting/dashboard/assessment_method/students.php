<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:53 AM
 */

/** @var $method_id int */
/** @var $section_id int */
$json = array();
$outcomes_json = array();
/** @var $students array */

foreach ($students as $key => $student) {
    $json[] = "['". htmlfilter(Orm_User::get_instance($student['student_id'])->get_full_name()) ."', " . number_format($student['score'],2) . "," . number_format($student['score'],2) . ", " . $student['student_id'] . ", '". Orm_Cm_Section_Student_Assessment::$GOOGLE_COLORS[$key%20] ."']";
}
$method = Orm_Cm_Assessment_Method::get_instance($method_id);
?>
<div class="row m-y-2">
    <div class="col-md-12">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Course Sections'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="students-score"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart', 'bar']});
        google.setOnLoadCallback(drawColleges);
    } else {
        drawColleges();
    }

    function drawColleges() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', '<?php echo lang('Program'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });
        data.addColumn({ type:"number", role: "annotationText" });
        data.addColumn({ type:"string", role: 'style'  });

        data.addRows([
            <?php echo implode(',', $json); ?>
        ]);

        var options = {
            bar: { groupWidth: 20 },
            legend: {position: 'none'},
            title: '<?php echo htmlfilter($method->get_title()); ?>',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: '#000',
                    auraColor: 'none'
                }
            },
            vAxis: {
                title: '<?php echo lang('Students') ?>'
            },
            hAxis: {
                title: '<?php echo lang('Score (%)') ?>',
                viewWindowMode:'explicit',
                viewWindow: {
                    max:100,
                    min:0
                }
            },
            height: <?php echo count($json) * 40 ?>

        };

        var chart = new google.visualization.BarChart(document.getElementById('students-score'));

        chart.draw(data, options);
    }
</script>