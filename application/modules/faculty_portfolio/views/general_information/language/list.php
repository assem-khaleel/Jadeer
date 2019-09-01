<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/17/17
 * Time: 11:46 AM
 */

/**
 * @var $language Orm_Fp_Language
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('language') ?></span>
        <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="panel-heading-controls ">
            <a style="" class="btn btn-sm" href="/faculty_portfolio/language_manage" data-toggle="ajaxModal"><span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New') ?></a>
        </div>
        <?php } ?>
    </div>
    <?php if(count($languages)): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-5"><?php echo lang('Language') ?></th>
            <th class="col-lg-5"><?php echo lang('Proficiency') ?></th>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
                <th class="col-lg-2 text-center"><?php echo lang('Actions') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($languages as $language) : ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($language->get_language()) ?></span>
            </td>
            <td>
                <span><?php echo $language->get_level(true) ?></span>
            </td>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
                <td class="td last_column_border text-center">
                    <a class="btn btn-block" data-toggle="ajaxModal" href="/faculty_portfolio/language_manage?id=<?php echo intval($language->get_id()) ?>"><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit') ?></a>
                    <a class="btn btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/faculty_portfolio/language_delete/<?php echo intval($language->get_id()) ?>"><span class="btn-label-icon left fa fa-remove"></span><?php echo lang('Delete') ?></a>
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
            <?php echo lang('There are no') . ' ' . lang('languages'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>