
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">

            <?php
            if($type == 0):
                /** @var $project Orm_Sp_Project */
            echo lang('Strategic Projects');
            else:
                /** @var $project Orm_Pm_Project */
            echo lang('Customized projects');
            endif;
            ?>
        </div>
    </div>


    <?php //echo "<pre>";print_r($projects); ?>

    <?php if (!empty($projects)) { ?>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-lg-3"><?php echo lang('Project Name'); ?></th>
                    <th class="col-lg-3"><?php echo lang('Start Date'); ?></th>
                    <th class="col-lg-3"><?php echo lang('End Date'); ?></th>
                    <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($projects as $project) { ?>
                    <tr>
                        <td>
                            <span><?php echo $project->get_title(); ?></span>
                        </td>

                        <td>
                            <span
                                    class="font-weight-bold"><?php echo $project->get_start_date(); ?></span>
                        </td>
                        <td>
                            <span
                                    class="font-weight-bold"><?php echo $project->get_end_date(); ?></span>
                        </td>


                        <td class="td last_column_border text-center">

                            <a class="btn btn-block"
                               href="/project_management/display_project_chart/<?php echo intval($project->get_id()); ?>/<?php echo $type; ?>" >
                                <span class="btn-label-icon left fa fa-eye"></span>
                                <?php echo lang('Display Progress'); ?></a>

                            <?php if ($project->get_end_date() != date("Y-m-d") && Orm_User::check_credential([Orm_User::USER_STAFF , Orm_User::USER_FACULTY] , false , 'project_management-manage') && $type == 1) {  ?>

                            <a class="btn btn-block"
                               href="/project_management/manage_phases/<?php echo intval($project->get_id()); ?>/<?php echo $type; ?>">
                                <span class="btn-label-icon left fa fa-tasks"></span>
                                <?php echo lang('Manage Phases'); ?></a>



                                <a class="btn btn-block" data-toggle="ajaxModal"
                                   href="/project_management/create_project/<?php echo intval($project->get_id()); ?>">
                                    <span class="btn-label-icon left fa fa-edit"></span>
                                    <?php echo lang('Edit'); ?></a>
                                <a class="btn btn-block" data-toggle="deleteAction"
                                   href="/project_management/delete_project/<?php echo intval($project->get_id()); ?>/<?php echo $type; ?>">
                                    <span class="btn-label-icon left fa fa-remove"></span>
                                    <?php echo lang('Delete'); ?></a>

                            <?php }  ?>

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
    <?php }else{ ?>
<div class = "box p-a-1">
    <p><?php echo lang('There is no').' '.lang('Project') ?></p>
</div>
    <?php }?>
</div>