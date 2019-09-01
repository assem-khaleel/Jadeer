<?php
/** @var courses Orm_Course[] */
?>
<div class="table-responsive m-a-0">
    <table class="table table-striped table-bordered">
        <thead>
        <tr class="bg-primary">
            <td class="col-md-6"><b><?php echo lang('Name') ?></b></td>
            <td class="col-md-2"><b><?php echo lang('Progress') ?></b></td>
            <td class="col-md-4 text-center"><b><?php echo lang('Action') ?></b></td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($courses) {
            foreach ($courses as $course) {
                /* @var $course Orm_Course */
                ?>
                <tr>
                    <td>
                        <h5 class="m-y-0"><?php echo htmlfilter($course->get_code()); ?> - <b><?php echo htmlfilter($course->get_name()); ?></b></h5>
                        <ul>
                            <li><?php echo lang('College'); ?>
                                : <?php echo htmlfilter($course->get_department_obj()->get_college_obj()->get_name()); ?></li>
                            <li><?php echo lang('Department'); ?>
                                : <?php echo htmlfilter($course->get_department_obj()->get_name()); ?></li>
                        </ul>

                    </td>
                    <td>
                        <?php
                        $total = 10;
                        $progress = 0;
                        $progress += Orm_Pc_Assignment::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress += Orm_Pc_Catalog_Information::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress += Orm_Pc_Course_Policies::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress += Orm_Pc_Format::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress += Orm_Pc_Instructor_Information::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress += Orm_Pc_Material::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress += Orm_Pc_Student_Work::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress += Orm_Pc_Support_Material::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress += Orm_Pc_Support_Service::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress += Orm_Pc_Teaching_Material::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        $progress = number_format($progress / $total * 100,2);
                        $topic = Orm_Pc_Topic::get_count(array('course_id' => $course->get_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ? 1 : 0;
                        ?>

                        <div id="c3-gauge-<?php echo  $course->get_id() ?>" data-percent="<?php echo number_format($progress / $total * 100,2); ?>" style="height: 100px;"></div>

                        <script>
                            //                        pxInit.push(function () {
                            $(function () {
                                var data = {
                                    columns: [
                                        ['<?php echo lang('Progress') ?>', <?php echo $progress ?>]
                                    ],
                                    type: 'gauge'
                                };

                                c3.generate({
                                    bindto: '#c3-gauge-<?php echo  $course->get_id() ?>',
                                    color: {pattern: ['<?php echo  get_chart_color($progress)?>']},
                                    data: data
                                });
                            });
                            //                        });
                        </script>
                    </td>


                    <td class="text-center">
                        <a href="/portfolio_course/course_evaluation?id=<?php echo $course->get_id(); ?>" class="btn  btn-block"><i class="btn-label-icon left fa fa-tasks"></i><?php echo Orm_User::has_role_teacher() ? lang('Edit') : lang('View'); ?></a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="4">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Courses'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php if ($pager) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>

<script>
    $(function() {
        $('.course-progress').easyPieChart({
            animate: 1000,
            barColor: '#72B159',
            size: 70,
            onStep: function(_from, _to, currentValue) {
                $(this.el).find('> span').text(currentValue.toFixed(2) + '%');
            }
        });
    });
</script>
