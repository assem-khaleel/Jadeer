<?php  /* @var $evaluation Orm_Survey_Evaluation */?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="well">
            <?php echo form_open("/advisory/Ad_Survey/save_evaluation"); ?>
            <div class="form-group">
                <label class=" control-label" for="desc_en">
                    <?php echo lang('Description') . ' (' . lang('English') . ')' ?>
                </label>
                            <textarea class="form-control tiny" name="desc_en"
                                      id="desc_en"><?php echo xssfilter($evaluation->get_description_english()) ?></textarea>
                <?php echo Validator::get_html_error_message('desc_en'); ?>
            </div>
            

            <div class="form-group">
                <label class="control-label"
                       for="desc_ar"><?php echo lang('Description') . ' (' . lang('Arabic') . ')' ?></label>
                            <textarea class="form-control tiny" name="desc_ar"
                                      id="desc_ar"><?php echo xssfilter($evaluation->get_description_arabic()) ?></textarea>
                <?php echo Validator::get_html_error_message('desc_ar'); ?>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"><?php echo lang('Who Will Evaluate Advisory'); ?> ?</label>
                <div class="col-md-9">
                    <?php foreach (Orm_Ad_Survey::$status as $key => $status) {
                        /* @var $survey_status Orm_Ad_Survey */
                        $selected = ($key == $survey_status->get_survey_status() ? 'checked="checked"' : '');
                        ?>
                        <label class="custom-control custom-radio">
                            <input type="radio" name="status" class="custom-control-input"
                                   value="<?php echo intval($key) ?>" <?php echo $selected ?>>
                            <span class="custom-control-indicator"></span>
                            <?php echo lang($status); ?>
                        </label>
                    <?php } ?>
                    <?php echo Validator::get_html_error_message('status'); ?>
                </div>
            </div>

            <input type="hidden" name="id" value="<?php echo intval($evaluation->get_id()) ?>">
            <input type="hidden" name="survey_id" value="<?php echo intval($survey_id) ?>">
            <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
                <?php echo lang('Save Changes'); ?>
            </button>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>
