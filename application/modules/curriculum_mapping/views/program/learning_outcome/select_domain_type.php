<?php
/* @var $domain_types Orm_Learning_Domain_Type[] */
$type_selected = Orm_Cm_Program_Domain::get_one(array('program_id'=>$program_id,'semester_id'=>Orm_Semester::get_active_semester()->get_id()));

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/program/save_domain_type", array('id' => 'map-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Domain Type'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

<!--                <div class="alert alert-warning">-->
<!--                    <button type="button" class="close" data-dismiss="alert">×</button>-->
<!--                    <strong>--><?php //echo lang('Warning')?><!-- !</strong> --><?php //echo lang('you will lose learning outcomes if you change the type several times')?>
<!--                </div>-->

                <div class="row form-group">
                    <label for="type" class="col-md-3 control-label"><?php echo lang('Learning Domain Types'); ?>:</label>
                    <div class="col-md-9">
                        <select name="type" id="type" class="form-control">
                            <option value=""> <?php echo lang('Select One')?></option>
                            <?php foreach ($domain_types as $domain_type) { ?>
                                <?php $selected = ($domain_type->get_id() == $type_selected->get_domain_type() ? 'selected="selected"' : ''); ?>
                                <option value="<?php echo intval($domain_type->get_id()); ?>" <?php echo $selected; ?> >
                                    <?php echo htmlfilter($domain_type->get_name()); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <?php echo Validator::get_html_error_message_no_arrow('type'); ?>
                    </div>
                </div>
                <input type="hidden" name="id" id="id" value="<?php echo intval($type_selected->get_id());?>" />
                <input type="hidden" name="program_id" id="program_id" value="<?php echo intval($program_id);?>" />
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

    $('#map-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.success == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>
