<?php
/* @var $notification Orm_Notification */
/* @var $property Orm_property */
?>
<div class="col-md-6 col-lg-7">
    <div class="well">

        <?php echo form_open('/notification/save', 'id="kpi-values-form"') ?>
        <div class="form-group">
            <label class="control-label"> <?php echo lang('Subject') ?></label>
            <input name="subject" type="text" class="form-control"
                   value="<?php echo $notification->get_subject(); ?>"/>
            <?php echo Validator::get_html_error_message('subject'); ?>
        </div>
        <div class="form-group">
            <label class="control-label"> <?php echo lang('Body') ?></label>
            <textarea name="body" type="text" id="body"
                      class="form-control"><?php echo $notification->get_body(); ?></textarea>
            <script>
                tinymce.init({
                    selector: "#body",
                    height: 200,
                    theme: "modern",
                    menubar: false,
                    file_browser_callback: elFinderBrowser,
                    font_size_style_values: "12px,13px,14px,16px,18px,20px",
                    plugins: [
                        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime nonbreaking save table contextmenu directionality",
                        "emoticons template paste textcolor"
                    ],
                    toolbar1: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontselect | fontsizeselect",
                    toolbar2: "forecolor backcolor emoticons | link image | ltr rtl | print preview "
                });
            </script>
            <?php echo Validator::get_html_error_message('body'); ?>
        </div>
        <div class="form-group">
            <label class="control-label"> <?php echo lang('Name') ?></label>
            <input name="name" type="text" class="form-control" readonly="readonly"
                   value="<?php echo $notification->get_name(); ?>"/>
            <?php echo Validator::get_html_error_message('name'); ?>
        </div>
        <input type="hidden" name="id" value="<?php echo (int)$notification->get_id(); ?>">
        <button type="submit" class="btn " <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close() ?>
    </div>
</div>

<div class="col-md-2 col-lg-2">
    <div class="panel panel-primary">
        <div class="panel-heading" style="text-align: center;">
            <h4><?php echo lang('Placeholders'); ?></h4>
        </div>
        <div class="panel-body p-a-1">
            <?php foreach (Orm_Notification_Template::get_template_names($notification->get_name()) as $place_holder) { ?>
                <button type="button" class="btn btn-block"
                        onclick="tinymce.activeEditor.execCommand('mceInsertContent', false, '<?php echo $place_holder ?>');">
                    <?php echo lang(ucwords(str_replace(['%', '_'], ['', ' '], $place_holder))); ?>
                </button>
            <?php } ?>
        </div>
    </div>
</div>

