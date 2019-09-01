<?php
/**
 * Created by PhpStorm.
 * User: laith
 * Date: 5/1/17
 * Time: 4:18 PM
 */
/* @var $assignment Orm_Tst_Exam */
?>

<div class="panel panel-primary">
    <?php echo form_open('/examination/student_assignment/save_question/'.$assignment->get_id(), 'method="post" enctype="multipart/form-data"'); ?>
    <div class="panel-heading">
        <div>
            <b><span style="font-size: large"><?php echo  lang('Assignment') ?></span></b>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-md-3 control-label"><?php echo lang('Description') ?></label>
            <div class="col-md-9">
                <?php echo nl2br(htmlfilter($assignment->get_desc())); ?>
            </div>
            <br clear="both" />
            <hr />
        </div>
        <?php $questions = $assignment->get_questions(); ?>
        <?php foreach($questions as $key=>$question): ?>

            <label class="col-md-3 control-label"><?php echo $question->get_question_id(true)->get_text() ?></label>
            <div class="col-md-9">
                <?php echo $question->get_question_id(true)->get_question_with_user_response($assignment->get_id()) ?>
            </div>

            <?php if($question->get_question_id(true)->get_can_attach()): ?>
            <br clear="both" />

            <div class="form-group m-t-2">
                <label for="<?php echo $question->get_question_id(true)->get_html_question_name(true) ?>" class="col-md-3 control-label"><?php echo lang('Attachment') ?></label>
                <div class="col-md-9">
                    <?php
                    $attch = Orm_Tst_Exam_Response_Attachment::get_one([
                        'exam_id'=>$assignment->get_id(),
                        'question_id' => $question->get_question_id(),
                        'user_id'=>Orm_User::get_logged_user_id()
                    ]);

                    ?>
                    <div class="col-md-<?php echo ($attch && $attch->get_id())? '9': '12'; ?>">
                        <label class="custom-file px-file">
                            <input type="file" id="<?php echo $question->get_question_id(true)->get_html_question_name(true) ?>" name="<?php echo $question->get_question_id(true)->get_html_question_name(true) ?>" class="custom-file-input">
                            <span class="custom-file-control form-control"><?php echo lang('Choose file...') ?></span>
                            <div class="px-file-buttons">
                                <button type="button" class="btn btn-xs px-file-clear"><?php echo lang('Clear') ?></button>
                                <button type="button" class="btn btn-primary btn-xs px-file-browse"><?php echo lang('Browse') ?></button>
                            </div>
                        </label>
                    </div>

                    <?php
                    if($attch && $attch->get_id()) {
                        echo '<div class="col-md-3">';
                        echo '<a href="'.$attch->get_path_file().'" class="btn btn-block pull-right"><span class="btn-label-icon left"><i class="fa fa-download"></i></span>'.lang('View File').'</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if((count($assignment->get_questions())-1) > $key): ?>
            <br clear="both" />
            <hr />
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="panel-footer">

        <button type="submit" class="btn pull-right m-l-3">
            <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Submit'); ?>
        </button>

        <a type="button" class="btn pull-right" href="<?php echo base_url('/examination/student_assignment') ?>">
            <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Cancel'); ?>
        </a>
        <div class="clearfix"></div>
    </div>
    <?php echo form_close(); ?>
</div>

<script>
$('.px-file').pxFile();
</script>
