<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 11/9/17
 * Time: 3:05 PM
 */
?>
<?php
function draw_inst($fltr)
{
    ob_start();
    ?>
<!--    --><?php //if(Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){?>
    <div class="col-md-3 m-b-1">
        <a class="btn btn-md btn-block" href="/advisory/meeting/?fltr[institution]=1" type="reset" ><?php echo lang('Institution') ?></a>
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
            <?php echo lang('Meeting Minutes') ?>
        </div>

        <?php echo filter_block('/meeting_minutes/filter', '/advisory/meeting', [Orm_Campus::class, Orm_College::class, Orm_Program::class, 'keyword'], 'ajax_block', draw_inst($fltr)); ?>
    </div>

    <div id="ajax_block">
        <?php $this->load->view('manage/meeting/data_table'); ?>
    </div>
</div>
