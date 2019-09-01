<?php
/** @var $action_plans Orm_Acc_Visit_Reviewer_Action_Plan[] */
?>
    <div class="well well-sm">
        <?php echo htmlfilter(Orm_Acc_Visit_Reviewer::get_type_element($type, $type_id)->get_name()) ?>
        <hr class="bg-info">
        <?php echo xssfilter(Orm_Acc_Visit_Reviewer_Recommendation::get_instance($recommendation_id)->get_recommendation()) ?>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><?php echo lang('Action Plans'); ?></span>
            <?php if($is_admin) { ?>
                <a href="/accreditation/reviewer_visit/action_add_edit/<?php echo htmlfilter($type); ?>/<?php echo intval($type_id); ?>/<?php echo intval($recommendation_id); ?>" data-toggle="ajaxModal" class="btn pull-right" >
                    <span class="btn-label-icon left fa fa-plus"></span>
                    <?php echo lang('New Action Plan'); ?>
                </a>
            <?php } ?>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="bg-primary" >
                    <td class="col-md-2"><?php echo lang('Responsible'); ?></td>
                    <td class="col-md-4"><?php echo lang('Action Plan Description'); ?></td>
                    <td class="col-md-2"><?php echo lang('Progress'); ?></td>
                    <td class="col-md-2"><?php echo lang('Due Date'); ?></td>
                    <?php if($is_admin) { ?>
                        <td class="col-md-2 text-center"><?php echo lang('Action'); ?></td>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php if ($action_plans) { ?>
                    <?php foreach ($action_plans as $action_plan) { ?>
                        <tr>
                            <td><?php echo $action_plan->get_responsible_obj()->draw_compose_link(); ?></td>
                            <td>
                                <?php echo character_limiter(strip_tags($action_plan->get_description()),100,' ...') . ' <a href="/accreditation/reviewer_visit/action_view/'.$action_plan->get_id().'" data-toggle="ajaxModal" >' . lang('Read More') . '</a>'; ?>
                            </td>
                            <td>
                                <?php
                                $progress = intval($action_plan->get_progress());
                                ?>
                                <div id="c3-gauge-<?php echo $action_plan->get_id() ?>" style="height: 100px"></div>
                                <script>
                                    pxInit.push(function () {
                                        $(function () {
                                            var data = {
                                                columns: [
                                                    ['<?php echo lang('Progress') ?>', <?php echo $progress ?>]
                                                ],
                                                type: 'gauge'
                                            };

                                            c3.generate({
                                                bindto: '#c3-gauge-<?php echo $action_plan->get_id() ?>',
                                                color: {pattern: ['<?php echo get_chart_color($progress)?>']},
                                                data: data
                                            });
                                        });
                                    });
                                </script>
                            </td>
                            <td><?php echo htmlfilter($action_plan->get_due_date()); ?></td>
                            <?php if($is_admin) { ?>
                                <td>
                                    <a href="/accreditation/reviewer_visit/action_add_edit/<?php echo urlencode($type); ?>/<?php echo intval($type_id); ?>/<?php echo intval($recommendation_id); ?>/<?php echo intval($action_plan->get_id()) ?>"
                                       data-toggle="ajaxModal" class="btn btn-sm btn-block" >
                                        <span class="btn-label-icon left icon fa fa-pencil-square-o" aria-hidden="true"></span>
                                        <?php echo lang('Edit') ?>
                                    </a>
                                    <a href="/accreditation/reviewer_visit/action_delete/<?php echo intval($action_plan->get_id()) ?>"
                                       class="btn btn-sm  btn-block" title="Delete" data-toggle="deleteAction" message="<?php echo lang('Are you sure ?')?>">
                                        <span class="btn-label-icon left icon fa fa-trash-o" aria-hidden="true"></span>
                                        <?php echo lang('Delete') ?>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="text-center m-a-0"><?php echo lang("There is no") . ' ' . lang('Action Plan'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php if (!empty($pager)) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>