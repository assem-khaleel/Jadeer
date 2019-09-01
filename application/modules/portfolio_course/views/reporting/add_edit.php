<?php
/** @var $report Orm_Pc_Report */
/** @var $course_id int */
?>
<div class="modal-dialog modal-sx">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php echo $report->get_id() ? lang('Edit').' '.lang('Report') : lang('Add').' '.lang('Report'); ?></h4>
        </div>
        <?php echo form_open("/portfolio_course/reporting/save/{$report->get_id()}?id={$course_id}", ["class" => 'inline-form', "id" => "report-form"]) ?>
        <div class="padding-sm-hr">
            <div class="modal-body">
                <div class="row form-group">
                    <label for="title_en" class="control-label"><?php echo lang('Report Title') ?> (<?php echo lang('English') ?>)</label>
                    <input type="text" name="title_en" id="editEn" class="form-control"
                           placeholder="<?php echo lang('Report Title') ?> (<?php echo lang('English') ?>)"
                           value="<?php echo htmlfilter($report->get_title_en()) ?>"/>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="control-label"><?php echo lang('Report Title') ?> (<?php echo lang('Arabic') ?>)</label>
                    <input type="text" name="title_ar" id="editAr" class=" form-control"
                           placeholder="<?php echo lang('Report Title') ?> (<?php echo lang('Arabic') ?>)"
                           value="<?php echo htmlfilter($report->get_title_ar()) ?>"/>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>
                <div class="row form-group">
                    <label for="component" class="control-label"><?php echo lang('Core Component') ?>:</label>
                    <div class="row">
                        <?php $components = $report->get_component_ids(); ?>
                        <?php foreach (Orm_Pc_Report::$COMPONENTS as $key => $component) { ?>
                            <div class="col-md-6">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="component[<?php echo $key; ?>]" value="<?php echo $key; ?>" <?php echo in_array($key, $components) ? 'checked="checked"' : ''; ?>>
                                    <span class="custom-control-indicator"></span>
                                    <?php echo lang($component); ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <label for="component" class="control-label"><?php echo lang('Custom Component') ?>:</label>
                    <div class="row">
                        <?php $categories = $report->get_component_ids(0); ?>
                        <?php foreach (Orm_Pc_Category::get_all(['course_id' => $course_id]) as $component) { ?>
                            <div class="col-md-6">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="custom_component[<?php echo $component->get_id(); ?>]" value="<?php echo $component->get_id(); ?>" <?php echo in_array($component->get_id(), $categories) ? 'checked="checked"' : ''; ?>>
                                    <span class="custom-control-indicator"></span>
                                    <?php echo lang($component->get_title()); ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <?php echo Validator::get_html_error_message('component'); ?>
                </div>
            </div>
            <div class="modal-footer">
                <div class=" text-right">
                    <button type="button" class="btn pull-left" data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                    <button type="submit" class="btn pull-right" <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $('#report-form').submit(function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error == false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });
    });

</script>