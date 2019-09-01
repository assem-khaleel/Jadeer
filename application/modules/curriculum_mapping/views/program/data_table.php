<div class="table-responsive m-a-0">
    <table class="table table-striped table-bordered">
        <thead>
        <tr class="bg-primary">
            <td class="col-md-8">
                <b><?php echo lang('Name') ?></b>
            </td>
            <td class="col-md-2">
                <b><?php echo lang('Progress') ?></b>
            </td>
            <td class="col-md-2 text-center">
                <b><?php echo lang('Action') ?></b>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($programs) {
            foreach ($programs as $program) {
                /* @var $program Orm_Program */
                ?>
                <tr>
                    <td>
                        <h5 class="m-t-0"><?php echo htmlfilter($program->get_name()); ?></h5>
                        <ul>
                            <li>
                                <i><?php echo lang('College'); ?></i> : <?php echo htmlfilter($program->get_department_obj()->get_college_obj()->get_name()); ?>
                            </li>
                            <li>
                                <i><?php echo lang('Department'); ?></i> : <?php echo htmlfilter($program->get_department_obj()->get_name()); ?>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <?php
                        $total = 3;

                        $count = 0;
                        $count += (Orm_Cm_Program_Learning_Outcome::get_one(array('program_id' => $program->get_id()))->get_id() ? 1 : 0);
                        $count += (Orm_Cm_Program_Assessment_Method::get_one(array('program_id' => $program->get_id()))->get_id() ? 1 : 0);
                        $count += (Orm_Cm_Program_Mapping_Matrix::get_one(array('program_id' => $program->get_id()))->get_id() ? 1 : 0);

                        $progress = round(($count/$total) * 100, 2);
                        ?>
                        <div id="c3-gauge-<?php echo  $program->get_id() ?>" style="height: 100px"></div>
                        <script>
                            //                        pxInit.push(function () {
                            $(function () {
                                var data = {
                                    columns: [
                                        ['<?php echo lang('Progress') ?>', <?php echo $progress ?>]
                                    ],
                                    type: 'gauge'
                                };

                                c3.generate({
                                    bindto: '#c3-gauge-<?php echo  $program->get_id() ?>',
                                    color: {pattern: ['<?php echo  get_chart_color($progress)?>']},
                                    data: data
                                });
                            });
                            //                        });
                        </script>
                    </td>
                    <td class="text-center">
                        <?php if(Orm_Cm_Active_Data::is_active_program($program->get_id())) { ?>
                            <a href="/curriculum_mapping/program/learning_outcome/<?php echo $program->get_id(); ?>" class="btn btn-block"><i class="btn-label-icon left fa fa-list-alt"></i><?php echo lang('Manage'); ?></a>
                        <?php } else { ?>
                            <a href="/curriculum_mapping/program/activate/<?php echo $program->get_id(); ?>" class="btn btn-block"><i class="btn-label-icon left fa fa-tasks"></i><?php echo lang('Initiate'); ?></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="4">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Programs'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php if ($pager) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>