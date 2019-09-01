<?php
/** @var $assessment_metric_objs Orm_Am_Assessment_Metric[] */
$college_id = isset($fltr['college_id']) ? $fltr['college_id'] : 0;
$program_id = isset($fltr['program_id']) ? $fltr['program_id'] : 0;
?>
<?php if (empty($assessment_metric_objs)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') .' ' . lang('Record has Entered'); ?>
        </div>
        <a href="/assessment_metric/add_edit" data-toggle="ajaxModal" class="btn  btn-block" >
            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New'); ?>
        </a>
    </div>
<?php } else { ?>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-3"><?php echo lang('Name'); ?></th>
                <th class="col-lg-3"><?php echo lang('Program'); ?></th>
                <th class="col-lg-1"><?php echo lang('Level'); ?></th>
                <th class="col-lg-1"><?php echo lang('Target'); ?></th>
                <th class="col-lg-2"><?php echo lang('Type'); ?></th>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($assessment_metric_objs as $assessment_metric) {?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter($assessment_metric->get_name()); ?></span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($assessment_metric->get_program_obj($assessment_metric->get_program_id())->get_name()); ?></span>
                    </td>
                    <td>
                       <span>
                           <?php echo ($assessment_metric->get_level()==1) ? lang('Advance'):lang('Simple') ;?>
                     </span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($assessment_metric->get_target()); ?></span>
                    </td>

                    <td>
                        <span><?php echo lang(htmlfilter($assessment_metric->get_item_class())); ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                        <a class="btn btn-block" href="/assessment_metric/manage/<?php echo urlencode($assessment_metric->get_id()); ?>/<?php echo urlencode($assessment_metric->get_level()); ?>"><span class="btn-label-icon left fa fa-gear"></span> <?php echo lang('Manage'); ?>
                        </a>
                        <a class="btn btn-block" href="/assessment_metric/view/<?php echo urlencode($assessment_metric->get_id()); ?>/<?php echo urlencode($assessment_metric->get_level()); ?>"><span class="btn-label-icon left fa fa-eye"></span> <?php echo lang('View'); ?>
                        </a>
                        <a class="btn btn-block" data-toggle="ajaxModal" href="/assessment_metric/analysis/<?php echo urlencode($assessment_metric->get_id()); ?>"><span class="btn-label-icon left fa fa-circle"></span> <?php echo lang('Analysis'); ?>
                        </a>
                            <a class="btn btn-block" data-toggle="ajaxModal" href="/assessment_metric/add_edit/<?php echo urlencode($assessment_metric->get_id()); ?>"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                            <a class="btn btn-block" data-toggle="deleteAction" href="/assessment_metric/delete/<?php echo urlencode($assessment_metric->get_id()); ?>" message="<?php echo lang('Are you sure ?')?>"><span class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
<?php } ?>
