<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/24/17
 * Time: 3:14 PM
 */
/** @var $winner_awards Orm_Wa_Winner_Award */
//echo "<pre>";print_r($winner_awards);die();
?>
<?php if (empty($winner_awards)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Winner'); ?>
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
            <?php foreach ($winner_awards as $winner) {
                ?>
                <tr>
                    <?php /* @var $winner Orm_Wa_Winner_Award */ ?>
                    <td>
                        <?php $user_name=Orm_User::get_instance($winner->get_user_id()) ;echo htmlfilter($user_name->get_full_name()) ?>
                    </td>
                    <td>
                        <?php echo htmlfilter(Orm_Wa_Award::get_instance($winner->get_award_id())->get_name()) ?>
                    </td>
                    <td>
                        <?php if ($winner->get_received() == 0):?>
                        <a href="/award_management/deleteWinner/<?php echo intval($winner->get_id()) ?>"
                           class="btn btn-sm  btn-block" title="Delete" data-toggle="deleteAction"
                           message="<?php echo lang('Are you sure ?') ?>">
                            <span class="btn-label-icon left icon fa fa-trash-o" aria-hidden="true"></span>
                            <?php echo lang('Delete') ?>
                        </a>
                          <?php

                        else:
                            echo lang('Received');

                        endif;
                        ?>
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
