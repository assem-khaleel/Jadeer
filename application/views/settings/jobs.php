<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 6/1/16
 * Time: 10:23 AM
 */
?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <span class="table-caption"><?php echo lang('Jobs'); ?></span>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="col-md-1">#</th>
                <th class="col-md-3"><?php echo lang('Cli'); ?></th>
                <th class="col-md-3"><?php echo lang('Job'); ?></th>
                <th class="col-md-2"><?php echo lang('Params'); ?></th>
                <th class="col-md-2"><?php echo lang('Schedule'); ?></th>
                <th class="col-md-1"><?php echo lang('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $jobs = Orm_Cron_Job::get_jobs();
            if ($jobs) {
                $i = 0;
                ?>
                <?php foreach ($jobs as $job_key => $job) { ?>
                    <?php
                    $url = base_url('/settings/');
                    $form_id = 'form_' . trim($job['cli']) . '_' . trim($job['job']);
                    $hint = isset($job['hint']) ? "<div class='text-muted font-italic'>{$job['hint']}</div>" : '';
                    ?>
                    <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo htmlfilter($job['cli']) . $hint; ?></td>
                        <td><?php echo htmlfilter($job['job']); ?></td>
                        <td>
                            <?php echo form_open("", array('id' => $form_id)) ?>
                            <?php if (!empty($job['params'])) { ?>
                                <?php foreach ($job['params'] as $key => $param) { ?>
                                    <label><?php echo $key ?></label>
                                    <?php if (strpos($param, 'Orm_') === 0) { ?>
                                        <select class="form-control" name="params[<?php echo $key ?>]">
                                            <?php foreach ($param::get_all() as $item) { ?>
                                                <option value="<?php echo $item->get_id() ?>"><?php echo $item->get_name(); ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <input class="form-control" type="text" name="params[<?php echo $key ?>]">
                                    <?php } ?>
                                <?php } ?>
                            <?php } else { echo '-'; } ?>
                            <input type="hidden" name="job" value="<?php echo trim(trim($job['cli']) . ' ' . trim($job['job'])); ?>">
                            <input type="hidden" name="job_key" value="<?php echo $job_key; ?>">
                        </td>
                        <td>
                            <?php if ($job['schedule']) { ?>
                                <select class="form-control" name="schedule">
                                    <?php foreach (Orm_Cron_Job::$SCHEDULE_ARRAY as $key => $schedule) { ?>
                                        <?php $selected = ($key == $job['schedule'] ? 'selected="selected"' : '') ?>
                                        <option value="<?php echo $key; ?>" <?php echo $selected ?>><?php echo lang($schedule); ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                            <?php echo form_close(); ?>
                        </td>
                        <td>
                            <a href="javascript: void(0);" onclick="$('#<?php echo $form_id; ?>').submit();" class="btn btn-sm btn-block">
                                <span class="btn-label-icon left"><i class="fa fa-fire"></i></span>
                                <?php echo lang('Run'); ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang("There are no").' '.lang("Jobs") ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="table-primary">
        <div class="table-header">
            <span class="table-caption"><?php echo lang('Scheduled Tasks'); ?></span>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="col-md-1"><?php echo lang('Status'); ?></th>
                <th class="col-md-4"><?php echo lang('Job'); ?></th>
                <th class="col-md-3"><?php echo lang('Owner'); ?></th>
                <th class="col-md-2"><?php echo lang('Date Released'); ?></th>
                <th class="col-md-1"><?php echo lang('Schedule'); ?></th>
                <th class="col-md-1"><?php echo lang('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $jobs = Orm_Cron_Job::get_all();
            if ($jobs) {
                ?>
                <?php foreach ($jobs as $job) { ?>
                    <tr>
                        <td class="align-center">
                            <?php if($job->get_is_released()) { ?>
                                <i class="fa fa-check text-success valign-middle" style="font-size: 18px;"></i>
                            <?php } else { ?>
                                <i class="fa fa-power-off  text-info valign-middle" style="font-size: 18px;"></i>
                            <?php } ?>
                        </td>
                        <td><?php echo htmlfilter($job->get_job()); ?></td>
                        <td><?php echo htmlfilter($job->get_user_added_obj()->get_full_name()); ?></td>
                        <td><?php echo htmlfilter($job->get_date_released()); ?></td>
                        <td>
                            <?php echo htmlfilter(isset(Orm_Cron_Job::$SCHEDULE_ARRAY[$job->get_schedule()]) ? lang(Orm_Cron_Job::$SCHEDULE_ARRAY[$job->get_schedule()]) : '-'); ?>
                        </td>
                        <td>
                            <a href="/settings/job_delete/<?php echo $job->get_id() ?>" class="btn btn-sm btn-block">
                                <span class="btn-label-icon left"><i class="fa fa-trash-o"></i></span>
                                <?php echo lang('Delete'); ?>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang("There are no").' '.lang("Scheduled Tasks") ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
