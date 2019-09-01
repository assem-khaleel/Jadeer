<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:48 AM
 */
$college_id = Orm_User::get_logged_user()->get_college_id();
$json = array();
/** @var $domains array */
foreach ($methods as $key => $method) {
    $json[] = "['". htmlfilter(Orm_Cm_Assessment_Method::get_instance($method['method_id'])->get_title()) ."', " . number_format($method['score'],2) . "," . number_format($method['score'],2) . ", " . $method['method_id'] . ", '". Orm_Cm_Section_Student_Assessment::$GOOGLE_COLORS[$key%20] ."']";
}
?>
<div id="methods"></div>
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
        data.addColumn('string', '<?php echo lang('Assessment Method'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });
        data.addColumn({ type:"number", role: "annotationText" });
        data.addColumn({ type:"string", role: 'style'  });

        data.addRows([
            <?php echo implode(',', $json); ?>
        ]);

        var options = {
            allowHtml: true,
            legend: {position: 'none'},
            title: '<?php echo lang('Assessment Method'); ?>',
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
                title: '<?php echo lang('Assessment Method') ?>'
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
                var value = data.getValue(selectedItem.row, selectedItem.column + 2);
                ajaxRender('programs','/curriculum_mapping/reporting/assessment_methods?type=programs&college_id=<?php echo $college_id; ?>&method_id='+value);
            }
        }

        var chart = new google.visualization.BarChart(document.getElementById('methods'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(data, options);
    }
</script>
<div id="programs"></div>