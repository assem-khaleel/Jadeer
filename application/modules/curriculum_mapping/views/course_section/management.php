<?php
/* @var $course Orm_Course */
/* @var $course_sections Orm_Course_Section[] */
$program_assessment_method_ids = array_column(Orm_Cm_Program_Assessment_Method::get_model()->get_all(['program_id' => Orm_Cm_Course_Offered_Program::get_one(['course_id' => $course->get_id()])->get_program_id()],0,0,[],Orm::FETCH_ARRAY), 'id');
$program_assessment_method_ids[] = 0;
$methods = Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $course->get_id(), 'program_assessment_method_in' => $program_assessment_method_ids));
?>
<?php $this->load->view('course/links',array('course_id' => $course->get_id())); ?>

<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <?php echo lang('Course Section') ?>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr class="bg-primary">
            <td class="col-md-4"><?php echo lang('Name') ?></td>
            <td class="col-md-5" colspan="2"><?php echo lang('Progress') . ' - ' . lang('Assessed Students')?></td>
            <td class="col-md-3 text-center">
                <b><?php echo lang('Action') ?></b>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($course_sections) {
            foreach ($course_sections as $course_section) {
                $section_student_count = Orm_Course_Section_Student::get_count(array('section_id' => $course_section->get_id()));
                ?>
                <tr>
                    <td>
                        <h3 class="m-a-0 "> <?php echo $course->get_code(); ?> - <?php echo htmlfilter($course_section->get_name()); ?></h3>

                    </td>
                    <?php if($methods){ ?>
                        <td class="col-md-2">
                            <ul class="list-group m-a-0">
                                <?php foreach ($methods as $method) { ?>
                                    <li class="list-group-item">
                                        <?php echo htmlfilter($method->get_text()); ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </td>
                        <td>
                            <ul class="list-group m-a-0">
                                <?php foreach ($methods as $method) { ?>
                                    <?php
                                    $assessed_students = Orm_Cm_Section_Student_Assessment::get_number_of_assessed_students($course_section->get_id(), $method->get_id());
                                    $progress = ($section_student_count ? $assessed_students / $section_student_count : 0) * 100;
                                    ?>
                                    <li class="list-group-item">
                                        <div class="progress progress-striped m-a-0"><div style="width: <?php echo round($progress, 2) ?>%; color: #002166;" class="progress-bar progress-bar-success" ><?php echo  round($progress, 2) ?>%</div></div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </td>
                    <?php }else{ ?>
                        <td colspan="2">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Assessment'); ?></h3>
                            </div>

                        </td>
                    <?php } ?>

                    <td class="text-center">
                        <a href="/curriculum_mapping/course_section/question_mapping/<?php echo intval($course_section->get_id()); ?>?course_id=<?php echo intval($course->get_id()); ?>" class="btn  btn-block"><i class="btn-label-icon left fa fa-tasks"></i><?php echo lang('Learning Outcome Mapping'); ?></a>
<!--                        <a href="/curriculum_mapping/course_section/student_curriculum/--><?php //echo intval($course_section->get_id()); ?><!--?course_id=--><?php //echo intval($course->get_id()); ?><!--" class="btn  btn-block"><i class="btn-label-icon left fa fa-tasks"></i>--><?php //echo lang('Student Assessment'); ?><!--</a>-->
                        <a href="/curriculum_mapping/course_section/students_assessment/<?php echo intval($course_section->get_id()); ?>?course_id=<?php echo intval($course->get_id()); ?>" class="btn  btn-block"><i class="btn-label-icon left fa fa-tasks"></i><?php echo lang('Student Assessment'); ?></a>
                    </td>
                </tr>
            <?php }} else { ?>
            <tr>
                <td colspan="4">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('course sections to be displayed'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if ($pager) { ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>
