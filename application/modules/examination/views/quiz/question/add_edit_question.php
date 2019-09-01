<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 11/05/17
 * Time: 01:58 م
 */
/* @var $question Orm_Tst_Question*/
/* @var $quiz Orm_Tst_Exam_Questions*/
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($question->get_id())) {
                echo lang('Create').' '.lang('Question');
            } else {
                echo lang('Edit').' '.lang('Question');
            }
            ?>
        </div>
        <?php echo form_open('/examination/quiz/save_question', 'id="question_form"') ?>
        <div class="modal-body">

            <div class="form-group">
                <label class="control-label"><?php echo lang('Question') ?></label>
                <input id="question_label" type="text" onclick="find_quiz_questions(this,'question_id','question_label', <?php echo Orm_Tst_Exam::get_instance($quiz_id)->get_course_id() ?>)" readonly
                       class="form-control" value="<?php echo htmlfilter($question->get_text()); ?>"/>
                <input id="question_id" name="question_id" type="hidden"  value="<?php echo (int)$question->get_id() ?>"/>
                <?php echo Validator::get_html_error_message('question_id'); ?>
            </div>
            
            <div class="form-group">
                <label class="control-label" for="mark"> <?php echo lang('Mark'); ?></label>
                <input name="mark" id="mark" type="text" class="form-control"
                       value="<?php echo htmlfilter($quiz->get_mark()); ?>"/>
                <?php echo Validator::get_html_error_message('mark'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo urlencode($quiz->get_id()); ?>">
            <input type="hidden" name="full_mark" value="<?php echo urlencode($full_mark); ?>">
            <input type="hidden" name="quiz_id" value="<?php echo urlencode($quiz_id); ?>">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span
                    class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span
                    class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $('#question_form').submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error === false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });


    function find_quiz_questions(element, property_id, property_label, course_id) {

        var url = (config.index_page ? '/' + config.index_page : '') + '/examination/quiz/find';

        $('.find_quiz_questions').remove();

        var width = ($(element).width() + 26) + 'px';
        var position = $(element).position();

        $(element).after('<div id="wrapper_' + property_id + '" class="find_quiz_questions" style="position: relative; z-index: 10; width: '+ width +'; left: ' + position.left + '; margin-top: 5px;">' +
            '<div class="panel panel-default">' +
            '<div class="panel-heading">' +
            '<button style="margin-top: -3px;" type="button" class="close" aria-label="Close" onclick="$(\'#wrapper_' + property_id + '\').remove();"><span aria-hidden="true">&times;</span></button>' +
            '<h3 class="panel-title">Find Question</h3>' +
            '</div>' +
            '<div class="panel-body">' +
            '<iframe style="border: none;" src="' + url + '?property_id='+property_id+'&property_label='+property_label+'&course_id='+course_id+'" width="100%" height="420" ></iframe>' +
            '</div>' +
            '</div>' +
            '</div>');
    }

</script>

