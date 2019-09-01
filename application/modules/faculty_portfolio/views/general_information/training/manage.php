<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/8/16
 * Time: 12:06 PM
 */

/**
 * @var $training Orm_Fp_Training
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/training_manage" , array('id' => 'training-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Trainings'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_training">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Title')?></label>
                            <div class="col-md-9">
                                <input type="text" name="title" value="<?php echo htmlfilter($training->get_title()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="date" value="<?php echo $training->get_date() != '0000-00-00' ? htmlfilter($training->get_date()) : ''; ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('date'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Duration')?></label>
                            <div class="col-md-9">
                                <input type="text" name="duration" value="<?php echo htmlfilter($training->get_duration()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('duration'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Address')?></label>
                            <div class="col-md-9">
                                <textarea name="address" class="form-control" ><?php echo htmlfilter($training->get_address()); ?></textarea>
                                <?php echo Validator::get_html_error_message('address'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Description')?></label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" ><?php echo htmlfilter($training->get_description()); ?></textarea>
                                <?php echo Validator::get_html_error_message('description'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($training->get_id()); ?>" >
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $(".datepicker_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('#training-form').on('submit', function (e) {
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