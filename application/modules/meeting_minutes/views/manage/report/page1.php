<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 3/6/17
 * Time: 3:36 PM
 *
 * @var $meeting Orm_Mm_Meeting
 *
 */
?>
<h2 class="m-t-1"><?php echo lang('Information') ?></h2>
<div class="row">
    <label class="col-sm-2"><?php echo lang('Meeting Subject') ?>: </label>
    <div class="col-sm-10"><?php echo htmlfilter($meeting->get_name()) ?></div>
</div>

<div class="row">
    <label class="col-sm-2"><?php echo lang('Date') ?></label>
    <div class="col-sm-4"><?php echo htmlfilter($meeting->get_date()) ?></div>
    <label class="col-sm-2"><?php echo lang('time') ?></label>
    <div class="col-sm-4"><?php echo htmlfilter($meeting->get_start_time()) ?></div>
</div>
<div class="row">
    <label class="col-sm-2"><?php echo lang('Facilitator') ?>: </label>
    <div class="col-sm-4"><?php echo htmlfilter($meeting->get_facilitator_id(true)->get_full_name()) ?></div>
    <label class="col-sm-2"><?php echo lang('Level') ?></label>
    <div class="col-sm-4"><?php
        echo $meeting->get_level(true);
        if($meeting->get_level()){
            echo " (".htmlfilter($meeting->get_level_title()).")";
        }
    ?></div>
</div>
<div class="row">
    <label class="col-sm-12"><?php echo lang('Objectives') ?></label>
    <div class="col-sm-11 col-sm-offset-1"><?php echo xssfilter($meeting->get_objective())?: '-' ?></div>
</div>

<div class="row">
    <?php if (Orm_Mm_Meeting::need_room()) { ?>
        <label class="col-sm-2"><?php echo lang('Location') ?></label>
        <div class="col-sm-4">
            <?php
            $location = Orm_Rm_Room_Management::get_instance($meeting->get_room_id());
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
    <?php } ?>

    <label class="col-sm-2"><?php echo lang('Type') ?></label>
    <div class="col-sm-4"><?php echo htmlfilter($meeting->get_type_class()) ?></div>
</div>