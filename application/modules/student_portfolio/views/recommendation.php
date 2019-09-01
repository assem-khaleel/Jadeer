<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/6/16
 * Time: 10:09 PM
 */
/** @var Orm_Stp_Recommendations[] $recommendations */
/** @var Orm_Stp_Complaints[] $complaints */
/** @var int $user_id */
?>
<div class="box p-a-1 clearfix">
    <div class="pull-left">
        <b><?php echo lang('Recommendations'); ?></b>
        <br />
        <?php
        if(count($recommendations)==0) {
            echo lang('There are no') . ' ' . lang('Recommendations');
        }
        ?>
    </div>
</div>
<ul class="list-group">

    <?php foreach ($recommendations as $key => $recommendation) { ?>
        <li class="list-group-item <?php echo $key % 2 ? '' : 'list-group-item-warning'?>">
            <div><label class="control-label"><?php echo lang('Title'); ?>:&nbsp; </label><?php echo htmlfilter($recommendation->get_title()); ?></div>
            <div><label class="control-label"><?php echo lang('Date'); ?>:&nbsp; </label><?php echo htmlfilter($recommendation->get_date()); ?></div>
            <div><label class="control-label"><?php echo lang('Attachment'); ?>:&nbsp; </label><a href="<?php echo $recommendation->get_attachement() ?>" class="btn btn-sm  pull-right"><i class="btn-label-icon left fa fa-download"></i><?php echo lang('View')?></a></div>
        </li>
    <?php } ?>
</ul>

<div id="complaint_container">
    <?php echo $complaints ?>
</div>