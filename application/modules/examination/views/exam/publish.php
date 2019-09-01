<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 10:32 ص
 */
/* @var $exam Orm_Tst_Exam*/
$method_duration = $this->input->get_post('method')?: 1;
$duration = $this->input->get_post('duration')?: '00:00';

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/examination/publish/".($exam->get_id()?: ''), array('id' => 'exam_form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Publish Exam'); ?></span>
        </div>
        <div class="modal-body">

            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="custom-control custom-radio">
                            <input type="radio" value="1" name="method" <?php echo $method_duration==1? 'checked="checked" ': '' ?>class="custom-control-input"/>
                            <span class="custom-control-indicator"></span>&nbsp;
                            <?php echo lang('Publish By Date'); ?>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="custom-control custom-radio">
                            <input type="radio" value="2" name="method" <?php echo $method_duration==2? 'checked="checked" ': '' ?>class="custom-control-input"/>
                            <span class="custom-control-indicator"></span>
                            <?php echo lang('Publish Now'); ?>
                        </label>
                    </div>
                </div>

                <div class="clearfix"></div>
                <hr>

                <div data-method="1" style="display: <?php echo $method_duration==2? 'none" ': '' ?>;">
                    <div class="form-group">
                        <label class="control-label" for="date"> <?php echo lang('Exam Date'); ?></label>
                        <input name="date" id="date" type="text" class="form-control date" value="<?php echo htmlfilter($exam->get_start_date()); ?>"/>
                        <?php echo Validator::get_html_error_message('date'); ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="start_time"> <?php echo lang('Start Time'); ?></label>
                        <input name="start_time" id="start_time" type="text" class="form-control time"
                               value="<?php echo htmlfilter($exam->get_start_time()); ?>"/>
                        <?php echo Validator::get_html_error_message('start_time'); ?>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="end_time"> <?php echo lang('End Time'); ?></label>
                        <input name="end_time" id="end_time" type="text" class="form-control time"
                               value="<?php echo htmlfilter($exam->get_end_time()); ?>"/>
                        <?php echo Validator::get_html_error_message('end_time'); ?>
                    </div>
                </div>

                <div data-method="2" style="display: <?php echo $method_duration==1? 'none" ': '' ?>;">

                    <div class="form-group">
                        <label class="control-label" for="end_time"> <?php echo lang('Duration'); ?></label>
                        <input name="duration" id="duration" type="text" class="form-control" value="<?php echo $duration ?>"/>
                        <?php echo Validator::get_html_error_message('duration'); ?>
                    </div>
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
    $('.time').timepicker({ 'scrollDefault': 'now' });
    $('#duration').timepicker({
            defaultTime: '00:00',
            minuteStep: 1,
            showSeconds: false,
            showMeridian: false,
            showInputs: false,
            orientation: $('body').hasClass('right-to-left') ? { x: 'right', y: 'auto'} : { x: 'auto', y: 'auto'}
        });


    $('input[name="method"]').change(function () {

        $('div[data-method="1"]').toggle($('input[name="method"][value=1]').prop('checked'));
        $('div[data-method="2"]').toggle($('input[name="method"][value=2]').prop('checked'));

    });


    $('#exam_form').submit(function(e){
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
