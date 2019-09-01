<?php
/** @var Orm_Fp_Forms_Type $form_types*/
/* @var $deprtments Orm_Department */


?>
<?php if( Orm_Fp_Forms_Deadline::get_current_deadline()!=0){?>

    <div class="col-md-12 col-lg-12 m-t-4">
        <?php echo filter_block('/faculty_performance/faculty_report/department_filter', '/faculty_performance/faculty_report/department_report',  [Orm_Campus::class, Orm_College::class, 'keyword'], 'ajax_block'); ?>

    </div>
    <div id="ajax_block">
        <?php $this->load->view('report/department_data_table'); ?>
    </div>




<?php }else{ ?>
    <div class="well">
        <div class="alert alert-default">
            <h3 class="m-a-0 text-center"><?php echo lang('There is no') . ' ' . lang('Current Deadline'); ?></h3>
        </div>
    </div>
<?php } ?>

