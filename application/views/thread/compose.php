<?php $uniqid = uniqid(); ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('/thread/send', 'id="compose_form-'.$uniqid.'" method="post"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Compose'); ?></h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label for="to-<?php echo $uniqid ?>"><?php echo lang('To') ?></label>
                <!-- NOTE: Select2 v4 is not support input[type=text] fields -->
                <select class="form-control" id="to-<?php echo $uniqid ?>" name="to[]" multiple="multiple">
                    <?php echo Orm_Thread_Participant_Group::prepare_option($to); ?>
                </select>
                <?php echo Validator::get_html_error_message('to'); ?>
            </div>

            <div class="form-group">
                <label for="subject-<?php echo $uniqid ?>"><?php echo lang('Subject') ?></label>
                <input type="text" name="subject" class="form-control" id="subject-<?php echo $uniqid ?>" value="<?php echo isset($subject) ? htmlfilter($subject) : ''; ?>" />
                <?php echo Validator::get_html_error_message('subject'); ?>
            </div>

            <div class="form-group">
                <label class="control-label"><?php echo lang('Body') ?></label>
                <textarea id="body-<?php echo $uniqid ?>" name="body" class="form-control"><?php echo isset($body) ? xssfilter($body) : ''; ?></textarea>
                <?php echo Validator::get_html_error_message('body'); ?>
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left" data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span>
                <?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn pull-right" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-envelope"></i></span>
                <?php echo lang('Send'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<style>
    .select2-container {
        z-index: 1000000;
    }
</style>

<script type="text/javascript">
    init_data_toggle();
    tinymce.remove("#body-<?php echo $uniqid ?>");
    tinymce.init({
        selector: "#body-<?php echo $uniqid ?>",
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

    $('#compose_form-<?php echo $uniqid ?>').on('submit', function () {

        $.ajax({
            type: "POST",
            url: "/thread/send",
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
            "</div>" +
            "</div>";

        return markup;
    }

    function formatRepoSelection(repo) {
        return repo.text || repo.name;
    }

    $("#to-<?php echo $uniqid ?>").select2({
        ajax: {
            url: "/thread/find_select",
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



