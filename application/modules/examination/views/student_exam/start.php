<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 04/05/17
 * Time: 10:03 ص
 */

/**
 * @var $exam Orm_Tst_Exam
 */
?>
<div class="m-t-4 col-md-9 col-lg-9">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <!--TODO Exam Name and timer will added here -->
            <div class="col-md-9 col-lg-9">
                <span class="font-weight-bold">
                    <span id="question_number">1</span> :
                    <span id="question_name"><?php echo $exam->get_questions()[0]->get_question_id(true)->get_text() ?></span>
                </span>
            </div>
            <div  class="col-md-3 col-lg-3 text-right">
                <span>
                    <?php echo lang('Time Remaining').': ' ?>
                    <span id="time"></span>
                </span>
            </div>
        </div>
        <div class="panel-body">
            <div id="question">
            <?php echo form_open('/examination/student_exam/save_question/'.$exam->get_id().'/'.$exam->get_questions()[0]->get_question_id(), 'method="post"'); ?>
            <?php echo $exam->get_questions()[0]->get_question_id(true)->get_question_with_user_response($exam->get_id()) ?>
            <?php echo form_close(); ?>
            </div>

            <br clear="both">
            <br clear="both">

            <hr class="panel-wide"/>

            <button style="visibility: hidden;" class="btn " <?php echo data_loading_text() ?> type="button" name="go_back" id="go_back">
                <span class="btn-label-icon left"><i class="fa fa-caret-left"></i></span><?php echo lang('Back'); ?>
            </button>

            <button class="btn pull-right" <?php echo data_loading_text() ?> type="button" name="go_next" id="go_next">
                <span class="btn-label-icon right"><i class="fa fa-caret-right"></i></span><?php echo lang('Next'); ?>
            </button>


        </div>
    </div>
</div>
<div class="m-t-4 col-md-3 col-lg-3">
    <div class="panel panel-default panel-dark">
        <div class="panel-heading"><?php echo lang('Question number') ?></div>
        <div class="panel-body">
            <div class="row" id="question_link">
                <?php foreach($exam->get_questions() as $key=>$question): ?>
                <div class="col-md-3 col-lg-3 p-b-2">
                    <a data-question="<?php echo $question->get_question_id() ?>" href="javascript:void(0);" onclick="get_question(<?php echo $question->get_question_id() ?>);" class="btn btn-primary btn-outline btn-outline-colorless <?php if($key+1 == 1) echo 'active' ?>"><?php echo ($key+1) ?></a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>

    var question_count = <?php echo count($exam->get_questions()); ?>;
    var stop=false;

    if(question_count<2) {
        $('#go_next').hide();
    }

    var check_time = function(){
        if(stop) {
            return;
        }

        var end_time = <?php echo $exam->get_end(true); ?>;
        var now_time = parseInt((new Date()).getTime()/1000);
        var remaining_time = end_time - now_time;

        if(remaining_time<0) {
            stop=true;
            $.ajax({
                url: '/examination/student_exam/check_exam/<?php echo $exam->get_id() ?>'
            }).done(function (data) {
                if (!data.status) {
                    save_question(function(){
                        window.location = '<?php echo base_url('/examination/student_exam/timeout/'.$exam->get_id()) ?>';
                    });
                }
                else {
                    stop=false;
                }
            });
            return;
        }

        $('#time').text(
            (parseInt(remaining_time/216000)? parseInt(remaining_time/216000)+':': '') +
            (parseInt((remaining_time%216000)/3600)? parseInt((remaining_time%216000)/3600)+':': '00:') +
            (parseInt(remaining_time/60)%60)+':'+(remaining_time%60));
    };

    check_time();
    setInterval(check_time, 1000);

    function save_question(callback) {
        var form = $('#question').find('form');

        if(typeof callback != 'function') {
            callback = function () {
            };
        }

        $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                dataType: "json"
            })
            .success(function(d){
                callback();
            });
    }

    $('#finish_btn').click(function(){
        save_question(function () {
            window.location.href ='/examination/student_exam/finish/<?php echo $exam->get_id() ?>';
        })
    });

    function get_question(question_id){

        $('#go_back, #go_next').button();

        save_question(function(){
            $.get('/examination/student_exam/get_question/<?php echo $exam->get_id() ?>/'+question_id)
                .success(function(d) {
                    if(d.success) {

                        var links = $('#question_link');
                        var links_a = links.find('a[data-question]');
                        var next_btn = $('#go_next'),
                            back_btn = $('#go_back');


                        $('#question_name').text(d.name);
                        $('#question').html(d.html);

                        $('#question_number').text(parseInt(links.find('a[data-question='+question_id+']').text()));

                        $('#question_link a.active').removeClass('active');
                        $('#question_link a').eq(question_id-1).addClass('active');

                        if(links_a.length==1) {
                            $('#go_next, #go_back').css('visibility', 'hidden');
                        }
                        else {

                            links_a.each(function (index) {

                                if ($(this).data('question') == question_id) {

                                    if (index == 0) {
                                        back_btn.css('visibility', 'hidden');
                                        next_btn.css('visibility', '');
                                    }
                                    else if( index == links_a.length-1) {
                                        back_btn.css('visibility', '');
                                        next_btn.css('visibility', 'hidden');
                                    }
                                    else {
                                        back_btn.css('visibility', '');
                                        next_btn.css('visibility', '');
                                    }
                                }
                            })
                        }
                    }

                    $('#go_back, #go_next').button('reset');
                });
        });
    }

    $('#go_next').click(function(){
        var key = parseInt($('#question_number').text());
        var links = $('#question_link');

        var question = links.find('a[data-question]');

        if(question.eq(key).length) {
            question.eq(key).click();
        }
    });

    $('#go_back').click(function(){
        var key = parseInt($('#question_number').text());
        var links = $('#question_link');
        key--;
        key--;

        var question = links.find('a[data-question]');

        if(question.eq(key).length) {
            question.eq(key).click();
        }
    });

</script>
