<?php
if( Orm_Fp_Forms_Deadline::get_current_deadline()!=0){

$this->load->view('faculty_performance/settings/left_nav'); ?>

<div class="col-md-8 col-lg-8 m-t-4">
    <div class="well">
        <div class="alert alert-default">
            <?php echo lang('Please Select on Of the Forms type to show the forms') ?>
        </div>
    </div>
</div>
<?php }else{ ?>
    <div class="well">
        <div class="alert alert-default">
            <h3 class="m-a-0 text-center"><?php echo lang('There is no') . ' ' . lang('Current Deadline'); ?></h3>
        </div>
    </div>
<?php } ?>

