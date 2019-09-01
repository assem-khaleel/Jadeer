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
        <?php echo form_open("/faculty_portfolio/work/creative_work_manage" , array('id' => 'creative_work-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Creative Work'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_creative_work">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Name')?></label>
                            <div class="col-md-9">
                                <input type="text" name="name" value="<?php echo htmlfilter($creative_work->get_name()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Owner Name')?></label>
                            <div class="col-md-9">
                                <input type="text" name="owner_name" value="<?php echo htmlfilter($creative_work->get_owner_name()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('owner_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Dissemination Type')?></label>
                            <div class="col-md-9">
                                <select name="dissemination_type" class="form-control" >
                                    <option value=""><?php echo lang('Dissemination Type')?>...</option>
                                    <?php foreach(Orm_Fp_Creative_Work::$dissemination_types as $dissemination_key => $dissemination_value) { ?>
                                        <?php $selected = ($dissemination_key == $creative_work->get_dissemination_type() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $dissemination_key; ?>" <?php echo $selected; ?>><?php echo lang($dissemination_value); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('dissemination_type'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Funds Type')?></label>
                            <div class="col-md-9">
                                <select name="funds_type" class="form-control" >
                                    <option value=""><?php echo lang('Funds Type')?>...</option>
                                    <?php foreach(Orm_Fp_Creative_Work::$funds_types as $funds_key => $funds_value) { ?>
                                        <?php $selected = ($funds_key == $creative_work->get_funds_type() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $funds_key; ?>" <?php echo $selected; ?>><?php echo lang($funds_value); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('funds_type'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Funds')?></label>
                            <div class="col-md-9">
                                <input type="text" name="funds" value="<?php echo htmlfilter($creative_work->get_funds()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('funds'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Description')?></label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" ><?php echo htmlfilter($creative_work->get_description()); ?></textarea>
                                <?php echo Validator::get_html_error_message('description'); ?>
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

                        <input type="hidden" name="id" value="<?php echo intval($creative_work->get_id()); ?>" >
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

    $('#creative_work-form').on('submit', function (e) {
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