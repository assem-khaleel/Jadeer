<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 11/7/17
 * Time: 9:52 AM
 */
?>
<?php echo filter_block('/advisory/filter_report', '/advisory/report', [Orm_Campus::class, Orm_College::class, Orm_Program::class], 'ajax_block'); ?>



    <div id="ajax_block">
        <?php $this->load->view('report'); ?>
    </div>

