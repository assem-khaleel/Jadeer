<?php
/** @var $measures Orm_Al_Measure[] */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption row">
            <div class="col-md-10">
                <i class="fa fa-book"></i>
                <?php echo lang('Measure'); ?>
            </div>
            <?php if ($assessment_loop->can_manage()) :?>
            <div class="col-md-2 ">
                <a href="/assessment_loop/measure/add_edit?assessment_loop_id=<?php echo (int) $assessment_loop_id; ?>" data-toggle="ajaxModal" class="btn  pull-right btn-sm" >
                    <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('Measure'); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if (empty($measures)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') .' ' . lang('Measure has Entered'); ?>
            </div>
        </div>
    <?php }else{ ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-<?php echo ($assessment_loop->can_manage())? 8: 12 ?>"><?php echo lang('Measure'); ?></th>
            <?php if ($assessment_loop->can_manage()) :?>
                <th class="col-lg-4 text-center"><?php echo lang('Actions'); ?></th>
            <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($measures)) { ?>
            <?php foreach ($measures as $measure) { ?>
                <tr>
                    <td>
                        <span><?php echo xssfilter($measure->get_text()); ?></span>
                    </td>
                    <?php if ($assessment_loop->can_manage()) :?>
                        <td class="td last_column_border text-center">
                        <a class="btn btn-block" data-toggle="ajaxModal" href="/assessment_loop/measure/add_edit/<?php echo intval($measure->get_id()); ?>?assessment_loop_id=<?php echo $assessment_loop_id;?>"><span class="btn-label-icon left fa  fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <a class="btn btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/assessment_loop/measure/delete/<?php echo intval($measure->get_id()); ?>?assessment_loop_id=<?php echo $assessment_loop_id;?>"><span class="btn-label-icon left fa  fa-remove"></span> <?php echo lang('Delete'); ?></a>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>