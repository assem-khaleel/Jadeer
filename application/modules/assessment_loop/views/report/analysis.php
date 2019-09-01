<?php
/** @var $analysis Orm_Al_Analysis */
?>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel  panel-primary">
            <div class="panel-heading">
                <h4 class='m-a-0'><?php echo lang('Analysis'); ?></h4>
            </div>
            <div class="panel-body">
                <?php if ($analysis->get_id()) { ?>

                <span><?php echo xssfilter($analysis->get_text()); ?></span>
                <?php } else { ?>
                <div class="m-b-1">
                    <?php echo lang('There are no') . ' ' . lang('analysis has Entered'); ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>