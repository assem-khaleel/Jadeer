<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/7/16
 * Time: 3:17 PM
 */
/** @var array $services */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/student_portfolio/community_manage" , array('id' => 'service-form' , 'class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Services'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class=" col-md-3"><?php echo lang('Date')?></label>
                <div class="col-md-9">
                    <input type="text" name="date" readonly value="<?php echo htmlfilter($service->get_date()=='0000-00-00'? '': $service->get_date()); ?>" class="form-control date" >
                    <?php echo Validator::get_html_error_message('date'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-md-3"><?php echo lang('Location')?></label>
                <div class="col-md-9">
                    <input type="text" name="location" value="<?php echo htmlfilter($service->get_location()); ?>" class="form-control" >
                    <?php echo Validator::get_html_error_message('location'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-md-3"><?php echo lang('Number Of Hours')?></label>
                <div class="col-md-9">
                    <input type="text" name="number_of_hours" value="<?php echo htmlfilter($service->get_number_of_hours()); ?>" class="form-control" >
                    <?php echo Validator::get_html_error_message('number_of_hours'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-md-3"><?php echo lang('Supervisor')?></label>
                <div class="col-md-9">
                    <input type="text" name="supervisor" value="<?php echo htmlfilter($service->get_supervisor()); ?>" class="form-control" >
                    <?php echo Validator::get_html_error_message('supervisor'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-md-3"><?php echo lang('Description')?></label>
                <div class="col-md-9">
                    <textarea name="description" class="form-control" ><?php echo htmlfilter($service->get_description()); ?></textarea>
                    <?php echo Validator::get_html_error_message('description'); ?>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo intval($service->get_id()); ?>" >
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true});

    $('#service-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>