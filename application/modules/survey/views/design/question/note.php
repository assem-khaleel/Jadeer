<?php
/* @var $question Orm_Survey_Question */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/survey/design/question_note/{$question->get_id()}") ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('Question Note'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label"><?php echo lang('Description') ?> (<?php echo lang('English') ?>):</label>
                    <textarea class="form-control"
                              name="description_english"><?php echo xssfilter($question->get_description_english()); ?></textarea>
                    <?php echo Validator::get_html_error_message('description_english'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo lang('Description') ?> (<?php echo lang('Arabic') ?>):</label>
                    <textarea class="form-control"
                              name="description_arabic"><?php echo xssfilter($question->get_description_arabic()); ?></textarea>
                    <?php echo Validator::get_html_error_message('description_arabic'); ?>
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn pull-right "
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
            <input type="hidden" name="survey_id"
                   value="<?php echo htmlfilter($question->get_page_obj()->get_survey_id()); ?>"/>
        <?php echo form_close() ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->

<script>
    tinymce.init({
        selector: "textarea",
        height: 200,
        theme: "modern",
        menubar: false,
        file_browser_callback: elFinderBrowser,
        font_size_style_values: "12px,13px,14px,16px,18px,20px",
        relative_urls: false,
        remove_script_host: false,
        statusbar: false,
        convert_urls: true,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontselect | fontsizeselect",
        toolbar2: "forecolor backcolor emoticons | link image | ltr rtl | print preview"
    });
</script>