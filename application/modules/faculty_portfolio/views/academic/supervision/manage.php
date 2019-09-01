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
        <?php echo form_open("/faculty_portfolio/academic/supervision_manage" , array('id' => 'supervision-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Supervision'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_supervision">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Level')?></label>
                            <div class="col-md-9">
                                <select name="level" class="form-control" >
                                    <?php foreach(Orm_Fp_Advising::$levels as $level_key => $level_value) { ?>
                                        <?php $selected = ($level_key == $supervision->get_level() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $level_key; ?>" <?php echo $selected; ?>><?php echo lang($level_value); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('level'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Supervision Type')?></label>
                            <div class="col-md-9">
                                <select name="thises_type" class="form-control" >
                                    <?php foreach(Orm_Fp_Supervision::$types as $level_key => $level_value) { ?>
                                        <?php $selected = ($level_key == $supervision->get_thises_type() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $level_key; ?>" <?php echo $selected; ?>><?php echo lang($level_value); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('thises_type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Supervision')?></label>
                            <div class="col-md-9">
                                <select name="type" class="form-control" >
                                    <?php foreach(Orm_Fp_Research::$author_types as $type_key => $type_value) { ?>
                                        <?php $selected = ($type_key == $supervision->get_type() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $type_key; ?>" <?php echo $selected; ?>><?php echo lang($type_value); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('thises_type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Thesis Title')?> (<?php echo lang('Arabic') ?>)</label>
                            <div class="col-md-9">
                                <input type="text" name="thises_title_ar" value="<?php echo htmlfilter($supervision->get_thises_title_ar()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('thises_title_ar'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Thesis Title')?> (<?php echo lang('English') ?>)</label>
                            <div class="col-md-9">
                                <input type="text" name="thises_title_en" value="<?php echo htmlfilter($supervision->get_thises_title_en()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('thises_title_en'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Grant Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="grant_date" value="<?php echo $supervision->get_grant_date() != '0000-00-00' ? htmlfilter($supervision->get_grant_date()) : ''; ?>" readonly="readonly" class="form-control date-picker" >
                                <?php echo Validator::get_html_error_message('grant_date'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Researcher')?></label>
                            <div class="col-md-9">
                                <input type="text" name="researcher" value="<?php echo htmlfilter($supervision->get_researcher()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('researcher'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Summary')?> (<?php echo lang('Arabic')?>)</label>
                            <div class="col-md-9">
                                <input type="text" name="summary_ar" value="<?php echo htmlfilter($supervision->get_summary_ar()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('summary_ar'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Summary')?> (<?php echo lang('English')?>)</label>
                            <div class="col-md-9">
                                <input type="text" name="summary_en" value="<?php echo htmlfilter($supervision->get_summary_en()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('summary_en'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo lang('Attachment'); ?></label>
                            <div class="col-md-9">
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
                        <input type="hidden" name="id" value="<?php echo intval($supervision->get_id()); ?>" >
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
    $(".date-picker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('#supervision-form').on('submit', function (e) {
        e.preventDefault();

        var files = $(":file:enabled", this);

        if(files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: $(":file:enabled", this),
                iframe: true,
                dataType: "json"
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

    $('.custom-file').pxFile();

</script>