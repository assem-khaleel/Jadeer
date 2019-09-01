<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:53 AM
 */
/** @var $method_id int */
$json = array();
$outcomes_json = array();
/** @var $colleges array */
foreach ($colleges as $key => $college) {
    $json[] = "['". htmlfilter(Orm_College::get_instance($college['college_id'])->get_name()) ."', " . number_format($college['score'],2) . "," . number_format($college['score'],2) . ", " . $college['college_id']  . ", '". Orm_Cm_Section_Student_Assessment::$GOOGLE_COLORS[$key%20] ."']";
}
$method = Orm_Cm_Assessment_Method::get_instance($method_id);
?>
<div class="row m-y-2">
    <div class="col-md-12">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Colleges'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="colleges-method"></div>
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
        data.addColumn('string', '<?php echo lang('College'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });
        data.addColumn({ type:"number", role: "annotationText" });
        data.addColumn({ type:"string", role: 'style'  });

        data.addRows([
            <?php echo implode(',', $json); ?>
        ]);

        var options = {
            legend: {position: 'none'},
            title: '<?php echo htmlfilter($method->get_title()); ?>',
            annotations: {
                alwaysOutside: true,
                textStyle: {
                    fontSize: 14,
                    color: '#000',
                    auraColor: 'none'
                }
            },
            vAxis: {
                title: '<?php echo lang('Colleges') ?>'
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
                ajaxRender('programs','/curriculum_mapping/reporting/assessment_methods?type=programs&college_id='+value+'&method_id=<?php echo $method_id; ?>');
            }
        }

        var chart = new google.visualization.BarChart(
            document.getElementById('colleges-method'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(data, options);
    }
</script>
<div id="programs"></div>
