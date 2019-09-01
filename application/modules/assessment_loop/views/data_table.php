<?php
/** @var $assessment_loop_objs Orm_Al_Assessment_Loop[] */
$college_id = isset($fltr['college_id']) ? $fltr['college_id'] : 0;
$program_id = isset($fltr['program_id']) ? $fltr['program_id'] : 0;
?>
<?php if (empty($assessment_loop_objs)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Record has Entered'); ?>
        </div>
        <a href="/assessment_loop/add_edit" data-toggle="ajaxModal" class="btn  btn-block">
            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add') . ' ' . lang('New'); ?>
        </a>
    </div>
<?php } else { ?>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-3"><?php echo lang('Name'); ?></th>
                <th class="col-lg-3"><?php echo lang('Level'); ?></th>
                <th class="col-lg-2"><?php echo lang('Due Date'); ?></th>
                <th class="col-lg-2"><?php echo lang('Progress'); ?></th>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($assessment_loop_objs as $assessment_loop) { ?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter($assessment_loop->get_item_title()); ?></span>
                    </td>
                    <td>
                       <span>
                           <?php echo htmlfilter($assessment_loop->get_current_item_type()) ?>
                           <?php if ($assessment_loop->get_current_item_type_id_title()) { ?>
                               (<?php echo htmlfilter($assessment_loop->get_current_item_type_id_title()) ?>)
                           <?php } ?>
                     </span>
                    </td>
                    <td>
                        <span><?php echo $assessment_loop->get_deadline() ? htmlfilter($assessment_loop->get_deadline()) : lang('Due Date not chosen yet'); ?></span>
                    </td>
                    <td class="text-center valign-middle">
                        <?php

                        $percentage = 0;

                        $percentage += $assessment_loop->get_analysis_obj()->get_id() ? 20 : 0;
                        $percentage += $assessment_loop->get_measure_objs() ? 20 : 0;
                        $percentage += $assessment_loop->get_result_objs() ? 20 : 0;
                        $percentage += $assessment_loop->get_recommendation_objs() ? 20 : 0;
                        $percentage += $assessment_loop->get_action_objs() ? 20 : 0;

                        ?>
                        <span>
                             <div id="c3-gauge-<?php echo (int)$assessment_loop->get_id(); ?>"
                                  style="height: 100px"></div>
                        </span>
                        <?php

                        if ($percentage == 100) {
                            echo lang('Done');
                        } elseif ($percentage > 0) {
                            echo lang('Partially done');
                        } else {
                            echo lang('not Done');
                        }


                        ?>
                        <script>
                            //                        pxInit.push(function () {
                            $(function () {
                                var data = {
                                    columns: [
                                        ['<?php echo lang('Progress') ?>', <?php echo $percentage ?>]
                                    ],
                                    type: 'gauge'
                                };

                                c3.generate({
                                    bindto: '#c3-gauge-<?php echo (int)$assessment_loop->get_id();?>',
                                    color: {pattern: ['<?php echo get_chart_color($percentage)?>']},
                                    data: data
                                });
                            });
                            //                        });
                        </script>
                    </td>
                    <td class="td last_column_border text-center">
                        <a class="btn btn-block"
                           href="/assessment_loop/manage/measure/<?php echo urlencode($assessment_loop->get_id()); ?>"><span
                                    class="btn-label-icon left fa fa-gear"></span> <?php echo lang('Manage'); ?></a>
                        <a class="btn btn-block"
                           href="/assessment_loop/pdf/<?php echo urlencode($assessment_loop->get_id()); ?>"><span
                                    class="btn-label-icon left fa fa-file-pdf-o"></span> <?php echo lang('pdf'); ?></a>
                        <?php if ($assessment_loop->can_manage()) : ?>
                            <a class="btn btn-block" data-toggle="ajaxModal"
                               href="/assessment_loop/add_edit/<?php echo urlencode($assessment_loop->get_id()); ?>"><span
                                        class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                            <a class="btn btn-block" data-toggle="deleteAction"
                               href="/assessment_loop/delete/<?php echo urlencode($assessment_loop->get_id()); ?>"
                               message="<?php echo lang('Are you sure ?') ?>"><span
                                        class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?>
                            </a>
                        <?php endif ?>
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
