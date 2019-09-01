<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:49 AM
 */
/** @var Orm_Sp_Goal[] $goals */
/* @var Orm_Sp_Strategy $item */
/** @var array $fltr */
/** @var string $pager */
/** @var int $type */
?>
<div class="table-primary table-responsive p-a-2">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Goal'); ?></span>

	    <div class="panel-heading-controls col-sm-4">
            <div class="pull-right">
                <a href="/strategic_planning/goal/integrate?strategy_id=<?php echo urlencode($strategy->get_id()); ?>" class="btn btn-sm integrate" data-toggle="ajaxModal"><span class="btn-label-icon left"><i class="fa fa-retweet"></i></span><?php echo lang('Integrate'); ?></a>
                <a href="/strategic_planning/goal/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>" class="btn btn-sm" data-toggle="ajaxModal"><span class="btn-label-icon left"><i class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create'); ?></a>
            </div>
	    </div>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-lg-1"><?php echo lang('code'); ?></th>
            <th class="col-lg-7"><?php echo lang('Title'); ?></th>
            <th class="col-lg-4 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($goals as $goal) { ?>
            <tr class="odd gradeX">
                <td><?php echo htmlfilter($goal->get_code()); ?></td>
                <td><?php echo htmlfilter($goal->get_title()); ?></td>
                <td class="text-center">
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/goal/add_edit?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($goal->get_id()); ?>"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/goal/delete?strategy_id=<?php echo urlencode($strategy->get_id()); ?>&id=<?php echo urlencode($goal->get_id()); ?>"
                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                </td>
            </tr>
        <?php } ?>
        <?php if (empty($goals)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Goals'); ?>
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
<script>
    function after_modal() {
        init_data_toggle();
    }
</script>