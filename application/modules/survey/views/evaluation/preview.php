<?php
/**
 * @var $survey Orm_Survey
 * @var $evaluation Orm_Survey_Evaluation
 **/

$survey_type = Orm_Survey::get_survey_type($survey->get_type());
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

        <?php if(intval($survey->get_type()) !== Orm_Survey::TYPE_COURSES) { ?>

            <div class="box p-a-1">
                <div >
                    <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>"
                            type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false"
                            aria-controls="filters">
                        <span class="fa fa-filter"></span>
                    </button>
                    <?php echo lang($survey->get_type(true)) ?>
                </div>
            </div>

            <form method="GET" class="form-horizontal">
                <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
                    <div class="well">
                        <?php
                        switch ($survey->get_type()) {
                            case Orm_Survey::TYPE_ALUMNI :
                                echo Orm_User_Alumni::draw_filters();
                                break;

                            case Orm_Survey::TYPE_EMPLOYER :
                                echo Orm_User_Employer::draw_filters();
                                break;

                            case Orm_Survey::TYPE_FACULTY :
                                echo Orm_User_Faculty::draw_filters();
                                break;

                            case Orm_Survey::TYPE_STAFF :
                                echo Orm_User_Staff::draw_filters();
                                break;

                            case Orm_Survey::TYPE_STUDENTS :
                                echo Orm_User_Student::draw_filters();
                                break;
                        }
                        ?>
                        <input type="hidden" name="survey_id" value="<?php echo intval($survey->get_id()); ?>"/>

                        <div class="clearfix">
                            <a class="btn pull-left "
                               href="<?php echo preg_replace('/(.*)\?(.*)/', '$1?survey_id=' . intval($survey->get_id()), $this->input->server('REQUEST_URI')) ?>"><span class="btn-label-icon left"><i class="fa fa-recycle"></i></span><?php echo lang('Reset'); ?></a>
                            <button class="btn pull-right " type="submit"><span class="btn-label-icon left"><i class="fa fa-filter"></i></span><?php echo lang('Filters'); ?></button>
                        </div>
                    </div>
                </div>
            </form>

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
                        /** @var $evaluator Orm_Survey_Evaluator */
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
                                    <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-report")) { ?>
                                        <a href="/survey/report/evaluator/<?php echo intval($evaluator->get_id()); ?>?survey_id=<?php echo intval($survey->get_id()); ?>"
                                           class="btn btn-block"><span class="btn-label-icon left fa fa-bar-chart"></span><?php echo lang('Results') ?></a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <?php if (Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) { ?>
                                        <a href="<?php echo $evaluator->get_response_link(); ?>"
                                           class="btn btn-block"><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Submit') ?></a>
                                    <?php } ?>
                                <?php } ?>
                                <a href="/survey/evaluation/evaluator_remind/<?php echo intval($evaluator->get_id()); ?>?survey_id=<?php echo intval($survey->get_id()); ?>"
                                   class="btn btn-block"><span class="btn-label-icon left fa fa-clock-o"></span><?php echo lang('Remind') ?></a>
                                <a href="/survey/evaluation/evaluator_delete/<?php echo intval($evaluator->get_id()); ?>?survey_id=<?php echo intval($survey->get_id()); ?>"
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
