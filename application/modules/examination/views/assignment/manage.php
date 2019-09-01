<?php
/* @var $assignment Orm_Tst_Exam*/
/* @var $question_ids Orm_Tst_Exam_Questions*/
?>
<div class="col-md-12 col-lg-12 m-t-4">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <div class="col-md-7 col-lg-7">
                <h5 class="m-t-0 m-b-0"><?php echo $assignment->get_name()?></h5>
            </div>
            <div  class="col-md-5 col-lg-5 text-right">
                <a class="btn btn-sm" href="/examination/assignments/add_question/<?php echo $assignment->get_id()?>" data-toggle="ajaxModal">
                    <span class="btn-label-icon left icon fa fa-plus"></span>
                    <?php echo lang('Add').' '.lang('Question') ?>
                </a>
            </div>

        </div>
        <div class="panel-body">
            <?php
            if ($question_ids):
            foreach ($question_ids as $question_id):/* @var $question_id Orm_Tst_Exam_Questions*/
            $question = Orm_Tst_Question::get_instance($question_id->get_question_id());
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-md-7 col-lg-7">
                        <span class="font-weight-bold"><?php echo $question->get_text()?></span>
                        <!--TODO Put mark are not ready yet -->
                        <span class="label label-tag label-default"><?php echo $question_id->get_mark().' '.lang('Marks')?></span>
                    </div>
                    <div  class="col-md-5 col-lg-5 text-right">
                        <a class="btn btn-sm" href="/examination/assignments/edit_question/<?php echo $assignment->get_id()?>/<?php echo $question->get_id() ?>/<?php echo $question_id->get_id()?>" data-toggle="ajaxModal" title="<?php echo lang('Edit').' '.lang('Question')?>">
                            <span class="icon fa fa-edit"></span>
                        </a>
                        <a class="btn btn-sm" href="/examination/assignments/remove_question/<?php echo $question_id->get_id()?>/<?php echo $assignment->get_id()?>"   message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" title="<?php echo lang('Delete').' '.lang('Question')?>">
                            <span class="icon fa fa-trash-o"></span>
                        </a>
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
