<?php
/** @var $outcomes Orm_Cm_Program_Learning_Outcome[] */
/** @var int $program_id */
/** @var Orm_Cm_Learning_Domain $domain */

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/program/learning_outcome_target/{$program_id}/{$domain->get_id()}" , array('id' => 'program-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo $domain->get_title(); ?></span>
        </div>
        <div class="modal-body">
            <div class="table-primary">
                <table class="table table-bordered more_items" id="more_learning_outcome">
                    <thead>
                    <tr>
                        <th class="col-md-1"><?php echo lang('Code'); ?></th>
                        <th class="col-md-8"><?php echo lang('Outcome'); ?></th>
                        <th class="col-md-3"><?php echo lang('Target'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($outcomes as $outcome) { ?>
                        <tr>
                            <td><?php echo htmlfilter($outcome->get_code()); ?></td>
                            <td><?php echo htmlfilter($outcome->get_text()); ?></td>
                            <td>
                                <div class="input-group">

                                    <input type="text" value="<?php echo $outcome->get_target_obj()->get_target(); ?>" name="outcome[<?php echo $outcome->get_id() ?>][target]" class="form-control">
                                    <input type="hidden" value="<?php echo $outcome->get_target_obj()->get_id(); ?>" name="outcome[<?php echo $outcome->get_id() ?>][id]" class="form-control">
                                    <input type="hidden" value="<?php echo $outcome->get_id(); ?>" name="outcome[<?php echo $outcome->get_id() ?>][outcome_id]" class="form-control">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
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
            if (msg.status === true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>