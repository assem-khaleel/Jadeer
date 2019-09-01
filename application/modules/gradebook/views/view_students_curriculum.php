<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/05/17
 * Time: 11:15 ص
 */

/* @var $assessment_method Orm_Cm_Course_Assessment_Method */
/* @var $students Orm_Course_Section_Student */
/* @var $section Orm_Course_Section */
/* @var $questions Orm_Cm_Section_Mapping_Question */
$final_score = 0;
$full_marks = 0;

?>

<div class="row">
    <div class="col-md-3 col-lg-3">
        <div class="panel">
            <div class="panel-body">
            <?php
            if($assessment_method):
                foreach($assessment_method as $method):/* @var $method Orm_Cm_Course_Assessment_Method  */ ?>
                    <a href="/gradebook/view_students/curriculum/<?php echo $section->get_id() ?>/<?php echo $method->get_id()?>" class="btn btn-block  <?php  echo $method_id == $method->get_id() ? 'btn-primary' : '' ?>" type="button">
                        <?php echo htmlfilter($method->get_text()); ?>
                    </a>
                    <?php
                endforeach;
            else:
                ?>
                <div class="alert alert-default">
                    <?php echo lang('There are no').' '.lang('Assessment Method for this course') ?>
                </div>
            <?php endif;?>
        </div>
        </div>
    </div>
    <div class="col-md-9 col-lg-9">
        <?php echo form_open('','id="gradebook-form"'); ?>
        <div class="table-primary">
            <div class="table-header">
                <span class="table-caption">
                    <?php echo $section->get_name().' - '.$section->get_course_obj()->get_name()?>
                    <input type="hidden" name="section_id" value="<?php echo (int) $section->get_id(); ?>">
                    <input type="hidden" name="method_id" value="<?php echo (int) $method_id; ?>">
                    <?php if($questions):?>
                    <div class="pull-right">
                    <a class="btn btn-sm " href="/gradebook/curriculum_csv/<?php echo $section->get_id()?>/<?php echo $method_id?>">
                        <span class="btn-label-icon left icon fa fa-file-excel-o"></span> <?php echo lang('CSV'); ?>
                    </a>
                    </div>
                    <?php endif;?>
                </span>

            </div>
            <table class="table table-bordered">

                <thead>
                <tr>
                    <td class="col-md-2"><?php echo lang('Student Name'); ?></td>
                    <?php if($questions):?>
                        <?php foreach ($questions as $question){/* @var $question Orm_Cm_Section_Mapping_Question */?>
                            <td class="col-md-2">
                                <?php  echo htmlfilter($question->get_question()); ?>
                                <span class="m-l-1 label label-pill label-success"><?php echo htmlfilter($question->get_full_mark())?></span>
                                <input type="hidden" class="question-full-score" id="question-<?php echo $question->get_id()?>" name="q_full_marks[<?php echo $question->get_id()?>]" value="<?php echo htmlfilter($question->get_full_mark()); ?>">
                            </td>

                            <?php
                            $full_marks +=$question->get_full_mark();
                        }
                        ?>
                        <td class="col-md-2">
                            <?php echo lang('Overall Mark')?>
                            <span class="m-l-1 label label-pill label-success"><?php echo htmlfilter($full_marks)?></span>
                        </td>
<!--                    --><?php //else: ?>
<!--                        <td class="alert alert-default">-->
<!--                            --><?php //echo lang('There are no').' '.lang('Question for this assessment method') ?>
<!--                        </td>-->
                    <?php endif;?>

                </tr>
                </thead>
                <tbody>
                <?php ?>
                <?php if (count($students) !=0 && count($questions) !=0  ): ?>

                    <?php foreach ($students as $student): /* @var $student Orm_Course_Section_Student*/
                        ?>

                        <tr>
                            <td>

                                <?php echo htmlfilter($student->get_user_obj()->get_full_name())?>
                            </td>
                            <?php
                                foreach ($questions as $question){/* @var $question Orm_Cm_Section_Mapping_Question */
                                    $score = Orm_Cm_Section_Student_Assessment::get_one(array('section_id' => $section_id,'student_id'=>$student->get_user_id(),'section_mapping_question_id' => $question->get_id()));
                                    $final_score += $score->get_score();
                                    ?>
                                    <td>
                                        <div class="form-group m-a-0">
                                            <input name="scores[<?php echo (int)$student->get_user_id(); ?>][<?php echo (int)$question->get_id(); ?>][<?php echo (int)$score->get_id(); ?>]" type="text" class="form-control"
                                                   value="<?php echo $score->get_score() ? htmlfilter(round($score->get_score(),2)) : 0 ; ?>"/>
                                            <div id="<?php echo 'scores_' . $student->get_user_id() . '_' . $question->get_id() . '_'. $score->get_id(); ?>"></div>
                                        </div>
                                    </td>

                                <?php } ?>
                                <td>
                                    <?php echo $final_score ?>
                                </td>
                        </tr>
                        <?php
                        $final_score = 0;
                    endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <?php if(count($students) == 0){?>

                                <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Students'); ?></h3>
                                <?php }else{
                                    // Added be shamaseen
                                    if(!$method_id)
                                    {?>
                                        <h3 class="m-a-0 text-center"><?php echo lang('Please choose a test.'); ?></h3>
                            <?php   }
                                    else
                                    {?>
                                        <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Questions for the selected assessment method'); ?></h3>
                              <?php }

                                }?>

                            </div>
                        </td>
                    </tr>
                <?php endif; ?>


                </tbody>
            </table>
            <?php if ($pager || ($assessment_method && $questions) ){ ?>

                <div class="table-footer clearfix">
                    <?php echo  $pager ; ?>
                    <?php if($assessment_method && $questions): ?>
                        <button type="button" id="submitBTN" class="btn pull-right" <?php echo data_loading_text() ?>>
                            <span class="btn-label-icon left fa fa-save"></span>
                            <?php echo lang('Save'); ?>
                        </button>
                    <?php endif; ?>
                </div>
            <?php } ?>
        </div>
        <?php form_close();?>
    </div>
</div>


<script>

$('#submitBTN').click(function () {

    $('div.form-message').each(function(){
        $(this).text('').removeClass('form-message').parents(".form-group").removeClass("form-message-light has-error");
    });

    $.ajax({
        type: "POST",
        url: '/gradebook/save_student_score/<?php echo $section->get_id() ?>',
        data: $('#gradebook-form').serializeArray(),
        dataType: 'JSON'
    }).done(function (d) {
        if (d.success) {
            window.location.reload();
//            $.growl.success({message:d.msg});
//            window.history.go(0);
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