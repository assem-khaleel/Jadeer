<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/26/16
 * Time: 7:49 PM
 */
?>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Academic Year').' :'.Orm_Semester::get_active_semester()->get_year(); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td colspan="2">Professor (M)</td>
            <td colspan="2">Professor (F)</td>
            <td colspan="2">Associate Professor (M)</td>
            <td colspan="2">Associate Professor (F)</td>
            <td colspan="2">Assistant Professor (M)</td>
            <td colspan="2">Assistant Professor (F)</td>
            <td colspan="2">Lecturer (M)</td>
            <td colspan="2">Lecturer (F)</td>
            <td colspan="2">Teaching Assistants / Language Instructors (M)</td>
            <td colspan="2">Teaching Assistants / Language Instructors (F)</td>
            <td colspan="2">Total</td>
        </tr>
        <tr>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
            <td>FT</td>
            <td>PT</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $program => $items) { ?>
            <tr class="bg-primary">
                <td colspan="22"><?php echo htmlfilter($program); ?></td>
            </tr>
            <tr>
                <td><?php echo $items['professor_m_ft']; ?></td>
                <td><?php echo $items['professor_m_pt']; ?></td>
                <td><?php echo $items['professor_f_ft']; ?></td>
                <td><?php echo $items['professor_f_pt']; ?></td>
                <td><?php echo $items['associate_professor_m_ft']; ?></td>
                <td><?php echo $items['associate_professor_m_pt']; ?></td>
                <td><?php echo $items['associate_professor_f_ft']; ?></td>
                <td><?php echo $items['associate_professor_f_pt']; ?></td>
                <td><?php echo $items['assistant_professor_m_ft']; ?></td>
                <td><?php echo $items['assistant_professor_m_pt']; ?></td>
                <td><?php echo $items['assistant_professor_f_ft']; ?></td>
                <td><?php echo $items['assistant_professor_f_pt']; ?></td>
                <td><?php echo $items['lecture_m_ft']; ?></td>
                <td><?php echo $items['lecture_m_pt']; ?></td>
                <td><?php echo $items['lecture_f_ft']; ?></td>
                <td><?php echo $items['lecture_f_pt']; ?></td>
                <td><?php echo $items['teaching_m_ft']; ?></td>
                <td><?php echo $items['teaching_m_pt']; ?></td>
                <td><?php echo $items['teaching_f_ft']; ?></td>
                <td><?php echo $items['teaching_f_pt']; ?></td>
                <td><?php echo $items['total_m']; ?></td>
                <td><?php echo $items['total_f']; ?></td>
            </tr>
        <?php } ?>
        <?php if(empty($data)) { ?>
            <tr>
                <td colspan="22">
                    <div class="alert m-a-0">
                        <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>