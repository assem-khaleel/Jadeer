<?php
/* @var Orm_Sp_Recommendation[] $recommendations */
/* @var Orm_Sp_Action_Plan[] $action_plans */
/* @var Orm_Sp_Strategy $item */
/** @var string $pager */
/** @var string $rec_pager */
/** @var array $fltr */
?>
<div class="table-primary table-responsive p-a-2">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Action Plan'); ?></span>

	    <div class="panel-heading-controls col-sm-4">
		    <a class="btn btn-sm pull-right" data-toggle="ajaxModal"
		       href="/strategic_planning/action_plan/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>">
			    <span class="btn-label-icon left"><i class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create'); ?>
		    </a>
	    </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Initiative'); ?></th>
            <th class="col-lg-4"><?php echo lang('Title'); ?></th>
            <th class="col-lg-1"><?php echo lang('Start Date'); ?></th>
            <th class="col-lg-1"><?php echo lang('End Date'); ?></th>
            <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($action_plans as $action_plan) { ?>
            <tr class="odd gradeX">
                <td><span
                        class="label label-primary"><?php echo htmlfilter($action_plan->get_initiative_obj()->get_code()); ?></span> <?php echo htmlfilter($action_plan->get_initiative_obj()->get_title()); ?>
                </td>
                <td><?php echo htmlfilter($action_plan->get_title()); ?></td>
                <td><?php echo htmlfilter($action_plan->get_start_date()); ?></td>
                <td><?php echo htmlfilter($action_plan->get_end_date()); ?></td>
                <td class="text-center">
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/action_plan/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($action_plan->get_id()); ?>"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/action_plan/delete?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($action_plan->get_id()); ?>"
                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/risk_tab/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($action_plan->get_id()); ?>&type=Orm_Sp_Action_Plan"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-bug"></i></span><?php echo lang('Risk'); ?></a>
                </td>
            </tr>
        <?php } ?>
        <?php if (empty($action_plans)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Action Plans'); ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if (!empty($pager)) { ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>
<br/>
<?php // recommendations listing ?>
<div class="table-primary table-responsive p-a-2">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Recommendation'); ?></span>

	    <div class="panel-heading-controls col-sm-4">
		    <a class="btn btn-sm pull-right" data-toggle="ajaxModal"
		       href="/strategic_planning/recommendation/add_edit">
			    <span class="btn-label-icon left"><i class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create'); ?>
		    </a>
	    </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-md-3"><?php echo lang('type'); ?></th>
            <th class="col-md-3"><?php echo lang('title'); ?></th>
            <th class="col-md-3"><?php echo lang('Program'); ?></th>
            <th class="col-md-3 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($recommendations as $recommendation) { ?>
            <tr class="odd gradeX">
                <td><?php echo htmlfilter($recommendation->get_recommendation_type_obj()->get_title()); ?></td>
                <td><?php echo htmlfilter($recommendation->get_title()); ?></td>
                <td><?php echo htmlfilter($recommendation->get_program_obj()->get_name()); ?></td>
                <td class="text-center">
                    <a class="btn btn-sm"
                       href="/strategic_planning/recommendation/add_edit/?id=<?php echo urlencode($recommendation->get_id()); ?>"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                    <a class="btn btn-sm"
                       href="/strategic_planning/recommendation/delete/?id=<?php echo urlencode($recommendation->get_id()); ?>"
                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                </td>
            </tr>
        <?php } ?>
        <?php if (empty($recommendations)) { ?>
            <tr>
                <td colspan="4">
                    <div class="alert alert-default">
                        <div class="m-b-1"><?php echo lang('No recommendations to be displayed') ?>.</div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if (!empty($rec_pager)) { ?>
        <div>
            <?php echo $rec_pager; ?>
        </div>
    <?php } ?>
</div>
<script>
    function after_modal() {
        init_data_toggle();
    }
</script>