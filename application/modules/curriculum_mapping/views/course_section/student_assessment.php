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
/** @var int $student_id */
/** @var Orm_Cm_Section_Mapping_Question[] $questions */
/** @var Orm_Cm_Course_Learning_Outcome[][] $domains */

$overall_score = 0;
$overall_full_mark = 0;
?>
<?php $this->load->view('course/links',array('course_id' => $course->get_id())); ?>

<div class="row">
    <div class="col-md-12">
        <div class="table-primary">
            <div class="table-header">
                <div class="table-caption">
                    <button class="btn" type="button" data-toggle="collapse" data-target="#legends" aria-expanded="false" aria-controls="legends">
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

<div class="panel-group panel-group-primary" id="accordion-domains">
    <?php foreach ($domains as $domain_id => $outcomes) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-domains" href="#domain-<?php echo $domain_id; ?>">
                    <?php echo htmlfilter(Orm_Cm_Learning_Domain::get_instance($domain_id)->get_title()); ?>
                </a>
            </div>
            <div id="domain-<?php echo $domain_id; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-group m-a-0-b">
                        <?php foreach ($outcomes as $outcome) { ?>
                            <li class="list-group-item"><span class="badge badge-primary"><?php echo htmlfilter($outcome->get_code()); ?></span><?php echo htmlfilter($outcome->get_text()); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="well">
            <?php foreach($assessment_methods as $method) { ?>
                <a href="/curriculum_mapping/course_section/students_assessment/<?php echo intval($section_id) ?>/<?php echo intval($method->get_id()) ?>/<?php echo intval($student_id) ?>/?course_id=<?php echo $course->get_id(); ?>" class="btn btn-block  <?php echo $method_id == $method->get_id() ? 'btn-primary' : '' ?>" type="button">
                    <?php echo htmlfilter($method->get_text()); ?>
                </a>
            <?php } ?>
            <hr>
            <?php foreach (Orm_Course_Section_Student::get_all(array('section_id' => $section_id)) as $student) { ?>
                <a href="/curriculum_mapping/course_section/students_assessment/<?php echo intval($section_id) ?>/<?php echo intval($method_id) ?>/<?php echo intval($student->get_user_id()) ?>/?course_id=<?php echo $course->get_id(); ?>" class="btn btn-block  <?php echo $student_id == $student->get_user_id() ? 'btn-primary' : '' ?>" type="button">
                    <i class="fa fa-tasks btn-label-icon left"></i>
                    <?php echo htmlfilter($student->get_user_obj()->get_full_name()); ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-md-9">
        <div class="well">
            <h3 class="m-a-0">
                <?php echo $method_id ? Orm_Cm_Course_Assessment_Method::get_instance($method_id)->get_text() : ''; ?>
                <?php echo $method_id && $student_id ? '/' : ''; ?>
                <?php echo $student_id ? Orm_User::get_instance($student_id)->get_full_name() : ''; ?>
            </h3>
        </div>
        <?php if($method_id && $student_id) { ?>
            <?php echo form_open("/curriculum_mapping/course_section/students_assessment/{$section_id}/{$method_id}/{$student_id}", ['id' => 'student-assessment-form']); ?>
            <div class="well">
                <div class="table-primary">
                    <div class="table-header"><span class="table-caption"><?php echo lang('Student Assessment'); ?></span></div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-md-6"><?php echo lang('Questions'); ?></th>
                            <th class="col-md-4"><?php echo lang('Competencies Dimension'); ?></th>
                            <th class="col-md-2"><?php echo lang('Student Score'); ?></th>
                        </tr>
                        </thead>
                        <?php foreach($questions as $question) { ?>
                            <?php
                            $score = round(Orm_Cm_Section_Student_Assessment::get_one(array('section_id' => $section_id, 'student_id' => $student_id, 'section_mapping_question_id' => $question->get_id()))->get_score(), 2);
                            $overall_score += $score;
                            $overall_full_mark += $question->get_full_mark();
                            ?>
                            <tr>
                                <td><?php echo htmlfilter($question->get_question()); ?></td>
                                <td>
                                    <ul class="list-group">
                                        <?php foreach ($domains as $domain_id => $outcomes) { ?>
                                            <?php $count = 0; ?>
                                            <li class="list-group-item active">
                                                    <span class="label pull-right"></span>
                                                    <?php echo htmlfilter(Orm_Cm_Learning_Domain::get_instance($domain_id)->get_title()); ?>

                                            </li>
                                            <li class="list-group-item">

                                                <?php foreach ($outcomes as $outcome) { ?>
                                                    <?php if (in_array($outcome->get_id(), $question->get_course_learning_outcomes_ids())) { ?>
                                                        <?php $count++; ?>
                                                        <span class="label pull-right"></span>&nbsp;
                                                        <span class="label label-success pull-right"><?php echo htmlfilter($outcome->get_code()); ?></span>

                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if (!$count) { ?>
                                                    <span class="label label-danger pull-right"><?php echo lang('N/A'); ?></span>
                                                    <span class="label pull-right"></span>&nbsp;
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-question" id="<?php echo $question->get_id() ?>" name="score[<?php echo $question->get_id(); ?>]" value="<?php echo $score; ?>">
                                            <input type="hidden" class="form-control input-score" id="score-<?php echo $question->get_id() ?>" value="<?php echo htmlfilter($question->get_full_mark()); ?>">
                                            <span class="input-group-addon bg-success no-border"><?php echo htmlfilter($question->get_full_mark()); ?></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr class="bg-tree-node-5">
                            <td colspan="2" class="valign-middle" style="color: #fff;"><strong><?php echo lang('Overall Band Performance based on SLOs') ?></strong></td>
                            <td>
                                <div class="input-group">
                                    <input class="form-control" disabled id="total-score">
                                    <span class="input-group-addon bg-success no-border"><?php echo $overall_full_mark; ?></span>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="table-footer text-right">
                        <input type="hidden" name="course_id" value="<?php echo $course->get_id(); ?>">
                        <button type="submit" id="save-btn" class="btn btn-sm " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        compute_score();
    });

    $('.input-question').on('change', function() {
        compute_score();
    });

    function compute_score() {
        var total_score = 0;
        $('.input-question').each(function() {
            total_score += parseFloat($(this).val());
        });
        $('#total-score').val(total_score);
    }
    $('#student-assessment-form').on('submit', function (e) {
        var success = true;
        $('.input-question').each(function(i, obj) {

            var question_id = $(obj).attr('id');
            var score = $('#score-'+question_id);

            if ((parseInt($(obj).val()) > parseInt(score.val())) || (parseInt($(obj).val()) < 0)) {
                var error_message = '<?php echo lang("The max value is") ?> ' + score.val() + ' <?php echo lang("and The Min value is 0"); ?>';
                var error_html = '<div class="form-message">' + error_message + '</div>';
                $(obj).parents('.form-group').find('.form-message').remove();
                $(obj).parents('.form-group').append(error_html);
                $(".form-message").parents(".form-group").addClass("form-message-light has-error");
                success = false;
            }
        });
        if (!success) {
            $('#save-btn').button('reset');
        }
        return success;
    });
</script>