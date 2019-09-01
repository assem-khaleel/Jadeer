<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('', 'id="create_system"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Create').' '.lang('Wizard Step 2'); ?>
                :: <?php echo $system->get_name(); ?></h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <div class="checkbox hidden"></div>
                <?php echo Validator::get_html_error_message('common_error'); ?>
            </div>

            <?php $system->draw_system_forms(); ?>

            <input type="hidden" name="system" value="<?php echo get_class($system); ?>"/>
            <input type="hidden" name="type" value="<?php echo $type ?>"/>

            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left"
                    data-dismiss="modal"><span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn pull-right"
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-floppy-o"></span><?php echo lang('Build'); ?></button>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->

<script type="text/javascript">
    init_data_toggle();
    $('#create_system').on('submit', function () {
        $.ajax({
            type: "POST",
            url: "/accreditation/generate",
            data: $(this).serialize()
        }).done(function (msg) {
            $('#ajaxModalDialog').html(msg);
        }).fail(function () {
            window.location.reload();
        });

        return false;
    });
</script>