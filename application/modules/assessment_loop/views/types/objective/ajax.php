<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/11/17
 * Time: 1:24 PM
 *
 * @var $assessment_loop Orm_Al_Assessment_Loop
 *
 */


$item_type = intval($this->input->post('item_type'));
$college_id = intval($this->input->post('college_id'));
$program_id = intval($this->input->post('program_id'));
$unit_id = intval($this->input->post('unit_id'));

$item_type = $assessment_loop->get_item_type()?: $item_type;
$college_id = $assessment_loop->get_item_type_id()?: $college_id;
$program_id = $assessment_loop->get_item_type_id()?: $program_id;
$unit_id = $assessment_loop->get_item_type_id()?: $unit_id;




switch($item_type){
    case Orm_Al_Assessment_Loop::ASSESSMENT_COLLEGE_LEVEL:
        $objectives = Orm_College_Objective::get_all(['college_id' => $college_id]);
        break;

    case Orm_Al_Assessment_Loop::ASSESSMENT_PROGRAM_LEVEL:
        $objectives = Orm_Program_Objective::get_all(['program_id' => $program_id]);
        break;

    case Orm_Al_Assessment_Loop::ASSESSMENT_UNIT_LEVEL:
        $objectives = Orm_Unit_Objective::get_all(['unit_id' => $unit_id]);
        break;

    default :
        $objectives = Orm_Institution_Objective::get_all();
        break;
}


?>
<tbody>
<?php if(empty($objectives)) { ?>
    <tr>
        <td colspan="2">
            <div class="alert alert-warning m-a-0">
                <?php echo lang('No Objectives found.') ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <?php foreach ($objectives as $objective) { ?>
        <tr>
            <td class="col-lg-2">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="item_id" <?php echo $assessment_loop->get_item_id() === $objective->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($objective->get_id()) ?>" class="px" />
                </label>
            </td>
            <td class="col-lg-10">
                <?php echo htmlfilter($objective->get_title()) ?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
