<?php
/**
 * @var string $pager
 * @var string $keyword
 * @var string $title
 * @var int $category
 */
/* @var array $group_objectives */
/* @var Orm_Sp_Objective $objective */
/* @var Orm_Sp_Strategy $item */
/** @var array $fltr */
/** @var string $pager */
/** @var Orm_Sp_Objective[] $perspective_data */
?>
<div class="row">
    <?php $i = 0; ?>
    <?php foreach ($group_objectives as $perspective => $group) : ?>

    <?php
    $i++;
    $perspective_color = isset($group['color']) ? $group['color'] : '';
    $perspective_icon = isset($group['icon']) ? $group['icon'] : '';
    $perspective_data = isset($group['data']) ? $group['data'] : '';
    ?>

    <div class="col-md-6 p-a-3">
        <div class="table-<?php echo $perspective_color; ?> table-responsive">
            <div class="table-header">
                <span class="table-caption">
                    <i class="<?php echo $perspective_icon; ?>"></i>
                    <?php echo lang($perspective); ?>
                </span>

	            <div class="panel-heading-controls col-sm-4">
		            <a class="btn btn-sm pull-right" data-toggle="ajaxModal"
		               href="/strategic_planning/objective/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()) . '&perspective=' . $perspective;; ?>">
			            <span class="btn-label-icon left"><i
					            class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create'); ?>
		            </a>
	            </div>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-lg-7"><?php echo lang('title'); ?></th>
                    <th class="col-lg-5 text-center"><?php echo lang('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($perspective_data)) { ?>
                    <?php foreach ($perspective_data as $objective) : ?>
                        <tr>
                            <td><span
                                    class="label label-<?php echo $perspective_color; ?>"><?php echo htmlfilter($objective->get_code()); ?></span> <?php echo htmlfilter($objective->get_title()); ?>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm"
                                   href="/strategic_planning/objective/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($objective->get_id()) . '&perspective=' . $perspective; ?>"
                                   data-toggle="ajaxModal"><i class="fa fa-edit" title="<?php echo lang('Edit'); ?>"></i></a>
                                <a class="btn btn-sm"
                                   href="/strategic_planning/objective/delete?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($objective->get_id()); ?>"
                                   message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><i class="fa fa-trash-o"
                                                                 title="<?php echo lang('Delete'); ?>"></i></a>
                                <a class="btn btn-sm"
                                   href="/strategic_planning/lag_kpi/add_edit_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&type_id=<?php echo urlencode($objective->get_id()); ?>&class_type=Orm_Sp_Objective"
                                   data-toggle="ajaxModal"><i class="fa fa-bar-chart-o"
                                                              title="<?php echo lang('KPI'); ?>"></i></a>
                                <a class="btn btn-sm"
                                   href="/strategic_planning/risk_tab/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($objective->get_id()); ?>&type=Orm_Sp_Objective"
                                   data-toggle="ajaxModal"><i class="fa fa-bug" title="<?php echo lang('Risk'); ?>"></i></a>
                                <a class="btn btn-sm"
                                   href="/strategic_planning/objective/milestone?id=<?php echo urlencode($objective->get_id()); ?>&strategy_id=<?php echo urlencode($strategy->get_id()); ?>"
                                   data-toggle="ajaxModal"><i class="fa fa-arrows"
                                                              title="<?php echo lang('Milestone'); ?>"></i></a>
                            </td>
                        </tr>
                        <?php foreach (Orm_Sp_Kpi::get_all(array('class_type' => 'Orm_Sp_Objective', 'type_id' => $objective->get_id())) as $kpi) { ?>
                            <tr class="alert alert-primary">
                                <td>
                                    <div class="media">
                                        <div class="pull-left"><i class="comment-avatar fa fa-key"></i></div>
                                        <div
                                            class="media-body"><?php echo htmlfilter(Orm_Kpi::get_instance($kpi->get_kpi_id())->get_title()); ?></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm"
                                       href="/strategic_planning/lag_kpi/add_edit_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&type_id=<?php echo urlencode($objective->get_id()); ?>&id=<?php echo urlencode($kpi->get_id()); ?>"
                                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                                    <a class="btn btn-sm"
                                       href="/strategic_planning/lag_kpi/remove_kpi?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($kpi->get_id()); ?>"
                                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php endforeach; ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="12">
                            <div class="alert m-a-0">
                                <?php echo lang('There are no') . ' ' . lang('Objectives'); ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!($i % 2) && $i != count($group_objectives)) { ?>
</div>
<div class="row">
    <?php } ?>

    <?php endforeach; ?>
</div>
