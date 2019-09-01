<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/25/17
 * Time: 4:33 PM
 */
/** @var $candidate_user Orm_Wa_Candidate_User */
?>

<?php if (empty($candidate_user)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There is no') . ' ' . lang('Candidate'); ?>
        </div>
    </div>
<?php } else { ?>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-4">
                    <?php echo lang('User Name') ?>
                </th>
                <th class="col-md-6">
                    <?php echo lang('Award Name') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Action') ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($candidate_user as $candidate) {   ?>
                <tr>
                    <?php /* @var $candidate Orm_Wa_Candidate_User */ ?>
                    <td>
                        <?php $user_name=Orm_User::get_instance($candidate->get_user_id()) ;echo htmlfilter($user_name->get_full_name()) ?>
                    </td>
                    <td>
                        <?php $award_name=Orm_Wa_Award::get_instance($candidate->get_award_id()) ;echo htmlfilter($award_name->get_name()) ?>
                    </td>
                    <td>
                        <?php
                        if (!Orm_User::check_credential(array(Orm_User::USER_STUDENT), TRUE)):
                        if(Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)){
                        if(Orm_User::check_credential([Orm_User_Faculty::class,Orm_User_Staff::class],false,'award_management-manage')){
                           if ($award_name->get_created_by() == Orm_User::get_logged_user_id() || Orm_User::has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) {
                            ?>
                        <a href="/award_management/deleteCandidate/<?php echo intval($candidate->get_id()) ?>"
                           class="btn btn-sm  btn-block" title="Delete" data-toggle="deleteAction"
                           message="<?php echo lang('Are you sure ?') ?>">
                            <span class="btn-label-icon left icon fa fa-trash-o" aria-hidden="true"></span>
                            <?php echo lang('Delete') ?>
                        </a>
                        <?php }?>
                        <?php }?>
                        <?php }?>
                        <?php else: ?>
                            <a href="/award_management/view/<?php echo intval($award_name->get_id()) ?>"
                               class="btn btn-sm btn-block">
                                <span class="btn-label-icon left icon fa fa-info" aria-hidden="true"></span>
                                <?php echo lang('View') ?>
                            </a>
                        <?php endif; ?>
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
