<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/26/16
 * Time: 9:19 PM
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
            <td colspan="6">On Campus Programs</td>
            <td colspan="6">Distance Education Programs</td>
        </tr>
        <tr>
            <td colspan="2">Full time</td>
            <td colspan="2">Part time</td>
            <td colspan="2">FTE</td>
            <td colspan="2">Full time</td>
            <td colspan="2">Part time</td>
            <td colspan="2">FTE</td>
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
            <td>M</td>
            <td>F</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $program => $items) { ?>
            <tr class="bg-primary">
                <td colspan="13"><?php echo htmlfilter($program); ?></td>
            </tr>
            <tr>
                <td>Saudi</td>
                <td><?php echo $items['on_campus_ft_m_s'] ?></td>
                <td><?php echo $items['on_campus_ft_f_s'] ?></td>
                <td><?php echo $items['on_campus_pt_m_s'] ?></td>
                <td><?php echo $items['on_campus_pt_f_s'] ?></td>
                <td><?php echo $items['on_campus_fte_m_s'] ?></td>
                <td><?php echo $items['on_campus_fte_f_s'] ?></td>
                <td><?php echo $items['distance_education_programs_ft_m_s'] ?></td>
                <td><?php echo $items['distance_education_programs_ft_f_s'] ?></td>
                <td><?php echo $items['distance_education_programs_pt_m_s'] ?></td>
                <td><?php echo $items['distance_education_programs_pt_f_s'] ?></td>
                <td><?php echo $items['distance_education_programs_fte_m_s'] ?></td>
                <td><?php echo $items['distance_education_programs_fte_f_s'] ?></td>
            </tr>
            <tr>
                <td>Others</td>
                <td><?php echo $items['on_campus_ft_m_o'] ?></td>
                <td><?php echo $items['on_campus_ft_f_o'] ?></td>
                <td><?php echo $items['on_campus_pt_m_o'] ?></td>
                <td><?php echo $items['on_campus_pt_f_o'] ?></td>
                <td><?php echo $items['on_campus_fte_m_o'] ?></td>
                <td><?php echo $items['on_campus_fte_f_o'] ?></td>
                <td><?php echo $items['distance_education_programs_ft_m_o'] ?></td>
                <td><?php echo $items['distance_education_programs_ft_f_o'] ?></td>
                <td><?php echo $items['distance_education_programs_pt_m_o'] ?></td>
                <td><?php echo $items['distance_education_programs_pt_f_o'] ?></td>
                <td><?php echo $items['distance_education_programs_fte_m_o'] ?></td>
                <td><?php echo $items['distance_education_programs_fte_f_o'] ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td><?php echo $items['on_campus_ft_m_t'] ?></td>
                <td><?php echo $items['on_campus_ft_f_t'] ?></td>
                <td><?php echo $items['on_campus_pt_m_t'] ?></td>
                <td><?php echo $items['on_campus_pt_f_t'] ?></td>
                <td><?php echo $items['on_campus_fte_m_t'] ?></td>
                <td><?php echo $items['on_campus_fte_f_t'] ?></td>
                <td><?php echo $items['distance_education_programs_ft_m_t'] ?></td>
                <td><?php echo $items['distance_education_programs_ft_f_t'] ?></td>
                <td><?php echo $items['distance_education_programs_pt_m_t'] ?></td>
                <td><?php echo $items['distance_education_programs_pt_f_t'] ?></td>
                <td><?php echo $items['distance_education_programs_fte_m_t'] ?></td>
                <td><?php echo $items['distance_education_programs_fte_f_t'] ?></td>
            </tr>
        <?php } ?>
        <?php if(empty($data)) { ?>
            <tr>
                <td colspan="13">
                    <div class="alert m-a-0">
                        <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>