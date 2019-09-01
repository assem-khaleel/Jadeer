<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 7/26/17
 * Time: 11:31 AM
 * * * /** @var $club Orm_Tf_Club
 * * /** @var $post Orm_Tf_Post
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("team_formation/save_post/{$club->get_id()}", array('id' => 'post-form')); ?>
        <div class="modal-header">
            <span
                class="panel-title"><?php echo $post->get_id() ? lang('Edit') . ' ' . lang('Post') : lang('Add') . ' ' . lang('Post'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="col-sm-3 control-label"><?php echo lang('Post') ?></label>
                            <textarea placeholder="<?php echo lang('Post') ?>" id="content" name="content" class="form-control" ><?php echo $post->get_content()?></textarea>
                            <?php echo Validator::get_html_error_message('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="<?php echo (int)$club->get_id()?>" name="club_id">
            <input type="hidden" value="<?php echo (int)$post->get_id()?>" name="id">
            </div>
            <div class="modal-footer">
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
        tinymce.remove("#content");
        tinymce.init({
            selector: "#content",
            plugins: "paste",
            paste_use_dialog: false,
            paste_auto_cleanup_on_paste: true,
            paste_convert_headers_to_strong: false,
            paste_strip_class_attributes: "all",
            paste_remove_spans: true,
            paste_remove_styles: true,
            paste_retain_style_properties: "",
            height: 200,
            theme: "modern",
            menubar: false,
            statusbar: false
        });
    }

    $('#post-form').on('submit', function (e) {
        e.preventDefault();
        tinymce.triggerSave();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
                init_tinymce();
            }
        });
    });

</script>