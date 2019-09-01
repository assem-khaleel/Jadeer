<?php
/* @var $program Orm_Program */
/** @var Orm_Program_Plan[] $plans */
?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php
            $extra_html = form_hidden('program_id', $program->get_id());
            echo filter_block('/program_plan/filter?program_id=' . $program->get_id(), '/program_plan?program_id=' . $program->get_id(), ['keyword'], 'ajax_block', $extra_html);
            ?>
        </div>
        <div id="ajax_block" >
            <?php $this->load->view('program_plan/data_table'); ?>
        </div>
    </div>
</div>
