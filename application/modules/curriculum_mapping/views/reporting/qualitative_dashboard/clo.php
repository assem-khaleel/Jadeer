<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/9/17
 * Time: 9:24 AM
 */

/** @var int $clo_id */
/** @var int $section_id */
$scores = array();
$filters = array();

$filters['class_type'] = 'Orm_User_Student';
$filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
$filters['course_id'] = Orm_Cm_Course_Learning_Outcome::get_instance($clo_id)->get_course_id();
$filters['section_id'] = $section_id;

foreach (Orm_Cm_Course_Learning_Outcome_Survey::get_all(array('course_learning_outcome_id' => $clo_id)) as $item) {
    $obj = Orm_Survey_Question_Statement::get_instance($item->get_statement_id());
    $response = $obj->get_user_response($filters);

    $score = round($response['average'], 2);

    $text = trim(str_replace('\'', '\\\'', htmlfilter($obj->get_title())));
    $scores[] = "['{$text}',{$score},{$score}]";
}

?>
<div class="row">
    <div class="col-md-12">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Students Scores'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="clo-scores"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart', 'bar']});
        google.setOnLoadCallback(drawSurvey);
    } else {
        drawSurvey();
    }

    function drawSurvey() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', '<?php echo lang('Survey Statement'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });

        data.addRows([<?php echo implode(',', $scores); ?>]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0,1,2]);

        var options = {
            legend: {position: 'none'},
            title: '<?php echo lang('Students Scores'); ?>',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: '#000',
                    auraColor: 'none'
                }
            },
            vAxis: {
                title: '<?php echo lang('Statements') ?>'
            },
            hAxis: {
                title: '<?php echo lang('Score') ?>',
                viewWindowMode:'explicit',
                viewWindow: {
                    max:5,
                    min:0
                }
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('clo-scores'));

        chart.draw(view, options);
    }
</script>