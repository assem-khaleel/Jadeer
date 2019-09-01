<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/11/17
 * Time: 1:24 PM
 *
 * @var $assessment_metric Orm_Am_Assessment_Metric *
 */


$program_id = $this->input->post('program_id');
$program_id = $assessment_metric->get_item_id()?: $program_id;

$objectives = Orm_Program_Objective::get_all(['program_id' => $program_id]);



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
                    <input type="radio" name="item_id" <?php echo $assessment_metric->get_item_id() === $objective->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($objective->get_id()) ?>" class="px" />
                </label>
            </td>
            <td class="col-lg-10">
                <?php echo htmlfilter($objective->get_title()) ?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
