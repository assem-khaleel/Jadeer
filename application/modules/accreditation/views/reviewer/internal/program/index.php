<div class="table-primary">
    <div class="table-header">
        <?php echo filter_block('/accreditation/reviewer_internal/filter_program', '/accreditation/reviewer_internal/program', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class, 'keyword']); ?>
    </div>
    <div id="ajax_block" >
        <?php $this->load->view('/reviewer/internal/program/data_table'); ?>
    </div>
</div>