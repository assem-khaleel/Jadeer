<?php
/**
 * Created by PhpStorm.
 * User: appleuser
 * Date: 9/21/15
 * Time: 9:50 AM
 */
/* @var Orm_Sp_Strategy $mission */
//$title_english = $mission->get_mission_en() ?: $mission->get_item_obj()->get_mission_en();
//$title_arabic  = $mission->get_mission_ar() ?: $mission->get_item_obj()->get_mission_ar();
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($mission->get_id())) {
                echo lang('Create').' '.lang('Mission');
            } else {
                echo lang('Edit').' '.lang('Mission');
            }
            ?>
        </div>
        <?php echo form_open("",'id="mission-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="mission_title_en" class="col-sm-2 control-label"><?php echo lang('Mission'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="title_english"
                                  name="title_english"><?php echo htmlfilter($mission->get_mission_en()); ?></textarea>
                        <?php echo Validator::get_html_error_message('title_english'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mission_title_ar" class="col-sm-2 control-label"><?php echo lang('Mission'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="title_arabic"
                                  name="title_arabic"><?php echo htmlfilter($mission->get_mission_ar()); ?></textarea>
                        <?php echo Validator::get_html_error_message('title_arabic'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($mission->get_id()); ?>">
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
                <button type="button" class="btn btn-sm pull-right  integrate" data-target="modal" <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-retweet"></i></span><?php echo lang('Integrate'); ?></button>

            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();
    $('form#mission-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/save_mission',
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
        return false;
    });

    $(".integrate").on("click",function(e){
        e.preventDefault();
        $.ajax({
            url: '/strategic_planning/integrate_mission',
            data: $('form#mission-form').serialize(),
            type: 'POST'
        }).done(function (html) {
            $('#ajaxModalDialog').html(html);
        });

    });
</script>