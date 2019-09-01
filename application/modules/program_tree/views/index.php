<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 18/12/16
 * Time: 10:25 ص
 */
?>

<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Programs') ?>
        </div>
        <div class="well m-a-0">
            <?php echo filter_block('/program_tree/filter', '/program_tree', [Orm_College::class,Orm_Department::class,Orm_Program::class, 'keyword']); ?>
        </div>
    </div>

    <div id="ajax_block">
        <?php $this->load->view('program_tree/data_table'); ?>
    </div>
</div>

