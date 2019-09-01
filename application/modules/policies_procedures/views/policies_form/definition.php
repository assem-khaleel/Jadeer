<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 23/03/17
 * Time: 01:10 م
 */
/** @var $policy Orm_Policies_Procedures */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/policies_procedures/save_update/definition", array('id' => 'definition-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Definition'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="definitions_en"><?php echo lang('Definition') . ' ( ' . lang('English').' ) ' ?></label>
                        <div class="col-sm-9">
                            <textarea class="form-control tiny" name="definitions_en"
                                      id="definitions_en"><?php echo xssfilter($policy->get_definitions_en()) ?></textarea>
                        </div>
                    </div>
                    <?php echo Validator::get_html_error_message_no_arrow('definitions_en'); ?>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="definitions_ar"><?php echo lang('Definition') . ' ( ' . lang('Arabic').' ) ' ?></label>
                        <div class="col-sm-9">
                            <textarea class="form-control tiny" name="definitions_ar"
                                      id="definitions_ar"><?php echo xssfilter($policy->get_definitions_ar()) ?></textarea>
                        </div>
                    </div>
                    <?php echo Validator::get_html_error_message_no_arrow('definitions_ar'); ?>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo intval($policy->get_id()) ?>">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
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
    
    $('#definition-form').on('submit', function (e) {
        e.preventDefault();
        tinymce.triggerSave();

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
                init_tinymce();
            }
        });
    });

</script>
