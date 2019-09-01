<?php
/** @var $result Orm_Al_Result */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("assessment_loop/result/save?assessment_loop_id={$assessment_loop_id}", array('id' => 'result-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Result'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label" for="text_en"> <?php echo lang('Result'); ?>
                        (<?php echo lang('English'); ?>)</label>
                    <textarea class="form-control tiny" id="text_en"
                              name="text_en"><?php echo htmlfilter($result->get_text_en()) ?></textarea>
                    <?php echo Validator::get_html_error_message('text_en'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for="text_ar"> <?php echo lang('Result'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <textarea class="form-control tiny" id="text_ar"
                              name="text_ar"><?php echo htmlfilter($result->get_text_ar()) ?></textarea>
                    <?php echo Validator::get_html_error_message('text_ar'); ?>
                </div>

                <input type="hidden" name="id" value="<?php echo intval($result->get_id()) ?>">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right "
                    <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    init_tinymce();
    function init_tinymce() {
        tinymce.remove(".tiny");
        tinymce.init({
            selector: ".tiny",
            plugins : "paste",
            paste_use_dialog : false,
            paste_auto_cleanup_on_paste : true,
            paste_convert_headers_to_strong : false,
            paste_strip_class_attributes : "all",
            paste_remove_spans : true,
            paste_remove_styles : true,
            paste_retain_style_properties : "",
            height: 200,
            theme: "modern",
            menubar: false,
            statusbar: false
        });
    }

    $('#result-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>