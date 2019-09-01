<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:53 AM
 */

/** @var $domain_id int */
/** @var $student_id int */
/** @var $section_id int */

$json = array();
$outcomes_json = array();
$student_obj = Orm_User_Student::get_instance($student_id);

$outcome_target = Orm_Cm_Program_Learning_Outcome_Target::get_outcomes_score($domain_id, 0, 0, Orm_Course_Section::get_instance($section_id)->get_course_id());

/** @var $outcomes array */
foreach ($outcomes as $key => $outcome) {

    $target = isset($outcome_target[$outcome['outcome_id']]) ? number_format($outcome_target[$outcome['outcome_id']], 2) : 0;

    $outcomes_json[] = "['". htmlfilter(Orm_Cm_Course_Learning_Outcome::get_instance($outcome['outcome_id'])->get_text()) ."', " . number_format($outcome['score'],2) . ", " . number_format($outcome['score'],2) . ", " . $target . ", " . $target ."]";
}
$domain = Orm_Cm_Learning_Domain::get_instance($domain_id);
?>
<div class="row m-y-2">
    <div class="col-md-12">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo htmlfilter($student_obj->get_full_name()) . ' ' . lang('Outcomes Results'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="student-outcomes"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart', 'bar']});
        google.setOnLoadCallback(drawOutcomes);
    } else {
        drawOutcomes();
    }

    function drawOutcomes() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', '<?php echo lang('Outcome'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });
        data.addColumn('number', '<?php echo lang('Target'); ?>');
        data.addColumn({ type:"number", role: "annotation" });

        data.addRows([<?php echo implode(',', $outcomes_json); ?>]);

        var options = {
            allowHtml: true,
            legend: {position: 'none'},
            title: '<?php echo $domain->get_title() . ' ' . lang('Learning Outcomes'); ?>',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: '#000',
                    auraColor: 'none'
                }
            },
            vAxis: {
                title: '<?php echo lang('Outcomes') ?>'
            },
            hAxis: {
                title: '<?php echo lang('Score (%)') ?>',
                viewWindowMode:'explicit',
                viewWindow: {
                    max:100,
                    min:0
                }
            }
        };

        var chart = new google.visualization.BarChart(
            document.getElementById('student-outcomes'));

        chart.draw(data, options);
    }
</script>