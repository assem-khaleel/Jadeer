<?php
/** @var $object Orm_Institution | Orm_Unit | Orm_College | Orm_Program */
$credential = Orm_User::check_credential(array(Orm_User_Staff::class, Orm_User_Faculty::class), false, 'setup-objective')
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption row">
            <div class="col-md-8">
                <i class="fa fa-book"></i>
                <?php echo lang('Objectives'); ?>
            </div>
            <div class="col-md-4">
                <?php if ($credential) { ?>
                    <a href="/setup/objective_add_edit/<?php echo get_class($object) ?>/<?php echo intval($object->get_id()) ?>"
                       data-toggle="ajaxModal" class="btn pull-right">
                        <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('Objective'); ?>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if ($object->get_objectives()): ?>
        <table class="table table-bordered ">
            <thead>
            <tr>
                <td class="col-md-10"><?php echo lang('Objective'); ?></td>
                <?php if ($credential) { ?>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($object->get_objectives() as $objective) : ?>
                <tr>
                    <td>
                        <?php echo htmlfilter($objective->get_title()); ?>
                    </td>
                    <?php if ($credential) { ?>
                        <td class="text-center">
                            <a href="/setup/objective_add_edit/<?php echo get_class($object) ?>/<?php echo intval($object->get_id()) ?>/<?php echo intval($objective->get_id()) ?>"
                               data-toggle="ajaxModal" class="btn btn-block "
                               title="<?php echo lang('Edit'); ?>">
                                <span class="btn-label-icon left fa fa-pencil-square-o" aria-hidden="true"></span>
                                <?php echo lang('Edit'); ?>
                            </a>
                            <a href="/setup/objective_delete/<?php echo get_class($object) ?>/<?php echo intval($object->get_id()) ?>/<?php echo intval($objective->get_id()) ?>"
                               data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>" class="btn btn-block "
                               title="<?php echo lang('Delete'); ?>">
                                <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                <?php echo lang('Delete'); ?>
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="table-footer m-a-0">
            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Objectives'); ?></h3>
        </div>
    <?php endif; ?>
</div>
