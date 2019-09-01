<?php
/** @var $assessment_metric Orm_Am_Assessment_Metric */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/assessment_metric/save_analysis", array('id' => 'assessment_metric_analysis')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Assessment Analysis'); ?></span>
        </div>
        <?php
        $sum_weight = 0;
        $final_result=0;
        foreach ($all_component as $one_component) {
            $weight = $one_component->get_weight();
            $sum_weight += $weight;
            $final_result += $one_component->get_result();
        }
        if($sum_weight == 100){
            $final_result=$final_result;?>
        <?php }else{
            $final_result = lang('N/A');?>
        <?php }
        ?>
        <div class="modal-body">
            <div class="alert clearfix">
               <div class="col-md-6">
                   <strong>
                       <?php echo lang('Final Result').' : '.$final_result ?>
                   </strong>
               </div>
               <div class="col-md-6">
                   <strong>
                       <?php echo lang('Target').' : '.$assessment_metric->get_target() ?>
                   </strong>

               </div>
            </div>

            <div class="form-group">
                <label class="control-label" for="text_en"><?php echo lang('Weakness'); ?> (<?php echo lang('English'); ?>)</label>
                <textarea class="form-control tiny" name="weakness_en" id="weakness_en"><?php echo xssfilter($assessment_metric->get_weakness_en())?></textarea>
                <?php echo Validator::get_html_error_message('weakness_en'); ?>
            </div>

            <div class="form-group">
                <label class="control-label" for="text_ar" ><?php echo lang('Weakness'); ?> (<?php echo lang('Arabic'); ?>)</label>
                <textarea class="form-control tiny" name="weakness_ar" id="weakness_ar"><?php echo xssfilter($assessment_metric->get_weakness_ar())?></textarea>
                <?php echo Validator::get_html_error_message('weakness_ar'); ?>
            </div>
            <div class="form-group">
                <label class="control-label" for="text_en"><?php echo lang('Strength'); ?> (<?php echo lang('English'); ?>)</label>
                <textarea class="form-control tiny" name="strength_en" id="strength_en"><?php echo xssfilter($assessment_metric->get_strength_en())?></textarea>
                <?php echo Validator::get_html_error_message('strength_en'); ?>
            </div>

            <div class="form-group">
                <label class="control-label" for="text_ar" ><?php echo lang('Strength'); ?> (<?php echo lang('Arabic'); ?>)</label>
                <textarea class="form-control tiny" name="strength_ar" id="strength_ar"><?php echo xssfilter($assessment_metric->get_strength_ar())?></textarea>
                <?php echo Validator::get_html_error_message('strength_ar'); ?>
            </div>
            <input type="hidden" name="id" id="id" value="<?php echo intval($assessment_metric->get_id())?>" />
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
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
            file_browser_callback: elFinderBrowser,
            font_size_style_values: "12px,13px,14px,16px,18px,20px",
            relative_urls: false,
            remove_script_host: false,
            statusbar: true,
            convert_urls: true,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor"
            ],
            toolbar1: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontselect | fontsizeselect",
            toolbar2: "forecolor backcolor emoticons | link image | ltr rtl | preview"
        });
    }

    $('#assessment_metric_analysis').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.success == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
                 init_tinymce();
            }
        })
    });





</script>