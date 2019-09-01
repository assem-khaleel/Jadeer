<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 17/04/17
 * Time: 10:44 ص
 */
/* @var $rate Orm_Fp_Forms_Rate*/
/* @var string $type_id*/


?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_performance/faculty_settings/save_rate", array('id' => 'rat-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Set Rate'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="row form-group">
                    <label class="col-sm-3 control-label" for="rate">
                        <?php echo  lang('Rate Value')?>
                    </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="rate" name="rate" class="form-control"
                                   value="<?php echo htmlfilter($rate->get_rate()) ?>">
                            <span class="input-group-addon">%</span>
                            <?php echo Validator::get_html_error_message('rate'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo intval($rate->get_id()) ?>">
            <input type="hidden" name="type_id" value="<?php echo intval($type_id) ?>">
            <div class="hidden alert alert-danger text-left"  id="error_message">

            </div>
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right ">
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<script type="text/javascript">
    $('#rat-form').on('submit', function (e) {
        e.preventDefault();

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#error_message').html(msg.html).removeClass('hidden');
            }
        });
    });

</script>
