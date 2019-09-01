<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 2/15/17
 * Time: 2:00 PM
 */

$scores = array();
$filters = array();
$clo = array();

if (isset($section_id) && isset($course_id)) {
    $filters['class_type'] = 'Orm_User_Student';
    $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();

    foreach (Orm_Cm_Course_Learning_Outcome_Survey::get_all(array('course_id' => $course_id)) as $item) {
        $clo[$item->get_course_learning_outcome_id()] = $item->get_course_learning_outcome_id();
    }

    foreach ($clo as $c) {

        $clo_obj = Orm_Cm_Course_Learning_Outcome::get_instance($c);
        $item = 0;
        foreach (Orm_Cm_Course_Learning_Outcome_Survey::get_all(array('course_learning_outcome_id' => $c)) as $factor) {
            $obj = Orm_Survey_Question_Statement::get_instance($factor->get_statement_id());
            $filters['course_id'] = $course_id;
            $filters['section_id'] = $section_id;
            $response = $obj->get_user_response($filters);

            $item += $response['average'];
        }
        $items_count = Orm_Cm_Course_Learning_Outcome_Survey::get_count(array('course_learning_outcome_id' => $c));

        $score = $items_count ? round($item / $items_count, 2) : 0;
        $clo_name = trim(str_replace('\'', '\\\'', htmlfilter($clo_obj->get_text())));
        $scores[] = "[{$clo_obj->get_id()},'{$clo_name}',{$score},{$score}]";
    }
}

/** @var $section_id int */
/** @var $course_id int */

$sections_filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
$sections_filters['in_id'] = Orm_Course_Section_Teacher::get_section_ids();
$course_sections = Orm_Course_Section::get_all($sections_filters);

?>

<div class="row">
    <div class="col-md-3">
        <?php if (!empty($course_sections)): ?>
        <div class="well">
            <?php foreach ($course_sections as $course_section) { ?>
                <a href="/curriculum_mapping/reporting/qualitative/?course_id=<?php echo $course_section->get_course_id() ?>&section_id=<?php echo $course_section->get_id() ?>" class="btn btn-block  <?php echo $section_id == $course_section->get_id() ? 'btn-primary' : '' ?>" type="button">
                    <i class="fa fa-tasks btn-label-icon left"></i>
                    <?php echo htmlfilter($course_section->get_course_obj()->get_code()) . ' - ' . htmlfilter($course_section->get_section_no()); ?>
                </a>
            <?php } ?>
            <?php else:?>
                <tr>
                    <td colspan="7">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Qualitative'); ?></h3>
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
                                <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Learning Outcomes Scores'); ?></div>
                            </div>
                        </div>
                        <div class="box-row">
                            <div class="box-cell p-x-3 p-y-2">
                                <div id="scores"></div>
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
                    data.addColumn('number', '<?php echo lang('ID'); ?>');
                    data.addColumn('string', '<?php echo lang('Course Learning Outcome'); ?>');
                    data.addColumn('number', '<?php echo lang('Score'); ?>');
                    data.addColumn({ type:"number", role: "annotation" });

                    data.addRows([<?php echo implode(',', $scores); ?>]);

                    var view = new google.visualization.DataView(data);
                    view.setColumns([1, 2, 3]);

                    var options = {
                        allowHtml: true,
                        legend: {position: 'none'},
                        title: '<?php echo lang('Learning Outcomes'); ?>',
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
                            title: '<?php echo lang('Outcomes') ?>'
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
                            ajaxRender('CLO','/curriculum_mapping/reporting/qualitative?type=clo&section_id=<?php echo $section_id; ?>&id='+value);
                        }
                    }

                    var chart = new google.visualization.BarChart(document.getElementById('scores'));

                    google.visualization.events.addListener(chart, 'select', selectHandler);

                    chart.draw(view, options);
                }
            </script>
        <?php } else { ?>
        <?php } ?>
        <div id="CLO"></div>
    </div>
</div>
