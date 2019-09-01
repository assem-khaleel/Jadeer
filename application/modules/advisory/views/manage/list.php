<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 11/7/17
 * Time: 9:52 AM
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Advisory') ?>
        </div>
        <?php echo filter_block('/advisory/filter_faculty', '/advisory/manage', [Orm_Campus::class, Orm_College::class, Orm_Program::class], 'ajax_block'); ?>
    </div>

    <div id="ajax_block">
        <?php $this->load->view('data_table'); ?>
    </div>
</div>
