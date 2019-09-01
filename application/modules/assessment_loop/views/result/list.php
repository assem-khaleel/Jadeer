<?php
/** @var $results Orm_Al_Result[] */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption row">
            <div class="col-md-10">
                <i class="fa fa-book"></i>
                <?php echo lang('Result'); ?>
            </div>
            <?php if ($assessment_loop->can_manage()) :?>
            <div class="col-md-2">
                <a href="/assessment_loop/result/add_edit?assessment_loop_id=<?php echo $assessment_loop_id; ?>"
                   data-toggle="ajaxModal" class="btn  btn-sm pull-right">
                    <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('Result'); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if (empty($results)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Result has Entered'); ?>
            </div>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-<?php echo ($assessment_loop->can_manage())? 8: 12 ?>"><?php echo lang('Result'); ?></th>
            <?php if ($assessment_loop->can_manage()) :?>
                <th class="col-lg-4 text-center"><?php echo lang('Actions'); ?></th>
            <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($results)) { ?>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td>
                            <span><?php echo xssfilter($result->get_text()); ?></span>
                        </td>
                    <?php if ($assessment_loop->can_manage()) :?>
                        <td class="td last_column_border text-center">
                            <a class="btn btn-block" data-toggle="ajaxModal"
                               href="/assessment_loop/result/add_edit/<?php echo intval($result->get_id()); ?>?assessment_loop_id=<?php echo $assessment_loop_id; ?>"><span
                                    class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                            <a class="btn btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"
                               href="/assessment_loop/result/delete/<?php echo intval($result->get_id()); ?>?assessment_loop_id=<?php echo $assessment_loop_id; ?>"><span
                                    class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?>
                            </a>
                        </td>
                    <?php endif; ?>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
