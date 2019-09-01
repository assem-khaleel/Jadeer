<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 1/12/17
 * Time: 11:53 AM
 */

/** @var $domain_id int */
/** @var $course_id int */
/** @var $overall_target int */
$json = array();
$outcomes_json = array();
/** @var $sections array */
/** @var $outcomes array */
foreach ($sections as $key => $section) {
    $json[] = "[" . $section['section_id'] . ",'". Orm_Course_Section::get_instance($section['section_id'])->get_name() ."', " . number_format($section['score'],2) . "," . number_format($section['score'],2) . ", " . $overall_target . ", ". $overall_target ."]";
}

$outcome_target = Orm_Cm_Program_Learning_Outcome_Target::get_outcomes_score($domain_id, 0, 0, $course_id);

foreach ($outcomes as $key => $outcome) {

    $target = isset($outcome_target[$outcome['outcome_id']]) ? number_format($outcome_target[$outcome['outcome_id']], 2) : 0;

    $outcomes_json[] = "['". Orm_Cm_Course_Learning_Outcome::get_instance($outcome['outcome_id'])->get_text() . "', " . number_format($outcome['score'],2) . ", " . number_format($outcome['score'],2) . ", " . $target . ", " . $target ."]";
}
$domain = Orm_Cm_Learning_Domain::get_instance($domain_id);
?>
<div class="row m-y-2">
    <div class="col-md-6">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Sections'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="sections-domain"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo $domain->get_title() . ' ' . lang('Learning Outcomes'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-2">
                    <div id="course-outcomes"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart', 'bar']});
        google.setOnLoadCallback(drawColleges);
        google.setOnLoadCallback(drawOutcomes);
    } else {
        drawColleges();
        drawOutcomes();
    }

    function drawColleges() {

        var data = new google.visualization.DataTable();
        data.addColumn('number', '<?php echo lang('ID'); ?>');
        data.addColumn('string', '<?php echo lang('Section'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: "annotation" });
        data.addColumn('number', '<?php echo lang('Target'); ?>');
        data.addColumn({ type:"number", role: "annotation" });

        data.addRows([<?php echo implode(',', $json); ?>]);

        var dataView = new google.visualization.DataView(data);

        dataView.setColumns([1,2,3,4,5]);

        var options = {
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
                title: '<?php echo lang('Sections') ?>'
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
                ajaxRender('students','/curriculum_mapping/reporting/outcomes?type=students&section_id='+value+'&domain_id=<?php echo $domain_id; ?>&target=<?php echo $overall_target; ?>');
            }
        }

        var chart = new google.visualization.BarChart(
            document.getElementById('sections-domain'));

        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(dataView, options);
    }

    function drawOutcomes() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', '<?php echo lang('Outcome'); ?>');
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: 'annotation'  });
        data.addColumn('number', '<?php echo lang('Score'); ?>');
        data.addColumn({ type:"number", role: 'annotation'  });

        data.addRows([
            <?php echo implode(',', $outcomes_json); ?>
        ]);

        var options = {
            allowHtml: true,
            legend: { position: 'top', maxLines: 3 },
            title: '<?php echo $domain->get_title() . ' ' . lang('Learning Outcomes'); ?>',
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
                title: '<?php echo lang('Score (%)') ?>',
                viewWindowMode:'explicit',
                viewWindow: {
                    max:100,
                    min:0
                }
            }
        };

        var chart = new google.visualization.BarChart(
            document.getElementById('course-outcomes'));

        chart.draw(data, options);
    }
</script>
<div id="students"></div>