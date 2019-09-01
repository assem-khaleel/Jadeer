<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:53 AM
 */

/** @var $domain_id int */
/** @var $section_id int */
/** @var $overall_target int */
$json = array();
$outcomes_json = array();
/** @var $students array */
/** @var $outcomes array */
foreach ($students as $key => $student) {
    $json[] = "[" . $student['student_id'] . ",'". Orm_User::get_instance($student['student_id'])->get_full_name(true) ."', " . number_format($student['score'],2) . "," . number_format($student['score'],2) . ", " . $overall_target . ", ". $overall_target ."]";
}
$domain = Orm_Cm_Learning_Domain::get_instance($domain_id);
?>
<div class="row m-y-2">
    <div class="col-md-12">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Students'); ?></div>
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
        data.addColumn('number', '<?php echo lang('ID'); ?>');
        data.addColumn('string', '<?php echo lang('Student'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });

        data.addRows([<?php echo implode(',', $json); ?>]);

        var dataView = new google.visualization.DataView(data);

        dataView.setColumns([1,2,3,4,5]);

        var options = {
            bar: { groupWidth: 20 },
            legend: { position: 'top', maxLines: 3 },
            title: '<?php echo htmlfilter($domain->get_title()); ?>',
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

        function selectHandler() {
            var selectedItem = chart.getSelection()[0];

            if (selectedItem && selectedItem.row != null) {
                var value = data.getValue(selectedItem.row, 0);
                ajaxRender('outcomes','/curriculum_mapping/reporting/outcomes?type=student&student_id='+value+'&section_id=<?php echo $section_id; ?>&domain_id=<?php echo $domain_id; ?>');
            }
        }

        var chart = new google.visualization.BarChart(
            document.getElementById('students-score'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(dataView, options);
    }
</script>
<div id="outcomes"></div>