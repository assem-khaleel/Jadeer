<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 02:58 م
 */
/* @var $assignment Orm_Tst_Exam*/
$full_mark = 0;

foreach ($assignment->get_questions() as $question){
    $full_mark+= $question->get_mark();
}
?>
<div class="col-md-12 col-lg-12 m-t-4">
    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <div class="col-md-7 col-lg-7">
                <h3 class="m-t-0 m-b-0">
                    <?php echo htmlfilter($assignment->get_name())?>
                    <span class="label label-default"><?php echo $assignment->get_fullmark().' '.lang('Marks')?></span>
                </h3>
            </div>
            <div  class="col-md-5 col-lg-5 text-right">
                <a class="btn btn-sm " <?php echo ($full_mark >= $assignment->get_fullmark())? 'disabled' : ('href="/examination/assignments/add_question/'.$assignment->get_id().'/'.$full_mark.' " data-toggle="ajaxModal"')?>>
                    <span class="btn-label-icon left icon fa fa-plus"></span>
                    <?php echo lang('Add').' '.lang('Question')?>
                </a>
            </div>

        </div>
        <div class="panel-body">
            <?php
            if ($questions = $assignment->get_questions()):
            foreach ($questions as $question):
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-md-7 col-lg-7">
                        <span class="font-weight-bold"><?php echo $question->get_question_id(true)->get_text()?></span>
                        <span class="label label-tag label-default"><?php echo $question->get_mark().' '.lang('Marks')?></span>
                    </div>
                    <div  class="col-md-5 col-lg-5 text-right">
                        <a class="btn btn-sm" href="/examination/assignments/remove_question/<?php echo $question->get_id()?>"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction" title="<?php echo lang('Delete').' '.lang('Question')?>">
                            <span class="icon fa fa-trash-o"></span>
                        </a>
                    </div>

                </div>
                <div class="panel-body">
                    <?php echo $question->get_question_id(true)->draw_question();?>
                </div>
            </div>
            <?php endforeach;?>
            <?php else:?>
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('questions for this assignment'); ?></h3>
                </div>
            <?php endif;?>

        </div>
    </div>
</div>

