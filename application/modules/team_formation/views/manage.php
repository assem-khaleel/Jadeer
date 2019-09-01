<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 08/08/17
 * Time: 11:06 ص
 */
/* @var $clubs Orm_Tf_Club[] */
?>
<ul class="nav nav-tabs nav-justified">
    <li class=<?php echo $active_tab == "creator"?"active":''; ?>>
        <a href="#yourOwnClub" class="box-cell  p-x-1 p-y-2 text-white" data-toggle="tab">
            <i class="fa fa-users">&nbsp <?php echo lang('Your Clubs') ?></i></a></li>
    <li class=<?php echo $active_tab == "admin"?"active":''; ?>><a href="#adminClubs" class="box-cell  p-x-1 p-y-2 text-white " data-toggle="tab"><i
                    class="fa fa-users">&nbsp <?php echo lang('Admin Clubs') ?></i></a></li>
</ul>
<div class="tab-content tab-content-bordered">
    <div class="tab-pane fade in <?php echo $active_tab == "creator"?'active':''; ?>" id="yourOwnClub">
        <div class="table-primary">
            <div class="table-header">
                <div class="table-caption m-b-1">
                    <?php echo lang('Your Clubs') ?>
                </div>
                <?php echo filter_block('/team_formation/manage', '/team_formation/manage', ['keyword'], 'ajax_block'); ?>
            </div>
            <?php if (!empty($clubs)) { ?>
                <div class="table-responsive m-a-0">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-lg-3"><?php echo lang('Name'); ?></th>
                            <th class="col-lg-3"><?php echo lang('Posts privilege'); ?></th>
                            <th class="col-lg-3"><?php echo lang('Gender privilege'); ?></th>
                            <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($clubs as $club) { ?>
                            <tr>
                                <td>
                                    <span><?php echo $club->get_name(); ?></span>
                                </td>

                                <td>
                                    <span
                                        class="font-weight-bold"><?php echo lang($club->get_approval_post(true)) ?></span>
                                </td>
                                <td>
                                    <span
                                        class="font-weight-bold"><?php echo lang($club->get_member_gender(true)) ?></span>
                                </td>


                                <td class="td last_column_border text-center">
                                    <a class="btn btn-block"
                                       href="/team_formation/manage_members/<?php echo intval($club->get_id()); ?>" >
                                        <span class="btn-label-icon left fa fa-users"></span>
                                        <?php echo lang('Members'); ?></a>
                                    <?php if ($club->check_if_can_edit()) : ?>
                                        <a class="btn btn-block"
                                           href="/team_formation/add_edit/<?php echo intval($club->get_id()); ?>"><span
                                                class="btn-label-icon left fa fa-edit"></span>
                                            <?php echo lang('Edit'); ?></a>
                                    <?php endif ?>
                                    <?php if ($club->check_if_can_edit()) : ?>
                                        <a class="btn btn-block" data-toggle="deleteAction"
                                           href="/team_formation/delete_club/<?php echo intval($club->get_id()); ?>"
                                           message="<?php echo lang('Are you sure ?') ?>">
                                            <span class="btn-label-icon left fa fa-remove"></span>
                                            <?php echo lang('Delete'); ?></a>
                                    <?php endif ?>

                                </td>
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
                            <h3 class="m-a-0 text-center"><?php echo lang('You do not have any clubs'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>

            <input type="hidden" id = "active_tab" name = "active_tab" value="creator">

        </div>
    </div>
    <div class="tab-pane fade in <?php echo $active_tab == "admin"?"active":''; ?>" id="adminClubs">
        <div class="table-primary">
            <div class="table-header">
                <div class="table-caption m-b-1">
                    <?php echo lang('Admin Clubs') ?>
                </div>
                <?php echo filter_block('/team_formation/manage', '/team_formation/manage', ['keyword'], 'ajax_block'); ?>
            </div>
            <?php if (!empty($admin_clubs)) { ?>
                <div class="table-responsive m-a-0">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-lg-3"><?php echo lang('Name'); ?></th>
                            <th class="col-lg-3"><?php echo lang('Posts privilege'); ?></th>
                            <th class="col-lg-3"><?php echo lang('Gender privilege'); ?></th>
                            <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($admin_clubs as $member_in) { /** @var $member_in Orm_Tf_User_Club*/?>
                            <?php $clubs = Orm_Tf_Club::get_all(['id'=>$member_in->get_club_id()]);
                            foreach ($clubs as $club){
                            ?>
                            <tr>
                                <td>
                                    <span><?php echo $club->get_name(); ?></span>
                                </td>

                                <td>
                                    <span
                                            class="font-weight-bold"><?php echo lang($club->get_approval_post(true)) ?></span>
                                </td>
                                <td>
                                    <span
                                            class="font-weight-bold"><?php echo lang($club->get_member_gender(true)) ?></span>
                                </td>


                                <td class="td last_column_border text-center">
                                    <a class="btn btn-block"
                                       href="/team_formation/club_info/<?php echo intval($club->get_id()); ?>" >
                                        <span class="btn-label-icon left fa fa-view"></span>
                                        <?php echo lang('View').' ' .lang('Club'); ?></a>
                                    <?php if (Orm_Tf_Club::check_if_can_manage()): ?>
                                        <a class="btn btn-block"
                                           href="/team_formation/leave_club/<?php echo intval($member_in->get_id()); ?>"
                                           >
                                            <span class="btn-label-icon left fa fa-remove"></span>
                                            <?php echo lang('Leave'); ?></a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php } }?>
                        </tbody>
                    </table>
                </div>
                <?php if ($admin_pager) { ?>
                    <div class="table-footer">
                        <?php echo $admin_pager; ?>
                    </div>
                <?php } ?>
            <?php } else {?>
                <tr>
                    <td colspan="4">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('Your not admin on any clubs'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <input type="hidden" id = "active_tab" name = "active_tab" value="admin">

        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('form').eq(0).append($('<input type="hidden" id = "active_tab" name = "active_tab" value="creator">'))
        $('form').eq(1).append($('<input type="hidden" id = "active_tab" name = "active_tab" value="admin">'))
    });
</script>