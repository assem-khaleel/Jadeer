<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 3/6/17
 * Time: 3:36 PM
 *
 * @var Orm_Mm_Meeting $meeting
 *
 */
?>
<div class="well">
    <?php if ($meeting->get_meeting_ref_id(true)->get_id()): ?>

        <div class="row">
            <div class="col-sm-10">
                <h3 class="m-t-1"><?php echo lang('Meeting Reference') ?></h3>
            </div>
            <?php if ($meeting->check_if_can_edit()) { ?>
                <div class="col-sm-2">
                    <a href="/meeting_minutes/reference_edit/<?php echo (int)$meeting->get_id() ?>"
                       data-toggle="ajaxModal" class="btn btn-primary btn-block">
                        <span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="row list-group-demo">
            <div class="col-sm-12">
                <ul class="list-group form-horizontal">
                    <li class="list-group-item">
                        <div class="row">
                            <label class="col-sm-2"><?php echo lang('Meeting Subject') ?>: </label>
                            <div
                                class="col-sm-10"><?php echo htmlfilter($meeting->get_meeting_ref_id(true)->get_name()) ?></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <label class="col-sm-2"><?php echo lang('Facilitator') ?>: </label>
                            <div
                                class="col-sm-10"><?php echo htmlfilter($meeting->get_meeting_ref_id(true)->get_facilitator_id(true)->get_full_name()) ?></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <label class="col-sm-2"><?php echo lang('Type') ?></label>
                            <div
                                class="col-sm-10"><?php echo lang(htmlfilter(Orm_Mm_Meeting_Individual::get_type($meeting->get_meeting_ref_id(true)->get_type_class()))) ?></div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2"><?php echo lang('Level') ?></label>
                            <div class="col-sm-10"><?php
                                echo htmlfilter($meeting->get_meeting_ref_id(true)->get_level(true));
                                if ($meeting->get_level()) {
                                    echo '(' . htmlfilter($meeting->get_meeting_ref_id(true)->get_level_title()) . ')';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2"><?php echo lang('Date') ?></label>
                            <div
                                class="col-sm-10"><?php echo htmlfilter($meeting->get_meeting_ref_id(true)->get_date()) . ' &nbsp; ' . htmlfilter($meeting->get_meeting_ref_id(true)->get_start_time()) ?></div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2"><?php echo lang('Location') ?></label>
                            <div class="col-sm-10">
                                <?php
                                $location = Orm_Rm_Room_Management::get_instance($meeting->get_meeting_ref_id(true)->get_room_id());
                                ?>
                                <b><?php echo lang('Room'); ?>:</b>
                                <?php echo htmlfilter($location->get_name()); ?>
                                <br>
                                <b><?php echo lang('Room Number'); ?>:</b>
                                <?php echo htmlfilter($location->get_room_number()); ?>
                                <br>
                                <b><?php echo lang('College'); ?>:</b>
                                <?php echo htmlfilter($location->get_college_obj()->get_name()); ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-sm-10">
                <h3 class="m-t-1"><?php echo lang('No Meeting Reference') ?></h3>
            </div>
            <div class="col-sm-2">
                <a href="/meeting_minutes/reference_edit/<?php echo (int)$meeting->get_id() ?>" data-toggle="ajaxModal"
                   class="btn btn-primary btn-block">
                    <span class="btn-label-icon left fa fa-pencil-square-o"></span> <?php echo lang('Add'); ?>
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>
