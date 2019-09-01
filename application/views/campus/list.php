<?php
/* @var $campuses Orm_Campus */;
?>
<div class="col-md-9 col-lg-10">

    <div class="table-primary">

        <div class="table-header">
            <?php echo filter_block('/campus/filter', '/campus', ['keyword']); ?>
        </div>

        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-10"><?php echo lang('Name'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($campuses): ?>
                    <?php foreach ($campuses as $campus): ?>
                        <tr>
                            <td><?php echo htmlfilter($campus->get_name()); ?></td>
                            <td class="text-center">
                                <a href="/campus/edit/<?php echo (int)$campus->get_id(); ?>"
                                   class="btn btn-sm btn-block" title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit"
                                          aria-hidden="true"></span> <?php echo lang('Edit') ?>
                                </a>
                                <a href="/campus/delete/<?php echo (int)$campus->get_id(); ?>"
                                   class="btn btn-sm btn-block" title="<?php echo lang('Delete') ?>"
                                   data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>">
                                    <span class="btn-label-icon left fa fa-trash-o"
                                          aria-hidden="true"></span> <?php echo lang('Delete') ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Campuses'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if (!empty($pager)): ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
