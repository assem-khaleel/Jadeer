<?php
/**
 * Created by PhpStorm.
 * User: assem al jimzawi
 * Date: 09/08/18
 * Time: 03:18 م
 */

function draw_inst()
{
  ob_start();
   ?>
<!--   <div class="col-md-3 m-b-1">-->
<!--       <a class="btn btn-md btn-block" href="/project_management/customized_projects/?fltr[project]=1" type="reset" >--><?php //echo lang('Projects') ?><!--</a>-->
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
            <?php echo lang('Customized Projects') ?>
        </div>
        <?php echo filter_block('/project_management/filterCustomized', '/project_management/customized_projects', [Orm_Pm_Project::class, 'keyword'], 'ajax_block', draw_inst()); ?>

    </div>

    <div id="ajax_block">
        <?php $this->load->view('home'); ?>
    </div>
</div>