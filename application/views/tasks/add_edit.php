<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/26/17
 * Time: 11:51 AM
 */

/** @var $task Orm_Tasks */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Task') ?></h4>
        </div>
        <?php echo form_open('/tasks/add_edit/' . $task->get_id(), 'id="task-form" method="post"') ?>
        <div class="modal-body">
            <div class="form-group">
                <label for="task-title" class="control-label"><?php echo lang('Task Title') ?></label>
                <input class="form-control" type="text" name="task-title" id="task-title"
                       value="<?php echo xssfilter($task->get_title()); ?>"/>
                <?php echo Validator::get_html_error_message('title'); ?>
            </div>

            <div class="form-group">
                <label for="to" class="control-label"><?php echo lang('Assigned To') ?></label>
                <select class="form-control" id="task-form-to" name="to[]"
                        multiple="multiple" <?php if ($task->get_to() && $task->get_id()) {
                    echo 'disabled="disabled"';
                } ?> >
                    <?php

                    $to = $this->input->post('to');
                    if (isset($to) && is_array($to) && $to) {
                        foreach ($to as $user_id) {
                            $user = Orm_User::get_instance($user_id);
                            if (!is_null($user) && $user->get_id()) {
                                echo "<option selected='selected' value='{$user->get_id()}'>{$user->get_full_name()}</option>";
                            }
                        }
                    } elseif ($task->get_to() && $task->get_id()) {
                        echo "<option selected='selected' value='{$task->get_to()}'>{$task->get_to(true)->get_full_name()}</option>";
                    }
                    ?>
                </select>

                <?php echo Validator::get_html_error_message('to'); ?>
            </div>

            <div class="form-group">
                <label for="task-title" class="control-label col-md-3"><?php echo lang('Task Text') ?></label>
                <textarea class="form-control" name="text"
                          id="task-form-text"><?php echo xssfilter($task->get_text()); ?></textarea>
                <?php echo Validator::get_html_error_message('text'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i
                            class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>><span
                        class="btn-label-icon left"><i class="fa fa-envelope"></i></span><?php echo lang('Send'); ?>
            </button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>

<style>
    .select2-container {
        z-index: 1000000;
    }
</style>

<script>
    tinymce.remove("#task-form-text");
    tinymce.init({
        selector: "#task-form-text",
        height: 200,
        theme: "modern",
        menubar: false,
        statusbar: false,
        font_size_style_values: "12px,13px,14px,16px,18px,20px",
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        plugins: ["advlist lists link image print preview hr anchor pagebreak", "nonbreaking table directionality", "paste textcolor"],
        toolbar1: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | ltr rtl",
        toolbar2: "fontselect | fontsizeselect | forecolor backcolor | link image | print preview"
    });


    $('#task-form').on('submit', function () {

        $('#task-form-to').prop('disabled', false);

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.success) {
                $('#ajaxModal').modal('hide');
                $('#tasks-container').html(msg.html);
                init_data_toggle();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
//            window.location.reload();
        });
        return false;
    });


    function formatRepo(repo) {
        if (repo.loading) return repo.name;

        var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class=''>" + repo.name + ' (' + repo.type + ')' + "</div>" +
            "</div></div>";

        return markup;
    }

    function formatRepoSelection(repo) {
        return repo.text || repo.name;
    }

    $("#task-form-to").select2({
        ajax: {
            url: "/user/find_select",
            dataType: 'json',
            delay: 250,
            tags: true,
            data: function (params) {
                return {
                    txt: params.term
                };
            },
            processResults: function (d, params) {
                return {
                    results: d.data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 3,
        templateResult: formatRepo, // omitted for brevity, see the source of this page
        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    });

    <?php if($task->get_to()) : ?>
    $("#task-form-to").select2('data', <?php echo $task->get_to(); ?>);
    <?php endif; ?>
</script>