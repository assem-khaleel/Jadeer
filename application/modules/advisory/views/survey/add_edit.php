<?php /* @var $survey Orm_Survey */ ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/advisory/Ad_Survey/save", array('id' => 'survey-form')); ?>
        <div class="modal-header">
            <span class="panel-title">
                <?php echo lang('Survey'); ?>
            </span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="row form-group">
                    <label for="title_en" class="col-sm-3 control-label">
                        <?php echo lang('Title') . ' ( ' . lang('English') . ' ) ' ?>
                    </label>

                    <div class="col-sm-9">
                        <input type="text" name="title_en" id="title_en" class="form-control"
                               placeholder="<?php echo lang('Title') . ' ( ' . lang('English') . ' ) ' ?>"
                               value="<?php echo htmlfilter($survey->get_title_english()); ?>"/>
                        <?php echo Validator::get_html_error_message('title_en'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="col-sm-3 control-label">
                        <?php echo lang('Title') . ' ( ' . lang('Arabic') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="title_ar" id="title_ar" class="form-control"
                               placeholder="<?php echo lang('Title') . ' ( ' . lang('Arabic') . ' ) ' ?>"
                               value="<?php echo htmlfilter($survey->get_title_arabic()); ?>"/>
                        <?php echo Validator::get_html_error_message('title_ar'); ?>
                    </div>
                </div>

                <input type="hidden" name="id" id="id" value="<?php echo intval($survey->get_id()) ?>"/>

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
                <button id="saveCommit" type="submit" class="btn pull-right " <?php echo data_loading_text() ?>>
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


    $('#survey-form').on('submit', function (e) {
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

</script>
