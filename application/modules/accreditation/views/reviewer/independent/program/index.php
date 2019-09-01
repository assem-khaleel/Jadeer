<div class="table-primary">
    <div class="table-header">
        <?php echo filter_block('/accreditation/Reviewer_independent/filter_program', '/accreditation/Reviewer_independent/program', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class, 'keyword']); ?>
    </div>
    <div id="ajax_block" >
        <?php $this->load->view('/reviewer/independent/program/data_table'); ?>
    </div>
</div>