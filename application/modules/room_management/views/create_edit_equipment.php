<?php
/** @var $equipment Orm_Rm_Equipment */

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/room_management/equipments/save", array('id' => 'equipment-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Equipment Management'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="name"><?php echo lang('Equipment Title') .'-'. lang('English') ?></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="<?php echo lang('Equipment Title') .'-'. lang('English') ?>" id="name_en" name="name_en" class="form-control" value="<?php echo htmlfilter($equipment->get_name_en()) ?>">
                            <?php echo Validator::get_html_error_message('name_en'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="name"><?php echo lang('Equipment Title') .'-'. lang('Arabic') ?></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="<?php echo lang('Equipment Title').'-'. lang('Arabic') ?>" id="name_ar" name="name_ar" class="form-control" value="<?php echo htmlfilter($equipment->get_name_ar()) ?>">
                            <?php echo Validator::get_html_error_message('name_ar'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="college"><?php echo lang('Notes') ?></label>
                        <div class="col-sm-9">
                               <textarea class="form-control" name="additional"  placeholder="<?php echo lang('Notes') ?>"
                                         id="additional"><?php echo xssfilter($equipment->get_additional()) ?></textarea>
                            <?php echo Validator::get_html_error_message('additional'); ?>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id" id="id" value="<?php echo intval($equipment->get_id());?>" />
            </div>
        </div>
        <div class="modal-footer">
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

    $('#equipment-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>
