<?php
/**
 * User: Laith
 */
/* @var $assignment Orm_Tst_Exam*/
?>


<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/examination/assignments/create_edit/".($assignment->get_id()?: ''), 'method="post" id="assignment_form" enctype="multipart/form-data"'); ?>

        <div class="modal-header">
            <span class="panel-title">
                <?php echo  ($assignment && $assignment->get_id())? lang('Edit').' '.lang('Assignment'): lang('Add').' '.lang('Assignment'); ?>
            </span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label" for="name_en"> <?php echo lang('Assignment Name'); ?> (<?php echo lang('English'); ?>)</label>
                <input name="name_en" type="text" id="name_en" class="form-control"
                       value="<?php echo htmlfilter($assignment->get_name_en()); ?>"/>
                <?php echo Validator::get_html_error_message('name_en'); ?>
            </div>

            <div class="form-group">
                <label class="control-label" for="name_ar"> <?php echo lang('Assignment Name'); ?> (<?php echo lang('Arabic'); ?>)</label>
                <input name="name_ar" id="name_ar" type="text" class="form-control"
                       value="<?php echo htmlfilter($assignment->get_name_ar()); ?>"/>
                <?php echo Validator::get_html_error_message('name_ar'); ?>
            </div>

            <div class="form-group">
                <label class="control-label" for="desc_en"> <?php echo lang('Assignment Description'); ?> (<?php echo lang('English'); ?>)</label>
                <textarea name="desc_en" id="desc_en" class="form-control"><?php echo htmlfilter($assignment->get_desc_en()); ?></textarea>
                <?php echo Validator::get_html_error_message('desc_en'); ?>
            </div>

            <div class="form-group">
                <label class="control-label" for="desc_ar"> <?php echo lang('Assignment Description'); ?> (<?php echo lang('Arabic'); ?>)</label>
                <textarea name="desc_ar" id="desc_ar" class="form-control"><?php echo htmlfilter($assignment->get_desc_ar()); ?></textarea>
                <?php echo Validator::get_html_error_message('desc_ar'); ?>
            </div>

            <div class="form-group">
                <label for="attach" class="control-label"><?php echo lang('Attachment') ?></label>

                <label class="custom-file px-file" style="table">
                    <input type="file" id="attach" name="attach" class="custom-file-input">
                    <span class="custom-file-control form-control"><?php echo lang('Choose file...') ?></span>
                    <div class="px-file-buttons">
                        <button type="button" class="btn btn-xs px-file-clear"><?php echo lang('Clear') ?></button>
                        <button type="button" class="btn btn-primary btn-xs px-file-browse"><?php echo lang('Browse') ?></button>
                    </div>
                </label>
                <?php echo Validator::get_html_error_message('name_ar'); ?>
            </div>

            <div class="form-group">
                <label class="control-label" for="fullmark"> <?php echo lang('Assignment Mark'); ?></label>
                <input name="fullmark" id="fullmark" type="text" class="form-control"
                       value="<?php echo htmlfilter($assignment->get_fullmark()); ?>"/>
                <?php echo Validator::get_html_error_message('fullmark'); ?>
            </div>

            <?php if(!$assignment->get_id()): ?>
            <div class="form-group">
                <label class="control-label"><?php echo lang('Course') ?></label>
                <input id="course_label" type="text" onclick="find_courses(this,'course_id','course_label')" readonly
                       class="form-control" value="<?php echo htmlfilter($assignment->get_course_obj()->get_name()); ?>"/>
                <input id="course_id" name="course_id" type="hidden"  value="<?php echo (int)$assignment->get_course_id() ?>"/>
                <?php echo Validator::get_html_error_message('course_id'); ?>
            </div>
            <?php endif; ?>
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

    $('#assignment_form').submit(function(e){
        e.preventDefault();


        var files = $(":file:enabled", this);

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        if(files.length) {
            $ajaxProp['files']  = files;
            $ajaxProp['iframe'] =  true;
        }

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    $(function() {
        $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true});

        $('.select_section').select2({
            placeholder: '<?php echo  lang('Select value');?>'
        });
    });

    $('.px-file').pxFile();
</script>