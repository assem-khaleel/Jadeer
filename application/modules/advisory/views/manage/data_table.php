<?php
/** @var $faculties Orm_Ad_Faculty_Program */
?>

<?php if (empty($all_faculty)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Faculty Members'); ?>
        </div>
      <?php  if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
        if (Orm_User::check_credential([Orm_User_Staff::class,Orm_User_Faculty::class], false, 'advisory-manage')) {?>
        <a href="/advisory/add_edit_faculty" data-toggle="ajaxModal" class="btn btn-block">
            <span class="btn-label-icon left fa fa-plus"></span>
            <?php echo lang('Add New'); ?>
        </a>
        <?php }
      }?>

    </div>
<?php } else { ?>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-4">
                    <?php echo lang('Faculty Name') ?>
                </th>
                <th class="col-md-4">
                    <?php echo lang('Program') ?>
                </th>
<!--                <th class="col-md-2">-->
<!--                    --><?php //echo lang('Created By') ?>
<!--                </th>-->
<!--                <th class="col-md-2">-->
<!--                    --><?php //echo lang('Created at') ?>
<!--                </th>-->
                <th class="col-md-2">
                    <?php echo lang('Action') ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($all_faculty as $faculty) {
                ?>
                <tr>
                    <?php /* @var $faculty Orm_Ad_Faculty_Program */ ?>
                    <td>
                        <?php echo htmlfilter(Orm_user::get_instance($faculty->get_faculty_id())->get_full_name()) ?>
                    </td>
                    <td>
                        <?php  echo htmlfilter(Orm_Program::get_instance($faculty->get_program_id())->get_name());?>
                    </td>
<!--                    <td>-->
<!--                        --><?php //$user_name = Orm_User::get_instance($faculty->get_user_id());
//                        echo htmlfilter($user_name->get_full_name()) ?>
<!--                    </td>-->
<!--                    <td>-->
<!--                        --><?php //echo htmlfilter($faculty->get_created_at()) ?>
<!--                    </td>-->
                    <td>
                        <?php if (Orm_User::check_credential([Orm_User_Staff::class,Orm_User_Faculty::class], false, 'advisory-manage')) {
                            if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                                ?>
                                <a href="/advisory/delete_faculty/<?php echo intval($faculty->get_faculty_id()) ?>/<?php echo intval($faculty->get_program_id()) ?>"
                                   class="btn btn-sm  btn-block" title="Delete" data-toggle="deleteAction"
                                   message="<?php echo lang('Are you sure ?') ?>">
                                    <span class="btn-label-icon left icon fa fa-trash-o" aria-hidden="true"></span>
                                    <?php echo lang('Delete') ?>
                                </a>
                                <a href="/advisory/advisory_student/<?php echo intval($faculty->get_faculty_id()) ?>/<?php echo intval($faculty->get_program_id()) ?>"
                                   class="btn btn-sm btn-block">
                                    <span class="btn-label-icon left icon fa fa-check"
                                          aria-hidden="true"></span>
                                    <?php echo lang('Select').' '.lang('Student') ?>
                                </a>
                            <?php } ?>
                        <?php } ?>

                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if ($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
<?php } ?>

