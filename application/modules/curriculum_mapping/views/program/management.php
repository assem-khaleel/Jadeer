<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Programs') ?>
        </div>
        <?php echo filter_block('/curriculum_mapping/program/filter', '/curriculum_mapping/program', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class, 'keyword']); ?>
    </div>
    <div id="ajax_block" >
        <?php $this->load->view('curriculum_mapping/program/data_table'); ?>
    </div>
</div>
