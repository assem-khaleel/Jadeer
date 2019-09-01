<?php
/* @var $all_training Orm_Tm_Training[] */
?>
<?php if (empty($all_training)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('General Training Management'); ?>
        </div>
    </div>
<?php } else { ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Name'); ?></th>
            <th class="col-lg-3"><?php echo lang('Type'); ?></th>
            <th class="col-lg-3"><?php echo lang('Organizations'); ?></th>
            <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($all_training as $training) { ?>
            <tr>
                <td>
                    <span><?php echo htmlfilter($training->get_name()) ?></span>
                </td>
                <td>
                    <span><?php echo htmlfilter($training->get_type_obj()->get_name()) ?></span>
                </td>
                <td>
                    <span><?php echo htmlfilter($training->get_organization()) ?></span>
                </td>
                <td class="td last_column_border text-center">
                    <?php if ($training->check_if_can_view()) { ?>
                        <a class="btn btn-block"
                           href="/training_management/training_general/view/<?php echo urlencode($training->get_id()) ?>"><span
                                    class="btn-label-icon left fa fa-eye"></span> <?php echo lang('View'); ?></a>
                    <?php } ?>

                    <?php
                    $join = Orm_Tm_Members::get_one(['training_id' => $training->get_id(), 'user_id' => $logged_user]);
                    if ($join->get_status() == Orm_Tm_Members::USER_WAITING) {
                        ?>
                        <a class="btn btn-block"
                           message="<?php echo lang('Are you sure that you want Join training?') ?>"
                           data-toggle="deleteAction"
                           href="/training_management/training_general/join/<?php echo intval($training->get_id()) ?>"><span
                                    class="btn-label-icon left fa fa-paper-plane"></span> <?php echo lang('Join'); ?>
                        </a>
                    <?php } elseif($join->get_status() == Orm_Tm_Members::USER_PENDING) {
                        ?>
                        <a class="btn btn-block" disabled><span
                                    class="btn-label-icon left fa fa-spinner"></span> <?php echo lang('Pending'); ?>
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php echo $pager ?>
<?php } ?>
