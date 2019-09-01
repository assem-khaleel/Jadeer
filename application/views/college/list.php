<?php
/* @var $colleges Orm_College */;
?>
<div class="col-md-9 col-lg-10">

    <div class="table-primary">

        <div class="table-header">
            <?php echo filter_block('/college/filter', '/college', [Orm_Campus::class, 'keyword']); ?>
        </div>

        <div id="ajax_block">
            <?php $this->load->view('college/data_table'); ?>
        </div>

    </div>

</div>

