<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/student_status/filter', '/student_status', ['keyword']); ?>
        </div>

        <div id="ajax_block">
            <?php $this->load->view('student_status/data_table'); ?>
        </div>
    </div>
</div>
