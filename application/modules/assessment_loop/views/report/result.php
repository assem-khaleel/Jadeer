<?php
/** @var $results Orm_Al_Result[] */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption row">
            <div class="col-md-10">
                <h4 class='m-a-0'><?php echo lang('Result'); ?></h4>
            </div>
        </div>
    </div>
    <?php if (empty($results)) { ?>
        <div class="alert alert-primary">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Result has Entered'); ?>
            </div>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-12"><?php echo lang('Result'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($results)) { ?>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td>
                            <span><?php echo htmlfilter($result->get_text()); ?></span>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>
