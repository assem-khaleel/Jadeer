<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/26/16
 * Time: 6:17 PM
 */
?>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Academic Year').' :'.Orm_Semester::get_active_semester()->get_year(); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td rowspan="2">Gender</td>
            <td colspan="2">Total Students Enrollment</td>
            <td colspan="2">No. of PhD holders in Teaching Staff</td>
            <td colspan="2">No. of Teaching Staff</td>
            <td rowspan="2">Average Class Size</td>
            <td rowspan="2">Average Teaching Load</td>
            <td rowspan="2">Ratio of Total Students to Teaching Faculty</td>
            <td rowspan="2">Ratio of Male Students to Teaching Faculty</td>
            <td rowspan="2">Ratio of Female Students to Teaching Faculty</td>
        </tr>
        <tr>
            <td>S**</td>
            <td>O***</td>
            <td>S</td>
            <td>O</td>
            <td>S</td>
            <td>O</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $program => $items) {?>
            <tr class="bg-primary">
                <td colspan="12"><?php echo htmlfilter($program) ?></td>
            </tr>
            <tr>
                <td class="bg-primary">M</td>
                <td><?php echo $items['student_enrolled_male_saudi']; ?></td>
                <td><?php echo $items['student_enrolled_male_other']; ?></td>
                <td><?php echo $items['phd_holder_male_saudi']; ?></td>
                <td><?php echo $items['phd_holder_male_other']; ?></td>
                <td><?php echo $items['teaching_staff_male_saudi']; ?></td>
                <td><?php echo $items['teaching_staff_male_other']; ?></td>
                <td><?php echo $items['class_size_male']; ?></td>
                <td><?php echo $items['teaching_load_male']; ?></td>
                <td><?php echo $items['ratio_total_student_fac']; ?></td>
                <td><?php echo $items['ratio_male_student_fac']; ?></td>
                <td><?php echo $items['ratio_female_student_fac']; ?></td>
            </tr>
            <tr>
                <td class="bg-primary">F</td>
                <td><?php echo $items['student_enrolled_female_saudi']; ?></td>
                <td><?php echo $items['student_enrolled_female_other']; ?></td>
                <td><?php echo $items['phd_holder_female_saudi']; ?></td>
                <td><?php echo $items['phd_holder_female_other']; ?></td>
                <td><?php echo $items['teaching_staff_female_saudi']; ?></td>
                <td><?php echo $items['teaching_staff_female_other']; ?></td>
                <td><?php echo $items['class_size_female']; ?></td>
                <td><?php echo $items['teaching_load_female']; ?></td>
                <td><?php echo $items['ratio_total_student_fac']; ?></td>
                <td><?php echo $items['ratio_male_student_fac']; ?></td>
                <td><?php echo $items['ratio_female_student_fac']; ?></td>
            </tr>
        <?php } ?>
        <?php if(empty($data)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
