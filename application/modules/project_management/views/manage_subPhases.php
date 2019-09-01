<?php
/**
 * Created by PhpStorm.
 * User: miral
 * Date: 10/22/17
 * Time: 3:43 PM
 */
/** @var $phase  Orm_Pm_Phase*/
/** @var $sub_phase Orm_Pm_Sub_Phase */
?>

<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Project')." ".$project->get_title();?>
            <ul>
                <li><?php echo lang('Phase')." ".$phase->get_title(); ?></li>
            </ul>
        </div>
    </div>

    <div class="table-responsive m-a-0">
        <?php if($sub_phases): ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-lg-2"><?php echo lang('Sub-phase Name'); ?></th>
                    <th class="col-lg-2"><?php echo lang('Sub-phase Status'); ?></th>
                    <th class="col-lg-2"><?php echo lang('Sub-phase responsible'); ?></th>
                    <th class="col-lg-2"><?php echo lang('Start date'); ?></th>
                    <th class="col-lg-2"><?php echo lang('End date'); ?></th>
                    <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
                </tr>
                </thead>

                <tbody>

                <?php foreach ($sub_phases as $sub_phase) { ?>
                    <tr>
                        <td>
                            <span><?php echo $sub_phase->get_title(); ?></span>
                        </td>
                        <td>
                            <span><?php echo ($sub_phase->get_is_complete() == 0)?lang('Uncompleted'):lang('Completed'); ?></span>
                        </td>
                        <td>
                            <span><?php echo Orm_User::get_instance($sub_phase->get_responsible())->get_full_name(); ?></span>
                        </td>

                        <td>
                            <span><?php echo $sub_phase->get_start_date(); ?></span>
                        </td>
                        <td>
                            <span><?php echo $sub_phase->get_end_date(); ?></span>
                        </td>
                        <td class="td last_column_border text-center">
                            <a class="btn btn-block" data-toggle="ajaxModal"
                               href="/project_management/add_edit_sub_phase/<?php echo intval($phase->get_id()); ?>/<?php echo intval($sub_phase->get_id()); ?>">
                                <span class="btn-label-icon left fa fa-edit"></span>
                                <?php echo lang('Edit'); ?></a>
                            <a class="btn btn-block" data-toggle="deleteAction"
                               href="/project_management/delete_sub_phase/<?php echo intval($sub_phase->get_id()); ?>" >
                                <span class="btn-label-icon left fa fa-remove"></span>
                                <?php echo lang('Delete'); ?></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class = "box p-a-1">
                <?php echo lang('This phase has no actions yet') ?>
            </div>
        <?php endif; ?>

    </div>
    <?php if ($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
</div>
