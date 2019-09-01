<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader
 * Date: 03/05/17
 * Time: 10:32 ص
 */
/* @var $assignment Orm_Tst_Exam*/

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/examination/assignments/publish/".($assignment->get_id()?: ''), array('id' => 'assignment_form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Publish Assignment'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label" for="start_time"> <?php echo lang('Start Date'); ?></label>
                    <input name="start" id="start_time" type="text" class="form-control date"
                           value="<?php echo htmlfilter($assignment->get_start_date()); ?>"/>
                    <?php echo Validator::get_html_error_message('start'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for="end_time"> <?php echo lang('End Date'); ?></label>
                    <input name="end" id="end_time" type="text" class="form-control date"
                           value="<?php echo htmlfilter($assignment->get_end_date()); ?>"/>
                    <?php echo Validator::get_html_error_message('end'); ?>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
                </button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Publish'); ?>
                </button>
            </div>


        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true, startDate: '<?php echo date('Y-m-d') ?>'});


    $('#assignment_form').submit(function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>
