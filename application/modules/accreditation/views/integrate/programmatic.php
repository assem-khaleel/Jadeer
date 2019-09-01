<?php if (!$this->input->is_ajax_request()) { ?>
    <div id="page-content">
<?php } ?>

<?php
$course_nodes = array();

/**
 * @param $system_number
 * @param $course_id
 * @return Orm_Node
 */
function get_course_node($system_number, $course_id) {

    if(!isset($course_nodes[$system_number][$course_id])) {
        $course_nodes[$system_number][$course_id] = Orm_Node::get_one(array('system_number' => $system_number, 'item_id' => $course_id, 'class_type' => Orm_Node::COURSE_COURSE));
    }

    return $course_nodes[$system_number][$course_id];
}

$fltr = $this->input->get_post('fltr');

$college_id = isset($fltr['college_id']) ? $fltr['college_id'] : 0;

$department_id = isset($fltr['department_id']) ? $fltr['department_id'] : 0;

$program_id = isset($fltr['program_id']) ? $fltr['program_id'] : 0;
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-2">
    <li role="presentation">
        <a href="/accreditation/integrate_ams/institutional"><?php echo lang('Institutional'); ?></a>
    </li>
    <li role="presentation" class="active">
        <a href="/accreditation/integrate_ams/programmatic"><?php echo lang('Programs'); ?></a>
    </li>
</ul>

<div>
    <div>
        <div class="p-a-2 bg-white font-size-15 m-b-2">
            <b><?php echo lang('About'); ?></b>
            <p><?php echo lang('Push to AIMS Note'); ?></p>
        </div>

        <?php
        $ams_logs = Orm_Ams_Log::get_all(array('type' => 'programmatic'), 1, 5, array('al.id DESC'));
        if ($ams_logs) {
            ?>
            <table style="margin:0;" class="table table-striped table-bordered table-header">
                <thead>
                <tr class="bg-primary">
                    <td class="col-md-12" colspan="4">
                        <?php echo lang('Last') . ' (' . count($ams_logs) . ') ' . lang('Push To AIMS') ?>
                    </td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ams_logs as $ams_log) { ?>
                    <tr>
                        <td class="col-md-6">
                            <?php echo nl2br(htmlfilter($ams_log->get_comment())); ?>
                        </td>
                        <td class="col-md-2 text-center">
                            <?php echo htmlfilter($ams_log->get_user_added_obj()->get_full_name()); ?>
                        </td>
                        <td class="col-md-2 text-center">
                            <?php echo htmlfilter($ams_log->get_date_added()); ?>
                        </td>
                        <td class="col-md-2">
                            <a class="btn btn-block"
                               href="<?php echo base_url("/accreditation/integrate_ams/programmatic?log_id=") . $ams_log->get_id() ?>"><span class="btn-label-icon left fa fa-eye"></span><?php echo lang('View').' '.lang('Log') ?></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>

    <div class="well well-table-header">
        <form method="GET">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><?php echo lang('College') ?>:</span>
                        <select class="form-control" name="fltr[college_id]"
                                onchange="get_departments_by_college(this, 1, 1);">
                            <option value=""><?php echo lang('All College') ?></option>
                            <?php foreach (Orm_College::get_all() as $college) { ?>
                                <?php $selected = (isset($fltr['college_id']) && $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : ''); ?>
                                <option
                                    value="<?php echo (int)$college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><?php echo lang('Department') ?>:</span>
                        <select class="form-control" name="fltr[department_id]" id="department_block" onchange="get_programs_by_department(this, 0, 1);">
                            <option value=""><?php echo lang('All Department') ?></option>
                            <?php if (!empty($fltr['college_id'])): ?>
                                <?php foreach (Orm_Department::get_all(array('college_id' => $fltr['college_id'])) as $department) { ?>
                                    <?php $selected = (isset($fltr['department_id']) && $department->get_id() == $fltr['department_id'] ? 'selected="selected"' : ''); ?>
                                    <option
                                        value="<?php echo (int)$department->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($department->get_name()); ?></option>
                                <?php } ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><?php echo lang('Program') ?>:</span>
                        <select class="form-control" name="fltr[program_id]" id="program_block">
                            <option value=""><?php echo lang('All Program') ?></option>
                            <?php if (!empty($fltr['department_id'])): ?>
                                <?php foreach (Orm_Program::get_all(array('department_id' => $fltr['department_id'])) as $program) { ?>
                                    <?php $selected = (isset($fltr['program_id']) && $program->get_id() == $fltr['program_id'] ? 'selected="selected"' : ''); ?>
                                    <option
                                        value="<?php echo (int)$program->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                                <?php } ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-sm btn-block" type="submit"><span class="btn-label-icon left fa fa-search" aria-hidden="true"></span> <?php echo lang('Search') ?></button>
                </div>
            </div>
        </form>
    </div>

    <?php echo form_open("/accreditation/integrate_ams/programmatic", 'id="ams-integration"'); ?>

    <div class="row form-group m-t-2">
        <?php

        if ($program_id) {
            $forms = array();

            $ssr_node = Orm_Node::get_active_ssr_node();

            $program_obj = Orm_Program::get_instance($program_id);

            if ($ssr_node->get_id()) {

                $ssr_node = Orm_Node::get_one(array('system_number' => $ssr_node->get_system_number(), 'class_type' => Orm_Node::PROGRAM_SSR, 'item_id' => $program_id));

                $forms[$program_obj->get_department_obj()->get_college_id()]['name'] = $program_obj->get_department_obj()->get_college_obj()->get_name('english');
                $forms[$program_obj->get_department_obj()->get_college_id()]['programs'][$program_obj->get_id()]['name'] = $program_obj->get_name('english');
                foreach ($ssr_node->get_children() as $child) {
                    $forms[$program_obj->get_department_obj()->get_college_id()]['programs'][$program_obj->get_id()]['forms'][] = $child;
                }
            }

            $program_node = Orm_Node::get_active_program_node();
            if ($program_node->get_id()) {

                $program_node = Orm_Node::get_one(array('system_number' => $program_node->get_system_number(), 'class_type' => Orm_Node::PROGRAM_PROGRAM, 'item_id' => $program_id));

                $forms[$program_obj->get_department_obj()->get_college_id()]['name'] = $program_obj->get_department_obj()->get_college_obj()->get_name('english');
                $forms[$program_obj->get_department_obj()->get_college_id()]['programs'][$program_obj->get_id()]['name'] = $program_obj->get_name('english');
                foreach ($program_node->reset_children()->get_children() as $child) {
                    $forms[$program_obj->get_department_obj()->get_college_id()]['programs'][$program_obj->get_id()]['forms'][] = $child;
                }
            }

            $course_node = Orm_Node::get_active_course_node();
            if ($course_node->get_id()) {

                foreach (Orm_Program_Plan::get_all(array('program_id' => $program_obj->get_id())) as $plan) {

                    $node = get_course_node($course_node->get_system_number(), $plan->get_course_id());

                    if($node->get_id()) {
                        $forms[$program_obj->get_department_obj()->get_college_id()]['name'] = $program_obj->get_department_obj()->get_college_obj()->get_name('english');
                        $forms[$program_obj->get_department_obj()->get_college_id()]['programs'][$program_obj->get_id()]['name'] = $program_obj->get_name('english');
                        $forms[$program_obj->get_department_obj()->get_college_id()]['programs'][$program_obj->get_id()]['courses'][$plan->get_id()]['name'] = $plan->get_course_obj()->get_name('english');
                        $forms[$program_obj->get_department_obj()->get_college_id()]['programs'][$program_obj->get_id()]['courses'][$plan->get_id()]['code'] = $plan->get_course_obj()->get_code('english');

                        foreach ($node->reset_children()->get_children() as $child) {
                            if (get_class($child) == Orm_Node::COURSE_SECTIONS) {
                                continue;
                            }
                            $forms[$program_obj->get_department_obj()->get_college_id()]['programs'][$program_obj->get_id()]['courses'][$plan->get_id()]['forms'][] = $child;
                        }
                    }
                }
            }
        }

        ?>
        <label class="col-sm-2 control-label"><?php echo lang('Forms'); ?></label>

        <div class="col-sm-10">
            <?php if (!empty($forms)) { ?>
                <div id="forms" class="checkbox">
                    <ul>
                        <li><?php echo lang('Select All'); ?>
                            <ul>
                                <?php foreach ($forms as $college) { ?>
                                    <li><?php echo htmlfilter($college['name']); ?>
                                        <ul>
                                            <?php if (!empty($college['programs'])) foreach ($college['programs'] as $program) { ?>
                                                <li><?php echo htmlfilter($program['name']); ?>
                                                    <ul>
                                                        <?php if (!empty($program['forms'])) { ?>
                                                            <?php foreach ($program['forms'] as $form) { ?>
                                                                <li <?php echo(in_array($form->get_id(), $integrate_forms) ? 'data-checkstate="checked"' : ''); ?>
                                                                        id="<?php echo $form->get_id() ?>">
                                                                    <?php echo htmlfilter($form->get_name()); ?>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if (!empty($program['courses'])) { ?>
                                                                <li><?php echo lang('Courses'); ?>
                                                                    <ul>
                                                                        <?php foreach ($program['courses'] as $plan_id => $course) { ?>
                                                                            <li>
                                                                                <?php echo htmlfilter($course['code'] . ' - ' .$course['name']); ?>
                                                                                <ul>
                                                                                    <?php if (!empty($course['forms'])) { ?>
                                                                                        <?php foreach ($course['forms'] as $form) { ?>
                                                                                            <li <?php echo(in_array("course-{$plan_id}-{$form->get_id()}", $integrate_forms) ? 'data-checkstate="checked"' : ''); ?>
                                                                                                    id="<?php echo "course-{$plan_id}-{$form->get_id()}" ?>">
                                                                                                <?php echo htmlfilter($form->get_name()) ?>
                                                                                            </li>
                                                                                        <?php } ?>
                                                                                    <?php } ?>
                                                                                </ul>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                </li>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php }else{ ?>
                <div class="alert m-a-0" >
                    <strong><?php echo lang('Warning') ?>!</strong> <?php echo lang('No program selected'); ?>
                </div>
            <?php } ?>
            <?php echo Validator::get_html_error_message('forms'); ?>
        </div>
    </div>

    <div class="row form-group">
        <label class="col-sm-2 control-label"><?php echo lang('Submission Type'); ?></label>

        <div class="col-sm-10">
            <select name="submission_type" class="form-control">
                <option value="programmatic" <?php echo isset($submission_type) && $submission_type == 'programmatic' ? 'selected="selected"' : ''; ?>><?php echo lang('Programmatic'); ?></option>
                <option value="institutional" <?php echo isset($submission_type) && $submission_type == 'institutional' ? 'selected="selected"' : ''; ?>><?php echo lang('Institutional'); ?></option>
            </select>
            <?php echo Validator::get_html_error_message('submission_type'); ?>
        </div>
    </div>

    <div class="row form-group">
        <label class="col-sm-2 control-label"><?php echo lang('Comment'); ?></label>

        <div class="col-sm-10">
            <textarea name="comment" class="form-control"><?php echo isset($comment) ? htmlfilter($comment) : ''; ?></textarea>
            <?php echo Validator::get_html_error_message('comment'); ?>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <input type="hidden" name="fltr[program_id]" value="<?php echo $program_id ?>">
        <input type="hidden" name="fltr[department_id]" value="<?php echo $department_id ?>">
        <input type="hidden" name="fltr[college_id]" value="<?php echo $college_id ?>">
        <button type="submit" class="btn btn-sm pull-right" <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-paper-plane"></span><?php echo lang('Push To AIMS'); ?></button>
        <div class="clearfix"></div>
    </div>
    <?php echo form_close(); ?>
    <div class="clearfix"></div>
</div>
<script>

    <?php if (!empty($forms)) { ?>
    $(function () {
        var $_tree = $("#forms");

        $_tree.jstree({
            'plugins': ["checkbox"],
            'core': {
                'themes': {
                    'name': 'proton',
                    'responsive': true,
                    icons: false
                }
            }
        });

        $_tree.on("hover_node.jstree", function (e, data) {
            $('a.preview').remove();
            if ($.isNumeric(data.node.id)) {
                $("li#" + data.node.id).find("a.jstree-anchor").after('<a class="preview link" style="margin: 0 10px;" data-toggle="ajaxModal" href="/accreditation/view_all/' + data.node.id + '">preview</a>');
                init_data_toggle();
            } else if (data.node.id.substring(0, 7) == "course-") {
                var res = data.node.id.split("-");
                var node_id = res[res.length-1];

                $("li#" + data.node.id).find("a.jstree-anchor").after('<a class="preview link" style="margin: 0 10px;" data-toggle="ajaxModal" href="/accreditation/view_all/' + node_id + '">preview</a>');
                init_data_toggle();
            }
        });

        $_tree.jstree(true).open_all();
        $('li[data-checkstate="checked"]').each(function () {
            $_tree.jstree('check_node', $(this));
        });
        $_tree.jstree(true).close_all();

        $.each($_tree.jstree(true).get_selected(), function (index, value) {
            open_node(value);
        });

        function open_node(node_id) {
            $_tree.jstree('open_node', node_id);

            var parent_id = $_tree.jstree(true).get_parent(node_id);
            if (parent_id && parent_id != '#') {
                open_node(parent_id);
            }
        }
    });
    <?php } ?>

    $('form#ams-integration').submit(function (e) {
        e.preventDefault();

        var form_data = $(this).serializeArray();

        <?php if (!empty($forms)) { ?>
        var forms = $('#forms').jstree('get_selected');
        $.each(forms, function (index, value) {
            if ($.isNumeric(value)) {
                form_data.push({
                    name: "forms[]",
                    value: value
                });
            } else if (value.substring(0, 7) == "course-") {
                form_data.push({
                    name: "forms[]",
                    value: value
                });
            }
        });
        <?php } ?>

        $.ajax({
            url: '/accreditation/integrate_ams/programmatic',
            type: 'POST',
            data: form_data,
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status === true) {
                window.location = '/accreditation/integrate_ams/programmatic';
            } else {
                $('#page-content').html(msg.html);
            }
        });
    });
</script>

<?php if (!$this->input->is_ajax_request()) { ?>
    </div>
<?php } ?>

