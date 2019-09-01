<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 11/9/17
 * Time: 4:06 PM
 */
/** @var $all_Advice Orm_Ad_Advice_Topic */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Topics For').' - '.Orm_Program::get_instance($program_id)->get_name() ?>
        </div>
        <?php echo filter_block('/advisory/view_topic', '/advisory/view_topic'.'/'.$program_id, ['keyword'], 'ajax_block'); ?>
    </div>

    <div id="ajax_block">
        <?php if (empty($all_Advice)) { ?>

            <div class="alert alert-default">
                <div class="m-b-1">
                    <?php echo lang('There are no') . ' ' . lang('Topics for advice'); ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="table-responsive m-a-0">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-2">
                            <?php echo lang('Topic') ?>
                        </th>
                        <th class="col-md-2">
                            <?php echo lang('Created by') ?>
                        </th>
                        <th class="col-md-2">
                            <?php echo lang('created at') ?>
                        </th>
                        <th class="col-md-2">
                            <?php echo lang('Action') ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($all_Advice as $topic) {

                        ?>
                        <tr>
                            <?php /* @var $topic Orm_Ad_Advice_Topic */ ?>
                            <td>
                                <?php echo htmlfilter($topic->get_topic()) ?>
                            </td>
                            <td>
                                <?php echo htmlfilter(Orm_User::get_instance($topic->get_user_id())->get_full_name()) ?>
                            </td>
                            <td>
                                <?php echo htmlfilter($topic->get_created_at()) ?>
                            </td>
                            <td>
                                <?php if (Orm_User::check_credential([Orm_User_Staff::class,Orm_User_Faculty::class], false, 'advisory-manage')) {
                                            if ($topic->get_user_id() ==  Orm_User::get_logged_user()->get_id() || Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){
                                                ?>
                                                <a href="/advisory/add_edit_topic/<?php echo intval($topic->get_id()) ?>"
                                            data-toggle="ajaxModal" class="btn btn-sm btn-block">
                                            <span class="btn-label-icon left icon fa fa-pencil-square-o"
                                                  aria-hidden="true"></span>
                                            <?php echo lang('Edit') ?>
                                            </a>
                                            <a href="/advisory/delete/<?php echo intval($topic->get_id()) ?>"
                                               class="btn btn-sm  btn-block" title="Delete" data-toggle="deleteAction"
                                               message="<?php echo lang('Are you sure ?') ?>">
                                                <span class="btn-label-icon left icon fa fa-trash-o"
                                                      aria-hidden="true"></span>
                                                <?php echo lang('Delete') ?>
                                            </a>
                                            <?php
                                    }?>
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

    </div>
</div>