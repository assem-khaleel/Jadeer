<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('', 'id="program_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang("Generate Program Plan Courses Form"); ?></h4>
            <h5 class="modal-title"><?php echo lang("Note") . ' : ' . lang("This Process Will take a few Moments"); ?></h5>
        </div>
        <div class="modal-body">
            <?php echo $this->load->view('accreditation/form/cdp'); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left"
                    data-dismiss="modal"><span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <button type="submit" id="save" name="save" class="btn pull-right"
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-plus-circle"></span><?php echo lang('Generate'); ?></button>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script type="text/javascript">
    init_data_toggle();

    $("#program_form").submit(function () {

        $.ajax({
            type: "POST",
            url: "/accreditation/generate_courses",
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });

        return false;
    });

</script>