<?php
/* @var Orm_Pm_Phase $phase */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($phase->get_id())) {
                echo lang('Create').' '.lang('Phase');
            } else {
                echo lang('Edit').' '.lang('Phase');
            }
            ?>
        </div>

        <?php echo form_open("/project_management/save",'id="phase-form" class="form-horizontal"') ?>
        <div class="modal-body">

            <div class="form-group">
                <label for="phase_title_en" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                    (<?php  echo lang('English'); ?>): *</label>

                <div class="col-sm-10">
                    <input type="text" name="title_en" class="form-control"
                           value="<?php echo htmlfilter($phase->get_title_en()); ?>" id="phase_title_en"/>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="phase_title_ar" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                    (<?php echo lang('Arabic'); ?>): *</label>

                <div class="col-sm-10">
                    <input type="text" name="title_ar" class="form-control"
                           value="<?php echo htmlfilter($phase->get_title_ar()); ?>" id="phase_title_ar"/>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="start_date" class="col-sm-2 control-label"><?php echo lang('Start Date'); ?>: *</label>

                <div class="col-sm-10">
                    <input type="text" name="start_date" class="form-control date-picker" id="start_date"
                           readonly="readonly"
                           value="<?php echo ($phase->get_start_date() != '0000-00-00'?$phase->get_start_date():'')  ?>"/>
                    <?php echo Validator::get_html_error_message('start_date'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="end_date" class="col-sm-2 control-label"><?php echo lang('End Date'); ?>: *</label>

                <div class="col-sm-10">
                    <input type="text" name="end_date" class="form-control date-picker" id="end_date"
                           readonly="readonly"
                           value="<?php echo ($phase->get_end_date() != '0000-00-00'?$phase->get_end_date():'') ?>"/>
                    <?php echo Validator::get_html_error_message('end_date'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="desc_en" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                    (<?php echo lang('English'); ?>): </label>

                <div class="col-sm-10">
                        <textarea name="desc_en" class="form-control"
                                  id="desc_en"><?php echo htmlfilter($phase->get_desc_en()) ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="desc_ar" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                    (<?php echo lang('Arabic'); ?>): </label>

                <div class="col-sm-10">
                        <textarea name="desc_ar" class="form-control"
                                  id="desc_ar"><?php echo htmlfilter($phase->get_desc_ar()) ?></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="project_id" value="<?php echo intval($project_id);?>">
            <input type="hidden" name="project_type" value="<?php echo intval($project_type);?>">
            <?php if(isset($phase_id)): ?>
            <input type="hidden" name="phase_id" value="<?php echo intval($phase_id);?>">
            <?php endif; ?>
            <button type="button" class="btn btn-sm pull-left "
                    data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    var options = {
        todayBtn: "linked",
        orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
        format: 'yyyy-mm-dd',
        autoclose: true
    };
    $('.date-picker').datepicker(options);

    $('form#phase-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/project_management/save',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error === false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>