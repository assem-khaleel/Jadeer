<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 02:58 م
 */
/* @var $quiz Orm_Tst_Exam*/
?>
<div class="col-md-12 col-lg-12 m-t-4">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <h3 class="m-t-0 m-b-0">
                <?php echo htmlfilter($quiz->get_name())?>
                <span class="label label-default"><?php echo $quiz->get_fullmark().' '.lang('Marks')?></span>
            </h3>
        </div>
        <div class="panel-body">
            <?php
            if ($questions = $quiz->get_questions()):
                foreach ($questions as $question):
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                <span class="font-weight-bold"><?php echo $question->get_question_id(true)->get_text()?></span>
                                <span class="label label-tag label-default"><?php echo $question->get_mark().' '.lang('Marks')?></span>
                        </div>
                        <div class="panel-body">
                            <?php echo $question->get_question_id(true)->draw_question();?>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Questions for this Quiz'); ?></h3>
                </div>
            <?php endif;?>

        </div>
    </div>
