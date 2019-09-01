<?php
/* @var $courses Orm_Course[] */;
?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/course/filter', '/course', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Degree::class, 'keyword']); ?>
        </div>
        <div id="ajax_block" >
            <?php $this->load->view('course/data_table'); ?>
        </div>
    </div>
</div>
