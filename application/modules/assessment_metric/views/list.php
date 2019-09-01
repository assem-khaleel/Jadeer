
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Assessment Metric') ?>
        </div>
        <?php echo filter_block('/assessment_metric/filter', '/assessment_metric', [Orm_Campus::class,Orm_College::class, Orm_Program::class] ,'ajax_block'); ?>
    </div>

    <div id="ajax_block">
        <?php $this->load->view('data_table'); ?>
    </div>
</div>