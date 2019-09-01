<?php
/**
 * Created by PhpStorm.
 * User: laith
 * Date: 5/1/17
 * Time: 4:18 PM
 */

/** @var Orm_Tst_Exam $exam */
/** @var int $user_id */
?>
<style>
    input[type="number"] {
        padding-right: 0px;
    }
</style>
<?php echo form_open('/examination/correction/check_answers/'.$exam->get_id().'/'.$user_id, 'method="post"'); ?>
<div class="panel-primary">
    <div class="panel">
        <div class="panel-heading p-b-2">
            <span class="panel-title">
                <?php echo htmlfilter($exam->get_name()); ?>
            </span>
            <div class="panel-heading-controls">
                <button class="btn " type="submit">
                    <span class="btn-label-icon left">
                        <i class="fa fa-save"></i>
                    </span>
                    <?php echo lang('Save'); ?>
                </button>
                <a class="btn" href='<?php echo base_url('/examination/correction/check_answers_next/'.$exam->get_id().'/'.$user_id)?>'>
                    <span class="btn-label-icon left">
                        <i class="fa fa-caret-square-o-right"></i>
                    </span>
                    <?php echo lang('Next'); ?>
                </a>
            </div>
        </div>
        <div id="collapseOne-danger-dark" class="panel-collapse collapse in" aria-expanded="true">
            <div class="panel-body">

                <?php

                $questions_html =[];
                foreach($exam->get_questions() as $question) {
                    $questions_html[] = $question->get_question_id(true)->get_question_with_user_response($exam->get_id(), $user_id,true);
                }

                echo implode('<hr />', $questions_html);

                ?>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>