<?php
/**
 * Created by PhpStorm.
 * User: Ali
 * Date: 22/05/17
 * Time: 01:17 م
 */
/* @var $exam Orm_Tst_Exam*/
/* @var $questions[] Orm_Tst_Exam_Questions*/


?>
<div class="col-md-12 col-lg-12 m-t-4">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <div class="col-md-7 col-lg-7">
                <h3 class="m-t-0 m-b-0">
                    <?php echo $exam->get_name()?>
                    <span class="label label-default"><?php echo $exam->get_fullmark().' '.lang('Marks')?></span>
                </h3>
            </div>
        </div>
        <div class="panel-body">
            <?php
            if ($questions):
                foreach ($questions as $key => $exam_question):
                    $question = Orm_Tst_Question::get_instance($exam_question->get_question_id());
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="col-md-7 col-lg-7">
                                <span class="font-weight-bold"><b class="font-size-18" ><?php echo  lang('Q') .($key+1).'. '; ?></b><?php echo $question->get_text()?></span>
                                <span class="label label-tag label-default"><?php echo $exam_question->get_mark().' '.lang('Marks')?></span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?php echo $question->draw_question();?>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Questions for this exam'); ?></h3>
                </div>
            <?php endif;?>

        </div>
    </div>
