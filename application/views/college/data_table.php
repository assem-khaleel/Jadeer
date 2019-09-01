<?php /** @var Orm_College[] $colleges */ ?>
<div class="table-responsive m-a-0">
    <table class="table table-bordered">
        <thead>
        <tr>
            <td class="col-md-6"><?php echo lang('Name'); ?></td>
            <td class="col-md-3"><?php echo lang('Campus'); ?></td>
            <td class="col-md-3 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($colleges): ?>
            <?php foreach ($colleges as $college): ?>
                <tr>
                    <td><?php echo htmlfilter($college->get_name()); ?></td>
                    <td>
                        <?php if ($college->get_campuses()) { ?>
                            <ul class="p-x-2">
                                <?php foreach ($college->get_campuses() as $campus) { ?>
                                    <li><?php echo htmlfilter($campus->get_name()); ?></li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </td>
                    <td class="text-center">
                        <a href="/college/vision_mission/<?php echo (int)$college->get_id(); ?>"
                           class="btn btn-sm btn-block" title="<?php echo lang('Vision & Mission'); ?>">
                            <span class="btn-label-icon left fa fa-tasks" aria-hidden="true"></span>
                            <?php echo lang('Vision & Mission'); ?>
                        </a>
                        <a href="/college_goal?college_id=<?php echo (int)$college->get_id(); ?>"
                           class="btn btn-sm btn-block" title="<?php echo lang('Goals') ?>">
                            <span class="btn-label-icon left fa fa-tasks" aria-hidden="true"></span>
                            <?php echo lang('Goals') ?>
                        </a>
                        <a href="/college_objective?college_id=<?php echo (int)$college->get_id(); ?>"
                           class="btn btn-sm btn-block" title="<?php echo lang('Objectives') ?>">
                            <span class="btn-label-icon left fa fa-tasks" aria-hidden="true"></span>
                            <?php echo lang('Objectives') ?>
                        </a>
                        <a href="/college/edit/<?php echo (int)$college->get_id(); ?>" class="btn btn-sm btn-block"
                           title="<?php echo lang('Edit') ?>">
                            <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                            <?php echo lang('Edit') ?>
                        </a>
                        <a href="/college/delete/<?php echo (int)$college->get_id(); ?>" class="btn btn-sm btn-block"
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
                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Colleges'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php if (!empty($pager)) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>