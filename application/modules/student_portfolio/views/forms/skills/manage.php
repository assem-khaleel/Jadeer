<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/8/16
 * Time: 12:06 PM
 */

/**
 * @var $skill Orm_Stp_Skill
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open_multipart("/student_portfolio/skill_manage" , array('id' => 'skill-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Skills'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_skill">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label for="skill_name_en" class="control-label col-md-3"><?php echo lang('Skill'). ' ( ' . lang('English') . ' ) ' ?></label>
                            <div class="col-md-9">
                                <input type="text" name="skill_name_en" value="<?php echo htmlfilter($skill->get_skill_name()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('skill_name_en'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="skill_name_ar" class="control-label col-md-3"><?php echo lang('Skill'). ' ( ' . lang('Arabic') . ' ) ' ?></label>
                            <div class="col-md-9">
                                <input type="text" name="skill_name_ar" value="<?php echo htmlfilter($skill->get_skill_name()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('skill_name_ar'); ?>
                            </div>
                        </div>

                        <hr>

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

                        <input type="hidden" name="id" value="<?php echo intval($skill->get_id()); ?>" >
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

    $('#skill-form').on('submit', function (e) {
        e.preventDefault();

        var files = $(":file:enabled", this);


        if(files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: files,
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
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }

    });

    $('.custom-file').pxFile();
</script>