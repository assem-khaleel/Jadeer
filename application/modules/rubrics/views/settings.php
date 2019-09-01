<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 3/23/17
 * Time: 2:28 PM
 */

/** @var Orm_Rb_Settings[] $settings */
?>
<?php echo form_open('/rubrics/settings', ['id'=>'save']); ?>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('settings'); ?></span>
    </div>
    <div class="panel-body">
        <?php foreach ($settings as $setting): ?>
            <div class="form-group">
                <label><?php echo lang($setting->get_key_text()); ?></label>
                <input type="text" name="value[<?php echo $setting->get_key_text() ?>]" class="form-control"
                       value="<?php echo htmlfilter(isset($values[$setting->get_key_text()]) ? $values[$setting->get_key_text()] : $setting->get_key_value()); ?>"/>
                <?php echo Validator::get_html_message($setting->get_key_text()); ?>
                <hr>
            </div>
        <?php endforeach; ?>
        <button class="btn btn-outline" type="submit">
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
    </div>
</div>
<?php echo form_close(); ?>
