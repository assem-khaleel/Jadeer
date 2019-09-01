<?php
/** @var Orm_Fp_Forms $form */
$results = isset($results) && is_array($results) ? $results : array();
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_performance/save/{$type_id}", array('id' => 'add-edit-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo htmlfilter($form->get_form_name()) ?></span>
        </div>
        <div class="modal-body">
            <?php
            foreach ($form->get_inputs() as $input) {
                echo Orm_Fp_Forms::get_static_form($input, isset($results[$input->get_id()]) ? $results[$input->get_id()] : new Orm_Fp_Forms_Result())->draw();
            }
            ?>
        </div>
        <div class="modal-footer">
            <input type="hidden" id="form_id" name="form_id" value="<?php echo intval($form->get_id()) ?>">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $('#add-edit-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.reload) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>
