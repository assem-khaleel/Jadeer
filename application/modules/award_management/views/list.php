<?php
function draw_inst()
{
    ob_start();
    ?>
    <div class="col-md-3 m-b-1">
        <a class="btn btn-md btn-block" href="/award_management/?fltr[institution]=1" type="reset" ><?php echo lang('Institution') ?></a>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
?>

    <div class="table-primary table-responsive">

        <div class="table-header">
            <div class="table-caption m-b-1">
                <?php echo lang('Award Management') ?>
            </div>
            <?php echo filter_block('/award_management/filter', '/award_management', [Orm_Campus::class, Orm_College::class, Orm_Program::class,  'keyword'],'ajax_block', draw_inst()); ?>
        </div>

        <div id="ajax_block">
            <?php $this->load->view('data_table'); ?>
        </div>

    </div>

