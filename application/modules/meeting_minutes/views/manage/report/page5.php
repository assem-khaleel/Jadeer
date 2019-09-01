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
<?php if($meeting->get_meeting_ref_id(true)->get_id()): ?>
<hr />

<h2 class="m-t-1"><?php echo lang('Reference') ?></h2>

<div class="row">
    <label class="col-sm-2"><?php echo lang('Meeting Subject') ?>: </label>
    <div class="col-sm-10"><?php echo htmlfilter($meeting->get_meeting_ref_id(true)->get_name()) ?></div>
</div>

<div class="row">
    <label class="col-sm-2"><?php echo lang('Date') ?></label>
    <div class="col-sm-4"><?php echo htmlfilter($meeting->get_meeting_ref_id(true)->get_date()) ?></div>
    <label class="col-sm-2"><?php echo lang('Time') ?></label>
    <div class="col-sm-4"><?php echo htmlfilter($meeting->get_meeting_ref_id(true)->get_start_time()) ?></div>
</div>
<div class="row">
    <label class="col-sm-2"><?php echo lang('Facilitator') ?>: </label>
    <div class="col-sm-4"><?php echo htmlfilter($meeting->get_meeting_ref_id(true)->get_facilitator_id(true)->get_full_name()) ?></div>
    <label class="col-sm-2"><?php echo lang('Level') ?></label>
    <div class="col-sm-4"><?php
        echo $meeting->get_meeting_ref_id(true)->get_level(true);
        if($meeting->get_meeting_ref_id(true)->get_level()){
            echo "(".htmlfilter($meeting->get_meeting_ref_id(true)->get_level_title()).")";
        }
    ?></div>
</div>
<?php endif; ?>