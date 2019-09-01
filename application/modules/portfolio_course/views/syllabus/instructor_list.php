<?php
/** @var $faculty Orm_Course_Section_Teacher[] */
/** @var $can_manage bool */
/** @var $course_id int */
?>
<?php foreach ($faculty as $teacher) {?>
    <div class="table-primary">
        <div class="table-header">
            <div class="table-caption">
                <?php echo  htmlfilter($teacher->get_user_obj()->get_full_name())?>
                <span><?php echo  htmlfilter($teacher->get_user_obj()->get_phone())?></span>
                <span class="pull-right"><?php echo  htmlfilter($teacher->get_user_obj()->get_email())?></span>
            </div>

        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><?php echo lang("Section Name")?></th>
                <th><?php echo lang("Office Location")?></th>
                <th><?php echo lang("Office hours")?></th>
                <?php if ($can_manage  && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){ ?>
                    <th><?php echo lang("Action")?></th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $sections = Orm_Course_Section::get_all(['course_id'=>$course_id,"teacher_id"=>$teacher->get_user_id(), 'semester_id' => Orm_Semester::get_active_semester()->get_id()]);
            foreach ($sections as $section) {
                $instructor = Orm_Pc_Instructor_Information::get_one(['section_id'=>$section->get_id(), 'faculty_id'=>$teacher->get_id()]);
                ?>
                <tr>
                    <?php /* @var $section Orm_Course_Section*/?>
                    <?php /* @var $instructor Orm_Pc_Instructor_Information*/?>
                    <td><?php echo  htmlfilter($section->get_name()); ?></td>
                    <td><?php echo  htmlfilter($instructor->get_office_location())?></td>
                    <td><?php echo  htmlfilter($instructor->get_office_hours())?></td>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()){ ?>
                        <td>
                            <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($instructor->get_id()) ?>?id=<?php echo $course_id; ?>&section=<?php echo intval($section->get_id()); ?>&faculty=<?php echo intval($teacher->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-sm btn-block" >
                                <span class="btn-label-icon left icon fa fa-pencil-square-o" aria-hidden="true"></span> <?php echo lang("Edit")?>
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="table-footer"></div>
    </div>
<?php } ?>
<?php if (empty($faculty)) { ?>
    <div class="well well-sm m-a-0">
        <h3 class="m-a-0 text-center"><?php echo lang('There is no') . ' ' . lang('Instructor Information'); ?>.</h3>
    </div>
<?php } ?>
