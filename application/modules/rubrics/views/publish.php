<?php
/** @var Orm_Rb_Rubrics $rubric */
/** @var Orm_Rb_Rubrics $orm_rubric */
/** @var Orm_Rb_Scale $all_scales */
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/rubrics/publish/" . $rubric->get_id(), ['id' => 'publish-form', 'method' => 'post']); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Publish').' '.lang('Rubrics'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?>
                        (<?php echo lang('Arabic'); ?>)</label>
                    <label class="form-control"><?php echo htmlfilter($rubric->get_name_ar()); ?></label>
                </div>

                <div class="form-group">
                    <label class="control-label" for="name_en"> <?php echo lang('Name'); ?>
                        (<?php echo lang('English'); ?>)</label>
                    <label class="form-control"><?php echo htmlfilter($rubric->get_name_en()); ?></label>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo lang('Time Range'); ?>:</label>

                    <div class="input-daterange input-group">
                        <input class="form-control date-picker" name="start"
                               value="<?php echo htmlfilter(date('Y', $rubric->get_start_date(true)) < 1975 ? '' : $rubric->get_start_date()); ?>">
                        <span class="input-group-addon"><?php echo lang('To') ?></span>
                        <input class="form-control date-picker" name="end"
                               value="<?php echo htmlfilter(date('Y', $rubric->get_end_date(true)) < 1975 ? '' : $rubric->get_end_date()); ?>">
                    </div>
                    <?php echo Validator::get_html_error_message('start'); ?>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                        <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
                    </button>
                    <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                        <span class="btn-label-icon left"><i
                                    class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

    <script type="text/javascript">

        $('#publish-form').on('submit', function (e) {
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

        var date = new Date();
        $(".date-picker").datepicker({
            format: 'yyyy-mm-dd',
            startDate: date
        });
    </script>

