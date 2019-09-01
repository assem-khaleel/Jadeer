<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/24/17
 * Time: 3:22 PM
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Winner Management') ?>
        </div>
<!--        --><?php //if(Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){  ?>
            <?php echo filter_block('/award_management/filterWinner', '/award_management/winner', [ 'keyword'], 'ajax_block'); ?>

<!--        --><?php //}?>

    </div>

    <div id="ajax_block">
        <?php $this->load->view('winner_data_table'); ?>
    </div>
</div>