<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/10/16
 * Time: 12:06 PM
 */

/**
 * @var $conference Orm_Fp_Conference
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/publication/conference_manage" , array('id' => 'conference-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Conference'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_conference">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Is Workshop')?></label>
                            <div class="col-md-9">
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="is_workshop" value="1" class="px" <?php echo ($conference->get_is_workshop() ? 'checked="checked"' : ''); ?>>
                                        <span class="lbl"><?php echo lang('Yes') ?></span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="is_workshop" value="0" class="px" <?php echo (!$conference->get_is_workshop() ? 'checked="checked"' : ''); ?>>
                                        <span class="lbl"><?php echo lang('No') ?></span>
                                    </label>
                                </div>
                                <?php echo Validator::get_html_error_message('is_workshop'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Name')?></label>
                            <div class="col-md-9">
                                <input type="text" name="name" value="<?php echo htmlfilter($conference->get_name()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="date" value="<?php echo $conference->get_date() != '0000-00-00' ? htmlfilter($conference->get_date()) : ''; ?>" class="form-control datepicker_date" readonly="readonly">
                                <?php echo Validator::get_html_error_message('date'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Location')?></label>
                            <div class="col-md-9">
                                <input type="text" name="location" value="<?php echo htmlfilter($conference->get_location()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('location'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Participation Type')?></label>
                            <div class="col-md-9">
                                <select name="participation_type" class="form-control" >
                                    <?php foreach(Orm_Fp_Conference::$PARTICIPATION_TYPES as $participation_type_key => $participation_type) { ?>
                                        <?php $selected = ($participation_type_key == $conference->get_participation_type() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $participation_type_key; ?>" <?php echo $selected; ?>><?php echo lang($participation_type); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('participation_type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Description')?></label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" ><?php echo htmlfilter($conference->get_description()); ?></textarea>
                                <?php echo Validator::get_html_error_message('description'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($conference->get_id()); ?>" >
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

    $('#conference-form').on('submit', function (e) {
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