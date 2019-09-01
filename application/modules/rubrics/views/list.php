<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Rubrics') ?>
        </div>
    </div>
    <div class="table-responsive m-a-0">
        <table class="table table-striped table-bordered">
            <thead>
            <tr class="bg-primary">
                <th class="col-md-2">
                    <b><?php echo lang('Name') ?></b>
                </th>
                <th class="col-md-2">
                    <b><?php echo lang('Description') ?></b>
                </th>
                <th class="col-md-2">
                    <b><?php echo lang('Publish') ?></b>
                </th>
                <th class="col-md-2">
                    <b><?php echo lang('Date Added') ?></b>
                </th>
                <th class="col-md-1 text-center"><?php echo lang('Type') ?></th>
                <th class="col-md-1 text-center"><?php echo lang('Classification') ?></th>

                <th class="col-md-2 text-center">
                    <b><?php echo lang('Action') ?></b>
                </th>
            </tr>
            </thead>
            <tbody>

            <?php
            /** @var Orm_Rb_Rubrics $rubric */
            if (!empty($rubrics)) {
                foreach ($rubrics as $rubric) {
                    ?>
                    <tr>
                        <td>
                            <b><?php echo htmlfilter($rubric->get_name()) ?></b>
                        </td>
                        <td>
                            <b><?php echo htmlfilter($rubric->get_desc()) ?></b>
                        </td>
                        <td>
                            <b><?php echo $rubric->get_start_date(true) ? htmlfilter($rubric->get_start_date()) . ' - ' . htmlfilter($rubric->get_end_date()) : lang('Not Published') ?></b>
                        </td>
                        <td>
                            <b><?php echo htmlfilter($rubric->get_date_added()) ?></b>
                        </td>

                        <td class="text-center">
                            <b><?php echo Orm_Rb_Rubrics::get_type($rubric->get_rubric_type()) ?></b>
                        </td>
                        <td class="text-center">
                            <b><?php echo lang($rubric->get_rubric_class()) ?></b>
                        </td>
                        <td class="text-center">
                            <?php if ($rubric->can_manage() && !$rubric->is_published()): ?>
                                <a href="/rubrics/add_edit/<?php echo (int)$rubric->get_id() ?>" data-toggle="ajaxModal"
                                   class="btn btn-block"><i
                                            class="btn-label-icon left fa fa-edit"></i><?php echo lang('Edit'); ?></a>
                                <a href="/rubrics/edit_scale/<?php echo (int)$rubric->get_id(); ?>"
                                   data-toggle="ajaxModal" class="btn btn-block"><i
                                            class="btn-label-icon left fa fa-info"></i><?php echo lang('Edit').' '. lang('Scale') ?>
                                </a>
                                <a href="/rubrics/manage/<?php echo (int)$rubric->get_id() ?>" class="btn btn-block"><i
                                            class="btn-label-icon left fa fa-gear"></i><?php echo lang('Manage'); ?></a>
                                <a href="/rubrics/publish/<?php echo (int)$rubric->get_id() ?>" data-toggle="ajaxModal"
                                   class="btn btn-block"><i
                                            class="btn-label-icon left fa fa-bell-o"></i><?php echo lang('Publish'); ?>
                                </a>
                                <a href="/rubrics/delete/<?php echo (int)$rubric->get_id() ?>"
                                   data-toggle="deleteAction" class="btn  btn-block"><i
                                            class="btn-label-icon left fa fa-trash-o"></i><?php echo lang('Delete'); ?>
                                </a>
                            <?php endif; ?>
                            <?php if ($rubric->can_manage() && $rubric->has_invitation() && !$rubric->has_answer() && !$rubric->is_end()): ?>
                                <a href="/rubrics/invitation/<?php echo (int)$rubric->get_id(); ?>"
                                   data-toggle="ajaxModal" class="btn btn-block"><span
                                            class="btn-label-icon left fa fa-user"></span><?php echo lang('Invitation') ?>
                                </a>
                                <?php if ($rubric->get_rubric_class() == Orm_Rb_Rubrics_Service::class): ?>

                                    <a href="/rubrics/invitation_manager/<?php echo (int)$rubric->get_id(); ?>"
                                       class="btn btn-block"><span
                                                class="btn-label-icon left fa fa-users"></span><?php echo lang('Manage').' '. lang('Invitation') ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($rubric->can_manage() && $rubric->is_published() && !$rubric->is_end() && !$rubric->has_answer()): ?>
                                <a href="/rubrics/unpublish/<?php echo (int)$rubric->get_id() ?>"
                                   data-toggle="deleteAction" class="btn btn-block"><i
                                            class="btn-label-icon left fa fa-bell-slash-o"></i><?php echo lang('Unpublished'); ?>
                                </a>
                            <?php endif; ?>
                            <a href="/rubrics/preview/<?php echo (int)$rubric->get_id(); ?>"
                               class="btn btn-block "><span
                                        class="btn-label-icon left fa fa-eye"></span><?php echo lang('Preview') ?></a>
                            <a href="/rubrics/report/<?php echo (int)$rubric->get_id(); ?>" class="btn btn-block "><span
                                        class="btn-label-icon left fa fa-eye"></span><?php echo lang('Report') ?></a>

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
