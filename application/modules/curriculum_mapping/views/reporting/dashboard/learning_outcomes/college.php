<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:48 AM
 */

$college_id = Orm_User::get_logged_user()->get_college_id();

$domains_target = Orm_Cm_Program_Learning_Outcome_Target::get_domain_target($college_id);

$json = array();
/** @var $domains array */
foreach ($domains as $key => $domain) {

    $target = isset($domains_target[$domain['domain_id']]) ? number_format($domains_target[$domain['domain_id']], 2) : 0;

    $json[] = "[" . $domain['domain_id'] . ",'". Orm_Cm_Learning_Domain::get_instance($domain['domain_id'])->get_title() ."', " . number_format($domain['score'],2) . "," . number_format($domain['score'],2) . ", " . $target . ", " . $target ."]";
}
?>
<div id="domains"></div>
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
        data.addColumn('string', '<?php echo lang('Learning Domain'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });
        data.addColumn('number', '<?php echo lang('Target'); ?>');
        data.addColumn({ type:"number", role: "annotation" });

        data.addRows([<?php echo implode(',', $json); ?>]);

        var dataView = new google.visualization.DataView(data);

        dataView.setColumns([1,2,3,4,5]);

        var options = {
            allowHtml: true,
            legend: {position: 'none'},
            title: '<?php echo lang('Learning Domain'); ?>',
            is3D:true,
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: '#000',
                    auraColor: 'none'
                }
            },
            vAxis: {
                title: '<?php echo lang('Learning Domain') ?>'
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

        function selectHandler() {
            var selectedItem = chart.getSelection()[0];

            if (selectedItem && selectedItem.row != null) {
                var value = data.getValue(selectedItem.row, 0);
                ajaxRender('colleges','/curriculum_mapping/reporting/outcomes?type=programs&college_id=<?php echo $college_id; ?>&domain_id='+value);
            }
        }

        var chart = new google.visualization.BarChart(
            document.getElementById('domains'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(dataView, options);
    }
</script>
<div id="colleges"></div>