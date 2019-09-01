<?php
/** @var $reviewer Orm_Acc_Independent_Reviewer */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/accreditation/reviewer_independent/reviewer_add/{$reviewer->get_type()}/{$reviewer->get_type_id()}/{$reviewer->get_id()}", 'id="reviewer_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Add').' '.lang('Reviewer'); ?></h4>
        </div>
        <div class="modal-body">
            <?php echo Orm_User_Staff::draw_find_users('reviewer_id', $reviewer->get_reviewer_id(), lang('Reviewer')) ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left" data-dismiss="modal">
                <span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn pull-right" >
                <span class="btn-label-icon left fa fa-save"></span><?php echo lang('Save'); ?>
            </button>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script>
    $('#reviewer_form').submit(function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
        }).done(function (msg) {
            $('#ajaxModalDialog').html(msg);
        }).fail(function () {
            window.location.reload();
        });

    });
</script>