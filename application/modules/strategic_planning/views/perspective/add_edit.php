<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 16/10/17
 * Time: 10:29 AM
 */

/** @var Orm_Sp_Perspective $perspective */

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/strategic_planning/perspective/save", array('id' => 'perspective-form', 'method'=>'post')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Perspective'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="text_en"><?php echo lang('name').' - '.lang('English') ?></label>
                        <div class="col-sm-9">
                            <input id="text_en" name="text_en" class="form-control" value="<?php echo htmlfilter($perspective->get_name_en()); ?>">
                            <?php echo Validator::get_html_error_message('text_en'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="text_ar"><?php echo lang('name').' - '.lang('Arabic') ?></label>
                        <div class="col-sm-9">
                            <input id="text_ar" name="text_ar" class="form-control" value="<?php echo htmlfilter($perspective->get_name_ar()); ?>">
                            <?php echo Validator::get_html_error_message('text_ar'); ?>
                        </div>
                    </div>
                </div>


                <input type="hidden" name="id" id="id" value="<?php echo intval($perspective->get_id())?>" />
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

    $('#perspective-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>