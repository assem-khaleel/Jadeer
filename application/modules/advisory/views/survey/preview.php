<?php
/* @var  $evaluation Orm_Survey_Evaluation */
/* @var $evaluators Orm_Survey_Evaluator[]*/
$access_report = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_advisory-report");
$manage = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_advisory-manage");
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title">
            <?php echo lang('Preview Evaluation') ?>
        </span>
    </div>
    <div class="panel-body">
        <?php if ($evaluation->get_description()) { ?>
            <div class="form-group row m-b-0">
                <label class="col-sm-3" for="description"><?php echo lang('Description') ?></label>

                <div class="col-sm-9">
                    <div id="description" class="well well-sm"><?php echo htmlfilter($evaluation->get_description()) ?></div>
                </div>
            </div>

            <hr class="page-block m-t-0">
        <?php } ?>
        

        <div class="table-primary">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-3 text-center valign-middle"><?php echo lang('Name') ?></th>
                    <th class="col-md-3"><?php echo lang('Submission Date') ?></th>
                    <th class="col-md-3"><?php echo lang('Progress') ?></th>
                    <th class="text-center col-md-3"><?php echo lang('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($evaluators) {
                    foreach ($evaluators as $evaluator) {
                        ?>
                        <tr>
                            <td><?php echo htmlfilter($evaluator->get_user_obj()->get_full_name()) ?></td>
                            <td>
                                <?php
                                if ($evaluator->get_response_status()) {
                                    $progress = 100;
                                    echo $evaluator->get_response_date();
                                } else {
                                    $progress = 0;
                                    echo lang('Not Submitted');
                                }
                                ?>
                            </td>
                            <td>
                                <div id="c3-gauge-<?php echo $evaluator->get_id()?>" style="height: 100px"></div>
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
                                                bindto: '#c3-gauge-<?php echo $evaluator->get_id()?>',
                                                color: {pattern: ['<?php echo  get_chart_color($progress)?>']},
                                                data: data
                                            });
                                        });
                                    });
                                </script>
                            </td>
                            <td class="text-center">
                                <?php if ($evaluator->get_response_status()) { ?>
                                    <?php if ($access_report) { ?>
                                        <a href="/survey/report/evaluator/<?php echo intval($evaluator->get_id()); ?>?survey_id=<?php echo intval($evaluation->get_survey_id()); ?>"
                                           class="btn btn-block"><span class="btn-label-icon left fa fa-bar-chart"></span><?php echo lang('Results') ?></a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) { ?>
                                        <a href="<?php echo $evaluator->get_response_link(); ?>"
                                           class="btn btn-block"><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Submit') ?></a>
                                    <?php } ?>
                                <?php } ?>
                                <a href="/advisory/Ad_Survey/evaluator_remind/<?php echo intval($evaluator->get_id()); ?>?survey_id=<?php echo intval($evaluation->get_survey_id()); ?>"
                                   class="btn btn-block"><span class="btn-label-icon left fa fa-clock-o"></span><?php echo lang('Remind') ?></a>
                                <a href="/advisory/Ad_Survey/evaluator_delete/<?php echo intval($evaluator->get_id()); ?>?survey_id=<?php echo intval($evaluation->get_survey_id()); ?>"
                                   class="btn btn-block"
                                   message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left fa fa-trash-o"></span><?php echo lang('Delete') ?></a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
            <?php if ($pager) { ?>
                <div class="table-footer"><?php echo $pager; ?></div>
            <?php } ?>
        </div>

    </div>
</div>

