<?php
function draw_institution()
{
    ob_start();
    ?>
    <div class="col-md-4 m-b-1">
        <a class="btn btn-md btn-block" href="/assessment_loop/?fltr[institution]=1" type="reset" ><?php echo lang('Institution') ?></a>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Assessment Loop') ?>
        </div>
        <?php echo filter_block('/assessment_loop/filter', '/assessment_loop', [Orm_Campus::class,Orm_College::class, Orm_Program::class] ,'ajax_block', draw_institution()); ?>
    </div>

    <div id="ajax_block">
        <?php $this->load->view('data_table'); ?>
    </div>
</div>