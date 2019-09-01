<?php
/* @var Orm_As_Agency[] $agencies */;
?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/accreditation/status_settings/agencies/filter', '/accreditation/status_settings/agencies', ['keyword']); ?>
        </div>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-9"><?php echo lang('Name'); ?></td>
                    <td class="col-md-3 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($agencies): ?>
                    <?php foreach ($agencies as $agency): ?>
                        <tr>
                            <td><?php echo htmlfilter( $agency->get_name()); ?></td>
                            <td class="text-center">
                                <a href="/accreditation/status_settings/mapping/<?php echo (int)$agency->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Mapping') ?>" >
                                    <span class="btn-label-icon left fa fa-map-o" aria-hidden="true"></span> <?php echo lang('Mapping') ?>
                                </a>
                                <a href="/accreditation/status_settings/agency_edit/<?php echo (int)$agency->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span> <?php echo lang('Edit') ?>
                                </a>
                                <a href="/accreditation/status_settings/agency_delete/<?php echo (int)$agency->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Delete') ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Delete') ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('agencies'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if(!empty($pager)):?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php endif;?>
    </div>
</div>