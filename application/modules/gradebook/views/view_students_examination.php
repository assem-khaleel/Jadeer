<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/05/17
 * Time: 11:15 ص
 */
/**
 * @var $exams    Orm_Tst_Exam[]
 * @var $exam     Orm_Tst_Exam
 * @var $section  Orm_Course_Section
 * @var $students Orm_Course_Section_Student[]
 *
 */
$final_score = 0;
$full_marks = 0;

?>

<div class="row">
    <div class="col-md-3 col-lg-3">

        <?php if(count($exams)): ?>
        <?php   $type=-1; ?>
        <?php   foreach($exams as $row): ?>
        <?php       if($type!=$row->get_type()): ?>
        <?php          if($type!=-1): ?>
    </div>
</div>
        <?php       endif; ?>
        <div class="panel">
            <div class="panel-head text-center"><h4 class="m-y-2"><?php
                $type=$row->get_type();

                switch ($row->get_type()) {
                    case Orm_Tst_Exam::TYPE_EXAM:
                        echo lang('Exams');
                        break;
                    case Orm_Tst_Exam::TYPE_ASSIGNMENT:
                        echo lang('Assignments');
                        break;
                    case Orm_Tst_Exam::TYPE_QUIZ:
                        echo lang('Quiz');
                }
                ?></h4></div>
            <div class="panel-body">
        <?php       endif; ?>
                <a href="/gradebook/view_students/examination/<?php echo $section->get_id() .'/'. $row->get_id()?>" class="btn btn-block  <?php  echo $exam->get_id() == $row->get_id() ? 'btn-primary' : '' ?>">
                    <?php echo htmlfilter($row->get_name()); ?>
                </a>
        <?php   endforeach; ?>

        <?php else: ?>
        <div class="panel">
           <div class="panel-body">
               <div class="alert alert-default">
                   <?php echo lang('There are no').' '.lang('Exams') ?>
               </div>

        <?php endif;?>
        </div>
        </div>
</div>
        <div class="col-md-9 col-lg-9">
            <input type="hidden" name="exam_id" value="<?php echo $exam->get_id(); ?>">
            <div class="table-primary">
                <div class="table-header">
                    <span class="table-caption">
                        <?php echo $section->get_name().' - '.$section->get_course_obj()->get_name()?>
                        <?php if(count($exams)):?>
                           <?php if(!empty($exam->get_id())){?>
                            <div class="pull-right">
                    <a class="btn btn-sm " href="/gradebook/examination_csv/<?php echo $section->get_id()?>/<?php echo $exam->get_id()?>">
                        <span class="btn-label-icon left icon fa fa-file-excel-o"></span> <?php echo lang('CSV'); ?>
                    </a>
                    </div>
                        <?php } endif;?>
                    </span>
                </div>

                <?php if($exam->get_id()) { ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="col-md-2"><?php echo lang('Student Name'); ?></td>
                        <?php if($questions = $exam->get_questions()):?>
                            <?php foreach ($exam->get_questions() as $question) { ?>
                                <td class="col-md-2">
                                    <?php  echo htmlfilter($question->get_question_id(true)->get_text()); ?>
                                    <span class="m-l-1 label label-pill label-success"><?php echo htmlfilter($question->get_mark() )?></span>
                                    <input type="hidden" class="question-full-score" id="question-<?php echo $question->get_question_id()?>" name="q_full_marks[<?php echo $question->get_question_id()?>]" value="<?php echo htmlfilter($question->get_mark()); ?>">
                                </td>

                                <?php
                                $full_marks +=$question->get_mark();
                            }
                            ?>
                            <td class="col-md-2">
                                <?php echo lang('Overall Mark')?>
                                <span class="m-l-1 label label-pill label-success"><?php echo htmlfilter($full_marks)?></span>
                            </td>
                        <?php else:?>
                            <td class="col-md-2"> - </td>
                        <?php endif;?>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($students): ?>
                    <?php   foreach ($students as $student):
                            ?>
                        <tr>
                            <?php
                                echo '<td>'.htmlfilter($student->get_user_obj()->get_full_name()).'</td>';

                                $marks = Orm_Tst_Exam_Student_Mark::get_model()->get_all(['exam_id' => $exam->get_id(), 'user_id' => $student->get_user_id()], 0, 0, [], Orm::FETCH_ARRAY);

                                if(count($marks)){
                                    $marks = array_column($marks, 'mark', 'question_id');
                                }

                                $final_score = 0;
                                foreach ($questions as $question) {
                                    $mark= isset($marks[$question->get_question_id()])? $marks[$question->get_question_id()]: 0;
                                    $final_score += $mark;

                                    echo "<td>{$mark}</td>";
                                }

                                echo "<td>{$final_score}</td>";
                         ?>
                        </tr>
                    <?php   endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">
                                <div class="well well-sm m-a-0">
                                    <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Students'); ?></h3>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php } else {?>
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('Please choose an exam'); ?></h3>

                    </div>
                <?php } ?>
            </div>
        </div>




<script>

$('#submitBTN').click(function () {

    $('div.form-message').each(function(){
        $(this).text('').removeClass('form-message').parents(".form-group").removeClass("form-message-light has-error");
    });

    $.ajax({
        type: "POST",
        url: '',
        data: $('#gradebook-form').serializeArray(),
        dataType: 'JSON'
    }).done(function (d) {
        if (d.success) {
            $.growl.success({message:d.msg});
        } else {
            for(var i in d.errors) {
                if(!d.errors.hasOwnProperty(i)){
                    continue;
                }

                $('#'+i).text(d.errors[i]).addClass('form-message').parents(".form-group").addClass("form-message-light has-error");
            }

            if(d.hasOwnProperty('msg')){
                $.growl.danger({message:d.msg});
            }
        }

        $('#submitBTN').button('reset');
    });
});
</script>