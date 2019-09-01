<?php

?>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Academic Year') . ' :' . Orm_Semester::get_active_semester()->get_year(); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td rowspan="3">Gender</td>
            <td colspan="9">Undergraduate Programs</td>
            <td colspan="9">Master Programs</td>
            <td colspan="9">PHD Programs</td>
        </tr>
        <tr>
            <td colspan="3">Four-Year Program*</td>
            <td colspan="3">Five-Year Program</td>
            <td colspan="3">Six-Year Program</td>
            <td colspan="3">Two-Year Program*</td>
            <td colspan="3">Three-Year Program</td>
            <td colspan="3">Four-Year Program</td>
            <td colspan="3">Three-Year Program*</td>
            <td colspan="3">Four-Year Program</td>
            <td colspan="3">Five-Year Program</td>
        </tr>
        <tr>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>

        </tr>
        </thead>
        <tbody>
        <?php if (!empty($data)) { ?>
        <?php foreach ($data as $program => $items) { ?>
            <tr class="bg-primary">
                <td colspan="28"><?php echo htmlfilter($program); ?></td>
            </tr>
            <tr>
                <td>Male</td>
                <td><?php echo round($items['under_programs_4_4_m'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_4_5_m'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_4_6_m'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_5_5_m'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_5_6_m'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_5_7_m'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_6_6_m'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_6_7_m'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_6_8_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_2_2_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_2_3_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_2_4_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_3_3_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_3_4_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_3_5_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_4_4_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_4_5_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_4_6_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_3_3_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_3_4_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_3_5_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_4_4_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_4_5_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_4_6_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_5_5_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_5_6_m'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_5_7_m'] * 100, 2) ?></td>


            </tr>
            <tr>
                <td>Female</td>
                <td><?php echo round($items['under_programs_4_4_f'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_4_5_f'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_4_6_f'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_5_5_f'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_5_6_f'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_5_7_f'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_6_6_f'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_6_7_f'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_6_8_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_2_2_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_2_3_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_2_4_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_3_3_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_3_4_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_3_5_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_4_4_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_4_5_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_4_6_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_3_3_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_3_4_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_3_5_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_4_4_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_4_5_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_4_6_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_5_5_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_5_6_f'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_5_7_f'] * 100, 2) ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td><?php echo round($items['under_programs_4_4_t'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_4_5_t'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_4_6_t'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_5_5_t'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_5_6_t'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_5_7_t'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_6_6_t'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_6_7_t'] * 100, 2) ?></td>
                <td><?php echo round($items['under_programs_6_8_t'] * 100, 2) ?></td>

                <td><?php echo round($items['post_programs_master_2_2_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_2_3_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_2_4_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_3_3_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_3_4_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_3_5_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_4_4_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_4_5_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_master_4_6_t'] * 100, 2) ?></td>

                <td><?php echo round($items['post_programs_phd_3_3_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_3_4_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_3_5_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_4_4_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_4_5_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_4_6_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_5_5_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_5_6_t'] * 100, 2) ?></td>
                <td><?php echo round($items['post_programs_phd_5_7_t'] * 100, 2) ?></td>


            </tr>
        <?php } ?>
        <?php }else{ ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo lang("There is no") . ' ' . lang('Data to be displayed.') ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
