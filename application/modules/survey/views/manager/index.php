<?php
$survey_type = Orm_Survey::get_survey_type($type);
$access_report = Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-report");
?>

<form method="GET">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label class="sr-only" for="form-inline-input-8"><?php echo lang('Title'); ?></label>
                <input type="text" class="form-control" id="form-inline-input-8" placeholder="<?php echo lang('Title'); ?>" name="fltr[keyword]" value="<?php echo (isset($fltr['keyword']) ? htmlfilter($fltr['keyword']) : '') ?>">
            </div>
        </div>
        <div class="col-md-2">
            <input type="hidden" name="type" value="<?php echo intval($type); ?>"/>

            <button class="btn btn-block" type="submit">
                    <span class="btn-label-icon left">
                        <i class="fa fa-filter"></i>
                    </span>
                <?php echo lang('Filters'); ?>
            </button>
        </div>
        <div class="col-md-2">
            <a class="btn btn-block" href="<?php echo base_url('survey?type=' . intval($type)) ?>">
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
        <span class="table-caption"><?php echo lang($survey_type); ?> <?php echo lang('Surveys'); ?></span>
    </div>
    <?php if ($items): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="<?php echo $access_report ? 'col-md-5' : 'col-md-6' ?>"><?php echo lang('Survey Title'); ?></th>
                <th class="col-md-1"><?php echo lang('Last Invitation'); ?></th>
                <th class="col-md-1 text-center"><?php echo lang('Design') ?></th>
                <th class="col-md-1 text-center"><?php echo lang('Evaluations') ?></th>
                <?php if ($access_report): ?>
                    <th class="col-md-1 text-center"><?php echo lang('Results') ?></th>
                <?php endif; ?>
                <th class="col-md-3 text-center"><?php echo lang('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item) : /* @var $item Orm_Survey */ ?>
                <tr>
                    <td class="valign-middle"><?php echo htmlfilter($item->get_title()); ?></td>
                    <td class="valign-middle"><?php echo htmlfilter($item->get_date_format()); ?></td>
                    <td class="text-center valign-middle">
                        <?php if ($item->get_created_by() == $logged_user_id): ?>
                            <a class="text-warning" href="/survey/design?survey_id=<?php echo urlencode($item->get_id()); ?>" title="<?php echo lang('Add Questions and control the layout and structure of your survey') ?>">
                                <i class="fa fa-edit fa-2x" ></i>
                            </a>
                        <?php else: ?>
                            <a class="text-default" title="<?php echo lang('This survey was created by another user you cannot edit the layout or the survey structure') ?>">
                                <i class="fa fa-edit fa-2x"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                    <td class="text-center valign-middle">
                        <a class="text-warning" href="/survey/evaluation?survey_id=<?php echo urlencode($item->get_id()); ?>" title="<?php echo lang('view your launced surveys and edit them') ?>">
                            <i class="fa fa-users fa-2x"></i>
                        </a>
                    </td>
                    <?php if ($access_report): ?>
                        <td class="text-center valign-middle">
                            <a class="text-warning" href="/survey/report?survey_id=<?php echo urlencode($item->get_id()); ?>" title="<?php echo lang('View').' '.lang('survey results') ?>">
                                <i class="fa fa-bar-chart fa-2x"></i>
                            </a>
                        </td>
                    <?php endif; ?>
                    <td class="text-center valign-middle">
                        <?php if ($access_report): ?>
                            <a href="/survey/report/summary/1?survey_id=<?php echo urlencode($item->get_id()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-bars"></span><?php echo lang('Summary') ?></a>
                            <a href="/survey/report/summary/2?survey_id=<?php echo urlencode($item->get_id()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-pie-chart"></span><?php echo lang('Summary (Details)') ?></a>
                            <a href="/survey/report/details?survey_id=<?php echo urlencode($item->get_id()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-asterisk"></span><?php echo lang('Details') ?></a>
                        <?php endif; ?>
                        <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-manage")): ?>
                            <a href="/survey/preview/<?php echo urlencode($item->get_id()); ?>?type=<?php echo urlencode($item->get_type()); ?>"
                               class="btn btn-block"><span class="btn-label-icon left fa fa-eye"></span><?php echo lang('Preview') ?></a>

                            <?php if ($item->get_created_by() == $logged_user_id): ?>
                                <a href="/survey/edit/<?php echo urlencode($item->get_id()); ?>?type=<?php echo urlencode($item->get_type()); ?>"
                                   class="btn btn-block"><span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit') ?></a>
                                <a href="/survey/delete/<?php echo urlencode($item->get_id()); ?>"
                                   class="btn btn-block"
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
            <?php echo lang('There are no') . ' ' . lang('Surveys'); ?>
            <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF, Orm_User::USER_FACULTY), false, "survey_{$survey_type}-manage")) { ?>
                <a href="/survey/create/?type=<?php echo $type; ?>"><?php echo lang('Create').' '.lang('Survey'); ?></a>
            <?php } ?>
        </div>
    <?php endif; ?>
</div>

