<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/25/17
 * Time: 1:42 PM
 */

?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Candidate Management') ?>
        </div>
            <?php echo filter_block('/award_management/filterWinner', '/award_management/candidate', ['keyword'], 'ajax_block'); ?>


    </div>

    <div id="ajax_block">
        <?php $this->load->view('candidate_data_table'); ?>
    </div>
</div>