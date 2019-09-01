<?php
/* @var $departments Orm_Department */
/* @var $colleges Orm_College */
?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/department/filter', '/department', [Orm_Campus::class, Orm_College::class, 'keyword']) ?>
        </div>

        <div id="ajax_block" >
            <?php $this->load->view('department/data_table') ?>
        </div>
    </div>
</div>
