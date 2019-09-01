<?php
/** @var Orm_Manual[] $manuals */
/** @var string $pager */
$is_admin = Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN);
?>
<div class="row m-b-3">
    <div class="col-md-3">
        <a href="/help/english" class="btn btn-block">
                  <span class="btn-label-icon left">
                        <i class="fa fa-globe"></i>
                    </span>
            <?php echo lang('Manual'); ?> (<?php echo lang('English') ?>)
        </a>
    </div>
    <div class="col-md-3">
        <a href="/help/arabic" class="btn btn-block">
                  <span class="btn-label-icon left">
                        <i class="fa fa-language"></i>
                    </span>
            <?php echo lang('Manual'); ?> (<?php echo lang('Arabic') ?>)
        </a>
    </div>
</div>

<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Manuals'); ?></span>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <td class="col-md-<?php echo $is_admin ? 7 : 9; ?>"><?php echo lang('Label'); ?></td>
            <td class="col-md-3"><?php echo lang('Link'); ?></td>
            <?php if ($is_admin) { ?>
                <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php if ($manuals): ?>
            <?php foreach ($manuals as $manual): ?>
                <tr>
                    <td><?php echo htmlfilter($manual->get_label()); ?></td>
                    <td><a href="<?php echo htmlfilter($manual->get_link_arabic()) ?>"
                           target="_blank"><?php echo htmlfilter($manual->get_link()) ?></a></td>
                    <?php if ($is_admin) { ?>
                        <td class="text-center">
                            <a href="/manual/add_edit/<?php echo (int)$manual->get_id(); ?>"
                               class="btn btn-block " title="<?php echo lang('Edit') ?>">
                                <span class="btn-label-icon left fa fa-edit"
                                      aria-hidden="true"></span> <?php echo lang('Edit') ?>
                            </a>
                            <a href="/manual/delete/<?php echo (int)$manual->get_id(); ?>"
                               class="btn btn-block " title="<?php echo lang('Delete') ?>"
                               data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>">
                                <span class="btn-label-icon left fa fa-trash-o"
                                      aria-hidden="true"></span> <?php echo lang('Delete') ?>
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Manual'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php if (!empty($pager)): ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php endif; ?>
</div>