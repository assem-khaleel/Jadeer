<?php
/* @var $item Orm_Item */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">

        <?php echo form_open("/item/save"); ?>
        <div class="form-group">
            <label class="control-label"><?php echo lang('Criteria'); ?></label>
            <select name="criteria_id" class="form-control">
                <option value=""><?php echo lang('Select One'); ?></option>
                <?php foreach (Orm_Criteria::get_all(array('id')) as $criteria) : ?>
                    <?php $selected = ($criteria->get_id() == $item->get_criteria_id() ? ' selected="selected"' : ''); ?>
                    <option
                            value="<?php echo (int)$criteria->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($criteria->get_title()); ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo Validator::get_html_error_message('criteria_id'); ?>
        </div>
        <div class="form-group">
            <label class="control-label" for="code"> <?php echo lang('Code'); ?></label>
            <input name="code" type="text" class="form-control" value="<?php echo htmlfilter($item->get_code()); ?>"/>
            <?php echo Validator::get_html_error_message('code'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="title"> <?php echo lang('Title'); ?> </label>
            <input name="title" type="text" class="form-control" value="<?php echo htmlfilter($item->get_title()); ?>"/>
            <?php echo Validator::get_html_error_message('title'); ?>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$item->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>

