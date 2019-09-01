<?php
/** @var $meeting_objs Orm_Mm_Meeting[] */
/** @var $rooms Orm_Rm_Room_Management */

//$college_id = isset($fltr['college_id']) ? $fltr['college_id'] : 0;
//$program_id = isset($fltr['program_id']) ? $fltr['program_id'] : 0;
?>
<div class="table-primary table-responsive">

    <?php if (empty($meeting_objs)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Meeting'); ?>

            </div>
            <?php if (Orm_User::get_logged_user()->has_role_type() == Orm_Role::ROLE_PROGRAM_ADMIN || Orm_User::get_logged_user()->has_role_type() == Orm_Role::ROLE_COLLEGE_ADMIN || Orm_User::get_logged_user()->has_role_type() == Orm_Role::ROLE_INSTITUTION_ADMIN) { ?>
                <?php echo lang('You Can Add New Meeting From'); ?>
                <a href="/meeting_minutes" class="font-weight-bold">
                  <?php echo lang('Meeting Minutes'); ?>
                </a>
            <?php } ?>
        </div>
    <?php }else{?>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-lg-3"><?php echo lang('Meeting Title'); ?></th>
                    <th class="col-lg-2"><?php echo lang('Level'); ?></th>
                    <th class="col-lg-3"><?php echo lang('Location'); ?></th>
                    <th class="col-lg-2"><?php echo lang('Date'); ?></th>
                    <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($meeting_objs as $meeting) {
                    ?>
                    <tr>
                        <?php /* @var $meeting Orm_Mm_Meeting */ ?>
                        <td>
                            <span><?php echo htmlfilter($meeting->get_name()); ?></span>
                        </td>
                        <td>
                        <span><?php
                            echo htmlfilter($meeting->get_level(true));
                            if ($meeting->get_level()) {
                                echo " (" . htmlfilter($meeting->get_level_title()) . ")";
                            }
                            ?></span>
                        </td>
                        <td>
                            <?php
                            $location = Orm_Rm_Room_Management::get_instance($meeting->get_room_id());
                            ?>
                            <b><?php echo lang('Room'); ?>:</b>
                            <span style="word-break: break-all" title="<?php echo   htmlfilter($location->get_name())?>">
                        <?php echo count_chars($location->get_name()) > 250 ? htmlfilter(substr($location->get_name(),0,50)).'...' : htmlfilter($location->get_name())?>
                         </span>
                            <br>
                            <b><?php echo lang('Room Number'); ?>:</b>
                            <?php echo htmlfilter($location->get_room_number()); ?>
                            <br>
                            <b><?php echo lang('College'); ?>:</b>
                            <?php echo htmlfilter($location->get_college_obj()->get_name()); ?>
                        </td>

                        <td class="text-left">
                            <b><?php echo lang('Date'); ?>:</b>
                            <span><?php echo  htmlfilter($meeting->get_date())?></span><br>
                            <b><?php echo lang('From'); ?>:</b>
                            <span><?php echo  htmlfilter($meeting->get_start_time())?></span><br>
                            <b><?php echo lang('To'); ?>:</b>
                            <span><?php echo  htmlfilter($meeting->get_end_time())?></span>
                        </td>
                        <td>

                            <a class="btn btn-block" href="/meeting_minutes/details/<?php echo (int)$meeting->get_id(); ?>">
                                <span class="btn-label-icon left fa fa-cogs"></span> <?php echo lang('Manage'); ?></a>

                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
