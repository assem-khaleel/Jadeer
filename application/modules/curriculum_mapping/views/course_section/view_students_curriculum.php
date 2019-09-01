<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 2/1/16
 * Time: 5:57 PM
 */
/** @var int $section_id */
/** @var Orm_Cm_Course_Assessment_Method[] $assessment_methods */
/** @var Orm_Course $course */
/** @var int $method_id */
/** @var Orm_Cm_Section_Mapping_Question[] $questions */
/** @var Orm_Cm_Course_Learning_Outcome[][] $domains */
/* @var $students Orm_Course_Section_Student[] */

$overall_score = 0;
$overall_full_mark = 0;
?>
<?php $this->load->view('course/links', array('course_id' => $course->get_id())); ?>

<div class="row">
    <div class="col-md-12">
        <div class="table-primary">
            <div class="table-header">
                <div class="table-caption">
                    <button class="btn" type="button" data-toggle="collapse" data-target="#legends"
                            aria-expanded="false" aria-controls="legends">
                        <i class="fa fa-question"></i>
                    </button>
                    <span class="padding-sm-hr"><?php echo lang('Band Performance Legend'); ?></span>
                </div>
            </div>
            <div class="collapse" id="legends">
                <table class="table table-bordered bg-theme text-bold">
                    <tr>
                        <td class="col-md-2"><span style="color: #FFF;">B1 (0% to 10 %)</span></td>
                        <td class="col-md-4"><?php echo lang('Unacceptable') ?></td>
                        <td class="col-md-2"><span style="color: #FFF;">B2 (11 % to 30 %)</span></td>
                        <td class="col-md-4"><?php echo lang('Basic Foundation') ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><span style="color: #FFF;">B3 (31 % to 50%)</span></td>
                        <td class="col-md-4"><?php echo lang('Emergent Proficiency') ?></td>
                        <td class="col-md-2"><span style="color: #FFF;">B4 (51 % to 65%)</span></td>
                        <td class="col-md-4"><?php echo lang('Intermediate Proficiency') ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><span style="color: #FFF;">B5 (66 % to 85%)</span></td>
                        <td class="col-md-4"><?php echo lang('Sophisticated Competency') ?></td>
                        <td class="col-md-2"><span style="color: #FFF;">B6 (85 % to 100%)</span></td>
                        <td class="col-md-4"><?php echo lang('Advanced Competency') ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="well">
            <?php foreach ($assessment_methods as $method) { ?>
                <a href="/curriculum_mapping/course_section/students_assessment/<?php echo intval($section_id) ?>/<?php echo intval($method->get_id()) ?>/?course_id=<?php echo $course->get_id(); ?>"
                   class="btn btn-block  <?php echo $method_id == $method->get_id() ? 'btn-primary' : '' ?>"
                   type="button">
                    <?php echo htmlfilter($method->get_text()); ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <?php if($method_id){ ?>
    <div class="col-md-9">
        <div class="well">
            <h3 class="m-a-0">
                <?php echo $method_id ? Orm_Cm_Course_Assessment_Method::get_instance($method_id)->get_text() : ''; ?>
                <?php  if($method_id !=0 ){?>
                    <a  href="/curriculum_mapping/course_section/view_outcomes/<?php echo  intval($section_id) ?>/<?php echo  intval($method_id) ?>/?course_id=<?php echo $course->get_id()?>"  data-toggle="ajaxModal" class="btn pull-right  btn-primary"><?php echo lang('View').' '. lang('Learning Outcomes')?></a>
                <?php  } ?>

            </h3>
        </div>
        <?php if ($method_id) { ?>
            <?php echo form_open("/curriculum_mapping/course_section/students_assessment/{$section_id}/{$method_id}", ['id' => 'student-assessment-form']); ?>
            <div class="well">
                <div class="table-primary table-responsive">
                    <div class="table-header"><span
                                class="table-caption"><?php echo lang('Student Assessment'); ?></span></div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-md-4" rowspan="2"><?php echo lang('Student Name'); ?></th>
                            <th class="col-md-8"
                                colspan="<?php echo count($questions) + 1 ?>"><?php echo lang('Questions ').' & ' . lang('Mark'); ?></th>
                        </tr>

                        <tr>
                            <?php foreach ($questions as $question) { ?>
                                <?php
                                $overall_full_mark += $question->get_full_mark();
                                ?>
                                <td>

                                    <?php echo htmlfilter($question->get_question()); ?>
                                    <span class="m-l-1 label label-pill label-success"><?php echo htmlfilter($question->get_full_mark()) ?></span>
                                    <input type="hidden" class="question-full-score"
                                           id="question-<?php echo $question->get_id() ?>"
                                           name="q_full_marks[<?php echo $question->get_id() ?>]"
                                           value="<?php echo htmlfilter($question->get_full_mark()); ?>">
                                </td>
                            <?php } ?>
                            <td>
                                <strong>
                                    <?php echo lang('Overall Band Performance based on SLOs') ?>
                                    <span class="m-l-2 label label-pill label-success"><?php echo htmlfilter($overall_full_mark); ?></span>
                                </strong>

                            </td>
                        </tr>
                        </thead>
                        <?php if (count($students) != 0 && count($questions) != 0): ?>
                            <?php foreach ($students as $student) { ?>
                                <tr>
                                    <td>

                                        <?php echo htmlfilter($student->get_user_obj()->get_full_name()) ?>
                                    </td>
                                    <?php
                                    foreach ($questions as $question) {
                                        $score = Orm_Cm_Section_Student_Assessment::get_one(array('section_id' => $section_id, 'student_id' => $student->get_user_id(), 'section_mapping_question_id' => $question->get_id()));
                                        $overall_score += $score->get_score();
                                        ?>
                                        <td>
                                            <div class="form-group m-a-0">
                                                <input name="scores[<?php echo (int)$student->get_user_id(); ?>][<?php echo (int)$question->get_id(); ?>][<?php echo (int)$score->get_id(); ?>]"
                                                       type="text" class="form-control"
                                                       value="<?php echo $score->get_score() ? htmlfilter(round($score->get_score(), 2)) : 0; ?>"/>
                                                <div id="<?php echo 'scores_' . $student->get_user_id() . '_' . $question->get_id() . '_' . $score->get_id(); ?>"></div>
                                            </div>
                                        </td>

                                    <?php } ?>
                                    <td>
                                        <?php echo $overall_score ?>

                                    </td>
                                </tr>
                                <?php
                                $overall_score = 0;
                            }
                            ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="10">
                                    <div class="well well-sm m-a-0">
                                        <?php if (count($students) == 0) { ?>
                                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Students'); ?></h3>
                                        <?php } else { ?>
                                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Questions for the selected assessment method'); ?></h3>
                                        <?php } ?>

                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <div class="table-footer text-right clearfix" >
                        <input type="hidden" name="course_id" value="<?php echo $course->get_id(); ?>">

                        <?php if ($pager || ($assessment_methods && $questions) ){ ?>
                            <?php echo  $pager ; ?>
                            <?php if($assessment_methods && $questions): ?>
                                <button type="button" id="submitBTN" class="btn pull-left" <?php echo data_loading_text() ?>>
                                    <span class="btn-label-icon left fa fa-save"></span>
                                    <?php echo lang('Save'); ?>
                                </button>
                            <?php endif; ?>
                        <?php } ?>



                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        <?php } ?>
    </div>
    <?php }else{ ?>
    <div class="col-md-9">
        <div class="alert">
            <strong><?php echo lang('Warning') ?>!</strong> <?php echo lang('Please select an Assessment Method from left list'); ?>.
        </div>
    </div>
    <?php } ?>


</div>

<script>
$('#submitBTN').click(function () {

    $('div.form-message').each(function(){
        $(this).text('').removeClass('form-message').parents(".form-group").removeClass("form-message-light has-error");
    });

    $.ajax({
        type: "POST",
        url: '/curriculum_mapping/course_section/save_scores/<?php echo $section_id ?>/?course_id=<?php echo $course->get_id() ?>',
        data: $('#student-assessment-form').serializeArray(),
        dataType: 'JSON'
    }).done(function (d) {
        if (d.success) {
            window.location.reload();
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