<?php
/* @var $standards Orm_Standard */;
?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">

        <div class="table-header">
            <?php echo filter_block('/standard/filter', '/standard', ['keyword']); ?>
        </div>

        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-2"><?php echo lang('Code'); ?></td>
                    <td class="col-md-8"><?php echo lang('Title'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($standards): ?>
                    <?php foreach ($standards as $standard): ?>
                        <tr>
                            <td><?php echo htmlfilter($standard->get_code()); ?></td>
                            <td><?php echo htmlfilter($standard->get_title()); ?></td>
                            <td class="text-center">
                                <a href="/standard/edit/<?php echo (int)$standard->get_id(); ?>"
                                   class="btn btn-sm btn-block " title="<?php echo lang('Edit') ?>">
                                        <span class="btn-label-icon left fa fa-edit"
                                              aria-hidden="true"></span> <?php echo lang('Edit') ?>
                                </a>
                                <a href="/standard/delete/<?php echo (int)$standard->get_id(); ?>"
                                   class="btn btn-sm btn-block " title="<?php echo lang('Delete') ?>"
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
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('standards'); ?></h3>
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
