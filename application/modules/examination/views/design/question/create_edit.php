<?php
/* @var $question Orm_Tst_Question */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('/examination/question_bank/question_save',array('id'=>'question_form')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo intval($question->get_id()) ? lang('Edit').' '.lang('Question') : lang('Create').' '.lang('Question'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label"><?php echo lang('Question') ?> (<?php echo lang('English'); ?>): *</label>
                    <textarea class="form-control"
                              name="question_english"><?php echo htmlfilter($question->get_text_en()); ?></textarea>
                    <?php echo Validator::get_html_error_message('question_english'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo lang('Question') ?> (<?php echo lang('Arabic'); ?>): *</label>
                    <textarea class="form-control"
                              name="question_arabic"><?php echo htmlfilter($question->get_text_ar()); ?></textarea>
                    <?php echo Validator::get_html_error_message('question_arabic'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo lang('Course') ?></label>
                    <input id="course_label" type="text" onclick="find_courses(this,'course_id','course_label')" readonly
                           class="form-control" value="<?php echo htmlfilter($question->get_course_id(true)->get_name()); ?>"/>
                    <input id="course_id" name="course_id" type="hidden"  value="<?php echo (int)$question->get_course_id() ?>"/>
                    <?php echo Validator::get_html_error_message('course_id'); ?>
                </div>

<?php /*
                <div class="form-group">
                    <label class="control-label"><?php echo lang('Question Difficulty') ?>: *</label>
                    <select class="form-control" name="question_difficulty">
                        <option value="">-- <?php echo lang('Choose Question Difficulty') ?> --</option>
                        <?php
                        foreach (Orm_Tst_Question::$difficulties as $difficulty_key => $difficulty_arr) {
                            $selected = (($difficulty_key == $question->get_difficulty()) ? 'selected="selected"' : '');
                            echo '<option value="' . htmlfilter($difficulty_key) . '" ' . htmlfilter($selected) . '>' . htmlfilter(lang($difficulty_arr['label'])) . '</option>';
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('question_difficulty'); ?>
                </div>
*/ ?>

                <div class="form-group">
                    <label class="control-label"><?php echo lang('Question Status') ?>: *</label>
                    <select class="form-control" name="question_status">
                        <option value="">-- <?php echo lang('Choose Question Status') ?> --</option>
                        <?php
                        foreach (Orm_Tst_Question::$status_arr as $question_status => $status) {
                            $selected = (($question_status == $question->get_status()) ? 'selected="selected"' : '');
                            echo '<option value="' . htmlfilter($question_status) . '" ' . htmlfilter($selected) . '>' . htmlfilter(lang($status)) . '</option>';
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('question_status'); ?>
                </div>

                <div class="form-group">
                    <label class="custom-control custom-checkbox" for="is_assignment">
                        <input type="checkbox" value="1" id="is_assignment" name="is_assignment" class="custom-control-input" <?php echo $question->get_is_assignment()? "checked": ''; ?> >
                        <span class="custom-control-indicator"></span>
                        <?php echo lang('Assignment Question') ?>
                    </label>
                </div>

                <div class="form-group" id="attach_container" <?php echo $question->get_is_assignment()? '': 'style="display: none;"'; ?>>
                    <label class="custom-control custom-checkbox" for="attach">
                        <input type="checkbox" value="1" id="attach" name="can_attach" class="custom-control-input" <?php echo $question->get_can_attach()? "checked": ''; ?> >
                        <span class="custom-control-indicator"></span>
                        <?php echo lang('Enable Attachment') ?>
                    </label>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo lang('Question Type') ?>: *</label>
                    <select class="form-control" name="class_type" onchange="choose_question_type();">
                        <option value="0">-- <?php echo lang('Choose Question Type') ?> --</option>
                        <?php
                        foreach (Orm_Tst_Question::get_types() as $question_type => $type) {
                            $selected = ($question_type == $question->get_type() ? 'selected="selected"' : '');
                            echo '<option value="' . htmlfilter($question_type) . '" ' . $selected . '>'  . htmlfilter(lang($type)) . '</option>';
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('class_type'); ?>
                </div>

                <div id="question_type">
                    <?php echo $question->draw_add_edit(); ?>
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn pull-right "
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
            <input name="question_id" type="hidden" value="<?php echo intval($question->get_id()); ?>"/>
        <?php echo form_close() ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->

<script type="text/javascript">
    $('#question_form').on('submit', function () {

        $.ajax({
            type: "POST",
            url: "/examination/question_bank/question_save",
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
        return false;
    });

    function choose_question_type() {
        do_post_submit('/examination/question_bank/question_types', 'question_form', 'question_type');
    }

    $('#is_assignment').click(function() {

        $('#attach_container').toggle($(this).is(':checked'));

    });

</script>

