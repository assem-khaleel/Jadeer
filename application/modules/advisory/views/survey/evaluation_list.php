<?php
/* @var $evaluations Orm_Survey_Evaluation[] */
$access_report = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_advisory-report");
$manage = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_advisory-manage");
$can_evaluation = Orm_Ad_Faculty_Program::can_evaluation();
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption">  <?php echo lang('Advisory Survey Evaluations') ?></span>
        <?php
        $extra_html =  form_hidden('survey_id', $survey_id);
        echo filter_block('/advisory/ad_advisory/evaluation_filter', '/advisory/Ad_Survey/evaluation/'.$survey_id, ['keyword'], 'ajax_block',$extra_html);
        ?>
    </div>
    <?php if (empty($evaluations)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Advisory Survey Evaluations'); ?>
                <?php if(Orm_Ad_Faculty_Program::check_if_can_add() && Orm_Ad_Faculty_Program::can_add_survey()){?>
                    <span>
                         <a class="btn btn-block"
                            href="/advisory/Ad_Survey/add_evaluation/<?php echo urlencode($survey_id)?>"><span
                                 class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add') . ' ' . lang('Evaluation'); ?>
                    </a>
                    </span>

                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-5"><?php echo lang('Description'); ?></th>
                <th class="col-md-2"><?php echo lang('Created'); ?></th>
                <th class="col-md-1"><?php echo lang('Respondent'); ?></th>
                <th class="col-md-2"><?php echo lang('Progress'); ?></th>
                <th class="col-md-2 text-center"><?php echo lang('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($evaluations as $evaluation) { ?>
                <tr>
                    <td><?php echo word_limiter(strip_tags($evaluation->get_description()),5) ?></td>
                    <td><?php echo htmlfilter($evaluation->get_date_format()); ?></td>
                    <td><?php echo htmlfilter($evaluation->get_respondent()); ?></td>
                    <td>
                        <?php $progress = $evaluation->get_respondent(true); ?>
                        <div id="c3-gauge-<?php echo $evaluation->get_id() ?>" style="height: 100px;"></div>
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
                                        bindto: '#c3-gauge-<?php echo $evaluation->get_id() ?>',
                                        color: {pattern: ['<?php echo get_chart_color($progress) ?>']},
                                        data: data
                                    });
                                });
                            });
                        </script>
                    </td>
                   <td class="text-center">
                       <?php if ($access_report): ?>
                           <a href="/survey/report/evaluation/<?php echo urlencode($evaluation->get_id()); ?>?survey_id=<?php echo urlencode($evaluation->get_survey_id()); ?>"
                              class="btn btn-block "><span class="btn-label-icon left fa fa-bar-chart"></span><?php echo lang('Results') ?></a>
                       <?php endif; ?>

                       <?php if ($can_evaluation): ?>
                           <a href="/advisory/Ad_Survey/remind/<?php echo urlencode($evaluation->get_id()); ?>?survey_id=<?php echo urlencode($evaluation->get_survey_id()); ?>"
                              class="btn btn-block"><span class="btn-label-icon left fa fa-clock-o"></span><?php echo lang('Remind') ?></a>
                           <a href="/advisory/Ad_Survey/preview/<?php echo urlencode($evaluation->get_id()); ?>?survey_id=<?php echo urlencode($evaluation->get_survey_id()); ?>"
                              class="btn btn-block "><span class="btn-label-icon left fa fa-eye"></span><?php echo lang('Preview') ?></a>

                           <?php if ($evaluation->get_created_by() == $logged_user): ?>
                               <a href="/advisory/Ad_Survey/edit_evaluation/<?php echo urlencode($evaluation->get_survey_id()); ?>/<?php echo urlencode($evaluation->get_id()); ?>"
                                   class="btn btn-block ">
                                   <span class="btn-label-icon left fa fa-edit"></span>
                                   <?php echo lang('Edit & Resend') ?>
                               </a>
                               <a
                                   href="/advisory/Ad_Survey/delete_evaluation/<?php echo urlencode($evaluation->get_survey_id()); ?>/<?php echo urlencode($evaluation->get_id()); ?>"
                                   class="btn btn-block "
                                   message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left fa fa-trash-o"></span><?php echo lang('Delete') ?></a>
                           <?php endif; ?>
                       <?php endif; ?>
                   </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    <?php } ?>
</div>
