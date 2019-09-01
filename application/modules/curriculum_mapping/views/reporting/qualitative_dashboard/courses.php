<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:53 AM
 */

/** @var int $program_id */
$json = array();
$factors = array();
$scores = array();
$filters = array();
$plo = array();

$filters['class_type'] = 'Orm_User_Student';
$filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

foreach (Orm_Cm_Program_Learning_Outcome_Survey::get_all(array('program_id' => $program_id)) as $item) {
    $plo[$item->get_program_learning_outcome_id()] = $item->get_program_learning_outcome_id();
}
foreach ($plo as $p) {

    $plo_obj = Orm_Cm_Program_Learning_Outcome::get_instance($p);
    $item = 0;
    foreach (Orm_Cm_Program_Learning_Outcome_Survey::get_all(array('program_learning_outcome_id' => $p)) as $factor) {
        $obj = Orm_Survey_Question_Statement::get_instance($factor->get_statement_id());
        $filters['program_id'] = $program_id;
        $response = $obj->get_user_response($filters);

        $item += $response['average'];
    }
    $items_count = Orm_Cm_Program_Learning_Outcome_Survey::get_count(array('program_learning_outcome_id' => $p));

    $score = $items_count ? round($item / $items_count, 2) : 0;
    $plo_text = trim(str_replace('\'', '\\\'', htmlfilter($plo_obj->get_text())));
    $scores[] = "[{$plo_obj->get_id()},'{$plo_text}',{$score},{$score}]";
}

$course_ids = array_column(Orm_Cm_Course_Learning_Outcome::get_model()->get_all(array('program_learning_outcome_id_in' => $plo),0,0, array(), Orm::FETCH_ARRAY), 'course_id');

$course_ids = array_merge(array(0),$course_ids);

foreach (Orm_Course::get_all(array('program_id' => $program_id, 'program_plan' => true, 'in_id' => $course_ids)) as $course) {

    $item = 0;
    foreach (Orm_Cm_Course_Learning_Outcome_Survey::get_all(array('course_id' => $course->get_id())) as $factor) {
        $obj = Orm_Survey_Question_Statement::get_instance($factor->get_statement_id());
        $filters['course_id'] = $course->get_id();
        $response = $obj->get_user_response($filters);

        $item += $response['average'];
    }
    $items_count = Orm_Cm_Course_Learning_Outcome_Survey::get_count(array('course_id' => $course->get_id()));
    if ($items_count) {
        $score = $items_count ? round($item / $items_count, 2) : 0;
        $course_name = trim(str_replace('\'', '\\\'', htmlfilter($course->get_name())));
        $json[] = "[{$course->get_id()},'{$course_name}',{$score},{$score}]";
    }
}
?>
<div class="row">
    <div class="col-md-6">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Courses'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="courses-scores"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo Orm_Program::get_instance($program_id)->get_name() . ' ' . lang('Learning Outcomes'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="program-plo"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart', 'bar']});
        google.setOnLoadCallback(drawCourses);
        google.setOnLoadCallback(drawPLOs);
    } else {
        drawCourses();
        drawPLOs();
    }

    function drawCourses() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', '<?php echo lang('ID'); ?>');
        data.addColumn('string', '<?php echo lang('Course'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });

        data.addRows([<?php echo implode(',', $json); ?>]);

        var view = new google.visualization.DataView(data);
        view.setColumns([1, 2, 3]);

        var options = {
            legend: {position: 'none'},
            title: '<?php echo Orm_Program::get_instance($program_id)->get_name() . ' ' . lang('Courses'); ?>',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: '#000',
                    auraColor: 'none'
                }
            },
            vAxis: {
                title: '<?php echo lang('Courses') ?>'
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

        function selectHandler() {
            var selectedItem = chart.getSelection()[0];

            if (selectedItem && selectedItem.row != null) {
                var value = data.getValue(selectedItem.row, 0);
                ajaxRender('sections','/curriculum_mapping/reporting/qualitative?type=sections&course_id='+value);
            }
        }

        var chart = new google.visualization.BarChart(document.getElementById('courses-scores'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(view, options);
    }

    function drawPLOs() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', '<?php echo lang('ID'); ?>');
        data.addColumn('string', '<?php echo lang('Program Learning Outcome'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: 'annotation'  });

        data.addRows([<?php echo implode(',', $scores); ?>]);

        var view = new google.visualization.DataView(data);
        view.setColumns([1, 2, 3]);

        var options = {
            allowHtml: true,
            legend: {position: 'none'},
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
                title: '<?php echo lang('Score') ?>',
                viewWindowMode:'explicit',
                viewWindow: {
                    max:5,
                    min:0
                }
            }
        };

        function selectHandler() {
            var selectedItem = chart.getSelection()[0];

            if (selectedItem && selectedItem.row != null) {
                var value = data.getValue(selectedItem.row, 0);
                ajaxRender('sections','/curriculum_mapping/reporting/qualitative?type=plo&id='+value);
            }
        }

        var chart = new google.visualization.BarChart(document.getElementById('program-plo'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(view, options);
    }
</script>
<div id="sections"></div>