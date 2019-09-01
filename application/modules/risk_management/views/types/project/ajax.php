<?php
/**
 * Created by PhpStorm.
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */

$project = $this->input->get_post('project');

$projects = Orm_Sp_Project::get_all(['project_id' => $project], 0, 0);
?>
<tbody>
<?php if(empty($projects)) { ?>
    <tr>
        <td colspan="2">
            <div class="alert alert-default m-a-0">
                <?php echo lang('Please choose Projects / No Project found.') ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <tr>
        <th><?php echo lang('Project Title')?></th>
        <th><?php echo lang('Related Action Plan')?></th>
    </tr>
    <?php foreach ($projects as $project) { ?>
        <tr>
            <td class="col-lg--6">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="type_id" <?php echo $risk_management->get_type_id() === $project->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($project->get_id()) ?>" class="px" />
                    <span class="lbl"><?php echo htmlfilter($project->get_title()) ?>&ensp;</span>
                </label>
            </td>
            <td class="col-lg-6">
                <?php echo $project->get_action_plan_obj()->get_title()?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
