<?php
/** @var $visit_reviewer Orm_Acc_Visit_Reviewer */
/** @var $recommendation Orm_Acc_Visit_Reviewer_Recommendation */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/accreditation/reviewer_visit/recommendation_add_edit/{$visit_reviewer->get_type()}/{$visit_reviewer->get_type_id()}/{$recommendation->get_id()}", 'id="reviewer_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Add').' '.lang('Recommendation'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="panel">
                <div class="panel-body">
                    <textarea name="recommendation" id="recommendation" class="form-control" rows="3"><?php echo xssfilter($recommendation->get_recommendation()); ?></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left" data-dismiss="modal">
                <span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn pull-right" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-save"></span><?php echo lang('Save'); ?>
            </button>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script>

    tinymce.remove("#recommendation");
    tinymce.init({
        selector: "#recommendation",
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

    $('#reviewer_form').submit(function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
        }).done(function (msg) {
            $('#ajaxModalDialog').html(msg);
        }).fail(function () {
            window.location.reload();
        });

    });
</script>