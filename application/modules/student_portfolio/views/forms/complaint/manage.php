<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/7/16
 * Time: 3:17 PM
 */
/** @var $complaint Orm_Stp_Complaints */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/student_portfolio/complaint_manage", 'id="complaint-form" class="form-horizontal"') ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Complaints'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="complaints" class="col-sm-2 control-label"><?php echo lang('Complaints'); ?></label>
                <div class="col-sm-10">
                    <textarea name="complaints" class="form-control" id="complaints"><?php echo xssfilter($complaint->get_complaints()); ?></textarea>
                    <?php echo Validator::get_html_error_message('complaints'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="date" class="col-sm-2 control-label"><?php echo lang('Date'); ?>:</label>
                <div class="col-sm-10">
                    <input type="text" readonly="readonly" name="date" class="form-control date" value="<?php echo $complaint->get_date()=='' || $complaint->get_date() == '0000-00-00' ? '' : date('Y-m-d', strtotime($complaint->get_date())); ?>" id="date"/>
                    <?php echo Validator::get_html_error_message('date'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo lang('Attachment'); ?></label>
                <div class="col-md-10">
                    <label class="custom-file px-file" id="attachment">
                        <input type="file" name="attachment" class="custom-file-input">
                        <span class="custom-file-control form-control"> <?php echo lang('Attachment'); ?></span>
                        <div class="px-file-buttons">
                            <button type="button" class="btn px-file-clear"><?php echo lang('Clear') ?></button>
                            <button type="button" class="btn btn-primary px-file-browse"><?php echo lang('Browse') ?></button>
                        </div>
                    </label>
                    <?php echo Validator::get_html_error_message('attachment'); ?>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo intval($complaint->get_id()); ?>" >
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('.custom-file').pxFile();

    $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true});

    $('#complaint-form').on('submit', function (e) {
        e.preventDefault();


        var files = $(":file:enabled", this);

        if(files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: $(":file:enabled", this),
                iframe: true,
                dataType: "JSON"
            }).complete(function(data) {
                handle_response(data.responseJSON);
            });
        } else {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'JSON'
            }).done(function (msg) {
                handle_response(msg);
            });
        }

        function handle_response(msg) {
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }

    });
</script>