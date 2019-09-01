

<div class="m-b-1">

    <?php echo filter_block('/skills_transcript/filter', '/skills_transcript', [Orm_Campus::class, Orm_College::class, Orm_Program::class], 'ajax_block'); ?>
</div>

<div id="ajax_block">
    <?php $this->load->view('data_table'); ?>
</div>
