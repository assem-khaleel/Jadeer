<?php
/**
 * Created by PhpStorm.
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */

$action_plan = $this->input->get_post('action_plan');

$action_plans = Orm_Sp_Action_Plan::get_all(['action_plan_id' => $action_plan], 0, 0);
?>
<tbody>
<?php if(empty($action_plans)) { ?>
    <tr>
        <td colspan="2">
            <div class="alert alert-default m-a-0">
                <?php echo lang('Please choose Action Plan / No Action Plan found.') ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <tr>
        <th><?php echo lang('Action Plan Title')?></th>
        <th><?php echo lang('Related Initiative')?></th>
    </tr>
    <?php foreach ($action_plans as $action_plan) { ?>
        <tr>
            <td class="col-lg--6">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="type_id" <?php echo $risk_management->get_type_id() === $action_plan->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($action_plan->get_id()) ?>" class="px" />
                    <span class="lbl"><?php echo htmlfilter($action_plan->get_title()) ?>&ensp;</span>
                </label>
            </td>
            <td class="col-lg-6">
                <?php echo $action_plan->get_initiative_obj()->get_title() ?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
