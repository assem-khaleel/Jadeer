<? /* @var $club Orm_Tf_Club */ ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="well">
           <?php echo form_open("/team_formation/save" , 'enctype="multipart/form-data"'); ?>
            <div class="form-group">
                <label
                    class=" control-label"><?php echo lang('Club Name') . ' (' . lang('English') . ')' ?></label>
                <input type="text" id="name_en" name="name_en" class="form-control"
                       value="<?php echo htmlfilter($club->get_name_en()) ?>">
                <?php echo Validator::get_html_error_message('name_en'); ?>
            </div>

            <div class="form-group">
                <label
                    class=" control-label"><?php echo lang('Club Name') . ' (' . lang('Arabic') . ')' ?></label>
                <input type="text" id="name_ar" name="name_ar" class="form-control"
                       value="<?php echo htmlfilter($club->get_name_ar()) ?>">
                <?php echo Validator::get_html_error_message('name_ar'); ?>
            </div>

            <div class="form-group">
                <label class=" control-label"
                       for="desc_en"><?php echo lang('Description') . ' (' . lang('English') . ')' ?></label>
                            <textarea class="form-control tiny" name="description_en"
                                      id="description_en"><?php echo xssfilter($club->get_description_en()) ?></textarea>
                <?php echo Validator::get_html_error_message('description_en'); ?>
            </div>

            <div class="form-group">
                <label class=" control-label"
                       for="desc_en"><?php echo lang('Description') . ' (' . lang('Arabic') . ')' ?></label>
                            <textarea class="form-control tiny" name="description_ar"
                                      id="description_ar"><?php echo xssfilter($club->get_description_ar()) ?></textarea>
                <?php echo Validator::get_html_error_message('description_ar'); ?>
            </div>

            <div class="form-group">
                <label class=" control-label"
                       for="desc_en"><?php echo lang('Policies') . ' (' . lang('English') . ')' ?></label>
                            <textarea class="form-control tiny" name="policies_en"
                                      id="policies_en"><?php echo xssfilter($club->get_description_en()) ?></textarea>
                <?php echo Validator::get_html_error_message('policies_en'); ?>
            </div>

            <div class="form-group">
                <label class=" control-label"
                       for="desc_en"><?php echo lang('Policies') . ' (' . lang('Arabic') . ')' ?></label>
                            <textarea class="form-control tiny" name="policies_ar"
                                      id="policies_ar"><?php echo xssfilter($club->get_description_ar()) ?></textarea>
                <?php echo Validator::get_html_error_message('policies_ar'); ?>
            </div>

            <div class="alert alert-warning" style="color: #8a6d3b;">
                <strong><?php echo lang('Warning').'!'?> </strong> <?php  echo lang("Max Size").' = ' .   ini_get('upload_max_filesize')?>
            </div>

            <div class="form-group">
                <?php echo Uploader::draw_file_upload($club, 'logo', lang('Club Logo')); ?>
                <?php echo Validator::get_html_error_message_no_arrow('logo'); ?>
            </div>
            <div class="form-group">
                <?php echo Uploader::draw_file_upload($club, 'cover', lang('Club Cover')); ?>
                <?php echo Validator::get_html_error_message_no_arrow('cover'); ?>
            </div>
            <?php (empty($club))?$display = 'style = "display:none;"':$display ='style = "display:block;"'; ?>
            <div class="form-group" <?php echo $display; ?>>
                <label class="col-md-3 control-label"><?php echo lang('Who can Post'); ?> ?</label>
                <div class="col-md-9">
                    <?php foreach (Orm_Tf_Club::$post_list as $key => $status) {
                        /* @var $status Orm_Tf_Club */
                        $selected = ($key == $club->get_approval_post() ? 'checked="checked"' : '');
                        ?>
                        <label class="custom-control custom-radio">
                            <input type="radio" name="approval_post" class="custom-control-input"
                                   value="<?php echo intval($key) ?>" <?php echo $selected ?>>
                            <span class="custom-control-indicator"></span>
                            <?php echo lang($status); ?>
                        </label>
                    <?php } ?>
                    <?php echo Validator::get_html_error_message('approval_post'); ?>
                </div>
                <div style="clear: both;"></div>
            </div>
            <?php  if(Orm_User::get_instance( Orm_User::get_logged_user_id())->get_class_type() != Orm_User::USER_STUDENT){ ?>
                <div class="form-group" <?php echo $display; ?>>
                    <label class="col-md-3 control-label"><?php echo lang('Who can Join the group'); ?> ?</label>
                    <div class="col-md-9">

                        <?php foreach (Orm_Tf_Club::$member_gender_list as $key => $gender) {
                            /* @var $status Orm_Tf_Club */
                            $selected = ($key == $club->get_member_gender() ? 'checked="checked"' : '');
                            ?>
                            <label class="custom-control custom-radio">
                                <input type="radio" name="memeber_gender" class="custom-control-input"
                                       value="<?php echo intval($key) ?>" <?php echo $selected ?>>
                                <span class="custom-control-indicator"></span>
                                <?php echo lang($gender); ?>
                            </label>
                        <?php } ?>
                        <?php echo Validator::get_html_error_message_no_arrow('memeber_gender'); ?>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            <?php  } ?>

            <input type="hidden" name="id" value="<?php echo intval($club->get_id()) ?>">
        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
           <?php form_close(); ?>
        </div>
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
</script>
