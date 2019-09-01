<?php
/* @var $clubs Orm_Tf_Club[] */
/**@var $club_info Orm_Tf_Club */
/**@var $member Orm_Tf_User_Club */
?>
<style>
    .userImage {
        border-radius: 50%;
        height: 50px;
        width: 50px;
    }
</style>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo $club_info->get_name(). ' ' . lang('Members') ; ?>
        </div>
        <?php echo filter_block('/team_formation/manage_members/'.$club_info->get_id().'', '/team_formation/manage_members/'.$club_info->get_id().'', ['keyword'], 'ajax_block'); ?>
    </div>
    <?php if (!empty($members)) { ?>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-lg-3"><?php echo lang('Member Name'); ?></th>
                    <th class="col-lg-3"><?php echo lang('Member Type'); ?></th>
            <?php if(Orm_Tf_Club::check_if_can_manage()): ?>
                    <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
            <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($members as $member) { ?>
                    <?php $member_info = Orm_User::get_instance($member->get_user_id()); ?>
                    <tr>
                        <td>
                            <img class = "userImage" src="<?php echo $member_info->get_avatar(); ?>">
                            <span style="text-align: center;"><?php echo $member_info->get_full_name(); ?></span>
                            <br>
                            <?php if($member->get_is_admin() == Orm_Tf_User_Club::USER_ADMIN): ?>
                            <span class="label label-primary"><?php echo lang('Admin')?></span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <span
                                class="font-weight-bold"><?php echo lang($member_info->get_class_type())?></span>
                        </td>
                        <?php if(Orm_Tf_Club::check_if_can_manage()): ?>
                        <td class="td last_column_border text-center">
                            <a class="btn btn-block"
                               href="/team_formation/remove_member/<?php echo intval($member->get_id()); ?>" data-toggle="deleteAction" >
                                <span class="btn-label-icon left fa fa-remove"></span>
                                <?php echo lang('Remove Member'); ?></a>
                           <?php if($member->get_is_admin() == Orm_Tf_User_Club::USER_NOT_ADMIN): ?>
                            <a class="btn btn-block"
                               href="/team_formation/set_as_admin/<?php echo intval($member->get_id()); ?>/<?php echo intval($club_info->get_id()); ?>">
                                <span class="btn-label-icon left fa fa-user-plus"></span>
                                <?php echo lang('Set Admin'); ?></a>
                           <?php else: ?>

                               <a class="btn btn-block"
                                  href="/team_formation/un_set_as_admin/<?php echo intval($member->get_id()); ?>/<?php echo intval($club_info->get_id()); ?>">
                                   <span class="btn-label-icon left fa fa-user-times"></span>
                                   <?php echo lang('Unset Admin'); ?></a>
                           <?php endif; ?>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if ($pager) { ?>
            <div class="table-footer">
                <?php echo $pager ?>
            </div>
        <?php } ?>
    <?php } else {?>
        <tr>
            <td colspan="4">
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Members in this club'); ?></h3>
                </div>
            </td>
        </tr>
    <?php } ?>


</div>
