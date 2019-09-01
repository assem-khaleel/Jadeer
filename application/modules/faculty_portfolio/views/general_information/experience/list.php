<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/17/17
 * Time: 11:46 AM
 */

/**
 * @var $experiences Orm_Fp_Experience[]
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Experiences') ?></span>
        <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <div class="panel-heading-controls ">
                <a style="" class="btn btn-sm" href="/faculty_portfolio/experience_manage" data-toggle="ajaxModal"><span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New') ?></a>
            </div>
        <?php } ?>
    </div>
    <?php if(count($experiences)): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-2"><?php echo lang('Organization') ?></th>
            <th class="col-lg-2"><?php echo lang('Date From') ?></th>
            <th class="col-lg-2"><?php echo lang('Date To') ?></th>
            <th class="col-lg-2"><?php echo lang('Position') ?></th>
            <th class="col-lg-2"><?php echo lang('Address') ?></th>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
                <th class="col-lg-2 text-center"><?php echo lang('Actions') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($experiences as $experience) : ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($experience->get_organization()) ?></span>
            </td>
            <td>
                <span><?php echo $experience->get_date_from() ?></span>
            </td>
            <td>
                <span><?php echo $experience->get_date_to() ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($experience->get_position()) ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($experience->get_address()) ?></span>
            </td>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/faculty_portfolio/experience_manage?id=<?php echo intval($experience->get_id()) ?>"><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit') ?></a>
                    <a class="btn btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/faculty_portfolio/experience_delete/<?php echo intval($experience->get_id()) ?>"><span class="btn-label-icon left fa fa-remove"></span><?php echo lang('Delete') ?></a>
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
            <?php echo lang('There are no') . ' ' . lang('Experiences'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>