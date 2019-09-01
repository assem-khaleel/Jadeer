<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/26/17
 * Time: 9:16 AM
 */
/** @var int $per_page */
/** @var int $page */
/** @var $user_id int */

$this->load->helper('text');

$user_id = Orm_User::get_logged_user_id();

$page = $this->input->get_post('page') ?: 1;
$per_page = 6;

$filters = ['to' => $user_id];

$tasks = Orm_Tasks::get_all($filters, $page, $per_page);

$pager = new Pager(array('url' => '/tasks/my_tasks'));
$pager->set_page($page);
$pager->set_per_page($per_page);
$pager->set_total_count(Orm_Tasks::get_count($filters));
$pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="tasks-container"');
$pager->set_pager_class('pagination m-x-3 m-y-0');
$html_pager = $pager->render(true);
?>

<?php if ($tasks) { ?>
    <?php foreach ($tasks as $task) { ?>
        <div class="widget-tasks-item">
            <label class="custom-control custom-checkbox col-md-8">
                <input type="checkbox" class="custom-control-input" value="<?php echo $task->get_id() ?>" <?php echo $task->get_done() ? 'checked="checked"' : '' ?> />
                <span class="label label-<?php echo $task->get_from() != $user_id ? 'warning' : 'info' ?>">
                    <i class="<?php echo $task->get_from() != $user_id ? 'fa fa-user' : 'fa fa-arrow-circle-right' ?>"></i>
                </span>
                <span class="custom-control-indicator"></span>
                <span class="widget-tasks-title"><?php echo character_limiter($task->get_title(), 40) . ($task->get_from() == $user_id ? '' : ' <span style="display: inline-block;">(' . $task->get_from(true)->get_full_name() . ')</span> ') ?></span>&nbsp;&nbsp;
                <span class="widget-tasks-timer"><?php echo $task->get_time() == '0000-00-00' ? lang('N/A') : date('Y-m-d', strtotime($task->get_time())); ?></span>
            </label>
            <div class="col-md-4">
                <div class="pull-right">
                    <a class="btn btn-sm" data-toggle="ajaxModal" href="/tasks/add_edit/<?php echo $task->get_id() ?>">
                        <?php echo $task->get_from() == $user_id ? lang('Edit') : lang('Details'); ?>
                    </a>
                    <?php if ($task->get_from() == $user_id): ?>
                        <a class="btn btn-sm" data-toggle="deleteAction" message="<?php echo lang('Are you sure?') ?>" href="/tasks/delete/<?php echo $task->get_id() ?>">
                            <?php echo lang('Remove'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class='widget-tasks-item'>
        <h4 class="m-a-0 text-center m-t-4"><?php echo lang("There are no").' '.lang('Tasks') ?></h4>
    </div>
<?php } ?>

<?php echo ($html_pager ? "<div style='position: absolute; bottom: 0px;'>{$html_pager}</div>" : '') ?>

<script>
    $('#my_tasks').addClass('active');
    $('#sent_tasks').removeClass('active');
</script>