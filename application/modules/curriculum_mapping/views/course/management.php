<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Courses') ?>
        </div>
            <?php echo filter_block('/curriculum_mapping/course/filter', '/curriculum_mapping/course', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class,'keyword']); ?>
    </div>
    <div id="ajax_block" >
        <?php $this->load->view('curriculum_mapping/course/data_table'); ?>
    </div>
</div>
