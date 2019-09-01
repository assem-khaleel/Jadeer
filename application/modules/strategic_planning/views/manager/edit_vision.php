<?php
/* @var Orm_Sp_Strategy $vision */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!$vision->get_id()) {
                echo lang('Create').' '.lang('Vision');
            } else {
                echo lang('Edit').' '.lang('Vision');
            }
            ?>
        </div>
        <?php echo form_open("",'id="vision-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="en_title" class="col-sm-2 control-label"><?php echo lang('Vision'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="title_english"
                                  name="title_english"><?php echo htmlfilter($vision->get_vision_en()); ?></textarea>
                        <?php echo Validator::get_html_error_message('title_english'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ar_title" class="col-sm-2 control-label"><?php echo lang('Vision'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="title_arabic"
                                  name="title_arabic"><?php echo htmlfilter($vision->get_vision_ar()); ?></textarea>
                        <?php echo Validator::get_html_error_message('title_arabic'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($vision->get_id()); ?>">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
                <button type="button" class="btn btn-sm pull-right  integrate" data-target="modal" <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-retweet"></i></span><?php echo lang('Integrate'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();
    $('form#vision-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/strategic_planning/save_vision',
            type: 'POST',
            data: $('#vision-form').serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error === false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
        return false;
    });
    $(".integrate").on("click",function(e){
        e.preventDefault();
        $.ajax({
            url: '/strategic_planning/integrate_vision',
            data: $('form#vision-form').serialize(),
            type: 'POST'
        }).done(function (html) {
            $('#ajaxModalDialog').html(html);
        });

    });
</script>