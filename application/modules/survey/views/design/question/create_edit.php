<?php
/* @var $question Orm_Survey_Question */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('/survey/design/question_save',array('id'=>'question_form')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo intval($question->get_id()) ? lang('Edit').' '.lang('Question') : lang('Create').' '.lang('Question'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label"><?php echo lang('Question') ?> (<?php echo lang('English') ?>): *</label>
                    <textarea class="form-control"
                              name="question_english"><?php echo htmlfilter($question->get_question_english()); ?></textarea>
                    <?php echo Validator::get_html_error_message('question_english'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo lang('Question') ?> (<?php echo lang('Arabic') ?>): *</label>
                    <textarea class="form-control"
                              name="question_arabic"><?php echo htmlfilter($question->get_question_arabic()); ?></textarea>
                    <?php echo Validator::get_html_error_message('question_arabic'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo lang('Question Type') ?>: *</label>
                    <select class="form-control" name="class_type" onchange="choose_question_type();">
                        <option value="">-- <?php echo lang('Choose Question Type') ?> --</option>
                        <?php
                        foreach (Orm_Survey_Question::get_types() as $class_type => $type) {
                            $selected = (($class_type == $question->get_class_type()) ? 'selected="selected"' : '');
                            echo '<option value="' . htmlfilter($class_type) . '" ' . htmlfilter($selected) . '>' . htmlfilter(lang($type)) . '</option>';
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('class_type'); ?>
                </div>

                <div id="question_type">
                    <?php echo $question->draw_add_edit(); ?>
                </div>

                <div class="form-group">
                    <label class="control-label">
                        <input type="checkbox"
                               name="is_require" <?php echo htmlfilter(($question->get_is_require() ? 'checked="checked"' : '')); ?>
                               value="1"/>
                        <?php echo lang('Require an answer to this Question') . ' (' . lang('optional') . ')' ?>
                    </label>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn pull-right "
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
            <input type="hidden" name="survey_id"
                   value="<?php echo intval($question->get_page_obj()->get_survey_id()); ?>"/>
            <input name="page_id" type="hidden" value="<?php echo intval($question->get_page_id()); ?>"/>
            <input name="question_id" type="hidden" value="<?php echo intval($question->get_id()); ?>"/>
            <input name="order" type="hidden" value="<?php echo htmlfilter($question->get_order()); ?>"/>
        <?php echo form_close() ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->

<script type="text/javascript">
    $('#question_form').on('submit', function () {

        $.ajax({
            type: "POST",
            url: "/survey/design/question_save",
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
        do_post_submit('/survey/design/question_types?survey_id=<?php echo intval($question->get_page_obj()->get_survey_id()); ?>', 'question_form', 'question_type');
    }

</script>

