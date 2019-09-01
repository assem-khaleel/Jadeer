<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/26/17
 * Time: 10:23 AM
 */
?>
<div class="panel" id="tasks">
    <div class="panel-heading p-a-3">
        <span class="panel-title">
            <i class="panel-title-icon fa fa-tasks"></i><?php echo lang('Tasks') ?>
        </span>

        <div class="panel-heading-controls">
            <ul class="pagination pagination-xs">
                <li id="my_tasks">
                    <a href="/tasks/my_tasks" data-toggle="ajaxRequest" data-scroll="false" data-target="tasks-container"><?php echo lang('My Tasks') ?></a>
                </li>
                <li id="sent_tasks">
                    <a href="/tasks/sent_tasks" data-toggle="ajaxRequest" data-scroll="false" data-target="tasks-container"><?php echo lang('Sent Tasks') ?></a>
                </li>
                <li>
                    <a class="label" data-toggle="ajaxModal" href="/tasks/add_edit"><?php echo lang('Add').' '.lang('New') ?></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="ps-block ps-container ps-theme-default ps-active-y" id="tasks-container" style="height: 297px;">
        <?php echo isset($content_widget) ? $content_widget : $this->load->view('tasks/my_tasks'); ?>
    </div>
</div>

<script>
    $('#tasks').on('click', "input[type='checkbox']", function () {
        var id = $(this).val();

        $.get('/tasks/set_done/' + id, {checked: $(this).prop('checked') ? 1 : 0});
    });
</script>