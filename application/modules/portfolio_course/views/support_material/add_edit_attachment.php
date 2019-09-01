<?php
/** @var $support_obj Orm_Pc_Support_Material */
switch ($fileType){
    case 'construction':
        $dataType = 'Construction Technique' ;

        break;
    case 'equipment':
        $dataType = 'Equipment Documentation';

        break;
    case 'computerDocumentation':
        $dataType = 'Computer Documentation';

        break;
    case 'troubleshootingTip':
        $dataType = 'Troubleshooting Tips';

        break;
    case 'debugging':
        $dataType = 'Debugging Tips';

        break;
    default:
        $dataType = 'Additions and Revisions';

        break;
}
?>

<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <?php echo form_open("/portfolio_course/support_material/addEditAttachment/{$fileType}/{$support_obj->get_id()}?id={$course_id}", ['method' => 'post', "class" => 'inline-form', "id" => "addEditAttachment", 'en']) ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"><?php echo $support_obj->get_id() ? lang('Edit').' '.lang($dataType) : lang('Add').' '.lang($dataType) ?></h4>
        </div>
        <div class="padding-sm-hr">
            <div class="modal-body">
            <?php    switch ($fileType) {
                case "construction":
                    $output_html = '<a href="/portfolio_course/support_material/download/' . htmlfilter($support_obj->get_id()) . '/construction?id='.htmlfilter($course_id).'" target="_blank" >' . lang('Download') . '</a>';
                    echo Uploader::draw_file_upload($support_obj, 'construction_technique_file', lang('Attachment'),$output_html);
                break;
                case "equipment":
                    $output_html = '<a href="/portfolio_course/support_material/download/' . htmlfilter($support_obj->get_id()) . '/equipment?id='.htmlfilter($course_id).'" target="_blank" >' . lang('Download') . '</a>';
                    echo Uploader::draw_file_upload($support_obj, 'equipment_documentation_file', lang('Attachment'),$output_html);

                break;
                case "computerDocumentation":
                    $output_html = '<a href="/portfolio_course/support_material/download/' . htmlfilter($support_obj->get_id()) . '/computerDocumentation?id='.htmlfilter($course_id).'" target="_blank" >' . lang('Download') . '</a>';
                    echo Uploader::draw_file_upload($support_obj, 'computer_documentation_file', lang('Attachment'),$output_html);
                break;
                case "troubleshootingTip":
                    $output_html = '<a href="/portfolio_course/support_material/download/' . htmlfilter($support_obj->get_id()) . '/troubleshootingTip?id='.htmlfilter($course_id).'" target="_blank" >' . lang('Download') . '</a>';
                    echo Uploader::draw_file_upload($support_obj, 'troubleshooting_tip_file', lang('Attachment'),$output_html);
                break;
                case "debugging":
                    $output_html = '<a href="/portfolio_course/support_material/download/' . htmlfilter($support_obj->get_id()) . '/debugging?id='.htmlfilter($course_id).'" target="_blank" >' . lang('Download') . '</a>';
                    echo Uploader::draw_file_upload($support_obj, 'debugging_tip_file', lang('Attachment'),$output_html);
                break;
                }
                ?>

                <div class="row form-group">
                    <label for="title_en" class="control-label"><?php echo lang('Text') ?> (<?php echo lang('English') ?>):</label>
                    <textarea type="text" name="title_en" class="form1 form-control select2-input"
                              placeholder="<?php echo lang('Text') ?> (<?php echo lang('English') ?>)"><?php echo $support_obj->get_file_name_en(); ?></textarea>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="control-label"><?php echo lang('Text') ?> (<?php echo lang('Arabic') ?>):</label>
                    <textarea type="text" name="title_ar" class="form1 form-control select2-input"
                              placeholder="<?php echo lang('Text') ?> (<?php echo lang('Arabic') ?>)"><?php echo $support_obj->get_file_name_ar(); ?></textarea>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row form-group">
                <div class=" text-right">
                    <button type="button" class="btn pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i
                                class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                    <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>><span
                            class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>

    $('.custom-file').pxFile();

    $('#addEditAttachment').on('submit', function (e) {
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
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }
    });

</script>