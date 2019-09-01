<?php
/**
 * @var $unites Orm_Unit[]
 * @var $unite  Orm_Unit
 *
 */

?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/unit/filter', '/unit', ['keyword']); ?>
        </div>

        <div class="table-responsive m-a-0">
            <table class="table table-bordered ">
                <thead>
                <tr>
                    <td class="col-md-7"><?php echo lang('Name'); ?></td>
                    <td class="col-md-2"><?php echo lang('Unit Head'); ?></td>
                    <td class="col-md-3 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($unites): ?>
                    <?php foreach ($unites as $unit): ?>
                        <tr>
                            <td><?php echo htmlfilter($unit->get_name()); ?></td>
                            <td><?php echo $unit->get_unit_head()->get_user_id() ? htmlfilter($unit->get_unit_head()->get_user_obj()->get_full_name()) : lang('N/A'); ?></td>
                            <td class="text-center">
                                <a href="/unit/vision_mission/<?php echo (int)$unit->get_id(); ?>"
                                   class="btn btn-sm  btn-block" title="<?php echo lang('Vision & Mission'); ?>">
                                    <span class="btn-label-icon left fa fa-tasks" aria-hidden="true"></span>
                                    <?php echo lang('Vision & Mission'); ?>
                                </a>
                                <a href="/unit_goal?unit_id=<?php echo (int)$unit->get_id(); ?>"
                                   class="btn btn-sm  btn-block" title="<?php echo lang('Goals') ?>">
                                    <span class="btn-label-icon left fa fa-tasks" aria-hidden="true"></span>
                                    <?php echo lang('Goals') ?>
                                </a>
                                <a href="/unit_objective?unit_id=<?php echo (int)$unit->get_id(); ?>"
                                   class="btn btn-sm  btn-block" title="<?php echo lang('Objectives') ?>">
                                    <span class="btn-label-icon left fa fa-tasks" aria-hidden="true"></span>
                                    <?php echo lang('Objectives') ?>
                                </a>
                                <a href="/unit/edit/<?php echo (int)$unit->get_id(); ?>" class="btn btn-sm  btn-block"
                                   title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                                    <?php echo lang('Edit') ?>
                                </a>
                                <a href="/unit/delete/<?php echo (int)$unit->get_id(); ?>" class="btn btn-sm  btn-block"
                                   title="<?php echo lang('Delete') ?>" data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>">
                                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                    <?php echo lang('Delete') ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Units'); ?></h3>
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
