<?php
/* @var $milestone Orm_Sp_Objective_Milestone */
/* @var $objective Orm_Sp_Objective */
/* @var $strategy Orm_Sp_Strategy */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!$milestone->get_id()) {
                echo lang('Create').' '.lang('Objective Milestone');
            } else {
                echo lang('Edit').' '.lang('Objective Milestone');
            }
            ?>
        </div>
        <?php echo form_open("",'id="milestone-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="year" class="col-sm-2 control-label"><?php echo lang('Year'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="number" name="year" class="form-control"
                               value="<?php echo htmlfilter($milestone->get_year()); ?>" id="year"/>
                        <?php echo Validator::get_html_error_message('year'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="target" class="col-sm-2 control-label"><?php echo lang('Target'); ?>: *</label>

                    <div class="col-sm-10">
                        <input type="number" name="target" class="form-control"
                               value="<?php echo htmlfilter($milestone->get_target()); ?>" id="target"/>
                        <?php echo Validator::get_html_error_message('target'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input name="ajax" value="post" type="hidden"/>
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
     init_data_toggle();
    $('form#milestone-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '/strategic_planning/objective/milestone?id=<?php echo urlencode($objective->get_id()) .'&strategy_id='. urlencode($strategy->get_id()); ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error == false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>