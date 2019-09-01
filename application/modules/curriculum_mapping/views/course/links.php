<?php
/** @var $course_id int */

$link = isset($link) ? $link : 'learning_outcome';
?>
<div class="well well-table-header">
    <h3 class="m-t-0"><?php echo htmlfilter(Orm_Course::get_instance($course_id)->get_name()) ?></h3>
    <h5 class="m-t-0"><?php echo htmlfilter(Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id))->get_program_obj()->get_name()) ?></h5>
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-block <?php echo $link == 'learning_outcome' ? 'btn-primary' : '' ?>" href="/curriculum_mapping/course/learning_outcome/<?php echo $course_id ?>"><i class="btn-label-icon left fa fa-list-alt"></i><?php echo lang('Learning Outcomes'); ?></a>
        </div>

        <div class="col-md-3">
            <a class="btn btn-block <?php echo $link == 'assessment_method' ? 'btn-primary' : '' ?>" href="/curriculum_mapping/course/assessment_method/<?php echo $course_id ?>"><i class="btn-label-icon left fa fa-pencil-square-o"></i><?php echo lang('Assessment Methods'); ?></a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-block <?php echo $link == 'section' ? 'btn-primary' : '' ?>" href="/curriculum_mapping/course_section?course_id=<?php echo $course_id ?>"><i class="btn-label-icon left fa fa-tasks"></i><?php echo lang('Course Sections'); ?></a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-block <?php echo $link == 'assessment_plan' ? 'btn-primary' : '' ?>" href="/curriculum_mapping/course/assessment_plan/<?php echo $course_id ?>"><i class="btn-label-icon left fa fa-hourglass"></i><?php echo lang('Assessment Plan'); ?></a>
        </div>
        <div class="col-md-3 m-t-1">
            <a class="btn btn-block <?php echo $link == 'x_matrix' ? 'btn-primary' : '' ?>" href="/curriculum_mapping/course/x_matrix/<?php echo $course_id?>"><i class="btn-label-icon left fa fa-map-signs"></i><?php echo lang('X-Matrix'); ?></a>
        </div>
    </div>
</div>
