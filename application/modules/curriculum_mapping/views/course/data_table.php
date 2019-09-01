<div class="table-responsive m-a-0">
    <table class="table table-striped table-bordered">
        <thead>
        <tr class="bg-primary">
            <td class="col-md-8">
                <b><?php echo lang('Name') ?></b>
            </td>
            <td class="col-md-2">
                <b><?php echo lang('Progress') ?></b>
            </td>
            <td class="col-md-2 text-center">
                <b><?php echo lang('Action') ?></b>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($courses) {
            foreach ($courses as $course) {
                /* @var $course Orm_Course */
                ?>
                <?php
                $offered_program = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course->get_id()));

                $total = 3;

                $count = 0;
                $count += ($offered_program->get_id() ? 1 : 0);
                $count += (Orm_Cm_Course_Learning_Outcome::get_one(array('course_id' => $course->get_id()))->get_id() ? 1 : 0);
                $count += (Orm_Cm_Course_Assessment_Method::get_one(array('course_id' => $course->get_id()))->get_id() ? 1 : 0);

                $progress = round(($count/$total) * 100, 2);
                ?>
                <tr>
                    <td>
                        <?php echo htmlfilter($course->get_code()); ?> - <b><?php echo htmlfilter($course->get_name()); ?></b>
                        <?php if($offered_program->get_id()) { ?>
                            <hr>
                            <a href="/curriculum_mapping/course/offered_program/<?php echo intval($course->get_id()); ?>" data-toggle="ajaxModal" class="btn"><i class="btn-label-icon left fa fa-remove"></i><?php echo lang('Remove Offered Program'); ?></a>
                        <?php } ?>
                    </td>
                    <td>
                        <div id="c3-gauge-<?php echo  $course->get_id() ?>" style="height: 100px"></div>
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
                        <?php if(Orm_Cm_Active_Data::is_active_course($course->get_id())) { ?>
                            <?php if(!$offered_program->get_id()) { ?>
                                <a href="/curriculum_mapping/course/offered_program/<?php echo intval($course->get_id()); ?>" data-toggle="ajaxModal" class="btn  btn-block font-size-10"><i class="btn-label-icon left fa fa-tasks  m-r-0"></i><?php echo lang('Offered Program'); ?></a>
                            <?php } else { ?>
                                <a href="/curriculum_mapping/course/learning_outcome/<?php echo intval($course->get_id()); ?>" class="btn  btn-block"><i class="btn-label-icon left fa fa-list-alt"></i><?php echo lang('Manage'); ?></a>
                            <?php } ?>
                        <?php } else { ?>
                            <a href="/curriculum_mapping/course/activate/<?php echo $course->get_id(); ?>" class="btn  btn-block"><i class="btn-label-icon left fa fa-tasks"></i><?php echo lang('Initiate'); ?></a>
                        <?php } ?>
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