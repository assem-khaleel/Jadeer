<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 22/05/17
 * Time: 01:56 م
 * @var $course_sections Orm_Course_Section[]
 * @var $section_students Orm_User_Student[]
 * @var $exam Orm_Tst_Exam
 */

?>
<div class="col-md-12 col-lg-12 m-t-0 ">
    <div class="table-primary">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="col-md-1 text-center"><?php echo lang('Attended'); ?></td>
                <td class="col-md-3"><?php echo lang('Student ID'); ?></td>
                <td class="col-md-4"><?php echo lang('Student Name'); ?></td>
                <td class="col-md-4"><?php echo lang('Proctor Name'); ?></td>
            </tr>
            </thead>
            <tbody>
        <?php if($course_sections): ?>
            <?php foreach ($course_sections as $section): ?>
                <?php if ($section->get_students()): ?>
                <tr>
                    <td  colspan="4" class="col-md-12 alert clearfix">
                        <?php echo htmlfilter(lang('Course Section ID').': '.$section->get_name()); ?>
                    </td>
                </tr>
                    <?php
                    $attended_student = [];
                    $absent_student = [];

                    foreach ($section->get_students() as $student){
                        if(isset($attended[$student->get_user_id()])){
                            $attended_student[$student->get_user_id()] = $attended[$student->get_user_id()];
                        }
                        else {
                            $absent_student[] = $student->get_user_id();
                        }
                    }
                    ?>

                    <?php foreach ($attended_student as $student_id=>$proctor): ?>
                <tr>
                    <td class="text-center"><span class="fa fa-check" aria-hidden="true"></span></td>
                    <td><?php echo $student_id ?></td>
                    <td><?php echo htmlfilter(Orm_User::get_instance($student_id)->get_full_name()); ?></td>
                    <td><?php echo htmlfilter(Orm_User::get_instance($proctor)->get_full_name()); ?></td>
                </tr>
                    <?php endforeach; ?>

                    <?php foreach ($absent_student as $student_id): ?>
                <tr>
                    <td class="text-center"><span class="fa fa-times" aria-hidden="true"></span></td>
                    <td><?php echo $student_id ?></td>
                    <td><?php echo htmlfilter(Orm_User::get_instance($student_id)->get_full_name()); ?></td>
                    <td> - </td>
                </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Students for this Exam'); ?></h3>
                        </div>
                    </td>
                </tr>
        <?php endif; ?>
            </tbody>
           </table>
    </div>
</div>