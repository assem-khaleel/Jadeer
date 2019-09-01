<?php
/** @var $meeting Orm_Mm_Meeting */
?>
<h2 class="m-t-1"><?php echo lang('Meeting Minutes') ?></h2>

<div class="row">
    <div class="col-sm-12"><?php echo xssfilter($meeting->get_meeting_minutes()) ?></div>
</div>