<?php

/* @var $courses Orm_Course */

?>

<div class="col-md-12 col-lg-12">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/gradebook/filter', '/gradebook', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class,'keyword'],'ajax_block'); ?>
        </div>
        <div id="ajax_block">
            <?php $this->load->view('gradebook/data_table'); ?>
        </div>
      
    </div>
</div>