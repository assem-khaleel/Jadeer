<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 05/11/17
 * Time: 16:35
 */

/** @var $rubric Orm_Rb_Rubrics */

$invitations = $rubric->get_evaluation();
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Invitation') ?>
        </div>
    </div>
    <div class="table-responsive m-a-0">
        <table class="table table-striped table-bordered">
            <thead>
            <tr class="bg-primary">
                <th class="col-md-8">
                    <b><?php echo lang('Description') ?></b>
                </th>
                <th class="col-md-2">
                    <b><?php echo lang('Date Added') ?></b>
                </th>
                <th class="col-md-2 text-center">
                    <b><?php echo lang('Action') ?></b>
                </th>
            </tr>
            </thead>
            <tbody>

            <?php

            if (count($invitations)) {
                foreach ($invitations as $invitation) {
                    ?>
                    <tr>
                        <td>
                            <b><?php echo htmlfilter($invitation->get_description()) ?></b>
                        </td>
                        <td>
                            <b><?php echo htmlfilter($invitation->get_date_added()) ?></b>
                        </td>
                        <td class="text-center">
                            <?php if ($rubric->can_manage() && !$rubric->has_answer()): ?>
                                <a href="/rubrics/invitation/<?php echo (int)$rubric->get_id() ?>?invitation_id=<?php echo $invitation->get_id(); ?>"
                                   data-toggle="ajaxModal" class="btn btn-block"><i
                                            class="btn-label-icon left fa fa-edit"></i><?php echo lang('Edit'); ?></a>
                                <a href="/rubrics/delete_invitation/<?php echo $rubric->get_id() . '/' . $invitation->get_id(); ?>"
                                   data-toggle="deleteAction" class="btn btn-block"><i
                                            class="btn-label-icon left fa fa-trash-o"></i><?php echo lang('Delete'); ?>
                                </a>
                            <?php endif; ?>
                            <a href="/rubrics/preview/<?php echo (int)$invitation->get_id(); ?>" class="btn btn-block "><span
                                        class="btn-label-icon left fa fa-eye"></span><?php echo lang('Preview') ?></a>
                        </td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="7">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Rubrics'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($pager)): ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php endif; ?>
</div>

