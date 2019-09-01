<?php
/**
 * Created by PhpStorm.
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */

$initiative = $this->input->get_post('initiative');

$initiatives = Orm_Sp_Initiative::get_all(['initiative_id' => $initiative], 0, 0, ['code']);
?>
<tbody>
<?php if(empty($initiatives)) { ?>
    <tr>
        <td colspan="2">
            <div class="alert alert-default m-a-0">
                <?php echo lang('Please choose Initiative / No Initiative found').'.' ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <tr>
        <th><?php echo lang('Code')?></th>
        <th><?php echo lang('Initiative Title')?></th>
        <th><?php echo lang('Related Objective')?></th>
    </tr>
    <?php foreach ($initiatives as $initiative) { ?>
        <tr>
            <td class="col-lg-2">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="type_id" <?php echo $risk_management->get_type_id() === $initiative->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($initiative->get_id()) ?>" class="px" />
                    <span class="lbl"><?php echo htmlfilter($initiative->get_code()) ?>&ensp;</span>
                </label>
            </td>
            <td class="col-lg-5">
                <?php echo htmlfilter($initiative->get_title()) ?>
            </td>
            <td class="col-lg-5">
                <?php echo $initiative->get_objective_obj()->get_title() ?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
