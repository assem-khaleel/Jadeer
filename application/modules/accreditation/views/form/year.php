<div class="form-group">
    <label for="due_date" class="control-label"><?php echo lang('Year'); ?></label>
    <select name="year" class="form-control">
        <?php for ($i = date('Y', strtotime('-5 year')); $i <= date('Y', strtotime('+5 year')); $i++) : ?>
            <?php $year = ($system->get_year() ? $system->get_year() : date('Y')); ?>
            <?php $selected = ($i == $year ? ' selected="selected"' : ''); ?>
            <option value="<?php echo $i; ?>"<?php echo $selected; ?>><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
    <?php echo Validator::get_html_error_message('year'); ?>
</div>