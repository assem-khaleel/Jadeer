<?php
/**
 * Created by PhpStorm.
 * User: shamaseen
 * Date: 16/05/18
 * Time: 11:45 ص
 */
?>
<table class="table table-striped table-bordered">
    <thead>
    <tr class="bg-primary">
        <td class="col-md-2"><b><?php echo lang('Question Type') ?></b></td>
        <td class="col-md-3"><b><?php echo lang('Course') ?></b></td>
        <td class="col-md-3"><b><?php echo lang('Question Description') ?></b></td>
        <td class="col-md-1"><b><?php echo lang('Question Status') ?></b></td>
        <td class="col-md-3 text-center"><b><?php echo lang('Action') ?></b></td>
    </tr>
    </thead>
    <tbody>
    <!--    if question type-->
    <?php if (count($questions)){
        foreach ($questions as $question) { ?>
            <tr>
                <td>
            <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')): ?>
                    <a href="/examination/question_bank/show_question/<?php echo $question->get_id(); ?>"  data-toggle="ajaxModal" >
                        <?php echo lang(htmlfilter($question->get_type(true))); ?>
                    </a>
            <?php else: ?>
                <?php echo lang(htmlfilter($question->get_type(true))); ?>
            <?php endif; ?>
                </td>
                <td>
                    <?php echo htmlfilter($question->get_course_id(true)->get_name()); ?>
                </td>
                <td>
                    <?php echo htmlfilter($question->get_text()); ?>
                </td>
                <td>
                    <?php echo lang(Orm_Tst_Question::$status_arr[$question->get_status()]); ?>
                    <?php echo $question->can_edit()? '': '<span class="text-danger"> ('. lang('Used in Exams') . ') </span>'; ?>
                </td>
                <td class="tree-actions">
                    <?php if(Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, 'examination-manage')): ?>
                    <a href="/examination/question_bank/show_question/<?php echo (int)$question->get_id(); ?>" class="btn btn-primary btn-sm btn-block" title="<?php echo lang('View'); ?>" data-toggle="ajaxModal"><span class="btn-label-icon left fa fa-eye" aria-hidden="true"></span> <?php echo lang('View'); ?></a>

                    <?php if(License::get_instance()->check_module('curriculum_mapping')): ?>
                    <a href="/examination/question_bank/link_question/<?php echo (int)$question->get_id(); ?>" class="btn btn-primary btn-sm  btn-block" title="<?php echo lang('Learning Outcome'); ?>" data-toggle="ajaxModal"><span class="btn-label-icon left fa fa-eye" aria-hidden="true"></span> <?php echo lang('Learning Outcome'); ?></a>
                    <?php endif; ?>

                    <?php if ($question->can_edit()): ?>
                        <a href="/examination/question_bank/question_edit/<?php echo (int)$question->get_id(); ?>" class="btn btn-primary btn-sm btn-block" title="<?php echo lang('Edit'); ?>" data-toggle="ajaxModal"><span class="btn-label-icon left fa fa-pencil-square-o" aria-hidden="true"></span><?php echo lang('Edit'); ?></a>
                        <a href="/examination/question_bank/question_delete/<?php echo (int)$question->get_id(); ?>" class="btn btn-primary btn-sm btn-block" title="<?php echo lang('Delete'); ?>"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction"><span class="btn-label-icon left fa fa-trash" aria-hidden="true"></span><?php echo lang('Delete'); ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
        }
    }else {
        ?>
        <tr>
            <td colspan="5">
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Questions'); ?></h3>
                </div>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<?php if (!empty($pager)) { ?>
<div class="table-footer">
    <?php echo $pager; ?>
</div>
<?php } ?>