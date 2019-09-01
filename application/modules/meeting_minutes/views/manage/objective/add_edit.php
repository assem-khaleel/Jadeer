<?php
/** @var $meeting Orm_Mm_Meeting */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("meeting_minutes/objective_edit/{$meeting->get_id()}", array('id' => 'objective-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Objectives'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <textarea class="form-control" name="objective" id="objective"><?php echo htmlfilter($meeting->get_objective()) ?></textarea>
                <?php echo Validator::get_html_error_message('objective'); ?>
            </div>
            <input type="hidden" name="id" value="<?php echo intval($meeting->get_id()) ?>">
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
        tinymce.remove("#objective");
        tinymce.init({
            selector: "#objective",
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

    $('#objective-form').on('submit', function (e) {
        e.preventDefault();

        tinymce.triggerSave();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
                init_tinymce();
            }
        });
    });

</script>