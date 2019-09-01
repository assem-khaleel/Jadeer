<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/3/17
 * Time: 4:56 PM
 */

/** @var Orm_Cm_Learning_Domain $domain */
/** @var array $result */
?>
<div id="sub-chart" style="width: 100%; height: 300px;"></div>
<script type="text/javascript">

    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart']});
        google.setOnLoadCallback(drawCLOChart);
    } else {
        drawCLOChart();
    }

    function drawCLOChart() {

        var data = new google.visualization.DataTable();

        data.addColumn('string', '<?php echo lang('Learning Outcome'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        <?php foreach ($result as $item) {
            $score = floatval($item['score']);
            $rows[] = "['{$item['outcome']}', {$score}]";
        } ?>
        data.addRows([<?php echo implode(',', $rows); ?>]);

        var dataView = new google.visualization.DataView(data);

        var options = {
            title: '<?php echo htmlfilter($domain->get_title()); ?>',
            fontSize: 12,
            legend: {position: 'none'},
            chartArea: {left:'30%',width:'60%'},
            hAxis:{
                viewWindowMode: 'explicit',
                viewWindow: {
                    max: 100,
                    min: 0
                },
                gridlines: {
                    count: 10
                }
            }
        };

        var chart = new google.visualization.BarChart(document.getElementById('sub-chart'));
        chart.draw(dataView, options);
    }
</script>
<script>window.onresize = function(){drawCLOChart();};</script>