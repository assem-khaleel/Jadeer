<?php
/* @var $value Orm_Sp_Values */
/* @var $item Orm_Sp_Strategy */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($value->get_id())) {
                echo lang('Create').' '.lang('Value');
            } else {
                echo lang('Edit').' '.lang('Value');
            }
            ?>
        </div>
        <?php echo form_open("/strategic_planning/value/add_edit?strategy_id={$item->get_id()}",'id="value-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="en_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_en" class="form-control"
                               value="<?php echo htmlfilter($value->get_title_en()); ?>" id="en_title"/>
                        <?php echo Validator::get_html_error_message('title_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ar_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_ar" class="form-control"
                               value="<?php echo htmlfilter($value->get_title_ar()); ?>" id="ar_title"/>
                        <?php echo Validator::get_html_error_message('title_ar'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc_en" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                        (<?php echo lang('English'); ?>):</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="desc_en"
                                  name="desc_en"><?php echo htmlfilter($value->get_desc_en()); ?></textarea>
                        <?php echo Validator::get_html_error_message('desc_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc_ar" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                        (<?php echo lang('Arabic'); ?>):</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="desc_ar"
                                  name="desc_ar"><?php echo htmlfilter($value->get_desc_ar()); ?></textarea>
                        <?php echo Validator::get_html_error_message('desc_ar'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo $value->get_id(); ?>">
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();
    $('form#value-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/value/save?strategy_id=<?php echo urlencode($item->get_id()); ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error == false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>