<?php
/* @var $maps Orm_Tm_Survey[] */
$access_report = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_training-report");
$manage = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_training-manage");
$training = Orm_Tm_Training::get_instance($training_id);
$type = Orm_Tm_Type::get_instance($training->get_type_id());
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption">  <?php echo Orm_Tm_Training::get_instance($training_id)->get_name().' '.lang('Surveys') ?></span>
    </div>
    <?php if (empty($maps)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Survey Mapped with this training'); ?>
            </div>
        </div>
    <?php } else { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-4"><?php echo lang('Name'); ?></th>
                <th class="col-lg-3"><?php echo lang('Last Invitation'); ?></th>
                <th class="col-lg-1"><?php echo lang('Design'); ?></th>
                <?php if ($access_report): ?>
                    <th class="col-md-1 text-center"><?php echo lang('Results') ?></th>
                <?php endif; ?>
                <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($maps as $map) {
                $survey = Orm_Survey::get_instance($map->get_survey_id());
                ?>
                <tr>
                    <td>
                        <?php echo htmlfilter($survey->get_title()) ?>
                        <span class="text-warning">

                         ( <?php echo lang( $map->get_status(true)).' '.$type->get_name().' '.lang('Survey') ?> )

                        </span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($survey->get_date_format()) ?></span>
                    </td>
                    <td class="text-center valign-middle">
                        <a class="text-warning" href="/survey/design?survey_id=<?php echo urlencode($survey->get_id()); ?>" title="<?php echo lang('Add Questions and control the layout and structure of your survey') ?>">
                            <i class="fa fa-edit fa-2x" ></i>
                        </a>
                    </td>
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
                            
                            <a href="/training_management/invite/<?php echo urlencode($map->get_training_id())?>/<?php echo urlencode($survey->get_id()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-users"></span><?php echo lang('Invite') ?></a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    <?php } ?>
</div>