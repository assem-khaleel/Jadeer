<?php /* @var $members Orm_Tm_Members[] */ ?>
<?php /* @var $training Orm_Tm_Training */ ?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Certified Members') ?>
        </div>

        <?php
        $extra_html = form_hidden('training_id', $training->get_id());
        echo filter_block('/training_management/member_list/' . $training->get_id(), '/training_management/member_list/' . $training->get_id(), ['keyword'], 'ajax_block', $extra_html);
        ?>

    </div>
    <?php if (empty($members)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Certified Members'); ?>
            </div>
            <a class="btn btn-block" data-toggle="ajaxModal"
               href="/training_management/add_edit_member/<?php echo intval($training->get_id()) ?>"><span
                        class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add') . ' ' . lang('Certified Member'); ?>
            </a>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-9"><?php echo lang('Name'); ?></th>
                <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($members as $member) { ?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter($member->get_user_obj()->get_full_name()) ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                        <?php if ($member->check_if_can_edit()) { ?>
                            <a class="btn btn-block" data-toggle="ajaxModal"
                               href="/training_management/add_edit_member/"><span
                                        class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <?php } ?>
                        <?php if ($member->check_if_can_delete()) { ?>
                            <a class="btn btn-block" message="<?php echo lang('Are you sure ?') ?>"
                               data-toggle="deleteAction"
                               href="/training_management/delete_memeber/<?php echo intval($training->get_id()) ?>/<?php echo intval($member->get_id()) ?>"><span
                                        class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
        <?php echo $pager ?>
    <?php } ?>
</div>
