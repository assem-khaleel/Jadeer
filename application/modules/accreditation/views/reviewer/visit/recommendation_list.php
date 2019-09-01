<?php
/** @var $programs Orm_Program[]
 * @var $recommendation Orm_Acc_Visit_Reviewer_Recommendation
 * @var $reviewer Orm_Acc_Visit_Reviewer
 * */

?>
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><?php echo lang('Recommendations'); ?> : <?php echo htmlfilter(Orm_Acc_Visit_Reviewer::get_type_element($type, $type_id)->get_name()) ?></span>
            <div class="panel-heading-controls">
                <?php if (Orm_Acc_Visit_Reviewer::can_manege($type, $type_id)){ ?>
                    <a class="btn btn-xs btn-success btn-outline btn-outline-colorless" href="/accreditation/reviewer_visit/recommendation_add_edit/<?php echo htmlfilter($type); ?>/<?php echo intval($type_id); ?>" data-toggle="ajaxModal" >
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span> <?php echo lang('Add').' '.lang('Recommendation'); ?>
                    </a>
                <?php } ?>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="bg-primary" >
                    <td class="col-md-2"><?php echo lang('Reviewer Name'); ?></td>
                    <td class="col-md-6"><?php echo lang('Recommendation'); ?></td>
                    <td class="col-md-2"><?php echo lang('Progress'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Action'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($recommendations) { ?>
                    <?php foreach ($recommendations as $recommendation) { ?>
                        <tr>
                            <td><?php echo $recommendation->get_reviewer_obj()->draw_compose_link(); ?></td>
                            <td>
                                <?php echo character_limiter(strip_tags($recommendation->get_recommendation()),100,' ...') . ' <a href="/accreditation/reviewer_visit/recommendation_view/'.$recommendation->get_id().'" data-toggle="ajaxModal" >' . lang('Read More') . '</a>'; ?>
                            </td>
                            <td>
                                <?php
                                $progress = intval($recommendation->get_progress());
                                ?>
                                <div id="c3-gauge-<?php echo $recommendation->get_id() ?>" style="height: 100px"></div>
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
                                                bindto: '#c3-gauge-<?php echo $recommendation->get_id() ?>',
                                                color: {pattern: ['<?php echo get_chart_color($progress)?>']},
                                                data: data
                                            });
                                        });
                                    });
                                </script>
                            </td>
                            <td>
                                <?php if (Orm_Acc_Visit_Reviewer::can_manege($type, $type_id) && $recommendation->get_reviewer_id() == Orm_User::get_logged_user_id()){ ?>
                                    <a href="/accreditation/reviewer_visit/recommendation_add_edit/<?php echo htmlfilter($recommendation->get_type()) ?>/<?php echo intval($recommendation->get_type_id()) ?>/<?php echo intval($recommendation->get_id()) ?>" class="btn btn-sm btn-block" data-toggle="ajaxModal" >
                                        <span class="btn-label-icon left icon fa fa-pencil-square-o" aria-hidden="true"></span>
                                        <?php echo lang('Edit') ?>
                                    </a>
                                    <a href="/accreditation/reviewer_visit/recommendation_delete/<?php echo intval($recommendation->get_id()) ?>" class="btn btn-sm btn-block" data-toggle="deleteAction" message="<?php echo lang('Are you sure ?')?>">
                                        <span class="btn-label-icon left icon fa fa-trash" aria-hidden="true"></span>
                                        <?php echo lang('Delete') ?>
                                    </a>
                                <?php } ?>
                                <?php if ($is_admin){ ?>
                                    <a href="/accreditation/reviewer_visit/action_list/<?php echo htmlfilter($recommendation->get_type()) ?>/<?php echo intval($recommendation->get_type_id()) ?>/<?php echo intval($recommendation->get_id()) ?>" class="btn btn-sm btn-block" >
                                        <span class="btn-label-icon left icon fa fa-tasks" aria-hidden="true"></span>
                                        <?php echo lang('Action Plans') ?>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="text-center m-a-0"><?php echo lang("There is no") . ' ' . lang('Recommendations'); ?></h3>
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