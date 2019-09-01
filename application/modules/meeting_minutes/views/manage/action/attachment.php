<?php
/** @var $meeting Orm_Mm_Meeting */

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("meeting_minutes/action_attachment/{$meeting->get_id()}", array('id' => 'action-attachment-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Action Attachment'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-3" for="attachment"><?php echo lang('Attachment'); ?></label>
                    <div class="col-sm-9">
                        <label class="custom-file px-file" id="attachment">
                            <input type="file" name="attachment" class="custom-file-input">
                            <span class="custom-file-control form-control"> <?php echo lang('Attachment'); ?></span>
                            <div class="px-file-buttons">
                                <button type="button" class="btn px-file-clear"><?php echo lang('Clear') ?></button>
                                <button type="button" class="btn btn-primary px-file-browse"><?php echo lang('Browse') ?></button>
                            </div>
                        </label>

                        <?php echo Validator::get_html_error_message('attachment'); ?>
                    </div>
                </div>
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

    $('#action-attachment-form').on('submit', function (e) {
        e.preventDefault();

//        tinymce.triggerSave();

        var files = $(":file:enabled", this);

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        if(files.length) {
            $ajaxProp['files']  = files;
            $ajaxProp['iframe'] =  true;
        }

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    $('.custom-file').pxFile();
</script>