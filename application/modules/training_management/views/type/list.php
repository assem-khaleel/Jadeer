<?php
/* @var $types Orm_Tm_Type[]*/


?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Training Management Type') ?>
        </div>

        <?php
        echo filter_block('/training_management/types/types_filter', '/training_management/types', ['keyword'], 'ajax_block');
        ?>

    </div>
    <?php if (empty($types)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Training Management Type'); ?>
            </div>
            <a class="btn btn-block" data-toggle="ajaxModal"
               href="/training_management/add_edit_type"><span
                    class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add').' '.lang('Type'); ?></a>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-9"><?php echo lang('Name'); ?></th>
                <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($types as $type) { ?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter($type->get_name()) ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                        <?php if($type->check_if_can_edit()){?>
                            <a class="btn btn-block" data-toggle="ajaxModal"
                               href="/training_management/add_edit_type/<?php echo intval($type->get_id())?>"><span
                                    class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <?php }?>
                        <?php if($type->check_if_can_delete()){?>
                            <a class="btn btn-block"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction"
                               href="/training_management/delete_type/<?php echo intval($type->get_id())?>"><span
                                    class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                        <?php } ?>


                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
        <?php echo $pager ?>
    <?php } ?>
</div>
