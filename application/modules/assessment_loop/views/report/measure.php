<?php
/** @var $measures Orm_Al_Measure[] */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption row">
            <div class="col-md-10">
                <h4 class='m-a-0'><?php echo lang('Measure'); ?></h4>
            </div>
        </div>
    </div>
    <?php if (empty($measures)) { ?>
        <div class="alert alert-primary">
            <div class="m-b-1">
                <?php echo lang('There are no') .' ' . lang('Measure has Entered'); ?>
            </div>
        </div>
    <?php }else{ ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-12"><?php echo lang('Measure'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($measures)) { ?>
            <?php foreach ($measures as $measure) { ?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter($measure->get_text()); ?></span>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>