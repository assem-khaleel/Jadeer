<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/major/filter', '/major', [Orm_Campus::class, Orm_College::class, Orm_Program::class, 'keyword']); ?>
        </div>
        <div id="ajax_block">
            <?php $this->load->view('major/data_table'); ?>
        </div>
    </div>
</div>
