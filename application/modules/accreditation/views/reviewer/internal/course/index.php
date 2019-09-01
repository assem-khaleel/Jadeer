<div class="table-primary">
    <div class="table-header">
        <?php echo filter_block('/accreditation/reviewer_internal/filter_course', '/accreditation/reviewer_internal/course', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class, 'keyword']); ?>
    </div>
    <div id="ajax_block" >
        <?php $this->load->view('/reviewer/internal/course/data_table'); ?>
    </div>
</div>