<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 11/9/17
 * Time: 9:57 AM
 */
/** @var $student_faculty Orm_Ad_Student_Faculty */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Advisory') ?>
        </div>
<!--        --><?php //echo filter_block('/advisory/filter_faculty', '/advisory/student', ['keyword'], 'ajax_block'); ?>
    </div>

    <?php if (empty($student_selected)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Student Members'); ?>
            </div>
            <?php if (Orm_User::get_logged_user()->has_role_type() == Orm_Role::ROLE_PROGRAM_ADMIN || Orm_User::get_logged_user()->has_role_type() == Orm_Role::ROLE_COLLEGE_ADMIN || Orm_User::get_logged_user()->has_role_type() == Orm_Role::ROLE_INSTITUTION_ADMIN) { ?>
                <a href="/advisory/add_edit_faculty" data-toggle="ajaxModal" class="btn btn-block">
                    <span class="btn-label-icon left fa fa-plus"></span>
                    <?php echo lang('Add New'); ?>
                </a>
            <?php } ?>
        </div>
    <?php }else{?>
        <div class="table-responsive m-a-0" style="height: 400px;overflow: auto">
            <table class="table table-bordered">
                <thead>
                <tr>

                    <th class="col-md-4">
                        <?php echo lang('Student Name') ?>
                    </th>
                    <th class="col-md-4">
                        <?php echo lang('Faculty Name') ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($student_selected as $student) {
                    ?>
                    <tr>
                        <?php /* @var $student Orm_Ad_Student_Faculty */ ?>
                        <td>
                            <?php echo Orm_User::get_instance($student->get_student_id())->get_full_name(); ?>
                        </td>
                        <td>
                            <?php echo Orm_User::get_instance($student->get_faculty_id())->get_full_name(); ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>







