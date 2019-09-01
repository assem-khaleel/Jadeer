<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 09:45 ص
 */
/* @var $sections Orm_Course_Section */
?>

<div class="col-md-12 col-lg-12">
    <div class="table-primary">
        <div class="table-header">
            <h4 class="m-t-0">
                <?php echo lang('Course') . ' : ' . Orm_Course::get_instance($course_id)->get_name(); ?>
            </h4>
            <?php echo filter_block('/gradebook/view_sections/filter/'.$course_id, '/gradebook/view_sections/'.$course_id, ['keyword'],'ajax_block'); ?>
        </div>
        
        <?php $this->load->view('gradebook/section_datatable'); ?>
    </div>
</div>