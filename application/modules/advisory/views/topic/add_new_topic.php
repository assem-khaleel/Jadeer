<?php
/** @var $topic Orm_Ad_Advice_Topic */

$user_login=Orm_User::get_logged_user();
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/advisory/save_new_topic", array('id' => 'topic-form')); ?>
        <div class="modal-header">
            <span class="panel-title">
                <?php echo lang('Topic'); ?>
            </span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="row form-group">
                    <label for="title_en" class="col-sm-3 control-label">
                        <?php echo lang('Topic') . ' ( ' . lang('English') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="topic_en" id="editTitle_en" class="form-control"
                               placeholder="<?php echo lang('Topic') . ' ( ' . lang('English') . ' ) ' ?>"
                              />
                        <?php echo Validator::get_html_error_message('topic_en'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="col-sm-3 control-label">
                        <?php echo lang('Topic') . ' ( ' . lang('Arabic') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="topic_ar" id="editTitle_ar" class="form-control"
                               placeholder="<?php echo lang('Topic') . ' ( ' . lang('Arabic') . ' ) ' ?>"
                               />
                        <?php echo Validator::get_html_error_message('topic_ar'); ?>
                    </div>
                </div>

                <input type="hidden" name="program_id" id="id" value="<?php echo intval($program_id) ?>"/>

            </div>
        </div>

        <div class="modal-footer">
            <div class=" text-right">
                <button type="button" class="btn pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left">
                        <i class="fa fa-times"></i>
                    </span>
                    <?php echo lang('Close'); ?>
                </button>
                <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left">
                        <i class="fa fa-floppy-o"></i>
                    </span>
                    <?php echo lang('save'); ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">

    $('#topic-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
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
    });

    $(".date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: '<?php echo date('Y-m-d'); ?>'
    });
</script>