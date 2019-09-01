<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 2/15/17
 * Time: 2:00 PM
 */

$json = array();
/** @var $domains array */
foreach ($methods as $key => $method) {
    $json[] = "['". htmlfilter(Orm_Cm_Assessment_Method::get_instance($method['method_id'])->get_title()) ."', " . number_format($method['score'],2) . "," . number_format($method['score'],2) . ", " . $method['method_id'] . ", '". Orm_Cm_Section_Student_Assessment::$GOOGLE_COLORS[$key%20] ."']";
}

/** @var $section_id int */
/** @var $course_id int */

$filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
$filters['in_id'] = Orm_Course_Section_Teacher::get_section_ids();
$course_sections = Orm_Course_Section::get_all($filters);

?>

<div class="row">
    <div class="col-md-3">
        <?php if (!empty($course_sections)): ?>
        <div class="well">
            <?php foreach ($course_sections as $course_section) { ?>
                <a href="/curriculum_mapping/reporting/assessment_methods/?course_id=<?php echo $course_section->get_course_id() ?>&section_id=<?php echo $course_section->get_id() ?>" class="btn btn-block  <?php echo $section_id == $course_section->get_id() ? 'btn-primary' : '' ?>" type="button">
                    <i class="fa fa-tasks btn-label-icon left"></i>
                    <?php echo htmlfilter($course_section->get_course_obj()->get_code()) . ' - ' . htmlfilter($course_section->get_section_no()); ?>
                </a>
            <?php } ?>
            <?php else:?>
                <tr>
                    <td colspan="7">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Assessment Methods'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php  endif;?>
        </div>
    </div>
    <div class="col-md-9">
        <?php if ($section_id && $course_id) { ?>
            <div class="row m-y-2">
                <div class="col-md-12">
                    <div class="panel box">
                        <div class="box-row">
                            <div class="box-cell p-x-3 p-y-1">
                                <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Assessment Methods'); ?></div>
                            </div>
                        </div>
                        <div class="box-row">
                            <div class="box-cell p-x-3 p-y-2">
                                <div id="methods"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                            ajaxRender('students','/curriculum_mapping/reporting/assessment_methods?type=students&section_id=<?php echo $section_id; ?>&method_id='+value);
                        }
                    }

                    var chart = new google.visualization.BarChart(document.getElementById('methods'));

                    google.visualization.events.addListener(chart, 'select', selectHandler);

                    chart.draw(data, options);
                }
            </script>
        <?php } else { ?>
        <?php } ?>
        <div id="students"></div>
    </div>
</div>
