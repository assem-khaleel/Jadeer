<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/program/assessment_method_add_edit/{$program_id}" , array('id' => 'program-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo Orm_Program::get_instance($program_id)->get_name() ?></span>
        </div>
        <div class="modal-body">

            <div class="form-group">

                <label class="control-label" for="method_id"><?php echo lang('Assessment Method'); ?></label>

                <hr class="m-t-0">

                <?php foreach(Orm_Cm_Assessment_Method::get_all() as $method) { ?>
                    <div class="checkbox">
                        <label>
                            <input name="assessment_method_ids[]" value="<?php echo $method->get_id(); ?>" class="px" type="checkbox" <?php echo in_array($method->get_id(), $program_assessment_method_ids) ? 'checked="checked"' : '' ?>>
                            <span class="lbl"><?php echo $method->get_title(); ?></span>
                        </label>
                    </div>
                <?php } ?>

                <?php echo Validator::get_html_error_message('method_id'); ?>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#program-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {

            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>