<?php
/** @var Orm_Fp_Legend $legend */
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/manage/add_edit_legend/".$legend->get_id(), ['id' => 'tab-form', 'method' => 'post']); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo ($legend->get_id()? lang('Edit'): lang('Add New')).' '.lang('Legend'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label" for="title_ar"> <?php echo lang('Title'); ?> (<?php echo lang('Arabic'); ?>)</label>
                    <input id="title_ar" name="title_ar" type="text" class="form-control"
                           value="<?php echo htmlfilter($legend->get_title_ar()); ?>"/>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for="title_en"> <?php echo lang('Title'); ?> (<?php echo lang('English'); ?>)</label>
                    <input id="title_en" name="title_en" type="text" class="form-control" value="<?php echo htmlfilter($legend->get_title_en()); ?>"/>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
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


    $('#tab-form').on('submit', function (e) {
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

