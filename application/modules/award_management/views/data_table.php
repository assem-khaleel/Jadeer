<?php
/** @var $awards Orm_Wa_Award */
?>

<?php if (empty($awards)) { ?>
    <div class="alert alert-default">

        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Award Management'); ?>
        </div>

    <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'award_management-manage')):?>
        <a href="/award_management/add_edit" data-toggle="ajaxModal" class="btn btn-block">
            <span class="btn-label-icon left fa fa-plus"></span>
            <?php echo lang('Add New'); ?>
        </a>
    <?php endif ?>
    </div>
<?php } else { ?>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-2">
                    <?php echo lang('Award Name') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Award Description') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Created By') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Date') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Level') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Action') ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($awards as $award)  {
                 ?>
                <tr>
                    <?php /* @var $award Orm_Wa_Award */ ?>
                    <td>
                        <?php echo htmlfilter($award->get_name()) ?>
                    </td>
                    <td>
                        <?php echo htmlfilter($award->get_description()) ?>
                    </td>
                    <td>
                        <?php $user_name = Orm_User::get_instance($award->get_created_by());
                        echo htmlfilter($user_name->get_full_name()) ?>
                    </td>
                    <td>
                        <?php echo date('Y-m-d', strtotime($award->get_date()))?>
                    </td>
                    <td>
                        <span>
                            <b>
                                <?php echo $award->get_current_type(); ?>
                            </b>
                            <?php if($award->get_level()){
                                echo " : (".htmlfilter($award->get_level_title()).")";
                            } ?>
                        </span>
                    </td>
                    <td>

                        <?php
                        if (Orm_User::check_credential([Orm_User_Faculty::class,Orm_User_Staff::class], false, 'award_management-manage')) {
                            if (Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)) {
                              if ($award->get_created_by()===Orm_User::get_logged_user_id() || Orm_User::get_logged_user_id() == Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) ){
                                ?>
                                <a href="/award_management/add_edit/<?php echo intval($award->get_id()) ?>"
                                   data-toggle="ajaxModal" class="btn btn-sm btn-block">
                                    <span class="btn-label-icon left icon fa fa-pencil-square-o"
                                          aria-hidden="true"></span>
                                    <?php echo lang('Edit') ?>
                                </a>
                                <a href="/award_management/add_edit_candidate/<?php echo intval($award->get_id()) ?>"
                                   data-toggle="ajaxModal" class="btn btn-sm btn-block">
                                    <span class="btn-label-icon left icon fa fa-eye" aria-hidden="true"></span>
                                    <?php echo lang('Select Candidate') ?>
                                </a>
                                <a href="/award_management/add_edit_old_winner/<?php echo intval($award->get_id()) ?>"
                                   data-toggle="ajaxModal" class="btn btn-sm btn-block">
                                    <span class="btn-label-icon left fa fa-trophy"></span>
                                    <?php echo lang('Old Winner'); ?>
                                </a>
                                  <a href="/award_management/add_edit_current_winner/<?php echo intval($award->get_id()) ?>"
                                     data-toggle="ajaxModal" class="btn btn-sm btn-block">
                                      <span class="btn-label-icon left fa fa-trophy"></span>
                                      <?php echo lang('Current Winner'); ?>
                                  </a>
                                <a href="/award_management/delete/<?php echo intval($award->get_id()) ?>"
                                   class="btn btn-sm  btn-block" title="Delete" data-toggle="deleteAction"
                                   message="<?php echo lang('Are you sure ?') ?>">
                                    <span class="btn-label-icon left icon fa fa-trash-o" aria-hidden="true"></span>
                                    <?php echo lang('Delete') ?>
                                </a>
                            <?php } ?>
                        <?php } } ?>
                        <a href="/award_management/view/<?php echo intval($award->get_id()) ?>"
                           class="btn btn-sm btn-block">
                            <span class="btn-label-icon left icon fa fa-info" aria-hidden="true"></span>
                            <?php echo lang('View') ?>
                        </a>
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
