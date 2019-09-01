<?php
/* @var $industrial Orm_Is_Industrial_Skills */
/* @var $industrial_skills Orm_Is_Industrial_Relation */
/* @var $program_students Orm_User_Student[] */

$total_evaluated_scales_weights = 0;
$skill_has_Results = 0;
$percentage_weight = 0;
foreach ($industrial_skills as $industrial_skill) {

    $student_result = Orm_Rb_Result::get_one(array('user_id' => $student_id, 'semester_id' => Orm_Semester::get_active_semester_id(), 'skill_id' => $industrial_skill));

    if ($student_result->get_scale_id() != 0) {
        $skill_has_Results += 1;
    }

//    if (Orm_Rb_Skills::get_instance($industrial_skill)->get_rubric_obj()->get_weight_type() == Orm_Rb_Rubrics::WEIGHT_TYPE_POINTS) {
//        $percentage_weight = 0;
//
//    } else {
//        $percentage_weight = $student_result->get_scale_obj()->get_weight();
//
//    }

    $percentage_weight = $student_result->get_scale_obj()->get_weight();
    $total_evaluated_scales_weights += $percentage_weight;
}
$average = count($industrial_skills)  ? ($total_evaluated_scales_weights /count($industrial_skills)):0;

?>

<?php if ($pager) { ?>
    <div class="well text-center-md">
        <?php echo $pager; ?>
    </div>
<?php } ?>
<div class="row">
    <div class="col-md-3">
        <div class="well">
            <?php foreach ($program_students as $program_student) { ?>
                <a href="/industrial_skills/details/<?php echo urlencode($industrial->get_id()); ?>/<?php echo urlencode($program_student->get_id()) ?>"
                   class="btn btn-block  <?php echo $student_id == $program_student->get_id() ? 'btn-primary' : '' ?>"
                   type="button">
                    <?php echo htmlfilter($program_student->get_full_name()); ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <?php if ($student_id): ?>
        <div class="col-md-9">
            <div class="panel panel-primary panel-dark">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3 class=" text-center font-weight-bold m-t-1">
                            <?php echo htmlfilter($industrial->get_name()); ?>
                            - <?php echo htmlfilter($industrial->get_program_obj()->get_name()) ?>
                        </h3>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="well clearfix">
                        <p class="font-size-15">
                            <?php echo lang('Student Name'); ?> :
                            <?php echo htmlfilter(Orm_User::get_instance($student_id)->get_full_name()) ?>
                        </p>
                        <p class="font-size-15">
                            <?php echo lang('# of Evaluation Skills'); ?> :
                            <span class="label label-default">
                    <?php echo $skill_has_Results ?> / <?php echo count($industrial_skills) ?>
                            </span>

                        </p>
                        <p class="font-size-15">
                            <?php echo lang('Result'); ?> :
                            <span class="label label-info">
                    <?php echo htmlfilter(round($average,2)) ?>
                            </span>
                        </p>

                    </div>
                    <div class="table-primary">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td class="col-md-3"> <?php echo lang('Skill Name') ?></td>
                                <td class="col-md-3"> <?php echo lang('Scale Name') ?> </td>
                                <td class="col-md-3"> <?php echo lang('Note') ?> </td>
                                <td class="col-md-3"><?php echo lang('Weight') ?> </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($industrial_skills as $industrial_skill) {

                                $student_result = Orm_Rb_Result::get_one(array('user_id' => $student_id, 'semester_id' => Orm_Semester::get_active_semester_id(), 'skill_id' => $industrial_skill));
                                $description_relation = Orm_Rb_Table::get_one(['scale_id' => $student_result->get_scale_id(), $industrial_skill]);

                                ?>
                                <tr>
                                    <td><?php echo htmlfilter(Orm_Rb_Skills::get_instance($industrial_skill)->get_name()) ?> </td>
                                    <td><?php echo htmlfilter($student_result->get_scale_obj()->get_name())?:lang('None') ?></td>
                                    <td><?php echo htmlfilter($description_relation->get_description())?:lang('None') ?></td>
                                    <td>
                                        <?php echo htmlfilter($student_result->get_scale_obj()->get_weight()) ?>
                                        <?php
                                        if (Orm_Rb_Skills::get_instance($industrial_skill)->get_rubric_obj()->get_weight_type() == Orm_Rb_Rubrics::WEIGHT_TYPE_POINTS) {
                                            ?>
                                            <span class="label label-danger pull-right">
                    <?php echo lang('Point') ?>
                            </span>
                                        <?php } else { ?>
                                            <span class="label label-warning pull-right">
                     <?php echo lang('Percentage') ?>
                            </span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="col-md-9">
            <div class="alert">
                <strong><?php echo lang('Warning') ?>
                    !</strong> <?php echo lang('Please select Student Name from left list'); ?>.
            </div>
        </div>
    <?php endif; ?>


</div>

