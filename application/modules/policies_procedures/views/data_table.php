<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/07/17
 * Time: 10:21 ص
 */
/** @var Orm_Policies_Procedures[] $items */
?>
<?php if (empty($items)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Policies & Procedures are Entered'); ?>
        </div>
        <?php if (Orm_Policies_Procedures::check_if_can_add()) { ?>
            <a href="/policies_procedures/add" class="btn btn-block">
                <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add New'); ?>
            </a>
        <?php } ?>

    </div>
<?php } else { ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Policy & Procedure Name'); ?></th>
            <th class="col-lg-2"><?php echo lang('Level'); ?></th>
            <th class="col-lg-2"><?php echo lang('Managers'); ?></th>
            <th class="col-lg-3"><?php echo lang('Description'); ?></th>
            <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item) { ?>
            <tr>
                <td>
                    <span><?php echo htmlfilter($item->get_title()) ?></span>
                </td>
                <td>
                        <span>
                            <?php
                            echo htmlfilter($item->get_current_unit_type());
                            if ($item->get_current_unit_type_title()) {
                                echo " ({$item->get_current_unit_type_title()})";
                                ?>

                            <?php } ?>
                        </span>
                </td>
                <td>
                    <ul>


                        <?php foreach (Orm_Policies_Procedures_Managers::get_all(['policy_id' => $item->get_id()]) as $manager) { ?>
                            <li>
                                <b><?php echo htmlfilter(Orm_User::get_instance($manager->get_manager_id())->get_full_name()); ?></b>
                            </li>
                        <?php } ?>
                    </ul>
                </td>
                <td>
                    <span><?php echo $item->get_desc() ? xssfilter($item->get_desc()) : lang('There are no') . ' ' . lang('Description Added'); ?></span>
                </td>
                <td class="td last_column_border text-center">

                    <a class="btn btn-block" href="/policies_procedures/view/<?php echo $item->get_id(); ?>"><span
                            class="btn-label-icon left fa fa-eye"></span> <?php echo lang('View'); ?></a>
                    <?php if ($item->check_if_can_generate_report()) { ?>
                        <a class="btn btn-block"
                           href="/policies_procedures/downloadpdf/<?php echo $item->get_id(); ?>"><span
                                class="btn-label-icon left fa fa-file-pdf-o"></span> <?php echo lang('pdf'); ?></a>
                    <?php } ?>

                    <?php if (Orm_User::get_logged_user()->get_class_type() != Orm_User::USER_STUDENT) {
                        if ($item->check_if_can_modify(Orm_User::get_logged_user())) { ?>
                            <a class="btn btn-block"
                               href="/policies_procedures/manage/<?php echo $item->get_id(); ?>"><span
                                    class="btn-label-icon left fa fa-gear"></span> <?php echo lang('Manage'); ?></a>
                            <?php if ($item->check_if_can_edit()) { ?>
                                <a class="btn btn-block"
                                   href="/policies_procedures/edit/<?php echo $item->get_id(); ?>"><span
                                        class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                            <?php } ?>
                            <?php if ($item->check_if_can_edit()) { ?>
                                <a class="btn btn-block"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction"
                                   href="/policies_procedures/delete/<?php echo $item->get_id(); ?>"><span
                                        class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?>
                                </a>
                            <?php } ?>
                        <?php } ?>

                    <?php } ?>

                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php echo $pager ?>
<?php } ?>
