<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/11/17
 * Time: 12:10 PM
 */
/** @var $objectives Orm_College_Objective[]|Orm_Institution_Objective[]|Orm_Program_Objective[]|Orm_Unit_Objective[] */
/** @var $strategy Orm_Sp_Strategy */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('Integrate Objective'); ?>
        </div>
        <?php echo form_open("/strategic_planning/objective/integrate/", array('id' => "integrate-form")); ?>
        <div class="modal-body">
            <div class="form-group" style="display: block;">
                <label for="objective" class="col-md-2 control-label"><?php echo lang('Objective'); ?></label>
                <div class="col-md-10">
                    <select class="form-control" id="objective" name="objective_id">
                        <?php foreach ($objectives as $objective) { ?>
                            <option value="<?php echo $objective->get_id() ?>"><?php echo htmlfilter($objective->get_title()); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <?php echo Validator::get_html_error_message('objective'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="strategy_id" value="<?php echo $strategy->get_id() ?>">
            <button type="button" class="btn btn-sm pull-left" data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right" <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>

<script type="text/javascript">
    init_data_toggle();

    $("#integrate-form").submit(function () {

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            $('#ajaxModalDialog').html(msg.html);
            init_data_toggle();
        }).fail(function () {
            window.location.reload();
        });

        return false;
    });
</script>
