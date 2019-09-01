<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/26/16
 * Time: 8:31 PM
 */
?>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Academic Year').' :'.Orm_Semester::get_active_semester()->get_year(); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td rowspan="3">Nationality</td>
            <td colspan="4">Undergraduates</td>
            <td colspan="6">PostGraduates</td>
        </tr>
        <tr>
            <td colspan="2">Diploma</td>
            <td colspan="2">Bachelor</td>
            <td colspan="2">Higher Diploma</td>
            <td colspan="2">Master</td>
            <td colspan="2">Ph.D.</td>
        </tr>
        <tr>
            <td>M</td>
            <td>F</td>
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
        <?php foreach ($data as $program => $items) { ?>
            <tr class="bg-primary">
                <td colspan="11"><?php echo htmlfilter($program) ?></td>
            </tr>
            <tr>
                <td>Saudi</td>
                <td><?php echo $items['undergraduate_students_diploma_saudi_m']; ?></td>
                <td><?php echo $items['undergraduate_students_diploma_saudi_f']; ?></td>
                <td><?php echo $items['undergraduate_students_bachelor_saudi_m']; ?></td>
                <td><?php echo $items['undergraduate_students_bachelor_saudi_f']; ?></td>
                <td><?php echo $items['postgraduate_students_higher_diploma_saudi_m']; ?></td>
                <td><?php echo $items['postgraduate_students_higher_diploma_saudi_f']; ?></td>
                <td><?php echo $items['postgraduate_students_master_saudi_m']; ?></td>
                <td><?php echo $items['postgraduate_students_master_saudi_f']; ?></td>
                <td><?php echo $items['postgraduate_students_phd_saudi_m']; ?></td>
                <td><?php echo $items['postgraduate_students_phd_saudi_f']; ?></td>
            </tr>
            <tr>
                <td>Others</td>
                <td><?php echo $items['undergraduate_students_diploma_others_m']; ?></td>
                <td><?php echo $items['undergraduate_students_diploma_others_f']; ?></td>
                <td><?php echo $items['undergraduate_students_bachelor_others_m']; ?></td>
                <td><?php echo $items['undergraduate_students_bachelor_others_f']; ?></td>
                <td><?php echo $items['postgraduate_students_higher_diploma_others_m']; ?></td>
                <td><?php echo $items['postgraduate_students_higher_diploma_others_f']; ?></td>
                <td><?php echo $items['postgraduate_students_master_others_m']; ?></td>
                <td><?php echo $items['postgraduate_students_master_others_f']; ?></td>
                <td><?php echo $items['postgraduate_students_phd_others_m']; ?></td>
                <td><?php echo $items['postgraduate_students_phd_others_f']; ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td><?php echo $items['undergraduate_students_diploma_total_m']; ?></td>
                <td><?php echo $items['undergraduate_students_diploma_total_f']; ?></td>
                <td><?php echo $items['undergraduate_students_bachelor_total_m']; ?></td>
                <td><?php echo $items['undergraduate_students_bachelor_total_f']; ?></td>
                <td><?php echo $items['postgraduate_students_higher_diploma_total_m']; ?></td>
                <td><?php echo $items['postgraduate_students_higher_diploma_total_f']; ?></td>
                <td><?php echo $items['postgraduate_students_master_total_m']; ?></td>
                <td><?php echo $items['postgraduate_students_master_total_f']; ?></td>
                <td><?php echo $items['postgraduate_students_phd_total_m']; ?></td>
                <td><?php echo $items['postgraduate_students_phd_total_f']; ?></td>
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
