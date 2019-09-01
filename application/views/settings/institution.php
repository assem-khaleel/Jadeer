<?php
/* @var $institution Orm_Institution */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">
        <?php echo form_open_multipart('/settings/institution'); ?>

        <div class="form-group">
            <label class="control-label" for="name_en"><?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <input name="name_en" id="name_en" type="text" class="form-control"
                   value="<?php echo htmlfilter($institution->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="name_ar"><?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>
                )</label>
            <input name="name_ar" id="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($institution->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'univ_logo_en', lang('University Logo') . ' (' . lang('English') . ')') ?>
            </div>
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'univ_logo_ar', lang('University Logo') . ' (' . lang('Arabic') . ')') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'cs_cover', lang('Course Specification Cover')) ?>
            </div>
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'cr_cover', lang('Course Report Cover')) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'fes_cover', lang('Field Experience Specification Cover')) ?>
            </div>
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'fer_cover', lang('Field Experience Report Cover')) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'ps_cover', lang('Program Specification Cover')) ?>
            </div>
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'pr_cover', lang('Program Report Cover')) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'ssr_cover', lang('Self-Study Report Cover')) ?>
            </div>
            <div class="col-md-6">
                <?php echo Uploader_Image::draw_file_upload($institution, 'sesr_cover', lang('Self-Evaluation Scale Report Cover')) ?>
            </div>
        </div>
    </div>

    <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
        <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
        <?php echo lang('Save Changes'); ?>
    </button>

    <?php echo form_close(); ?>
</div>
</div>


