<?php
/** @var $recommendations Orm_Al_Recommendation[] */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption row">
            <div class="col-md-10">
                <h4 class='m-a-0'><?php echo lang('Recommendation'); ?></h4>
            </div>
        </div>
    </div>
    <?php if (empty($recommendations)) { ?>
        <div class="alert alert-primary">
            <div class="m-b-1">
                <?php echo lang('There are no') .' ' . lang('recommendation has Entered'); ?>
            </div>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-12"><?php echo lang('Recommendation'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($recommendations)) { ?>
                <?php foreach ($recommendations as $recommendation) {?>
                    <tr>
                        <td>
                            <span><?php echo htmlfilter($recommendation->get_text()); ?></span>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
