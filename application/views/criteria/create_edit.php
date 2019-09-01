<?php
/* @var $criteria Orm_Criteria */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">

        <?php echo form_open("/criteria/save"); ?>
        <div class="form-group">
            <label class="control-label"><?php echo lang('Standard'); ?></label>
            <select name="standard_id" class="form-control">
                <option value=""><?php echo lang('Select One'); ?></option>
                <?php foreach (Orm_Standard::get_all(array('id')) as $standard) : ?>
                    <?php $selected = ($standard->get_id() == $criteria->get_standard_id() ? ' selected="selected"' : ''); ?>
                    <option
                            value="<?php echo (int)$standard->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($standard->get_title()); ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo Validator::get_html_error_message('standard_id'); ?>
        </div>
        <div class="form-group">
            <label class="control-label" for="code"> <?php echo lang('Code'); ?></label>
            <input name="code" type="text" class="form-control"
                   value="<?php echo htmlfilter($criteria->get_code()); ?>"/>
            <?php echo Validator::get_html_error_message('code'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="title"> <?php echo lang('Title'); ?> </label>
            <input name="title" type="text" class="form-control"
                   value="<?php echo htmlfilter($criteria->get_title()); ?>"/>
            <?php echo Validator::get_html_error_message('title'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Process Or Result'); ?></label>
            <div class="radio">
                <label>
                    <input type="radio" name="type" id="type1" value="3"
                           class="px" <?php echo ($criteria->get_type() == Orm_Criteria::CRITERIA_INSTITUTION_KPI) ? ' checked' : '' ?>>
                    <span class="lbl"><?php echo lang('Result Based'); ?> (<?php echo lang('Institution'); ?>
                        )</span>
                </label>
            </div> <!-- / .radio -->
            <div class="radio">
                <label>
                    <input type="radio" name="type" id="type2" value="2"
                           class="px" <?php echo($criteria->get_type() == Orm_Criteria::CRITERIA_COLLEGE_KPI ? ' checked="checked"' : '') ?>>
                    <span class="lbl"><?php echo lang('Result Based'); ?> (<?php echo lang('College'); ?>)</span>
                </label>
            </div> <!-- / .radio -->
            <div class="radio">
                <label>
                    <input type="radio" name="type" id="type3" value="1"
                           class="px" <?php echo($criteria->get_type() == Orm_Criteria::CRITERIA_NORMAL_TYPE ? ' checked="checked"' : '') ?>>
                    <span class="lbl"><?php echo lang('Process Based'); ?></span>
                </label>
            </div> <!-- / .radio -->
            <?php echo Validator::get_html_error_message('type'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Program Criteria'); ?></label>
            <div class="radio">
                <label>
                    <input type="radio" name="is_program" id="type1" value="1"
                           class="px" <?php echo($criteria->get_is_program() ? ' checked="checked"' : '') ?>>
                    <span class="lbl"><?php echo lang('Program & Institution Criteria'); ?></span>
                </label>
            </div> <!-- / .radio -->
            <div class="radio">
                <label>
                    <input type="radio" name="is_program" id="type2" value="0"
                           class="px" <?php echo(!$criteria->get_is_program() ? ' checked="checked"' : '') ?>>
                    <span class="lbl"><?php echo lang('Institution Criteria'); ?></span>
                </label>
            </div>
            <?php echo Validator::get_html_error_message('is_program'); ?>
        </div>


        <input type="hidden" name="id" value="<?php echo (int)$criteria->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>

