<?php
/**
 * Created by PhpStorm.
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */




$learning_domain = $this->input->get_post('learning_domain');

$program_learning_outcome = (isset($learning_domain['program_learning_outcome']) ? $learning_domain['program_learning_outcome'] : null);

$course = (isset($learning_domain['course']) ? $learning_domain['course'] : null);


$clos = Orm_Cm_Course_Learning_Outcome::get_all(['course_id'=>$course, 'program_learning_outcome_id'=>$program_learning_outcome, 'learning_domain_id'=>$learning_domain], 0, 10, ['code']);

?>
<tbody>
<?php if(empty($clos)) { ?>
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
            <td class="col-lg-2">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="type_id" <?php echo $risk_management->get_type_id() === $clo->get_id() ? 'checked="checked"' : '' ?>value="<?php echo intval($clo->get_id()) ?>" class="px" />
                    <span class="lbl"><?php echo htmlfilter($clo->get_code()) ?>&ensp;</span>
                </label>
            </td>
            <td class="col-lg-5">
                <?php echo htmlfilter($clo->get_text()) ?>
            </td>
            <td class="col-lg-5">
                <?php echo $clo->get_program_learning_outcome_obj()->get_text() ?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
