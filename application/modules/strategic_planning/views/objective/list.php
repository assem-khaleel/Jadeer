<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/10/17
 * Time: 12:27 PM
 */
/** @var Orm_Sp_Objective[] $objectives */
?>
<div class="table-primary m-b-4">
    <div class="table-header">
        <div class="table-caption">
            <button class="btn btn-rounded btn-sm" type="button" data-toggle="collapse" data-target="#legends" aria-expanded="false" aria-controls="legends">
                <i class="fa fa-question"></i>
            </button>
            <span class="padding-sm-hr"><?php echo lang('Perspectives Legends'); ?></span>
        </div>
    </div>
    <div class="collapse" id="legends">
        <table class="table table-bordered bg-theme text-bold">
            <?php if(Orm_Sp_Perspective::get_count() != 0){ ?>
                <?php foreach (Orm_Sp_Perspective::get_all() as $perspective) { ?>
                    <tr>
                        <!--                    <td class="col-md-2 text-center"><i class="font-size-24 fa fa-circle"></i></td>-->
                        <td class="col-md-10"><?php echo htmlfilter($perspective->get_name()) ?></td>
                    </tr>
                <?php } ?>
            <?php }else{?>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <div class="well well-sm m-a-0">
                            <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Perspectives'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php }?>

        </table>
    </div>
</div>

<div class="table-primary">
    <div class="table-header">
        <span class="table-caption m-b-1"><?php echo lang('Strategic Objective'); ?></span>
        <div class="panel-heading-controls col-sm-4">
            <div class="pull-right">
                <a href="/strategic_planning/objective/integrate?strategy_id=<?php echo urlencode($strategy->get_id()); ?>" class="btn btn-sm integrate" data-toggle="ajaxModal"><span class="btn-label-icon left"><i class="fa fa-retweet"></i></span><?php echo lang('Integrate'); ?></a>
                <a href="/strategic_planning/objective/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>" class="btn btn-sm" data-toggle="ajaxModal"><span class="btn-label-icon left"><i class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create'); ?></a>
            </div>
        </div>
    </div>

    <div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr class="bg-primary">
                <td class="col-md-6"><b><?php echo lang('Title') ?></b></td>
                <td class="col-md-2 text-center"><b><?php echo lang('Perspective(s)');?></b></td>
                <td class="col-md-4 text-center"><b><?php echo lang('Action'); ?></b></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($objectives as $objective) { ?>
                <tr>
                    <td><?php echo htmlfilter($objective->get_title()); ?></td>
                    <td class="text-center">
                        <?php foreach ($objective->get_perspectives() as $perspective) { ?>
                            <span class="label label-primary label-tag"><?php echo htmlfilter(Orm_Sp_Perspective::get_instance($perspective->get_perspective())->get_name()) ?></span>&nbsp;&nbsp;&nbsp;
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-no-width" href="/strategic_planning/objective/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($objective->get_id()); ?>" data-toggle="ajaxModal"><i class="fa fa-edit" title="<?php echo lang('Edit'); ?>"></i></a>
                        <a class="btn btn-sm btn-no-width" href="/strategic_planning/objective/delete?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($objective->get_id()); ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><i class="fa fa-trash-o" title="<?php echo lang('Delete'); ?>"></i></a>
                        <a class="btn btn-sm btn-no-width" href="/strategic_planning/lag_kpi/add_edit_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&type_id=<?php echo urlencode($objective->get_id()); ?>&class_type=Orm_Sp_Objective" data-toggle="ajaxModal"><i class="fa fa-bar-chart-o" title="<?php echo lang('KPI'); ?>"></i></a>
                        <a class="btn btn-sm btn-no-width" href="/strategic_planning/risk_tab/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($objective->get_id()); ?>&type=Orm_Sp_Objective" data-toggle="ajaxModal"><i class="fa fa-bug" title="<?php echo lang('Risk'); ?>"></i></a>
                        <a class="btn btn-sm btn-no-width" href="/strategic_planning/objective/milestone?id=<?php echo urlencode($objective->get_id()); ?>&strategy_id=<?php echo urlencode($strategy->get_id()); ?>" data-toggle="ajaxModal"><i class="fa fa-arrows" title="<?php echo lang('Milestone'); ?>"></i></a>
                    </td>
                </tr>
                <?php foreach (Orm_Sp_Kpi::get_all(array('class_type' => 'Orm_Sp_Objective', 'type_id' => $objective->get_id())) as $kpi) { ?>
                    <tr class="alert alert-primary">
                        <td colspan="2">
                            <div class="media">
                                <div class="pull-left"><i class="comment-avatar fa fa-key"></i></div>
                                <div class="media-body"><?php echo htmlfilter(Orm_Kpi::get_instance($kpi->get_kpi_id())->get_title()); ?>
                                    <span class="label label-default"><?php echo htmlfilter(Orm_Kpi::get_instance($kpi->get_kpi_id())->get_unit_obj()->get_name()); ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-no-width" href="/strategic_planning/lag_kpi/add_edit_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&type_id=<?php echo urlencode($objective->get_id()); ?>&id=<?php echo urlencode($kpi->get_id()); ?>" data-toggle="ajaxModal"><span class="btn-label-icon left"><i class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                            <a class="btn btn-sm btn-no-width" href="/strategic_planning/lag_kpi/remove_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($kpi->get_id()); ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
        <?php if ($pager) { ?>
            <div class="table-footer"><?php echo $pager; ?></div>
        <?php } ?>
    </div>
</div>
