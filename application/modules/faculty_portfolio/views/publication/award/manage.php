<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/10/16
 * Time: 12:06 PM
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/publication/award_manage" , array('id' => 'award-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Award'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_award">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Name')?></label>
                            <div class="col-md-9">
                                <input type="text" name="name" value="<?php echo htmlfilter($award->get_name()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Domain')?></label>
                            <div class="col-md-9">
                                <input type="text" name="domain" value="<?php echo htmlfilter($award->get_domain()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('domain'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Party')?></label>
                            <div class="col-md-9">
                                <input type="text" name="party" value="<?php echo htmlfilter($award->get_party()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('party'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="date" readonly="readonly" value="<?php echo htmlfilter($award->get_date()); ?>" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('date'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Address')?></label>
                            <div class="col-md-9">
                                <input type="text" name="address" value="<?php echo htmlfilter($award->get_address()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('address'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Material Value')?></label>
                            <div class="col-md-9">
                                <input type="text" name="material_value" value="<?php echo htmlfilter($award->get_material_value()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('material_value'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Moral Value')?></label>
                            <div class="col-md-9">
                                <input type="text" name="moral_value" value="<?php echo htmlfilter($award->get_moral_value()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('moral_value'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Description')?></label>
                            <div class="col-md-9">
                                <input type="text" name="description" value="<?php echo htmlfilter($award->get_description()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('description'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($award->get_id()); ?>" >
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
    $('#award-form').on('submit', function (e) {
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