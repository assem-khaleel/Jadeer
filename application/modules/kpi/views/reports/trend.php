<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/13/16
 * Time: 3:09 PM
 */
/** @var array $fltr */
/** @var int $type */
$college_id = isset($fltr['college_id']) ? $fltr['college_id'] : (isset($college_id) ? $college_id : 0);
$program_id = isset($fltr['program_id']) ? $fltr['program_id'] : (isset($program_id) ? $program_id : 0);
$exist = false;
/** @var int $is_strategic */
?>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption">
            <?php echo lang('KPIs Trend Analysis'); ?>
        </span>
        <?php if (!isset($export)) { ?>
            <div class="panel-heading-controls col-sm-4"><a href="/kpi/report/<?php echo Orm_Kpi::KPI_LIST_REPORT_HISTORICAL ?>/1/<?php echo $is_strategic ?>?fltr[college_id]=<?php echo $college_id; ?>&fltr[program_id]=<?php echo $program_id; ?>" class=" btn btn-sm pull-right"><i class="btn-label-icon left fa fa-file-pdf-o"></i><?php echo lang('PDF'); ?></a></div>
        <?php } ?>
    </div>
    <?php if (!isset($export)) { ?>
        <div class="table-header">
            <form method="GET">
                <div class="row">
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <a class="btn btn-sm btn-block" href="/kpi/report/<?php echo Orm_Kpi::KPI_LIST_REPORT_HISTORICAL ?>" type="reset" ><?php echo lang('Institution') ?></a>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><?php echo lang('College'); ?>:</span>
                            <select class="form-control" name="fltr[college_id]" onchange="get_programs_by_college(this, 0, 1);">
                                <option value=""><?php echo lang('All College') ?></option>
                                <?php foreach (Orm_College::get_all() as $college) { ?>
                                    <?php $selected = ($college->get_id() == $college_id ? 'selected="selected"' : ''); ?>
                                    <option value="<?php echo (int) $college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><?php echo lang('Program'); ?>:</span>
                            <select class="form-control" name="fltr[program_id]" id="program_block">
                                <option value=""><?php echo lang('All Program'); ?></option>
                                <?php if (!empty($fltr['college_id'])): ?>
                                    <?php foreach (Orm_Program::get_all(array('college_id' => $fltr['college_id'])) as $program) { ?>
                                        <?php $selected = ($program->get_id() == $program_id ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo (int) $program->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                                    <?php } ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 10px;">
                        <button class="btn btn-sm btn-block" type="submit" ><?php echo lang('Search') ?></button>
                    </div>
                </div>
            </form>
        </div>
    <?php } ?>
    <div <?php echo isset($export) ? '' : 'class="table-responsive"'; ?>>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="col-md-1"><?php echo lang('Code'); ?></th>
                <th class="col-md-5"><?php echo lang('KPI Title'); ?></th>
                <th class="col-md-2"><?php echo lang('Unit Responsible'); ?></th>
                <th class="col-md-1"><?php echo lang('Stakeholder'); ?></th>
                <?php foreach (array_reverse(Orm_Semester::get_last_five_years()) as $year) { ?>
                    <th class="col-md-1"><?php echo $year['year']; ?></th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php if (!$is_strategic) { ?>
                <?php foreach (Orm_Standard::get_all() as $standard) { ?>
                    <tr>
                        <td colspan="8"><?php echo htmlfilter($standard->get_code()) . '. ' . nl2br( htmlfilter($standard->get_title()) ) ?></td>
                    </tr>
                    <?php $current_kpi = 0; ?>
                    <?php foreach (Orm_Kpi::get_all(array('standard_id' => $standard->get_id(),'college_id' => $college_id)) as $kpi) { ?>
                        <?php
                        $exist = true;
                        $levels = Orm_Kpi_Level::get_all(array('kpi_id' => $kpi->get_id()));
                        if (count($levels)) {
                            ?>
                            <?php foreach ($levels as $level) { ?>
                                <tr>
                                    <?php if (count($levels) > 1 && $current_kpi <> $kpi->get_id() ) { ?>
                                        <?php $current_kpi = $kpi->get_id(); ?>
                                        <td rowspan="<?php echo count($levels) ?>"><?php echo htmlfilter($kpi->get_code()); ?></td>
                                        <td rowspan="<?php echo count($levels) ?>"><?php echo nl2br(htmlfilter($kpi->get_title())); ?></td>
                                        <td><?php echo $kpi->get_unit_obj()->get_name();?></td>
                                    <?php }elseif (count($levels) <= 1) { ?>
                                        <td><?php echo htmlfilter($kpi->get_code()); ?></td>
                                        <td><?php echo nl2br(htmlfilter($kpi->get_title())); ?></td>
                                        <td><?php echo $kpi->get_unit_obj()->get_name();?></td>
                                    <?php } ?>
                                    <td><?php echo $kpi->get_kpi_type() == Orm_Kpi::KPI_QUALITATIVE ? $level->get_level() : 'N/A'; ?></td>
                                    <?php $values = $level->get_trend_values($type,$fltr,$kpi); ?>
                                    <?php foreach ($values as $value) { ?>
                                        <td class="text-xs">
                                            <?php if (is_array($value)) { ?>
                                                <?php foreach ($value as $key => $item) { echo $key .': ' . $item . '<br>';  }?>
                                            <?php } else { echo $value; } ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td><?php echo htmlfilter($kpi->get_code()); ?></td>
                                <td><?php echo nl2br(htmlfilter($kpi->get_title())); ?></td>
                                <td><?php echo $kpi->get_unit_obj()->get_name();?></td>
                                <td><?php echo 'N/A'; ?></td>
                                <?php foreach (array_reverse(Orm_Semester::get_last_five_years()) as $year) { ?>
                                    <td class="text-xs"><?php echo 0; ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <?php $current_kpi = 0; ?>
                <?php foreach (Orm_Kpi::get_all(array('category_id' => Orm_Kpi::KPI_STRATEGIC)) as $kpi) { ?>
                    <?php
                    $exist = true;
                    $levels = Orm_Kpi_Level::get_all(array('kpi_id' => $kpi->get_id()));
                    if (count($levels)) {
                        ?>
                        <?php foreach ($levels as $level) { ?>
                            <tr>
                                <?php if (count($levels) > 1 && $current_kpi <> $kpi->get_id() ) { ?>
                                    <?php $current_kpi = $kpi->get_id(); ?>
                                    <td rowspan="<?php echo count($levels) ?>"><?php echo htmlfilter($kpi->get_code()); ?></td>
                                    <td rowspan="<?php echo count($levels) ?>"><?php echo nl2br(htmlfilter($kpi->get_title())); ?></td>
                                    <td><?php echo $kpi->get_unit_obj()->get_name();?></td>
                                <?php }elseif (count($levels) <= 1) { ?>
                                    <td><?php echo htmlfilter($kpi->get_code()); ?></td>
                                    <td><?php echo nl2br(htmlfilter($kpi->get_title())); ?></td>
                                    <td><?php echo $kpi->get_unit_obj()->get_name();?></td>
                                <?php } ?>
                                <td><?php echo $kpi->get_kpi_type() == Orm_Kpi::KPI_QUALITATIVE ? $level->get_level() : 'N/A'; ?></td>
                                <?php $values = $level->get_trend_values($type,$fltr,$kpi); ?>
                                <?php foreach ($values as $value) { ?>
                                    <td class="text-xs">
                                        <?php if (is_array($value)) { ?>
                                            <?php foreach ($value as $key => $item) { echo $key .': ' . $item . '<br>';  }?>
                                        <?php } else { echo $value; } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td><?php echo htmlfilter($kpi->get_code()); ?></td>
                            <td><?php echo nl2br(htmlfilter($kpi->get_title())); ?></td>
                            <td><?php echo $kpi->get_unit_obj()->get_name();?></td>
                            <td><?php echo 'N/A'; ?></td>
                            <?php foreach (array_reverse(Orm_Semester::get_last_five_years()) as $year) { ?>
                                <td class="text-xs"><?php echo 0; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            <?php if (!$exist) { ?>
                <tr>
                    <td colspan="<?php echo count(Orm_Semester::get_last_five_years()) + 3; ?>">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('KPIs'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
