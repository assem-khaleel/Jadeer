<?php
/* @var $risk Orm_Sp_Risk_Tab */
/* @var $obj_id integer */
/* @var $class string */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($risk->get_id())) {
                echo lang('Create').' '.lang('Risk Tab');
            } else {
                echo lang('Edit').' '.lang('Risk Tab');
            }
            ?>
        </div>
        <?php echo form_open("",'id="risk_tab-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo lang('Content'); ?> :</label>

                    <div class="col-sm-10">
                        <textarea name="risk" class="form-control" rows="4"
                                  cols="10"><?php echo htmlfilter($risk->get_risk()); ?></textarea>
                        <?php echo Validator::get_html_error_message('risk'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo lang('Impact'); ?> :</label>

                    <div class="col-sm-10">
                        <textarea name="impact" class="form-control" rows="4"
                                  cols="10"><?php echo htmlfilter($risk->get_impact()); ?></textarea>
                        <?php echo Validator::get_html_error_message('impact'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($risk->get_id()); ?>">
                <input type="hidden" name="obj_id" value="<?php echo urlencode($obj_id); ?>">
                <input type="hidden" name="class" value="<?php echo urlencode($class); ?>">
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();
    $('form#risk_tab-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/risk_tab/save',
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