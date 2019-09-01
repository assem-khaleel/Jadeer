<?php
function draw_inst()
{
    ob_start();
    ?>
    <div class="col-md-3 m-b-1">
        <a class="btn btn-md btn-block" href="/committee_work/?fltr[institution]=1" type="reset" ><?php echo lang('Institution') ?></a>
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
            <?php echo lang('Committee') ?>
        </div>
        <?php if(Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){  ?>
            <?php echo filter_block('/committee_work/filter', '/committee_work', [Orm_Campus::class, Orm_College::class, Orm_Program::class, 'keyword'], 'ajax_block', draw_inst()); ?>

        <?php }else{ ?>
            <?php echo filter_block('/committee_work/filter', '/committee_work', [Orm_Campus::class, Orm_College::class, Orm_Program::class, 'keyword'], 'ajax_block'); ?>

        <?php } ?>

    </div>

    <div id="ajax_block">
        <?php $this->load->view('data_table'); ?>
    </div>
</div>