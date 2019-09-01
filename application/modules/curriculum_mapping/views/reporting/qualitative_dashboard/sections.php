<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 09/04/17
 * Time: 11:53 AM
 */

/** @var int $course_id */
$json = array();
$factors = array();
$scores = array();
$filters = array();
$clo = array();

$filters['class_type'] = 'Orm_User_Student';
$filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

foreach (Orm_Cm_Course_Learning_Outcome_Survey::get_all(array('course_id' => $course_id)) as $item) {
    $clo[$item->get_course_learning_outcome_id()] = $item->get_course_learning_outcome_id();
}

foreach ($clo as $c) {

    $clo_obj = Orm_Cm_Course_Learning_Outcome::get_instance($c);
    $item = 0;
    foreach (Orm_Cm_Course_Learning_Outcome_Survey::get_all(array('course_learning_outcome_id' => $c)) as $factor) {
        $obj = Orm_Survey_Question_Statement::get_instance($factor->get_statement_id());
        $filters['course_id'] = $course_id;
        $response = $obj->get_user_response($filters);

        $item += $response['average'];
    }
    $items_count = Orm_Cm_Course_Learning_Outcome_Survey::get_count(array('course_learning_outcome_id' => $c));

    $score = $items_count ? round($item / $items_count, 2) : 0;
    $text = trim(str_replace('\'', '\\\'', htmlfilter($clo_obj->get_text())));

    $scores[] = "[{$clo_obj->get_id()},'{$text}',{$score},{$score}]";
}

foreach (Orm_Course_Section::get_all(array('course_id' => $course_id, 'semester_id' => Orm_Semester::get_active_semester()->get_id())) as $section) {

    $item = 0;
    foreach (Orm_Cm_Course_Learning_Outcome_Survey::get_all(array('course_id' => $course_id)) as $factor) {
        $obj = Orm_Survey_Question_Statement::get_instance($factor->get_statement_id());
        $filters['course_id'] = $course_id;
        $filters['section_id'] = $section->get_id();
        $response = $obj->get_user_response($filters);

        $item += $response['average'];
    }
    $items_count = Orm_Cm_Course_Learning_Outcome_Survey::get_count(array('course_id' => $course_id));
    $score = $items_count ? round($item / $items_count, 2) : 0;
    $section_name = trim(str_replace('\'', '\\\'', htmlfilter($section->get_name())));
    $json[] = "[{$section->get_id()},'{$section_name}',{$score},{$score}]";
}
?>
<div class="row">
    <div class="col-md-6">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Sections'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="sections-scores"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo Orm_Course::get_instance($course_id)->get_name() . ' - ' . lang('Learning Outcomes'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="course-clo"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart', 'bar']});
        google.setOnLoadCallback(drawSections);
        google.setOnLoadCallback(drawCLOs);
    } else {
        drawSections();
        drawCLOs();
    }

    function drawSections() {

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
            title: '<?php echo Orm_Course::get_instance($course_id)->get_name() . ' ' . lang('Sections'); ?>',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: '#000',
                    auraColor: 'none'
                }
            },
            vAxis: {
                title: '<?php echo lang('Sections') ?>'
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
                ajaxRender('section','/curriculum_mapping/reporting/qualitative?type=section&section_id='+value);
            }
        }

        var chart = new google.visualization.BarChart(document.getElementById('sections-scores'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(view, options);
    }

    function drawCLOs() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', '<?php echo lang('ID'); ?>');
        data.addColumn('string', '<?php echo lang('Course Learning Outcome'); ?>');
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
                ajaxRender('section','/curriculum_mapping/reporting/qualitative?type=clo&id='+value);
            }
        }

        var chart = new google.visualization.BarChart(document.getElementById('course-clo'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(view, options);
    }
</script>
<div id="section"></div>