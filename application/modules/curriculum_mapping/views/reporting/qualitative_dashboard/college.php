<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:53 AM
 */


$json = array();
$factors = array();
$filters = array();

$college_id = Orm_User::get_logged_user()->get_college_id();

foreach (Orm_Cm_Program_Learning_Outcome_Survey::get_all(array('college_id' => $college_id)) as $item) {
    $factors[$item->get_factor_id()] = $item->get_factor_id();
}

$filters['class_type'] = 'Orm_User_Student';
$filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

foreach (Orm_Program::get_all(array('college_id' => $college_id)) as $program) {
    $item = 0;
    foreach (Orm_Cm_Program_Learning_Outcome_Survey::get_all(array('program_id' => $program->get_id())) as $factor) {
        $obj = Orm_Survey_Question_Statement::get_instance($factor->get_statement_id());
        $filters['program_id'] = $program->get_id();
        $response = $obj->get_user_response($filters);

        $item += $response['average'];
    }
    $items_count = Orm_Cm_Program_Learning_Outcome_Survey::get_count(array('program_id' => $program->get_id()));
    $score = $items_count ? round($item / $items_count, 2) : 0;
    $program_name = trim(str_replace('\'', '\\\'', htmlfilter($program->get_name())));
    $json[] = "[{$program->get_id()},'{$program_name}',{$score},{$score}]";
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Programs'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="programs-scores"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart', 'bar']});
        google.setOnLoadCallback(drawPrograms);
    } else {
        drawPrograms();
    }

    function drawPrograms() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', '<?php echo lang('ID'); ?>');
        data.addColumn('string', '<?php echo lang('Program'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });

        data.addRows([<?php echo implode(',', $json); ?>]);

        var view = new google.visualization.DataView(data);
        view.setColumns([1, 2, 3]);

        var options = {
            legend: {position: 'none'},
            title: '<?php echo lang('Programs of') . ' ' . Orm_College::get_instance($college_id)->get_name(); ?>',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: '#000',
                    auraColor: 'none'
                }
            },
            vAxis: {
                title: '<?php echo lang('Programs') ?>'
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
                ajaxRender('courses','/curriculum_mapping/reporting/qualitative?type=courses&program_id='+value);
            }
        }

        var chart = new google.visualization.BarChart(
            document.getElementById('programs-scores'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(view, options);
    }
</script>
<div id="courses"></div>