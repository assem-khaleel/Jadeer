<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 7/22/15
 * Time: 11:55 AM
 */
/** @var Orm_Kpi $kpi */
/** @var array $fltr */
/** @var int $type */
$college_id = isset($fltr['college_id']) ? $fltr['college_id'] : 0;
$program_id = isset($fltr['program_id']) ? $fltr['program_id'] : 0;
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="row">
            <strong class="panel-title col-md-11 col-sm-10 col-xs-8" ><span class="label label-default"><?php echo htmlfilter($kpi->get_view_code()); ?></span> - <?php echo htmlfilter($kpi->get_title()); ?></strong>
        </div>
    </div>
    <div class="panel-heading">
        <form method="GET">
            <div class="row">
                <div class="col-md-3" style="margin-bottom: 10px;">
                    <a class="btn btn-sm btn-block" href="/kpi/view/?id=<?php echo urlencode($kpi->get_id()); ?>" type="reset" ><?php echo lang('Institution') ?></a>
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
                    <input type="hidden" name="id" value="<?php echo intval($kpi->get_id()); ?>">
                    <button class="btn btn-sm btn-block" type="submit" ><?php echo lang('Search') ?></button>
                </div>
            </div>
        </form>
    </div>
    <div class="panel-heading text-center-md">
        <a href="/kpi/image?id=<?php echo urlencode($kpi->get_id()); ?>&college_id=<?php echo urlencode($college_id); ?>&program_id=<?php echo urlencode($program_id); ?>&t=<?php echo Orm_Kpi::KPI_REPORT_NORMAL; ?>" class="btn "><span class="btn-label-icon left icon fa fa-file-image-o"></span><?php echo lang('Image'); ?></a>
        <a href="/kpi/pdf?id=<?php echo urlencode($kpi->get_id()); ?>&college_id=<?php echo urlencode($college_id); ?>&program_id=<?php echo urlencode($program_id); ?>&t=<?php echo Orm_Kpi::KPI_REPORT_NORMAL; ?>" class="btn "><span class="btn-label-icon left icon fa fa-file-pdf-o"></span><?php echo lang('PDF'); ?></a>
        <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF,Orm_User::USER_FACULTY), false, 'kpi-values')) { ?>
            <a href="/kpi/values?kpi_id=<?php echo urlencode($kpi->get_id()); ?>&college_id=<?php echo urlencode($college_id); ?>&program_id=<?php echo urlencode($program_id); ?>" class="btn " data-toggle="ajaxModal"><span class="btn-label-icon left icon fa fa-info "></span><?php echo lang('Set Values'); ?></a>
        <?php } ?>
        <a href="/kpi/details?kpi_id=<?php echo urlencode($kpi->get_id()); ?>&college_id=<?php echo urlencode($college_id); ?>&program_id=<?php echo urlencode($program_id); ?>" class="btn " data-toggle="ajaxModal"><span class="btn-label-icon left icon fa fa-list-ol"></span><?php echo lang('Show Details'); ?></a>
        <a href="/kpi/trend_analysis?kpi_id=<?php echo urlencode($kpi->get_id()); ?>&college_id=<?php echo urlencode($college_id); ?>&program_id=<?php echo urlencode($program_id); ?>" class="btn " data-toggle="ajaxModal"><span class="btn-label-icon left icon fa fa-line-chart"></span><?php echo lang('Trend'); ?></a>

        <?php if(License::get_instance()->check_module('assessment_loop')) { ?>
            <a href="/assessment_loop/assessment/Orm_Al_Assessment_Loop_Kpi/<?php echo urlencode($kpi->get_id()); ?>/<?php echo $college_id ?>/<?php echo $program_id ?>" data-toggle="confirmAction" message="<?php echo lang('Are you sure you want to analyze this KPI.'); ?>" class="btn ">
                <span class="btn-label-icon left icon fa fa-circle-o-notch"></span><?php echo lang('Assessment Loop'); ?>
            </a>
        <?php } ?>
        <a href="/kpi/manage_level_desc/<?php echo urlencode($kpi->get_id()); ?>" class="btn " data-toggle="ajaxModal"><span class="btn-label-icon left icon fa fa-sort-amount-asc "></span><?php echo lang('Set Level Description'); ?></a>
    </div>
    <div class="panel-body">
        <?php echo $kpi->draw_chart($type, $fltr); ?>
    </div>
</div>