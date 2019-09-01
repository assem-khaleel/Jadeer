<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/7/16
 * Time: 3:17 PM
 */
/** @var $activity Orm_Stp_Activities */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('activities'); ?>
        </div>

        <?php echo form_open("/student_portfolio/activity_manage",'id="activity-form" class="form-horizontal"') ?>
        <div class="modal-body">
            <div class="form-group">
                <label for="title" class="col-sm-3 "><?php echo lang('Title'); ?></label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" value="<?php echo htmlfilter($activity->get_title()); ?>" id="title"/>
                    <?php echo Validator::get_html_error_message('title'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-sm-3 "><?php echo lang('Date'); ?>:</label>
                <div class="col-sm-9">
                    <input type="text" readonly="readonly" name="date" class="form-control date" value="<?php echo $activity->get_date() == '0000-00-00' || $activity->get_date() == '' ? '' : date('Y-m-d', strtotime($activity->get_date())); ?>" id="date"/>
                    <?php echo Validator::get_html_error_message('date'); ?>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo intval($activity->get_id()); ?>" >
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>

    $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true});

    $('form#activity-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>