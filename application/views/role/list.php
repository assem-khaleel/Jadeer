<?php
/** @var Orm_Role[] $items */
$i = 0;
?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary table-responsive">
        <div class="table-header">
        <span class="table-caption">
            <?php echo lang('Roles') ?>
        </span>
        </div>
        <div class="clearfix"></div>

        <table class="table table-bordered">
            <thead>
            <tr class="titles_line">
                <th class="col-md-1"><?php echo '#'; ?></th>
                <th class="col-md-9"><?php echo lang('Name'); ?></th>
                <th class="col-md-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($items) {
                foreach ($items as $item) { ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo htmlfilter($item->get_name()); ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-block"
                               href="/role/create_edit/?id=<?php echo urlencode($item->get_id()); ?>"
                               data-toggle="ajaxModal">
                                <span class="btn-label-icon left "><i
                                            class="fa fa-edit"></i></span> <?php echo lang('Edit'); ?>
                            </a>
                            <a class="btn btn-sm btn-block"
                               href="/role/delete/?id=<?php echo urlencode($item->get_id()); ?>"
                               data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>">
                                <span class="btn-label-icon left"><i
                                            class="fa fa-trash-o"></i></span> <?php echo lang('Delete') ?>
                            </a>
                        </td>
                    </tr>
                <?php }
            } else {
                ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang("There are no").' '.lang('Role') ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php if ($pager) { ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php } ?>
    </div>
</div>
