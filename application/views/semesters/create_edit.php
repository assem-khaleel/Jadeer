<?php
/* @var $semester Orm_Semester */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">

        <?php echo form_open('/semester/save'); ?>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Name') . ' (' . lang('English') . ')' ?> *</label>
            <input name="name_en" type="text" class="form-control"
                   value="<?php echo htmlfilter($semester->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Name') . ' (' . lang('Arabic') . ')' ?> *</label>
            <input name="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($semester->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Start date') ?> *</label>
            <?php
            $start = '';
            if ($semester->get_start() != '0000-00-00') {
                $start = $semester->get_start();
            }
            ?>
            <input name="start" type="text" class="form-control date" value="<?php echo $start; ?>"/>
            <?php echo Validator::get_html_error_message('start'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('End date') ?> *</label>
            <?php
            $end = '';
            if ($semester->get_end() != '0000-00-00') {
                $end = $semester->get_end();
            }
            ?>
            <input name="end" type="text" class="form-control date" value="<?php echo $end; ?>"/>
            <?php echo Validator::get_html_error_message('end'); ?>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$semester->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
    });
</script>