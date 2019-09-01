<?php
/**
 * Created by PhpStorm.
 * User: Laith
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */


$level_type = intval($this->input->post('level_type'));
$college_id = intval($this->input->post('college_id'));
$program_id = intval($this->input->post('program_id'));
$unit_id = intval($this->input->post('unit_id'));

$level_type = $risk_management->get_level_type()?: $level_type;
$college_id = $risk_management->get_level_id()?: $college_id;
$program_id = $risk_management->get_level_id()?: $program_id;
$unit_id = $risk_management->get_level_id()?: $unit_id;




switch($level_type){
    case Orm_Rim_Risk_Management::RISK_COLLEGE_LEVEL:
        $objectives = Orm_College_Objective::get_all(['college_id' => $college_id]);
        break;

    case Orm_Rim_Risk_Management::RISK_PROGRAM_LEVEL:
        $objectives = Orm_Program_Objective::get_all(['program_id' => $program_id]);
        break;

    case Orm_Rim_Risk_Management::RISK_UNIT_LEVEL:
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
            <div class="alert alert-default m-a-0">
                <?php echo lang('No Objectives found.') ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <?php foreach ($objectives as $objective) { ?>
        <tr>
            <td class="col-lg-2">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="type_id" <?php echo $risk_management->get_type_id() === $objective->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($objective->get_id()) ?>" class="px" />
                </label>
            </td>
            <td class="col-lg-10">
                <?php echo htmlfilter($objective->get_title()) ?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
