<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Room Management') ?>
        </div>
        <?php echo filter_block('/room_management/filter', '/room_management', [Orm_Campus::class,Orm_College::class,'keyword'],'ajax_block'); ?>
    </div>

      <div id="ajax_block">
        <?php $this->load->view('data_table'); ?>
    </div>
</div>