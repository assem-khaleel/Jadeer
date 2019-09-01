<?php
/**
 * Created by PhpStorm.
 * User: miral
 * Date: 10/22/17
 * Time: 3:43 PM
 */
/** @var $phase  Orm_Pm_Sub_Phase*/
//echo '<pre>';print_r($assignToMePhases);die();
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Sub-phases Assigned to me'); ?>
        </div>
    </div>

    <div class="table-responsive m-a-0">
        <?php if($assignToMePhases): ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-lg-3"><?php echo lang('Sub-Phase info'); ?></th>
                    <th class="col-lg-3"><?php echo lang('Work progress'); ?></th>
                    <th class="col-lg-3"><?php echo lang('Start Date'); ?></th>
                    <th class="col-lg-3"><?php echo lang('End Date'); ?></th>
                    <?php if(Orm_User::check_credential([Orm_User::USER_FACULTY , Orm_User::USER_STAFF] , false , 'project_management-manage')): ?>
                    <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>

                <tbody>

                <?php foreach ($assignToMePhases as $sub_phase) { ?>
                    <?php $phase_info = Orm_Pm_Phase::get_instance($sub_phase->get_phase_id()); ?>
                    <?php $project_info = Orm_Pm_Project_Phase::get_one(['phase_id' => $phase_info->get_id()]); ?>
                    <tr>
                        <td>
                            <span class="font-weight-bold">- <?php echo lang('Project').' : '; ?>
                                <?php if($project_info->get_project_type() == 0): ?>
                                    <?php echo Orm_Sp_Project::get_instance($project_info->get_project_id())->get_title(); ?>
                                <?php else:?>
                                    <?php echo Orm_Pm_Project::get_instance($project_info->get_project_id())->get_title(); ?>
                                <?php endif; ?>
                                </span>

                                <ul>
                                    <li><?php echo lang('Phase').' : '; ?><?php echo $phase_info->get_title(); ?></li>
                                    <ul>
                                        <li><?php echo lang('Sub-phase').' : '; ?><?php echo $sub_phase->get_title(); ?></li>
                                    </ul>
                                </ul>
                        </td>
                        <td>
                            <span class="font-weight-bold">
                                <?php echo ($sub_phase->get_is_complete() == 1)?lang('Completed'):lang('Uncompleted'); ?>
                            </span>
                        </td>
                        <td>
                            <span
                                class="font-weight-bold"><?php echo $sub_phase->get_start_date(); ?></span>
                        </td>
                        <td>
                            <span
                                class="font-weight-bold"><?php echo $sub_phase->get_end_date(); ?></span>
                        </td>

                        <?php if(Orm_User::check_credential([Orm_User::USER_FACULTY , Orm_User::USER_STAFF] , false , 'project_management-manage')): ?>
                            <td class="td last_column_border text-center">
                                <a class="btn btn-block" data-toggle="ajaxModal"
                                   href="/project_management/add_edit_sub_phase/<?php echo intval($phase_info->get_id()); ?>/<?php echo intval($sub_phase->get_id()); ?>/true">
                                    <span class="btn-label-icon left fa fa-edit"></span>
                                    <?php echo lang('Edit'); ?></a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class = "box p-a-1">
                <?php echo lang('There is no').' '.lang('Sub-phases assigned to you') ?>
            </div>
        <?php endif; ?>

    </div>
    <?php if ($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
</div>