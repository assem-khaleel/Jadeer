<?php 
/* @var $surveys Orm_Survey[] */
$access_report = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_advisory-report");
$manage = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_advisory-manage");
$user = Orm_Ad_Faculty_Program::get_one(['faculty_id'=>Orm_User::get_logged_user()->get_id()]);
$evaluation = Orm_Ad_Faculty_Program::can_evaluation();
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption">  <?php echo lang('Advisory Survey') ?></span>
        <?php
        echo filter_block('/advisory/ad_advisory/filter', '/advisory/Ad_Survey', ['keyword'], 'ajax_block');
        ?>
    </div>
    <?php if (empty($surveys)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Advisory Survey'); ?>
                <?php if(Orm_Ad_Faculty_Program::check_if_can_add() && Orm_Ad_Faculty_Program::can_add_survey()){?>
                    <span>
                         <a class="btn btn-block"
                            href="/advisory/Ad_Survey/add_survey" data-toggle="ajaxModal"><span
                                 class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add') . ' ' . lang('Survey'); ?>
                    </a>
                    </span>

                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-3"><?php echo lang('Name'); ?></th>
                <th class="col-lg-3"><?php echo lang('Last Invitation'); ?></th>
                <th class="col-lg-1"><?php echo lang('Design'); ?></th>
                <?php if($evaluation){?>
                    <th class="col-lg-1"><?php echo lang('Evaluations'); ?></th>
                <?php } ?>

                <?php if ($access_report): ?>
                    <th class="col-md-1 text-center"><?php echo lang('Results') ?></th>
                <?php endif; ?>
                <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($surveys as $survey) {
                ?>
                <tr>
                    <td>
                        <?php echo htmlfilter($survey->get_title()) ?>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($survey->get_date_format()) ?></span>
                    </td>
                    <td class="text-center valign-middle" title="<?php echo lang('Invite Student')?>">
                        <a class="text-warning" href="/survey/design?survey_id=<?php echo urlencode($survey->get_id()); ?>" title="<?php echo lang('Add Questions and control the layout and structure of your survey') ?>">
                            <i class="fa fa-edit fa-2x" ></i>
                        </a>

                    </td>
                    <?php if($evaluation){ ?>
                    <td class="text-center valign-middle">
                        <a class="text-warning" href="/advisory/Ad_Survey/evaluation/<?php echo urlencode($survey->get_id()); ?>" title="<?php echo lang('view your launced surveys and edit them') ?>">
                            <i class="fa fa-users fa-2x"></i>
                        </a>

                    </td>
                    <?php } ?>
                    <?php if ($access_report): ?>
                        <td class="text-center valign-middle">
                            <a class="text-warning" href="/survey/report?survey_id=<?php echo urlencode($survey->get_id()); ?>" title="<?php echo lang('View').' '.lang('survey results') ?>">
                                <i class="fa fa-bar-chart fa-2x"></i>
                            </a>
                        </td>
                    <?php endif; ?>

                    <td class="td last_column_border text-center">
                        <?php if ($access_report): ?>
                            <a href="/survey/report/summary/1?survey_id=<?php echo urlencode($survey->get_id()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-bars"></span><?php echo lang('Summary') ?></a>
                            <a href="/survey/report/summary/2?survey_id=<?php echo urlencode($survey->get_id()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-pie-chart"></span><?php echo lang('Summary (Details)') ?></a>
                            <a href="/survey/report/details?survey_id=<?php echo urlencode($survey->get_id()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-asterisk"></span><?php echo lang('Details') ?></a>
                        <?php endif; ?>
                        <?php if ($manage): ?>
                            <a href="/survey/preview/<?php echo urlencode($survey->get_id()); ?>?type=<?php echo urlencode($survey->get_type()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-eye"></span><?php echo lang('Preview') ?></a>
                            <?php if($user->check_if_can_edit()){ ?>
                            <a class="btn btn-block" data-toggle="ajaxModal"
                               href="/advisory/Ad_Survey/edit_survey/<?php echo intval($survey->get_id())?>"><span
                                    class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>

                            <?php } ?>
                            <?php if($user->check_if_can_delete()){ ?>
                        <a class="btn btn-block"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction"
                           href="/advisory/Ad_Survey/delete_survey/<?php echo intval($survey->get_id())?>"><span
                                class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                            <?php } ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    <?php } ?>
</div>
