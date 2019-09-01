<?php
/**
 * Created by PhpStorm.
 * User: abdelqader osama
 * Date: 11/4/17
 * Time: 1:24 PM
 *
 * @var $assessment_metric Orm_Am_Assessment_Metric
 *
 */


$extra_data = $this->input->get_post('extra_data');

$learning_domain = (isset($extra_data['learning_domain']) ? $extra_data['learning_domain'] : null);

if (is_null($learning_domain)) {
    $learning_domain = $assessment_metric->get_item_from_extra_data('learning_domain');
}

if (is_null($learning_domain)) {
    $learning_domain = -1;
}


$program_learning_outcome = (isset($extra_data['program_learning_outcome']) ? $extra_data['program_learning_outcome'] : null);

if (is_null($program_learning_outcome)) {
    $program_learning_outcome = $assessment_metric->get_item_from_extra_data('program_learning_outcome');
}

if (is_null($program_learning_outcome)) {
    $program_learning_outcome = -1;
}


$course = (isset($extra_data['course']) ? $extra_data['course'] : null);

if (is_null($course)) {
    $course = $assessment_metric->get_item_from_extra_data('course');
}

if (is_null($course)) {
    $course = -1;
}


$clos = Orm_Cm_Course_Learning_Outcome::get_all(['course_id' => $course, 'program_learning_outcome_id' => $program_learning_outcome, 'learning_domain_id' => $learning_domain], 0, 10, ['code']);

?>
<tbody>
<?php if (empty($clos)) { ?>
    <tr>
        <td colspan="2">
            <div class="alert alert-warning m-a-0">
                <?php echo lang('Please choose Program / No Course Learning Outcome found.') ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <?php foreach ($clos as $clo) { ?>
        <tr>
            <td class="col-lg-3">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="item_id"
                           <?php echo $assessment_metric->get_item_id() === $clo->get_id() ? 'checked="checked"' : '' ?>value="<?php echo intval($clo->get_id()) ?>"
                           class="px"/>
                    <span class="lbl"><?php echo htmlfilter($clo->get_code()) ?>&ensp;</span>
                </label>
            </td>
            <td class="col-lg-9">
                <?php echo htmlfilter($clo->get_text()) ?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
