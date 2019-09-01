<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/17/17
 * Time: 11:46 AM
 */

/**
 * @var $services Orm_Stp_Community_Services[]
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Service') ?></span>
        <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="panel-heading-controls">
            <a style="" class="btn btn-sm" href="/student_portfolio/community_manage" data-toggle="ajaxModal"><span class="btn-label-icon left icon fa fa-plus"></span><?php echo lang('Add').' '.lang('New') ?></a>
        </div>
        <?php } ?>
    </div>
    <?php if(count($services)):?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Date') ?></th>
            <th class="col-lg-4"><?php echo lang('Location') ?></th>
            <th class="col-lg-3"><?php echo lang('Supervisor') ?></th>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <th class="col-lg-2 text-center"><?php echo lang('Actions') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($services as $service) : ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($service->get_date())?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($service->get_location()) ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($service->get_supervisor()) ?></span>
            </td>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <td class="td last_column_border text-center">
                <a class="btn btn-block btn-sm" data-toggle="ajaxModal" href="/student_portfolio/community_manage?id=<?php echo (int)$service->get_id() ?>"><span class="btn-label-icon left"><i class="fa fa-edit"></i></span><?php echo lang('Edit') ?></a>
                <a class="btn btn-block btn-sm" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/student_portfolio/community_delete/<?php echo (int) $service->get_id() ?>"><span class="btn-label-icon left"><i class="fa fa-remove"></i></span><?php echo lang('Delete') ?></a>
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
                <?php echo lang('There are no') . ' ' . lang('Services'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>