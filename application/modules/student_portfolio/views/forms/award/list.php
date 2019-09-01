<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/17/17
 * Time: 11:46 AM
 */

/**
 * @var $awards Orm_Stp_Awards_And_Publications[]
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Award') ?></span>
        <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="panel-heading-controls">
            <a style="" class="btn btn-sm" href="/student_portfolio/award_manage" data-toggle="ajaxModal"><span class="btn-label-icon left icon fa fa-plus"></span><?php echo lang('Add').' '.lang('New') ?></a>
        </div>
        <?php } ?>
    </div>
    <?php if(count($awards)): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-4"><?php echo lang('Award Title') ?></th>
            <th class="col-lg-3"><?php echo lang('Publish Date') ?></th>
            <th class="col-lg-3"><?php echo lang('Attachment') ?></th>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <th class="col-lg-2 text-center"><?php echo lang('Actions') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($awards as $award) : ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($award->get_title()) ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($award->get_publish_date())?></span>
            </td>
            <td class="text-center ">
                <?php if(file_exists(FCPATH.$award->get_attachement())): ?>
                        <a href="<?php echo $award->get_attachement() ?>" target="_blank" class="btn btn-block btn-sm pull-right"><i class="btn-label-icon left fa fa-paperclip"></i><?php echo lang('Download') ?></a>
                <?php endif; ?>
            </td>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <td class="td last_column_border text-center">
                <a class="btn btn-block btn-sm" data-toggle="ajaxModal" href="/student_portfolio/award_manage?id=<?php echo $award->get_id() ?>"><span class="btn-label-icon left"><i class="fa fa-edit"></i></span><?php echo lang('Edit') ?></a>
                <a class="btn btn-block btn-sm" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/student_portfolio/award_delete/<?php echo $award->get_id() ?>"><span class="btn-label-icon left"><i class="fa fa-remove"></i></span><?php echo lang('Delete') ?></a>
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
            <?php echo lang('There are no') . ' ' . lang('Award'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>