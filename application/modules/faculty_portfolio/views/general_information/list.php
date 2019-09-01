<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/6/16
 * Time: 2:54 PM
 *
 * @var $general_info Orm_Fp_General_Information
 */
?>

<div class="box p-a-1 clearfix">
    <div class="pull-left">
        <b><?php echo lang('General Info')?></b>
    </div>
    <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="pull-right">
            <a href="/faculty_portfolio/general_info_manage" data-toggle="ajaxModal" class="btn btn-sm"><i class="btn-label-icon left fa fa-edit"></i><?php echo lang('Edit')?></a>
        </div>
    <?php } ?>
</div>

<ul class="list-group">
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Mobile No.')?> : </label>
        <?php echo htmlfilter($general_info->get_mobile_no()) ?: '-'; ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Personal Email')?> : </label>
        <?php echo htmlfilter($general_info->get_personal_email()) ?: '-'; ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Contract Date')?> : </label>
        <?php echo $general_info->get_contract_date() == '0000-00-00'? '-' : $general_info->get_contract_date(); ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Contract Type')?> : </label>
        <?php echo $general_info->get_contract_type(true) ?: '-'; ?>
    </li>
    <?php if($general_info->get_contract_attachment() && file_exists(FCPATH.$general_info->get_contract_attachment())) { ?>
        <li class="list-group-item">
            <label class="control-label"><?php echo lang('Contract Attachment')?> : </label>
            <a href="<?php echo htmlfilter($general_info->get_contract_attachment()) ?>" target="_blank" class=" col-md-2  btn  pull-right"><i class="btn-label-icon left fa fa-download"></i><?php echo lang('Download')?></a>
        </li>
    <?php } ?>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('CV')?> : </label>
        <?php echo $general_info->get_cv_text()?
            character_limiter(strip_tags($general_info->get_cv_text()), 100, " ...") . " <a href='".base_url('/faculty_portfolio/general_info_show_cv/'.$general_info->get_id())."' data-toggle='ajaxModal'>".lang('Read More').'</a>' :
            '-';
        ?>
    </li>
    <?php if($general_info->get_cv_attachment() && file_exists(FCPATH.$general_info->get_cv_attachment())) { ?>
        <li class="list-group-item">
            <label class="control-label"><?php echo lang('CV Attachment')?> : </label>
            <a href="<?php echo htmlfilter($general_info->get_cv_attachment()) ?>" target="_blank"  class=" col-md-2 btn  pull-right"><i class="btn-label-icon left fa fa-download"></i><?php echo lang('Download')?></a>
        </li>
    <?php } ?>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Website')?> : </label>
        <?php echo htmlfilter($general_info->get_website()); ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Twitter')?> : </label>
        <?php if ($general_info->get_twitter()) { ?>
            <a href="<?php echo htmlfilter($general_info->get_twitter()) ?>" target="_blank"  class="col-md-2 btn btn-sm pull-right"><i class="btn-label-icon left fa fa-twitter"></i><?php echo lang('Twitter')?></a>
        <?php } else { ?>
            <?php echo lang('N/A') ?>
        <?php } ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Facebook')?> : </label>
        <?php if ($general_info->get_facebook()) { ?>
            <a href="<?php echo htmlfilter($general_info->get_facebook()) ?>" target="_blank"  class="col-md-2 btn btn-sm btn-facebook  pull-right"><i class="btn-label-icon left fa fa-facebook"></i><?php echo lang('Facebook')?></a>
        <?php } else { ?>
            <?php echo lang('N/A') ?>
        <?php } ?>
    </li>
    <li class="list-group-item">
        <label class="control-label"><?php echo lang('Linkedin')?> : </label>
        <?php if ($general_info->get_linkedin()) { ?>
            <a href="<?php echo htmlfilter($general_info->get_linkedin()) ?>" target="_blank"  class="col-md-2 btn btn-sm pull-right"><i class="btn-label-icon left fa fa-linkedin"></i><?php echo lang('Linkedin')?></a>
        <?php } else { ?>
            <?php echo lang('N/A') ?>
        <?php } ?>
    </li>
</ul>

<div id="language_container">
<?php echo $languages ?>
</div>

<div id="skill_container">
<?php echo $skills ?>
</div>

<div id="training_container">
<?php echo $trainings ?>
</div>

<div id="experience_container">
<?php echo $experiences ?>
</div>
