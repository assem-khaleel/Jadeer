<?php if (!$this->input->is_ajax_request()) { ?>
    <div id="page-content">
<?php } ?>

<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-2 m-t-1">
    <li role="presentation" class="active">
        <a href="/accreditation/integrate_ams/institutional"><?php echo lang('Institutional'); ?></a>
    </li>
    <li role="presentation">
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

        $ams_logs = Orm_Ams_Log::get_all(array('type' => 'institutional'), 1, 5, array('al.id DESC'));
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
                        <td class="col-md-2 text-center">
                            <a class="btn btn-block"
                               href="<?php echo base_url("/accreditation/integrate_ams/institutional?log_id=") . $ams_log->get_id() ?>"><span class="btn-label-icon left fa fa-eye"></span><?php echo lang('View').' '.lang('Log') ?></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>

    <?php echo form_open("/accreditation/integrate_ams/institutional", 'id="ams-integration"'); ?>

    <div class="row form-group m-t-2">
        <label class="col-sm-2 control-label"><?php echo lang('Forms'); ?></label>

        <div class="col-sm-10">
            <div id="forms" class="checkbox">
                <ul>
                    <?php
                    $institutional_node = Orm_Node::get_active_institutional_node();
                    if ($institutional_node->get_id()) foreach ($institutional_node->reset_children()->get_children() as $form) { ?>
                        <li <?php echo(in_array($form->get_id(), $integrate_forms) ? 'data-checkstate="checked"' : ''); ?>
                            id="<?php echo $form->get_id() ?>">
                            <?php echo htmlfilter($form->get_name()); ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php echo Validator::get_html_error_message('forms'); ?>
        </div>
    </div>

    <div class="row form-group">
        <label class="col-sm-2 control-label"><?php echo lang('Comment'); ?></label>

        <div class="col-sm-10">
            <textarea name="comment" class="form-control" autocomplete="off"><?php echo isset($comment) ? htmlfilter($comment) : ''; ?></textarea>
            <?php echo Validator::get_html_error_message('comment'); ?>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <button type="submit" class="btn btn-sm pull-right" <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-paper-plane"></span><?php echo lang('Push To AIMS'); ?></button>
        <div class="clearfix"></div>
    </div>
    <?php echo form_close(); ?>
    <div class="clearfix"></div>
</div>
<script>


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

    $('form#ams-integration').submit(function (e) {
        e.preventDefault();

        var form_data = $(this).serializeArray();

        var forms = $("#forms").jstree('get_selected');
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

        $.ajax({
            url: '/accreditation/integrate_ams/institutional',
            type: 'POST',
            data: form_data,
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status === true) {
                window.location = '/accreditation/integrate_ams/institutional';
            } else {
                $('#page-content').html(msg.html);
            }
        });
    });
</script>

<?php if (!$this->input->is_ajax_request()) { ?>
    </div>
<?php } ?>
