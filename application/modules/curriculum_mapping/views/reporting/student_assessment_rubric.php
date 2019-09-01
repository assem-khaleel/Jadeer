<div class="m-b-2">
    <?php echo filter_block('/curriculum_mapping/reporting/student_filter', '/curriculum_mapping/reporting/student_assessment_rubric', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class, 'keyword']); ?>
</div>
<div id="ajax_block">
    <?php $this->load->view('curriculum_mapping/reporting/student_data_table'); ?>
</div>