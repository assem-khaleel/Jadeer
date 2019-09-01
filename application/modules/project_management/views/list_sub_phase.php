<?php
/**
 * Created by PhpStorm.
 * User: assem al jimzawi
 * Date: 12/08/18
 * Time: 11:43 ص
 */

function draw_inst()
{
    ob_start();
    ?>
<!--    <div class="col-md-3 m-b-1">-->
<!--        <a class="btn btn-md btn-block" href="/project_management/assigned_sub_phases/?fltr[sub-project]=1" type="reset" >--><?php //echo lang('Sub Phases') ?><!--</a>-->
<!--    </div>-->
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Search Sub Phases') ?>
        </div>
        <?php echo filter_block('/project_management/filtersubPhase', '/project_management/assigned_sub_phases', [Orm_Pm_Sub_Phase::class, 'keyword'], 'ajax_block', draw_inst()); ?>
    </div>

    <div id="ajax_block">
        <?php $this->load->view('assigned_to_me_phases'); ?>
    </div>
</div>