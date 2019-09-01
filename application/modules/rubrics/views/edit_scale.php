<?php
/** @var Orm_Rb_Rubrics $rubric */
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/rubrics/edit_scale/" . $rubric->get_id(), ['id' => 'scale-form', 'method' => 'post']); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Edit Scales'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <table class="table">
                    <colgroup>
                        <col class="col-md-2"/>
                        <col class="col-md-4"/>
                        <col class="col-md-4"/>
                        <col class="col-md-2"/>
                    </colgroup>
                    <thead>
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"><?php echo lang('name') . ' (' . lang('Arabic') . ')'; ?></td>
                        <td class="text-center"><?php echo lang('name') . ' (' . lang('English') . ')'; ?></td>
                        <td class="text-center"><?php echo lang('Weight') ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rubric->get_scales() as $key => $scale): ?>
                        <tr>
                            <td class="text-center"><?php echo lang('scale') . ' ' . ($key + 1); ?></td>
                            <td>
                                <input name="scale[<?php echo $key; ?>][name_ar]" id="scale_ar_<?php echo $key + 1; ?>"
                                       type="text" class="form-control"
                                       value="<?php echo htmlfilter($scale->get_name_ar()); ?>"/>
                                <div class="form-group">
                                    <?php echo Validator::get_html_error_message('name_ar', $key); ?>
                                </div>
                            </td>
                            <td>
                                <input name="scale[<?php echo $key; ?>][name_en]" id="scale_en_<?php echo $key + 1; ?>"
                                       type="text" class="form-control"
                                       value="<?php echo htmlfilter($scale->get_name_en()); ?>"/>
                                <div class="form-group">
                                    <?php echo Validator::get_html_error_message('name_en', $key); ?>
                                </div>
                            </td>
                            <td>
                                <input name="scale[<?php echo $key; ?>][weight]"
                                       id="scale_weight_<?php echo $key + 1; ?>" type="text"
                                       class="form-control  text-center"
                                       value="<?php echo htmlfilter($scale->get_weight()); ?>"/>
                                <div class="form-group">
                                    <?php echo Validator::get_html_error_message('weight', $key); ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>

                </table>
                <div class="form-group">
                    <?php echo Validator::get_html_error_message('scale'); ?>
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
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('.number').keypress(function (e) {

        var key = e.charCode || e.which;
        var char = String.fromCharCode(key);
        if (!(/[\d]/).test(char)) {
            e.preventDefault();
            return false;
        }
    });

    $('#scale-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });

        return false;
    });


</script>

