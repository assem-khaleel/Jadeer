<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/6/16
 * Time: 10:09 PM
 */
/** @var Orm_Stp_Personal $personal */
/** @var int $user_id */
?>
<div class="box p-a-1 clearfix">
    <div class="pull-left">
        <b><?php echo lang('Personal'); ?></b>
    </div>
    <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="pull-right">
            <a href="/student_portfolio/personal_manage" data-toggle="ajaxModal" class="btn btn-sm "><i class="btn-label-icon left fa fa-cog"></i><?php echo lang('Manage')?></a>
        </div>
    <?php } ?>
</div>
<ul class="list-group">
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Resume'); ?>: </label>
        <?php if($personal->get_resume() && file_exists(FCPATH . trim($personal->get_resume(), '/'))) { ?>
        <a href="<?php echo base_url('/student_portfolio/personal_download_resume/'.$user_id) ?>" class="btn btn-sm  pull-right"><i class="btn-label-icon left fa fa-download"></i><?php echo lang('Download'); ?></a>
        <?php } else { ?>
            <?php echo '-'; ?>
        <?php } ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Goals'); ?>: </label>
        <?php echo xssfilter($personal->get_personal_goals()) ? xssfilter($personal->get_personal_goals()) : '-'; ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Hobbies'); ?>: </label>
        <?php echo xssfilter($personal->get_hobbies()) ? xssfilter($personal->get_hobbies()) : '-'; ?>
    </li>
</ul>