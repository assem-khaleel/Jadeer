<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/17/17
 * Time: 11:46 AM
 */

/**
 * @var $academic_qualifications Orm_Fp_Academic_Qualification[]
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Academic Qualifications') ?></span>
        <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="panel-heading-controls ">
            <a style="" class="btn btn-sm" href="/faculty_portfolio/academic/academic_qualification_manage" data-toggle="ajaxModal"><span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New') ?></a>
        </div>
        <?php } ?>
    </div>
    <?php if(count($academic_qualifications)): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-2"><?php echo lang('Country') ?></th>
            <th class="col-lg-2"><?php echo lang('City') ?></th>
            <th class="col-lg-2"><?php echo lang('University') ?></th>
            <th class="col-lg-2"><?php echo lang('From') ?></th>
            <th class="col-lg-2"><?php echo lang('To') ?></th>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <th class="col-lg-2 text-center"><?php echo lang('Actions') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($academic_qualifications as $academic_qualification) : ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($academic_qualification->get_country()) ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($academic_qualification->get_city()) ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($academic_qualification->get_university()) ?></span>
            </td>
            <td>
                <span><?php echo $academic_qualification->get_date_from() ?></span>
            </td>
            <td>
                <span><?php echo $academic_qualification->get_date_to() ?></span>
            </td>
            <?php if($user_id == Orm_User::get_logged_user_id()) { ?>
            <td class="td last_column_border text-center">
                <a class="btn btn-block" data-toggle="ajaxModal" href="/faculty_portfolio/academic/academic_qualification_manage?id=<?php echo intval($academic_qualification->get_id()) ?>"><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit') ?></a>
                <a class="btn btn-block"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" href="/faculty_portfolio/academic/academic_qualification_delete/<?php echo intval($academic_qualification->get_id()) ?>"><span class="btn-label-icon left fa fa-remove"></span><?php echo lang('Delete') ?></a>
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
            <?php echo lang('There are no') . ' ' . lang('Academic Qualifications'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>