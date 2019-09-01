<?php
/**
 * Created by PhpStorm.
 * User: miral
 * Date: 10/22/17
 * Time: 3:43 PM
 */
/** @var $phase  Orm_Pm_Project_Phase*/
?>

<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Project')." ".$project->get_title()." ".lang('phases'); ?>
        </div>
    </div>

    <div class="table-responsive m-a-0">
        <?php if($phases): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-3"><?php echo lang('Phase Name'); ?></th>
                <th class="col-lg-3"><?php echo lang('Start Date'); ?></th>
                <th class="col-lg-3"><?php echo lang('End Date'); ?></th>
                <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>

            <tbody>

            <?php foreach ($phases as $phase) { ?>
                <?php $phase_info = Orm_Pm_Phase::get_instance($phase->get_phase_id());
                ?>
                <tr>
                    <td>
                        <span><?php echo $phase_info->get_title(); ?></span>
                    </td>

                    <td>
                            <span
                                class="font-weight-bold"><?php echo $phase_info->get_start_date(); ?></span>
                    </td>
                    <td>
                            <span
                                class="font-weight-bold"><?php echo $phase_info->get_end_date(); ?></span>
                    </td>

                    <td class="td last_column_border text-center">
                        <a class="btn btn-block"
                           href="/project_management/manage_sub_phases/<?php echo intval($phase_info->get_id()); ?>/<?php echo $project->get_id(); ?>/<?php echo $type; ?>">
                            <span class="btn-label-icon left fa fa-tasks"></span>
                            <?php echo lang('Manage sub-phases'); ?></a>
                        <a class="btn btn-block" data-toggle="ajaxModal"
                           href="/project_management/add_edit/<?php echo intval($phase_info->get_id()); ?>?project_id=<?php echo $project->get_id(); ?>&project_type=<?php echo $type;?>">
                            <span class="btn-label-icon left fa fa-edit"></span>
                            <?php echo lang('Edit'); ?></a>
                        <a class="btn btn-block" data-toggle="deleteAction"
                           href="/project_management/delete_phase/<?php echo intval($phase_info->get_id()); ?>" >
                            <span class="btn-label-icon left fa fa-remove"></span>
                            <?php echo lang('Delete'); ?></a>

                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
            <?php else: ?>
                <div class = "box p-a-1">
                    <?php echo lang('This project has no phases yet') ?>
                </div>
            <?php endif; ?>

    </div>
    <?php if ($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
</div>