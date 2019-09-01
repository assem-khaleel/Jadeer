<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 23/03/17
 * Time: 01:10 م
 */

/* @var Orm_Policies_Procedures_Files $form_file */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/policies_procedures/get_form_file/{$policy_id}/forms/{$form_file->get_id()}", array('id' => 'standards-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Forms & Upload Files'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="form_en"><?php echo lang('Form') . ' ( ' . lang('English').' ) ' ?></label>
                        <div class="col-sm-9">
                            <textarea class="form-control tiny" name="form_en"
                                      id="form_en"><?php echo xssfilter($form_file->get_form_name_en()) ?></textarea>
                            <?php echo Validator::get_html_error_message('form_en'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="form_ar"><?php echo lang('Form') . ' ( ' . lang('Arabic').' ) ' ?></label>
                        <div class="col-sm-9">
                            <textarea class="form-control tiny" name="form_ar"
                                      id="form_ar"><?php echo xssfilter($form_file->get_form_name_ar()) ?></textarea>
                            <?php echo Validator::get_html_error_message('form_ar'); ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <?php
                    $output_html = '<a href="/policies_procedures/download_file/'.$form_file->get_id().'" target="_blank" >' . lang('Download') . '</a>';
                    echo Uploader::draw_file_upload($form_file, 'file_path', lang('Attachment'),$output_html);
                    ?>
                </div>


            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo intval($form_file->get_id()) ?>">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
                </button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <script type="text/javascript">

        $('#standards-form').on('submit', function (e) {
            e.preventDefault();
            var files = $(":file:enabled", this);

            if (files.length) {
                $.ajax($(this).attr('action'), {
                    data: $(this).serializeArray(),
                    files: $(":file:enabled", this),
                    iframe: true,
                    dataType: 'JSON'
                }).complete(function (data) {
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
                if (msg.status == 1) {
                    window.location.reload();
                } else {
                    console.log(msg.html);
                    $('#ajaxModalDialog').html(msg.html);
                }
            }
        });
        $('.custom-file').pxFile();

    </script>
