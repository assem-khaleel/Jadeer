<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/17/17
 * Time: 11:46 AM
 */

/**
 * @var $creative_works Orm_Fp_Creative_Work[]
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Creative Works') ?></span>
        <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="panel-heading-controls ">
            <a style="" class="btn btn-sm" href="/faculty_portfolio/work/creative_work_manage" data-toggle="ajaxModal"><span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New') ?></a>
        </div>
        <?php } ?>
    </div>
    <?php if(count($creative_works)): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Name') ?></th>
            <th class="col-lg-2"><?php echo lang('Owner Name') ?></th>
            <th class="col-lg-2"><?php echo lang('Dissemination Type') ?></th>
            <th class="col-lg-2"><?php echo lang('Attachment') ?></th>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <th class="col-lg-2 text-center"><?php echo lang('Actions') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($creative_works as $creative_work) : ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($creative_work->get_name()) ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($creative_work->get_owner_name()) ?></span>
            </td>
            <td>
                <span><?php echo $creative_work->get_dissemination_type(true) ?></span>
            </td>
            <td class="text-center">
                <?php if(file_exists(FCPATH.$creative_work->get_attachment())): ?>
                    <a href="<?php echo $creative_work->get_attachment() ?>" target="_blank" class="btn  btn-block"><i class="btn-label-icon left fa fa-paperclip"></i><?php echo lang('Download') ?></a>
                <?php endif; ?>
            </td>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <td class="td last_column_border text-center">
                <a class="btn btn-block" data-toggle="ajaxModal" href="/faculty_portfolio/work/creative_work_manage?id=<?php echo intval($creative_work->get_id()) ?>"><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit') ?></a>
                <a class="btn btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/faculty_portfolio/work/creative_work_delete/<?php echo intval($creative_work->get_id()) ?>"><span class="btn-label-icon left fa fa-remove"></span><?php echo lang('Delete') ?></a>
            </td>
            <?php } ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $pager ?>
    <?php else: ?>
    <div class="alert alert-dafualt">
        <div class="m-b-12">
            <?php echo lang('There are no') . ' ' . lang('Creative Works'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>