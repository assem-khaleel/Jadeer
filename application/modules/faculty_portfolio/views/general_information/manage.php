<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/7/16
 * Time: 6:18 PM
 *
 * @var $general_info Orm_Fp_General_Information
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <?php echo form_open("/faculty_portfolio/general_info_manage", 'id="portfolio-form" class="form-horizontal"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
                <?php echo lang('General Info'); ?>
            </h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label for="personal_email" class="col-md-3 control-label"><?php echo lang('Personal Email'); ?></label>
                <div class="col-md-9">
                    <input type="text" name="personal_email" id="personal_email" class="form-control" value="<?php echo htmlfilter($general_info->get_personal_email()); ?>">
                    <?php echo Validator::get_html_error_message('personal_email'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="mobile_no" class="col-md-3 control-label"><?php echo lang('Mobile No.'); ?></label>
                <div class="col-md-9">
                    <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="<?php echo htmlfilter($general_info->get_mobile_no()); ?>">
                    <?php echo Validator::get_html_error_message('mobile_no'); ?>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <label for="contract_type" class="col-md-3 control-label"><?php echo lang('Contract Type'); ?></label>
                <div class="col-md-9">
                    <select name="contract_type" id="contract_type" class="form-control" >
                        <?php foreach(Orm_Fp_General_Information::$contract_types as $key => $value) { ?>
                            <?php $selected = $general_info->get_contract_type() == $key ? 'selected="selected"' : ''; ?>
                            <option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo htmlfilter($value) ?></option>
                        <?php } ?>
                    </select>
                    <?php echo Validator::get_html_error_message('contract_type'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="contract_date" class="col-md-3 control-label"><?php echo lang('Contract Date'); ?></label>
                <div class="col-md-9">
                    <input type="text" name="contract_date" id="contract_date" readonly="readonly" class="form-control" value="<?php echo ($general_info->get_contract_date() != '0000-00-00') ? htmlfilter($general_info->get_contract_date()) : ''; ?>">
                    <?php echo Validator::get_html_error_message('contract_date'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('Contract Attachment'); ?></label>
                <div class="col-md-9">
                    <label class="custom-file px-file" id="contract_attachment">
                        <input type="file" name="contract_attachment" class="custom-file-input">
                        <span class="custom-file-control form-control"> <?php echo lang('Attachment'); ?></span>
                        <div class="px-file-buttons">
                            <button type="button" class="btn px-file-clear"><?php echo lang('Clear') ?></button>
                            <button type="button" class="btn btn-primary px-file-browse"><?php echo lang('Browse') ?></button>
                        </div>
                    </label>
                    <?php echo Validator::get_html_error_message('contract_attachment'); ?>
                </div>
            </div>
            <hr>

            <div class="form-group">
                <label for="cv_text_en" class="col-md-3 control-label"><?php echo lang('CV'); ?> (<?php echo lang('English'); ?>)</label>
                <div class="col-md-9">
                    <textarea name="cv_text_en" id="cv_text_en" class="form-control tiny" ><?php echo xssfilter( $general_info->get_cv_text_en()); ?></textarea>
                    <?php echo Validator::get_html_error_message('cv_text_en'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="cv_text_ar" class="col-md-3 control-label"><?php echo lang('CV'); ?> (<?php echo lang('Arabic'); ?>)</label>
                <div class="col-md-9">
                    <textarea name="cv_text_ar" id="cv_text_ar" class="form-control tiny" ><?php echo xssfilter($general_info->get_cv_text_ar()); ?></textarea>
                    <?php echo Validator::get_html_error_message('cv_text_ar'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('CV Attachment'); ?></label>
                <div class="col-md-9">
                    <label class="custom-file px-file" id="attachment">
                        <input type="file" name="cv_attachment" class="custom-file-input">
                        <span class="custom-file-control form-control"> <?php echo lang('Attachment'); ?></span>
                        <div class="px-file-buttons">
                            <button type="button" class="btn px-file-clear"><?php echo lang('Clear') ?></button>
                            <button type="button" class="btn btn-primary px-file-browse"><?php echo lang('Browse') ?></button>
                        </div>
                    </label>
                    <?php echo Validator::get_html_error_message('cv_attachment'); ?>
                </div>
            </div>
            <hr>

            <div class="form-group">
                <label for="website" class="col-md-3 control-label"><?php echo lang('Website'); ?></label>
                <div class="col-md-9">
                    <input type="text" name="website" id="website" class="form-control" value="<?php echo htmlfilter($general_info->get_website()); ?>">
                    <?php echo Validator::get_html_error_message('website'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="twitter" class="col-md-3 control-label"><?php echo lang('Twitter'); ?></label>
                <div class="col-md-9">
                    <input type="text" name="twitter" id="twitter" class="form-control" value="<?php echo htmlfilter($general_info->get_twitter()); ?>">
                    <?php echo Validator::get_html_error_message('twitter'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="facebook" class="col-md-3 control-label"><?php echo lang('Facebook'); ?></label>
                <div class="col-md-9">
                    <input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo htmlfilter($general_info->get_facebook()); ?>">
                    <?php echo Validator::get_html_error_message('facebook'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="linkedin" class="col-md-3 control-label"><?php echo lang('Linkedin'); ?></label>
                <div class="col-md-9">
                    <input type="text" name="linkedin" id="linkedin" class="form-control" value="<?php echo htmlfilter($general_info->get_linkedin()); ?>">
                    <?php echo Validator::get_html_error_message('linkedin'); ?>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close() ?>

    </div>
</div>

<script type="text/javascript">

    $("#portfolio-form").on('submit', function (e) {
        e.preventDefault();

        $.ajax(this.action, {
            data: $(this).serializeArray(),
            files: $(":file", this),
            iframe: true,
            method: 'POST',
            dataType: "json"
        }).complete(function(data) {

            var msg = data.responseJSON;

            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
        //return false;
    });

    $("#contract_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

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
            statusbar: false,
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    }

    $('.custom-file').pxFile();
</script>

