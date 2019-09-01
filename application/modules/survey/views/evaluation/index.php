<?php
/** @var $survey Orm_Survey */

$this->load->helper('text');
$survey_type = Orm_Survey::get_survey_type($survey->get_type());
?>
<form method="GET">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label class="sr-only" for="form-inline-input-8"><?php echo lang('Description'); ?></label>
                <input type="text" class="form-control" id="form-inline-input-8" placeholder="<?php echo lang('Description'); ?>" name="fltr[keyword]" value="<?php echo (isset($fltr['keyword']) ? htmlfilter($fltr['keyword']) : '') ?>">
            </div>
        </div>
        <div class="col-md-2">
            <input type="hidden" name="survey_id" value="<?php echo intval($survey->get_id()); ?>"/>

            <button class="btn btn-block" type="submit">
                    <span class="btn-label-icon left">
                        <i class="fa fa-filter"></i>
                    </span>
                <?php echo lang('Filters'); ?>
            </button>
        </div>
        <div class="col-md-2">
            <a class="btn btn-block" href="<?php echo base_url('survey/evaluation?survey_id=' . intval($survey->get_id())) ?>">
                <span class="btn-label-icon left">
                    <i class="fa fa-recycle"></i>
                </span>
                <?php echo lang('Reset'); ?>
            </a>
        </div>
    </div>
</form>

<hr class="page-block m-t-0">

<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Evaluations') . ' - ' . htmlfilter($survey->get_title()); ?></span>
        <?php if(intval($survey->get_type()) !== Orm_Survey::TYPE_COURSES) { ?>
            <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-evaluation")): ?>
                <a class="btn btn-sm pull-right" href="/survey/evaluation/create?survey_id=<?php echo urlencode($survey->get_id()); ?>">
                    <span class="btn-label-icon left  icon fa fa-plus"></span> <?php echo lang('Add'); ?>
                </a>
                <div class="clearfix"></div>
            <?php endif; ?>
        <?php } ?>
    </div>
    <?php if ($items): ?>
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
            <?php foreach ($items as $item) : /** @var $item Orm_Survey_Evaluation */ ?>
                <tr>
                    <td><?php echo word_limiter(strip_tags($item->get_description()), 5); ?></td>
                    <td><?php echo htmlfilter($item->get_date_format()); ?></td>
                    <td><?php echo htmlfilter($item->get_respondent()); ?></td>
                    <td>
                        <?php $progress = $item->get_respondent(true); ?>
                        <div id="c3-gauge-<?php echo $item->get_id() ?>" style="height: 100px;"></div>
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
                                        bindto: '#c3-gauge-<?php echo $item->get_id() ?>',
                                        color: {pattern: ['<?php echo get_chart_color($progress) ?>']},
                                        data: data
                                    });
                                });
                            });
                        </script>
                    </td>
                    <td class="text-center">
                        <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-report")): ?>
                            <a href="/survey/report/evaluation/<?php echo urlencode($item->get_id()); ?>?survey_id=<?php echo urlencode($item->get_survey_id()); ?>"
                               class="btn btn-block "><span class="btn-label-icon left fa fa-bar-chart"></span><?php echo lang('Results') ?></a>
                        <?php endif; ?>

                        <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-evaluation")): ?>
                            <a href="/survey/evaluation/remind/<?php echo urlencode($item->get_id()); ?>?survey_id=<?php echo urlencode($item->get_survey_id()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-clock-o"></span><?php echo lang('Remind') ?></a>
                            <a href="/survey/evaluation/preview/<?php echo urlencode($item->get_id()); ?>?survey_id=<?php echo urlencode($item->get_survey_id()); ?>"
                               class="btn btn-block "><span class="btn-label-icon left fa fa-eye"></span><?php echo lang('Preview') ?></a>

                            <?php if ($item->get_created_by() == $logged_user_id): ?>
                                <a
                                    href="/survey/evaluation/edit/<?php echo urlencode($item->get_id()); ?>?survey_id=<?php echo urlencode($item->get_survey_id()); ?>"
                                    class="btn btn-block "><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit & Resend') ?></a>
                                <a
                                    href="/survey/evaluation/delete/<?php echo urlencode($item->get_id()); ?>?survey_id=<?php echo urlencode($item->get_survey_id()); ?>"
                                    class="btn btn-block "
                                    message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left fa fa-trash-o"></span><?php echo lang('Delete') ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
         <?php if (!empty($pager)): ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
         <?php endif; ?>
         <?php else: ?>
            <div class="box p-a-1">
                <?php echo lang('There are no') . ' ' . lang('Evaluations'); ?>
                <?php if(intval($survey->get_type()) !== Orm_Survey::TYPE_COURSES) { ?>
                    <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-evaluation")): ?>
                        <a href="/survey/evaluation/create?survey_id=<?php echo urlencode($survey->get_id()); ?>"><?php echo lang('Create').' '.lang('Evaluation'); ?></a>
                    <?php endif; ?>
                <?php } ?>
            </div>
    <?php endif; ?>
</div>

