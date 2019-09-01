<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 2/24/15
 * Time: 10:58 AM
 */
/** @var Orm_Learning_Domain_Type $type */

?>


?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('/curriculum_mapping/settings/learning_domain_type_add_edit/' . intval($type->get_id()), array('id' => 'domain_type-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Learning Domain Type'); ?></span>
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <label for="title_en" class="col-md-2 control-label"><?php echo lang('Name'); ?> (<?php echo lang('English'); ?>):</label>
                <div class="col-md-10">
                    <input type="text" name="name_en" id="name_en" class="form-control" value="<?php echo htmlfilter($type->get_name_en()); ?>">
                    <?php echo Validator::get_html_error_message('name_en'); ?>
                </div>
            </div>
            <div class="row form-group">
                <label for="title_ar" class="col-md-2 control-label"><?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>):</label>
                <div class="col-md-10">
                    <input type="text" name="name_ar" id="name_ar" class="form-control" value="<?php echo htmlfilter($type->get_name_ar()); ?>">
                    <?php echo Validator::get_html_error_message('name_ar'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" id="id"  value="<?php echo htmlfilter($type->get_id()); ?>">

            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    init_data_toggle();

    $('#domain_type-form').on('submit', function (e) {
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