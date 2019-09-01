<?php
$items = array();
if (isset($institutional_active_node) && $institutional_active_node->get_id()) {
    $items[$institutional_active_node->get_id()]['node'] = $institutional_active_node;
    $items[$institutional_active_node->get_id()]['url'] = "/accreditation/item/{$institutional_active_node->get_id()}";
}

if (isset($ssr_active_node) && $ssr_active_node->get_id()) {
    $items[$ssr_active_node->get_id()]['node'] = $ssr_active_node;
    $items[$ssr_active_node->get_id()]['url'] = "/accreditation/national_ssr";
}

if (isset($program_active_node) && $program_active_node->get_id()) {
    $items[$program_active_node->get_id()]['node'] = $program_active_node;
    $items[$program_active_node->get_id()]['url'] = "/accreditation/national_program";
}

if (isset($course_active_node) && $course_active_node->get_id()) {
    $items[$course_active_node->get_id()]['node'] = $course_active_node;
    $items[$course_active_node->get_id()]['url'] = "/accreditation/national_course";
}
/* 2018 new accreditation*/

if (isset($institutional2018_active_node) && $institutional2018_active_node->get_id()) {
    $items[$institutional2018_active_node->get_id()]['node'] = $institutional2018_active_node;
    $items[$institutional2018_active_node->get_id()]['url'] = "/accreditation/item/{$institutional2018_active_node->get_id()}";
}

if (isset($ssr2018_active_node) && $ssr2018_active_node->get_id()) {
    $items[$ssr2018_active_node->get_id()]['node'] = $ssr2018_active_node;
    $items[$ssr2018_active_node->get_id()]['url'] = "/accreditation/national_ssr18";
}

if (isset($program2018_active_node) && $program2018_active_node->get_id()) {
    $items[$program2018_active_node->get_id()]['node'] = $program2018_active_node;
    $items[$program2018_active_node->get_id()]['url'] = "/accreditation/national_program18";
}

if (isset($course2018_active_node) && $course2018_active_node->get_id()) {
    $items[$course2018_active_node->get_id()]['node'] = $course2018_active_node;
    $items[$course2018_active_node->get_id()]['url'] = "/accreditation/national_course18";
}


?>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered table-header">
            <thead>
            <tr class="bg-primary">
                <td class="<?php echo(Orm_Node::check_if_can_generate(true) ? 'col-md-3' : 'col-md-5') ?>">
                    <b><?php echo lang('Accreditation Name') ?></b>
                </td>
                <td class="col-md-1">
                    <b><?php echo lang('Year') ?></b>
                </td>
                <td class="col-md-2">
                    <b><?php echo lang('Progress') ?></b>
                </td>
                <td class="col-md-2">
                    <b><?php echo lang('Review') ?></b>
                </td>
                <td class="<?php echo(Orm_Node::check_if_can_generate(true) ? 'col-md-4' : 'col-md-2') ?> text-center">
                    <b><?php echo lang('Action') ?></b>
                </td>
            </tr>
            </thead>
            <tbody>
            <?php if ($items): ?>
                <?php foreach ($items as $item) :
                    $node = $item['node'];
                    /* @var $node Orm_Node */ ?>
                    <tr>
                        <td>
                            <?php echo htmlfilter($node->get_name()); ?>
                        </td>
                        <td>
                            <?php echo $node->get_year() ?>
                        </td>
                        <td>
                            <?php $progress = $node->get_progress_score() ?>
                            <div id="progress-gauge-<?php echo  $node->get_id() ?>" style="height: 100px"></div>
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
                                            bindto: '#progress-gauge-<?php echo $node->get_id() ?>',
                                            color: {pattern: ['<?php echo get_chart_color($progress)?>']},
                                            data: data
                                        });
                                    });
                                });
                            </script>
                        </td>
                        <td>
                            <?php $review = $node->get_review_score() ?>
                            <div id="review-gauge-<?php echo $node->get_id() ?>" style="height: 100px"></div>
                            <script>
                                pxInit.push(function () {
                                    $(function () {
                                        var data = {
                                            columns: [
                                                ['<?php echo lang('Progress') ?>', <?php echo $review ?>]
                                            ],
                                            type: 'gauge'
                                        };

                                        c3.generate({
                                            bindto: '#review-gauge-<?php echo  $node->get_id() ?>',
                                            color: {pattern: ['<?php echo get_chart_color($review)?>']},
                                            data: data
                                        });
                                    });
                                });
                            </script>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo $item['url'] ?>" class="btn btn-block"  style="margin-bottom: 3px;">
                                <span class="btn-label-icon left fa fa-cogs" aria-hidden="true"></span>
                                <?php echo lang('Manage'); ?>
                            </a>

                            <?php if (Orm_Node::check_if_can_generate(true)): ?>
                                <a href="/accreditation/due_date/<?php echo intval($node->get_id()) ?>" data-toggle="ajaxModal" class="btn btn-block"  style="margin-bottom: 3px;">
                                    <span class="btn-label-icon left fa fa-calendar" aria-hidden="true"></span>
                                    <?php echo lang('Due Date'); ?>
                                </a>
                                <a href="/accreditation/delete/<?php echo intval($node->get_id()) ?>" data-toggle="deleteAction" class="btn btn-block"  style="margin-bottom: 3px;" message="<?php echo lang('Are you sure ?')?>">
                                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                    <?php echo lang('Delete'); ?>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" style="text-align: center;">
                        <div class="well well-sm m-a-0">
                            <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Accreditations'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>