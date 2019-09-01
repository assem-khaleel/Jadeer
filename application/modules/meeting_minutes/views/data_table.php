<?php
/** @var $meeting_obj Orm_Mm_Meeting[] */
/** @var $rooms Orm_Rm_Room_Management */

//$college_id = isset($fltr['college_id']) ? $fltr['college_id'] : 0;
//$program_id = isset($fltr['program_id']) ? $fltr['program_id'] : 0;
?>
<?php if (empty($meeting_obj)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Data to be displayed.'); ?>
        </div>
        <?php if(Orm_Mm_Meeting::check_if_can_add()){ ?>
            <a href="/meeting_minutes/add_edit" data-toggle="ajaxModal" class="btn  btn-block">
                <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add'); ?>
            </a>
        <?php } ?>

    </div>
<?php } else { ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Meeting Title'); ?></th>
            <th class="col-lg-2"><?php echo lang('Level'); ?></th>

            <?php if (Orm_Mm_Meeting::need_room()) { ?>
                <th class="col-lg-3"><?php echo lang('Location'); ?></th>
            <?php } ?>

            <th class="col-lg-2"><?php echo lang('Date'); ?></th>
            <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($meeting_obj as $meeting) { ?>
            <tr>
                <td>
                    <span><?php echo htmlfilter($meeting->get_name()); ?></span>
                    <br>

                        <?php if ($meeting->get_type_class() == 'Orm_Mm_Meeting_Committee') { ?>
                            <b><?php echo lang('Committee Name'); ?>:</b>
                            <?php echo $meeting->get_type_title() ? htmlfilter( $meeting->get_type_title()) : lang('No Committee selected'); ?>
                        <?php } ?>


                </td>
                <td>
                        <span><?php
                            echo htmlfilter($meeting->get_level(true));
                            if ($meeting->get_level()) {
                                echo " (" . htmlfilter($meeting->get_level_title()) . ")";
                            }
                            ?></span>
                </td>
                <?php if (Orm_Mm_Meeting::need_room()) { ?>
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
                <?php } ?>
                <td class="text-left">
                    <b><?php echo lang('Date'); ?>:</b>
                     <span><?php echo  htmlfilter($meeting->get_date())?></span><br>
                          <b><?php echo lang('From'); ?>:</b>
                    <span><?php echo  htmlfilter($meeting->get_start_time())?></span><br>
                          <b><?php echo lang('To'); ?>:</b>
                    <span><?php echo  htmlfilter($meeting->get_end_time())?></span>
                </td>
                <td class="td last_column_border text-center">

                    <?php if (Orm_Mm_Meeting::check_if_can_generate_report()) : ?>
                        <a class="btn btn-block"
                           href="/meeting_minutes/pdf/<?php echo (int)$meeting->get_id(); ?>"><span
                                class="btn-label-icon left fa fa-file-pdf-o"></span> <?php echo lang('pdf'); ?></a>
                    <?php endif ?>

                        <a class="btn btn-block" href="/meeting_minutes/details/<?php echo (int)$meeting->get_id(); ?>"><span
                                class="btn-label-icon left fa fa-gear"></span> <?php echo lang('Manage'); ?></a>
                    <?php if ($meeting->check_if_can_edit()) : ?>
                        <a class="btn btn-block" href="/meeting_minutes/add_edit/<?php echo (int)$meeting->get_id(); ?>"
                           data-toggle="ajaxModal"><span
                                class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                    <?php endif ?>
                    <?php if ($meeting->check_if_can_delete()) : ?>
                        <a class="btn btn-block" data-toggle="deleteAction"  message="<?php echo lang('Are you sure ?') ?>"
                           href="/meeting_minutes/delete/<?php echo (int)$meeting->get_id(); ?>"><span
                                class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                    <?php endif ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php echo $pager ?>
<?php } ?>