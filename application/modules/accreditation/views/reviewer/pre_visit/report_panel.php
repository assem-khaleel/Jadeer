<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 17/04/17
 * Time: 09:42 م
 */
?>
<div class="well well-sm clearfix">
    <a class="btn btn-xs btn-success btn-outline btn-outline-colorless pull-right" href="/accreditation/reviewer_pre_visit/report/<?php echo htmlfilter($type); ?>/<?php echo intval($type_id); ?>">
        <span class="btn-label-icon left"><i class="fa fa-flag"></i></span> <?php echo lang('Report'); ?>
    </a>
    <a class="btn btn-xs btn-success btn-outline btn-outline-colorless pull-right m-x-1" href="/accreditation/reviewer_pre_visit/report/<?php echo htmlfilter($type); ?>/<?php echo intval($type_id); ?>/1" >
        <span class="btn-label-icon left"><i class="fa fa-flag"></i></span> <?php echo lang('Report Details'); ?>
    </a>
</div>