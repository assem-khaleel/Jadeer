
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Industrial Skills') ?>
        </div>
        <?php echo filter_block('/industrial_skills/filter', '/industrial_skills', [Orm_Campus::class, Orm_College::class, Orm_Program::class, 'keyword'], 'ajax_block'); ?>
    </div>

    <div id="ajax_block">
        <?php $this->load->view('data_table'); ?>
    </div>
</div>
