<?php
/**
 * Created by PhpStorm.
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */

$activity = $this->input->get_post('activity');

$activities = Orm_Sp_Activity::get_all(['activity_id' => $activity], 0, 0);
?>
<tbody>
<?php if(empty($activities)) { ?>
    <tr>
        <td colspan="2">
            <div class="alert alert-default m-a-0">
                <?php echo lang('Please choose activity / No activity found.') ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <tr>
        <th><?php echo lang('Project Title')?></th>
        <th><?php echo lang('Related Project')?></th>
    </tr>
    <?php foreach ($activities as $activity) { ?>
        <tr>
            <td class="col-lg--6">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="type_id" <?php echo $risk_management->get_type_id() === $activity->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($activity->get_id()) ?>" class="px" />
                    <span class="lbl"><?php echo htmlfilter($activity->get_title()) ?>&ensp;</span>
                </label>
            </td>
            <td class="col-lg-6">
                <?php echo $activity->get_project_obj()->get_title()?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
