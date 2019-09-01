<?php /* @var $requests Orm_Tm_Members[] */ ?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Requests') ?>
        </div>

        <?php
        echo filter_block('/training_management/training_general/request/request_filter', '/training_management/training_general/request', ['keyword'], 'ajax_block');
        ?>

    </div>
    <?php if (!empty($requests)) { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-5"><?php echo lang('Name'); ?></th>
                <th class="col-lg-4"><?php echo lang('Training'); ?></th>
                <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($requests as $request) { ?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter($request->get_user_obj()->get_full_name()) ?></span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($request->get_training_obj()->get_name()) ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                            <a class="btn btn-block"
                               href="/training_management/training_general/approve/<?php echo intval($request->get_id())?>"><span
                                    class="btn-label-icon left fa fa-check"></span> <?php echo lang('Approve'); ?></a>
                            <a class="btn btn-block"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction"
                               href="/training_management/training_general/ignore/<?php echo intval($request->get_id())?>"><span
                                    class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Ignore'); ?></a>
                    
                    </td>
                </tr>
            <?php } ?>
            </tbody>
    <?php } else { ?>
        <tr>
            <td colspan="3">
                <div class="well well-sm m-a-0">
                    <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Requests'); ?></h3>
                </div>
            </td>
        </tr>
    <?php } ?>
        </table>
</div>
<?php if (!empty($pager)) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>
