<?php
/**
 * @var $thread_message Orm_Thread_Message
 * @var $main_message Orm_Thread_Message
 */
?>

<div class="panel">
    <div class="panel-title">
        <a href="/thread/star/<?php echo (int)$main_message->get_id(); ?>"
           class="pull-xs-left m-r-1 text-muted font-size-14"><i
                    class="fa <?php echo $main_message->get_is_important() ? 'fa-star' : 'fa-star-o' ?>"></i></a>
        <?php echo htmlfilter($main_message->get_subject()); ?>
    </div>

    <hr class="m-y-0">

    <div class="panel-body p-y-1 clearfix">
        <div class="btn-toolbar page-messages-wide-buttons pull-left" role="toolbar">
            <div class="btn-group">
                <button type="button" title="<?php echo lang('Back'); ?>"
                        onclick="window.location = '/thread/items/<?php echo htmlfilter($type); ?>';" class="btn"><i
                            class="fa fa-chevron-left"></i></button>
            </div>

            <div class="btn-group">
                <button type="button" title="<?php echo lang('Unread'); ?>"
                        onclick="window.location = '/thread/unread_one/<?php echo htmlfilter($type); ?>/<?php echo (int)$main_message->get_id(); ?>';"
                        class="btn"><i class="fa fa fa-file-text-o"></i></button>
                <button type="button" title="<?php echo lang('Delete'); ?>"
                        onclick="window.location = '/thread/trash_one/<?php echo (int)$main_message->get_id(); ?>';"
                        class="btn"><i class="fa fa-trash-o"></i></button>
            </div>
        </div>

    </div>

    <hr class="m-y-0">

    <?php foreach ($thread_messages as $thread_message) : ?>
        <div class="panel-body p-y-1 clearfix" style="cursor: pointer; background-color: #F5F5F5;"
             onclick="$('#related_<?php echo htmlfilter($thread_message->get_id()); ?>').toggle();">
            <div class="box m-a-0 valign-middle" style="background-color: #F5F5F5; color:#fff;">
                <div class="box-cell col-md-8">
                    <div class="box-container">
                        <div class="box-row">
                            <div class="box-cell p-l-2">
                                <div class="font-size-14"
                                     style="color:#000 !important;"><?php echo htmlfilter($thread_message->get_sender_obj()->get_full_name()); ?></div>
                                <div class="font-size-12 text-muted"><?php echo htmlfilter($thread_message->get_sender_obj()->get_email()); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-cell text-muted col-md-4 text-md-right">
                    <div class="m-t-2 visible-xs visible-sm"></div>
                    <?php echo htmlfilter($thread_message->get_sent_date()); ?>
                </div>
            </div>
        </div>

        <hr class="m-y-0">

        <div class="panel-body font-size-14"
             id="related_<?php echo htmlfilter($thread_message->get_id()); ?>" <?php echo(($thread_message->get_id() != $main_message->get_id()) ? 'style="display: none;"' : '') ?>>
            <?php
            echo(($thread_message->get_id() != $main_message->get_id()) ? '<blockquote class="m-a-0">' : '');
            echo xssfilter($thread_message->get_body());
            echo(($thread_message->get_id() != $main_message->get_id()) ? '</blockquote>' : '');
            ?>
        </div>
        <hr class="m-y-0">
    <?php endforeach; ?>
    <!-- Form -->

    <div class="panel-body">
        <div class="expanding-input">
            <textarea class="form-control expanding-input-control" rows="4"
                      placeholder="Click here to Reply or Forward"></textarea>
            <div class="expanding-input-overlay" onclick="$(this).parent().hide().next().show();"></div>
        </div>
        <div class="message-details-reply"
             style="<?php echo($this->input->server('REQUEST_METHOD') != 'POST' ? 'display: none;' : '') ?>">
            <?php echo form_open(); ?>
            <div class="form-group">
                <label for="page-messages-new-to"><?php echo lang('To') ?></label>
                <!-- NOTE: Select2 v4 is not support input[type=text] fields -->
                <select class="form-control" id="page-messages-new-to" name="to[]" multiple="multiple">
                    <?php

                    echo Orm_Thread_Participant_Group::prepare_option($to);

//                    if (isset($to) && $to) {
//                        foreach ($to as $user_id) {
//                            $user = Orm_User::get_instance($user_id);
//                            if (!is_null($user) && $user->get_id()) {
//                                echo "<option selected='selected' value='{$user->get_id()}'>{$user->get_full_name()}</option>";
//                            }
//                        }
//                    }
                    ?>
                </select>
                <?php echo Validator::get_html_error_message('to'); ?>
            </div>

            <div class="form-group">
                <label class="control-label"><?php echo lang('Body') ?></label>
                <textarea id="body" name="body"
                          class="form-control"><?php echo isset($body) ? xssfilter($body) : ''; ?>    </textarea>
                <?php echo Validator::get_html_error_message('body'); ?>
            </div>

            <div class="clearfix"></div>

            <div class="form-group">
                <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>><span
                            class="btn-label-icon left"><i class="fa fa-envelope"></i></span><?php echo lang('Send'); ?>
                </button>
            </div>

            <?php echo form_close(); ?>

        </div>


    </div>
</div>

<style>
    /* Special styles */

    .page-messages-item-label {
        vertical-align: text-bottom;
    }

    ul.ui-autocomplete {
        z-index: 1000000;
    }
</style>

<script type="text/javascript">

    tinymce.remove("#body");
    tinymce.init({
        selector: "#body",
        height: 150,
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

    $('#compose_form').on('submit', function () {

        $.ajax({
            type: "POST",
            url: "/thread/save",
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
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

    $("#page-messages-new-to").select2({
        ajax: {
            url: "/thread/find_select", // "/user/find_select"
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

</script>