<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:48 AM
 */
$json = array();
$factors = array();
$filters = array();

foreach (Orm_Cm_Program_Learning_Outcome_Survey::get_all() as $item) {
    $factors[$item->get_factor_id()] = $item->get_factor_id();
}

$filters['class_type'] = 'Orm_User_Student';
$filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

foreach (Orm_College::get_all() as $college) {
    $item = 0;
    foreach (Orm_Cm_Program_Learning_Outcome_Survey::get_all(array('college_id' => $college->get_id())) as $factor) {
        $obj = Orm_Survey_Question_Statement::get_instance($factor->get_statement_id());
        $filters['college_id'] = $college->get_id();
        $response = $obj->get_user_response($filters);

        $item += $response['average'];
    }
    $items_count = Orm_Cm_Program_Learning_Outcome_Survey::get_count(array('college_id' => $college->get_id()));
    $score = $items_count ? round($item / $items_count, 2) : 0;
    $json[] = "[{$college->get_id()},'". str_replace(['&amp;','\''], ['&','\\\''], htmlfilter($college->get_name())). "',{$score},{$score}]";
}
?>
<div id="colleges-score" style="min-height: 600px;"></div>

<script type="text/javascript">

    <?php $uniqid = uniqid(); ?>

    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart', 'bar']});
        google.setOnLoadCallback(drawBasic_<?php echo $uniqid?>);
    } else {
        drawBasic_<?php echo $uniqid?>();
    }

    function drawBasic_<?php echo $uniqid?>() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', '<?php echo lang('ID'); ?>');
        data.addColumn('string', '<?php echo lang('College'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });

        data.addRows([<?php echo implode(',', $json); ?>]);

        var view = new google.visualization.DataView(data);
        view.setColumns([1, 2, 3]);

        var options = {
            allowHtml: true,
            legend: {position: 'none'},
            title: '<?php echo lang('Colleges Scores'); ?>',
            is3D:true,
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: '#000',
                    auraColor: 'none'
                }
            },
            bar: { groupWidth: '75%' },
            chartArea: {
                width:"65%"
            },
            vAxis: {
                title: '<?php echo lang('College') ?>'
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
                ajaxRender('programs','/curriculum_mapping/reporting/qualitative?type=programs&college_id='+value);
            }
        }

        var chart = new google.visualization.BarChart(document.getElementById('colleges-score'));
        google.visualization.events.addListener(chart, 'select', selectHandler);
        chart.draw(view, options);
    }
</script>
<div id="programs"></div>