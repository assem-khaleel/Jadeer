<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Programs') ?>
        </div>
        <?php echo filter_block('/report/program_report/filter', '/report/program_report', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class, 'keyword']); ?>
    </div>
    <div id="ajax_block" >
        <?php $this->load->view('report/program_report/data_table'); ?>
    </div>
</div>
