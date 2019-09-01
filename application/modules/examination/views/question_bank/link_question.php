<?php
/**
 * Created by PhpStorm.
 * User: laith
 * Date: 5/1/17
 * Time: 4:18 PM
 */

/* @var $question Orm_Tst_Question */

?>


<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('/examination/question_bank/link_question/'.$question->get_id(), 'id="link-form"'); ?>
        <div class="modal-header">
            <b><?php echo lang('Manage').' '.lang('Learning Outcome') ?>:</b>
                &nbsp;&nbsp;<?php echo nl2br(htmlfilter($question->get_text())); ?>
        </div>
        <div class="modal-body">
            <div id="more_learning_outcome" class="more_items well">
                <?php foreach($question->get_outcome() as $key=>$outcome): ?>
                <div class="item m-y-1" data-key="<?php echo $key ?>">
                    <div class="form-group m-a-0">
                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    <input name="learning_outcome[<?php echo $key ?>][type]"<?php echo $outcome->get_type()==Orm_Tst_Question_Outcome::TYPE_PROGRAM_LEARNING_OUTCOME ?' checked=""': ''?> type="radio" value="<?php echo Orm_Tst_Question_Outcome::TYPE_PROGRAM_LEARNING_OUTCOME; ?>">
                                    <span class="lbl"> <?php echo lang('Program Learning Outcome') ?></span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    <input name="learning_outcome[<?php echo $key ?>][type]"<?php echo $outcome->get_type()==Orm_Tst_Question_Outcome::TYPE_COURSE_LEARNING_OUTCOME ?' checked=""': ''?> type="radio" value="<?php echo Orm_Tst_Question_Outcome::TYPE_COURSE_LEARNING_OUTCOME; ?>">
                                    <span class="lbl"> <?php echo lang('Course Learning Outcome') ?></span>
                                </label>
                            </div>
                            <div class="col-md-11">
                                <input id="learning_outcome_label_<?php echo $key ?>" type="text" onclick="find_learning_outcome(this, 0)" readonly="" class="form-control" value="<?php echo $outcome->get_outcome_name() ?>">
                                <input id="learning_outcome_id_<?php echo $key ?>" name="learning_outcome[<?php echo $key ?>][id]" type="hidden" value="<?php echo $outcome->get_outcome_id() ?>">
                            </div>

                            <div class="col-md-1"><a class="btn btn-sm remove"><i class="fa fa-trash-o"></i></a></div>
                        </div>
                    </div>
                    <?php echo Validator::get_html_error_message('learning_outcome', $key); ?>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="more_link">
                <button type="button" class="btn" aria-label="Left Align" onclick="add_more_link();">
                    <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add').' '.lang('Learning Outcome'); ?>
                </button>
              </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left btn-sm"
                    data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $('#link-form').submit(function(e){
        e.preventDefault();
        var $that = $(this);
        $.get('/welcome/refresh_token', function(data) {
            var $data = $that.serializeArray();
            $.each($data, function(i, item) {
                if (item.name == 'csrf_test_name') {
                    item.value = data;
                }
            });
            $.ajax({
                type: "POST",
                url: $that.attr('action'),
                data: $data,
                dataType: 'JSON'
            }).done(function (msg) {
                if (msg.success) {
                    window.location.reload();
                } else {
                    $('#ajaxModalDialog').html(msg.html);
                }
            });
        });
    });

    function add_more_link() {
        var id = parseInt($('#more_learning_outcome>div:last').attr('data-key')) + 1;

        id = id || 0;

        $('#more_learning_outcome').append(
            '<div class="item m-y-1" data-key="'+id+'"><div class="form-group m-a-0">'+
            '<div class="row">' +
            '<div class="col-md-6">' +
            '<label>' +
            '<input name="learning_outcome['+id+'][type]" checked="" type="radio" value="<?php echo Orm_Tst_Question_Outcome::TYPE_PROGRAM_LEARNING_OUTCOME; ?>">' +
            '<span class="lbl"> <?php echo lang('Program Learning Outcome') ?></span>' +
            '</label>' +
            '</div>' +
            '<div class="col-md-6">' +
            '<label>' +
            '<input name="learning_outcome['+id+'][type]" type="radio" value="<?php echo Orm_Tst_Question_Outcome::TYPE_COURSE_LEARNING_OUTCOME; ?>">' +
            '<span class="lbl"> <?php echo lang('Course Learning Outcome') ?></span>' +
            '</label>' +
            '</div>' +
            '<div class="col-md-11">' +
            '<input id="learning_outcome_label_'+id+'" type="text" onclick="find_learning_outcome(this, '+id+')" readonly="" class="form-control" value="">' +
            '<input id="learning_outcome_id_'+id+'" name="learning_outcome['+id+'][id]" type="hidden" value="">' +
            '</div>' +
            '<div class="col-md-1">' +
            '<a class="btn btn-sm remove"><i class="fa fa-trash-o"></i></a>' +
            '</div>' +
            '</div>' +
            '</div>');
    }

    $(document).on("click",'.remove',function(){
        $(this).parent().parent().parent().parent().remove();
    });

    $('#more_learning_outcome').on('change', 'input[type="radio"]', function(){
        $('#more_learning_outcome').find(
            '#learning_outcome_label_'+ parseInt(String($(this).attr('name')).replace('learning_outcome[','')) +
            ', #learning_outcome_id_'+ parseInt(String($(this).attr('name')).replace('learning_outcome[',''))).val('');

        $('#more_learning_outcome')
            .find('#learning_outcome_label_'+ parseInt(String($(this).attr('name')).replace('learning_outcome[',''))).click();


    });

    function find_learning_outcome(element, id_element) {
        var _id = parseInt($('#learning_outcome_id_'+id_element).val());
        if($('[name="learning_outcome['+id_element+'][type]"]:checked').val()=='<?php echo Orm_Tst_Question_Outcome::TYPE_PROGRAM_LEARNING_OUTCOME; ?>') {
            find_plo(element, 'learning_outcome_id_'+id_element, 'learning_outcome_label_'+id_element, '<?php echo lang('Find Program Learning Outcome')?>', _id);
        }
        else {
            find_clo(element, 'learning_outcome_id_'+id_element, 'learning_outcome_label_'+id_element, '<?php echo lang('Find Course Learning Outcome')?>', _id);
        }
    }
</script>

