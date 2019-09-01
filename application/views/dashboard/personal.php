<?php
$logged_user = Orm_User::get_logged_user();
$courses = array();
$course_sections = array();
$course_section_ids = array(0);

if ($logged_user->get_class_type() == Orm_User::USER_FACULTY) {
    $course_sections = Orm_Course_Section_Teacher::get_all(array('user_id' => $logged_user->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id(), 'is_deleted' => 0));

    foreach ($course_sections as $section) {
        $courses[$section->get_section_obj()->get_course_id()] = $section->get_section_obj()->get_course_obj();
        $course_section_ids[$section->get_section_id()] = $section->get_section_id();
    }
} elseif ($logged_user->get_class_type() == Orm_User::USER_STUDENT) {

    $course_sections = Orm_Course_Section_Student::get_all(array('user_id' => $logged_user->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id()));
}
?>

    <div class="row">
        <div class="col-md-6">
            <?php echo $this->load->view('tasks/widget'); ?>
        </div>
        <div class="col-md-6">
            <?php
            if (License::get_instance()->check_module('survey') && Modules::load('survey')) {
                echo Modules::run('survey/survey_dashboard/personal');
            }
            ?>
        </div>
    </div>

<?php if ($logged_user->get_class_type() == Orm_User::USER_FACULTY) { ?>
    <div class="row">
        <div class="col-md-3">
            <div class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Courses'); ?></div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left text-danger font-size-52 fa fa-book"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1"><?php echo count($courses); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Course Sections'); ?></div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left text-danger font-size-52 fa fa-address-book"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1"><?php echo count($course_sections); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (License::get_instance()->check_module('survey') && Modules::load('survey')) { ?>
            <div class="col-md-3">
                <div class="panel box bg-white text-default">
                    <div class="box-row">
                        <div class="box-cell p-x-3 p-y-1">
                            <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Surveys'); ?></div>
                        </div>
                    </div>
                    <div class="box-row">
                        <div class="box-cell p-x-3 p-y-2">
                            <i class="box-bg-icon middle left text-danger font-size-52 fa fa-tasks"></i>
                            <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1"><?php echo Orm_Survey_Evaluator::get_count(array('academic_year' => Orm_Semester::get_active_semester()->get_year(), 'user_id' => $logged_user->get_id())); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-md-3">
            <div class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Students'); ?></div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left text-danger font-size-52 fa fa-users"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1"><?php echo Orm_Course_Section_Student::get_count(array('semester_id' => Orm_Semester::get_active_semester()->get_id(), 'section_id_in' => $course_section_ids)); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('No. of Courses') . ' ' . lang('Last 5 Years'); ?></div>
                    </div>
                </div>
                <div class="box-row">
                    <div id="course-taught"></div>
                    <?php
                    $sections_in_year = array();
                    $years = array(lang('Academic Year'));
                    $ticks = array();
                    $academic_years = Orm_Semester::get_last_five_years();
                    sort($academic_years);
                    foreach ($academic_years as $year) {
                        $count = Orm_Course_Section_Teacher::get_count(array('user_id' => $logged_user->get_id(), 'academic_year' => $year['year'], 'is_deleted' => 0));
                        $sections_in_year[] = array(intval($year['year']), $count, $count);
                        $years[] = $year['year'];
                        $ticks[] = $year['year'];
                    }
                    ?>
                    <script>

                        if (typeof google.visualization === 'undefined') {
                            google.load('visualization', '1', {'packages':['corechart', 'bar']});
                            google.setOnLoadCallback(drawBasic);
                        } else {
                            drawBasic();
                        }

                        function drawBasic() {

                            var data = new google.visualization.DataTable();
                            data.addColumn('number', '<?php echo lang('Academic Year'); ?>');
                            data.addColumn('number', '<?php echo lang('No. Of Courses'); ?>');
                            data.addColumn({type: 'number', role: 'annotation'});

                            data.addRows(<?php echo json_encode($sections_in_year) ?>);

                            var options = {
                                legend: {position: 'in'},
                                hAxis: {
                                    title: '<?php echo lang('Academic Year'); ?>',
                                    textPosition: 'out',
                                    showTextEvery: 1,
                                    format: '',
                                    viewWindow: {
                                        min: [7, 30, 0],
                                        max: [17, 30, 0]
                                    }
                                },
                                vAxis: {
                                    title: '<?php echo lang('No. Of Courses'); ?>',
                                    viewWindow: {
                                        min: 0,
                                        max: 5
                                    }
                                }
                            };

                            var chart = new google.visualization.ColumnChart(
                                document.getElementById('course-taught'));

                            chart.draw(data, options);
                        }
                    </script>
                </div>
            </div>
        </div>
        <?php if (License::get_instance()->check_module('accreditation') && Modules::load('accreditation')) { ?>
            <div class="col-md-3">
                <div class="panel box bg-white text-default">
                    <div class="box-row">
                        <div class="box-cell p-x-3 p-y-1">
                            <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('Accreditation Progress'); ?></div>
                        </div>
                    </div>
                    <div class="box-row">
                        <?php $assessor_nodes = Orm_Node_Assessor::get_all(array('assessor_id' => Orm_User::get_logged_user()->get_id())); ?>
                        <?php
                        $completed = 0;
                        foreach ($assessor_nodes as $assessor_node) {
                            $node = $assessor_node->get_node_obj();
                            $completed += $node->get_progress_score();
                        }
                        $completed = count($assessor_nodes) ? $completed / count($assessor_nodes) : 0;
                        $all = 100 - $completed;
                        $chart[] = array(lang('Completed'), $completed);
                        $chart[] = array(lang('Not Completed'), $all);
                        ?>
                        <div id="accreditation-chart"></div>
                        <script>

                            if (typeof google.visualization === 'undefined') {
                                google.load('visualization', '1', {'packages':['corechart']});
                                google.setOnLoadCallback(drawChart);
                            } else {
                                drawChart();
                            }

                            function drawChart() {

                                var data = new google.visualization.DataTable();
                                data.addColumn('string', '<?php echo lang('Status'); ?>');
                                data.addColumn('number', '<?php echo lang('Percentage'); ?>');
                                data.addRows(<?php echo json_encode($chart) ?>);

                                var options = {
                                    legend: {position: 'bottom'}
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('accreditation-chart'));

                                chart.draw(data, options);
                            }
                        </script>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php if (License::get_instance()->check_module('curriculum_mapping') && Modules::load('curriculum_mapping')) { ?>
        <?php if (!empty($course_sections)) { ?>
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title"><i class="panel-title-icon fa fa-pencil text-danger"></i><?php echo lang('Student Assessment'); ?></span>
                    <ul class="nav nav-tabs nav-xs">
                        <?php $i = 0; ?>
                        <?php $extraSections = []; ?>
                        <?php foreach ($course_sections as $key => $course_section) { ?>
                            <?php $i++; ?>
                            <?php if ($i <= 7) { ?>
                                <li class="<?php echo $key == 0 ? 'active' : '' ?>"><a
                                            href="#section-<?php echo $course_section->get_id() ?>"
                                            title="<?php echo htmlfilter($course_section->get_section_obj()->get_course_obj()->get_name()); ?>"
                                            data-toggle="tab"
                                            aria-expanded="false"><?php echo htmlfilter($course_section->get_section_obj()->get_course_obj()->get_code()) . ' - ' . htmlfilter($course_section->get_section_obj()->get_name()); ?></a>
                                </li>
                            <?php } else { ?>
                                <?php $extraSections[$key] = $course_section; ?>
                            <?php } ?>
                        <?php } ?>
                        <?php if (count($extraSections)) { ?>
                            <li class="dropdown tab-resize show">
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="tab-resize-icon"></span></a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($course_sections as $key => $course_section) { ?>
                                        <li class="<?php echo $key == 0 ? 'active' : '' ?>"><a
                                                    href="#section-<?php echo $course_section->get_id() ?>"
                                                    title="<?php echo htmlfilter($course_section->get_section_obj()->get_course_obj()->get_name()); ?>"
                                                    data-toggle="tab"
                                                    aria-expanded="false"><?php echo htmlfilter($course_section->get_section_obj()->get_course_obj()->get_code()) . ' - ' . htmlfilter($course_section->get_section_obj()->get_name()); ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="tab-content p-a-0">
                    <?php foreach ($course_sections as $key => $course_section) { ?>
                        <?php $section_student_count = Orm_Course_Section_Student::get_count(array('section_id' => $course_section->get_section_id())); ?>
                        <div id="section-<?php echo $course_section->get_id() ?>"
                             class="ps-block tab-pane fade in <?php echo $key == 0 ? 'active' : '' ?>">
                            <?php $methods = Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $course_section->get_section_obj()->get_course_id())); ?>
                            <?php foreach ($methods as $method) { ?>
                                <?php
                                $assessed_students = Orm_Cm_Section_Student_Assessment::get_number_of_assessed_students($course_section->get_section_id(), $method->get_id());
                                $progress = ($section_student_count ? $assessed_students / $section_student_count : 0) * 100;
                                ?>
                                <div class="box m-y-2">
                                    <div class="box-cell valign-middle text-xs-center" style="width: 60px">
                                        <i class="fa fa-pencil-square font-size-28 line-height-1 text-muted"></i>
                                    </div>
                                    <div class="box-cell p-r-3">
                                        <?php echo htmlfilter($method->get_text()); ?><span
                                                class="text-muted">-</span><strong><?php echo $progress ?>%</strong>
                                        <div class="progress m-b-0" style="height: 5px; margin-top: 5px;">
                                            <div class="progress-bar progress-bar-default"
                                                 style="width: <?php echo $progress ?>%"></div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="m-a-0">
                            <?php } ?>
                            <?php if (empty($methods)) { ?>
                                <div class="alert alert-dafualt">
                                    <?php echo lang('There are no') . ' ' . lang('Assessment Methods Defined') . ' ' . lang('for the course titled') . ', "' . htmlfilter($course_section->get_section_obj()->get_course_obj()->get_name()) . '"."'; ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>

<?php if ($logged_user->get_class_type() == Orm_User::USER_STUDENT) { ?>
    <?php if (!empty($course_sections)) { ?>
        <div class="table-primary">
            <div class="table-header">
                <?php echo lang('Course Sections'); ?>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        <?php echo lang('Section Number'); ?>
                    </th>
                    <th>
                        <?php echo lang('Course Number'); ?>
                    </th>
                    <th>
                        <?php echo lang('Course Name'); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($course_sections as $course_section) { ?>
                    <tr>
                        <td><?php echo htmlfilter($course_section->get_section_obj()->get_name()); ?></td>
                        <td><?php echo htmlfilter($course_section->get_section_obj()->get_course_obj()->get_code()); ?></td>
                        <td><?php echo htmlfilter($course_section->get_section_obj()->get_course_obj()->get_name()); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
<?php } ?>