<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 2/5/16
 * Time: 9:43 PM
 */
/** @var int $student_id */
/** @var int $section_id */
/** @var int $course_id */
/** @var Orm_Cm_Learning_Domain[] $domains */
$course_assessment_methods = Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $course_id));
$domains = array();

if ($course_id) {
    $mapping_matrix = Orm_Cm_Course_Mapping_Matrix::get_all(array('course_id' => $course_id));
    foreach ($mapping_matrix as $item) {
        $domains[$item->get_course_learning_outcome_obj()->get_learning_domain_id()] = $item->get_course_learning_outcome_obj()->get_learning_domain_obj();
    }
}
$domains_array = array();
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption"><?php echo lang('Course Assessment Matrix'); ?></div>
    </div>
    <div class="table-header">
        <div
            class="table-caption"><?php echo htmlfilter(Orm_Course::get_instance($course_id)->get_code() . ' - ' . Orm_Course::get_instance($course_id)->get_name());
            echo htmlfilter($section_id ? ' ( ' . lang('Section #').': ' . Orm_Course_Section::get_instance($section_id)->get_section_no() . ' ) ' : ''); ?></div>
    </div>
    <?php if ($student_id) { ?>
        <div class="table-header">
            <div
                class="table-caption"><?php echo htmlfilter(Orm_User_Student::get_instance($student_id)->get_full_name()); ?></div>
        </div>
    <?php } ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th><?php echo lang('Competencies Dimension'); ?></th>
            <?php foreach ($course_assessment_methods as $method) { ?>
                <th><?php echo htmlfilter($method->get_text()); ?></th>
            <?php } ?>
            <th><?php echo lang('Overall Band Performance'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($domains)) { ?>
            <tr class="text-bold">
                <td colspan="<?php echo count($course_assessment_methods) + 2; ?>">
                    <div class="alert alert-default">
                        <div class="m-b-1">
                            <?php echo lang('This Student Has not been Assessed yet'); ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } else { ?>
            <?php foreach ($domains as $domain) { ?>
                <tr class="text-bold">
                    <td><b><?php echo htmlfilter($domain->get_title()); ?></b></td>
                    <?php foreach ($course_assessment_methods as $method) { ?>
                        <td class="text-right"><?php echo Orm_Cm_Section_Student_Assessment::get_course_assessment_method_score($course_id, $method->get_id(), $domain->get_id(), 0, $section_id, $student_id); ?></td>
                    <?php } ?>
                    <td class="text-right"><?php $domains_array[$domain->get_id()] = array($domain->get_title(), Orm_Cm_Section_Student_Assessment::get_course_assessment_method_score($course_id,0,$domain->get_id(), 0,$section_id, $student_id)); echo $domains_array[$domain->get_id()][1] ?></td>
                </tr>
                <?php foreach (Orm_Cm_Course_Learning_Outcome::get_outcomes($course_id, $domain->get_id()) as $course_learning_outcome) { ?>
                    <tr>
                        <td class="padding-sm">
                            <span class="m-l-3">
                                <?php echo htmlfilter($course_learning_outcome->get_text()); ?>
                            </span>
                        </td>
                        <?php foreach ($course_assessment_methods as $method) { ?>
                            <td class="text-right"><?php echo Orm_Cm_Section_Student_Assessment::get_course_assessment_method_score($course_id, $method->get_id(), $domain->get_id(), $course_learning_outcome->get_id(), $section_id, $student_id); ?></td>
                        <?php } ?>
                        <td class="text-right"><?php echo Orm_Cm_Section_Student_Assessment::get_course_assessment_method_score($course_id, 0, $domain->get_id(), 0, $section_id, $student_id); ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
            <tr class="text-bold bg-default">
                <td><?php echo lang('Overall Band Performance based on SLOs'); ?></td>
                <?php foreach ($course_assessment_methods as $method) { ?>
                    <td class="text-right"><?php echo Orm_Cm_Section_Student_Assessment::get_course_assessment_method_score($course_id, $method->get_id(), 0, 0, $section_id, $student_id); ?></td>
                <?php } ?>
                <td class="text-right"><?php echo Orm_Cm_Section_Student_Assessment::get_course_assessment_method_score($course_id, 0, 0, 0, $section_id, $student_id); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if (!empty($domains)) { ?>
        <div class="table-footer">
            <div id="rubric-chart" style="width: 100%; height: 300px;"></div>
            <script type="text/javascript">

                if (typeof google.visualization === 'undefined') {
                    google.load('visualization', '1', {'packages':['corechart']});
                    google.setOnLoadCallback(drawChart);
                } else {
                    drawChart();
                }

                function drawChart() {

                    var data = new google.visualization.DataTable();

                    data.addColumn('number', 'Domain ID');
                    data.addColumn('string', '<?php echo lang('Learning Domain'); ?>');
                    data.addColumn('number', '<?php echo lang('Score'); ?>');
                    <?php foreach ($domains_array as $key => $item) {
                        $score = floatval($item[1]);
                        $rows[] = "[{$key},'{$item[0]}', {$score}]";
                    } ?>
                    data.addRows([<?php echo implode(',', $rows); ?>]);

                    var dataView = new google.visualization.DataView(data);

                    dataView.setColumns([1,2]);

                    var options = {
                        title: '<?php echo htmlfilter(lang('Overall Band Performance based on SLOs')); ?>',
                        fontSize: 12,
                        legend: {position: 'none'},
                        chartArea: {left: '30%', width: '60%'},
                        hAxis: {
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

                    var chart = new google.visualization.BarChart(document.getElementById('rubric-chart'));
                    google.visualization.events.addListener(chart, 'select', function() {

                        var obj = chart.getSelection();
                        if (obj.length) {
                            load_clo(data.getValue(obj[0]['row'],0));
                        } else {
                            $('#clo-chart').html('').css('display','none');
                        }
                    });
                    chart.draw(dataView, options);
                }

                function load_clo(domain_id) {
                    $('#clo-chart').load('/curriculum_mapping/reporting/clo_results/<?php echo $course_id ?>/<?php echo $section_id ?>/'+domain_id+'/<?php echo $student_id; ?>').css('display','block');
                }
            </script>
            <script> window.onresize = function () { drawChart(); };</script>
        </div>
        <div class="table-footer" id="clo-chart" style="display: none;"></div>
    <?php } ?>
</div>
