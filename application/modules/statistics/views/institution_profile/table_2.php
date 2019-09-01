<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/26/16
 * Time: 11:47 AM
 */
/** @var array $data */
?>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Academic Year').' :'.Orm_Semester::get_active_semester()->get_year(); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td rowspan="2">Streams or Sections</td>
            <td colspan="2">Male Students</td>
            <td colspan="2">Female Students</td>
            <td colspan="2">Total  Students</td>
            <td colspan="2">Number of full time equivalent teaching staff *</td>
            <td colspan="2">Student to Teaching Self Ratio</td>
            <td colspan="2">Retention Rate**</td>
            <td colspan="2">Completion Rate in Minimum Required Time***</td>
        </tr>
        <tr>
            <td>Saudi</td>
            <td>Others</td>
            <td>Saudi</td>
            <td>Others</td>
            <td>Saudi</td>
            <td>Others</td>
            <td>M</td>
            <td>F</td>
            <td>M</td>
            <td>F</td>
            <td>M</td>
            <td>F</td>
            <td>M</td>
            <td>F</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $item) { ?>
            <?php
            $faculty_male = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $item['stream'],'academic_year' => Orm_Semester::get_active_semester()->get_year(),'gender' => \Orm_User::GENDER_MALE))->get_teacher_count();
            $faculty_female = \Orm_Data_Preparatory_Year_Faculty::get_one(array('stream' => $item['stream'],'academic_year' => Orm_Semester::get_active_semester()->get_year(),'gender' => \Orm_User::GENDER_FEMALE))->get_teacher_count();

            $total_male = $item['SAUDI_MALE'] + $item['NONESAUDI_MALE'];
            $total_female = $item['SAUDI_FEMALE'] + $item['NONESAUDI_FEMALE'];
            ?>
            <tr>
                <td><?php echo $item['stream'] ?></td>
                <td><?php echo $item['SAUDI_MALE'] ?></td>
                <td><?php echo $item['NONESAUDI_MALE'] ?></td>
                <td><?php echo $item['SAUDI_FEMALE'] ?></td>
                <td><?php echo $item['NONESAUDI_FEMALE'] ?></td>
                <td><?php echo $item['SAUDI_TOTAL'] ?></td>
                <td><?php echo $item['NONESAUDI_TOTAL'] ?></td>
                <td><?php echo $item['MALE_STAFF'] ?></td>
                <td><?php echo $item['FEMALE_STAFF'] ?></td>
                <td><?php echo ($faculty_male ? round($total_male / $faculty_male) : '0' ) . ' : ' . '1'; ?></td>
                <td><?php echo ($faculty_female ? round($total_female / $faculty_female) : '0' )  . ' : ' . '1';  ?></td>
                <td><?php echo round($item['COMPLETION_RATE_MALE'],2) ?></td>
                <td><?php echo round($item['COMPLETION_RATE_FEMALE'],2) ?></td>
                <td><?php echo round($item['COMPLETION_RATE_MALE'],2) ?></td>
                <td><?php echo round($item['COMPLETION_RATE_FEMALE'],2) ?></td>
            </tr>
        <?php } ?>
        <?php if(empty($data)) { ?>
            <tr>
                <td colspan="15">
                    <div class="alert m-a-0">
                        <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>