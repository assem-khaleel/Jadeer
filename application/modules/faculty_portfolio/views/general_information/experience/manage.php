<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/10/16
 * Time: 12:06 PM
 */

/**
 * @var $experience Orm_Fp_Experience
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/experience_manage" , array('id' => 'experience-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Experience'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_experience">
                <tr class="item">
                    <td class="col-md-10">
                        <div class="form-group form-horizontal">
                            <label class="control-label col-md-3"><?php echo lang('Organization')?></label>
                            <div class="col-md-9">
                                <input type="text" name="organization" value="<?php echo htmlfilter($experience->get_organization()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('organization'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Date From')?></label>
                            <div class="col-md-9">
                                <input type="text" name="date_from" value="<?php echo $experience->get_date_from() != '0000-00-00' ? htmlfilter($experience->get_date_from()) : ''; ?>" readonly="readonly" class="form-control datepicker_date">
                                <?php echo Validator::get_html_error_message('date_from'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Date To')?></label>
                            <div class="col-md-9">
                                <input type="text" name="date_to" value="<?php echo $experience->get_date_to() != '0000-00-00' ? htmlfilter($experience->get_date_to()) : ''; ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('date_to'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Position')?></label>
                            <div class="col-md-9">
                                <input type="text" name="position" value="<?php echo htmlfilter($experience->get_position()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('position'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Address')?></label>
                            <div class="col-md-9">
                                <textarea name="address" class="form-control" ><?php echo htmlfilter($experience->get_address()); ?></textarea>
                                <?php echo Validator::get_html_error_message('address'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Description')?></label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" ><?php echo htmlfilter($experience->get_description()); ?></textarea>
                                <?php echo Validator::get_html_error_message('description'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($experience->get_id()); ?>" >
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

    $('#experience-form').on('submit', function (e) {
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