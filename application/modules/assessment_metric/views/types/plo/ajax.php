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

$program_id = $this->input->post('program_id');
$program_id = $assessment_metric->get_item_id()?: $program_id;

$program_id = (isset($program_id) ? $program_id : null);

if (is_null($program_id) && $assessment_metric->get_item_id() == 2) {
    $program_id = $assessment_metric->get_item_id();
}

if (is_null($program_id)) {
    $program_id = -1;
}


$plos = Orm_Cm_Program_Learning_Outcome::get_all(['program_id' => $program_id, 'learning_domain_id' => $learning_domain], 0, 0, ['code']);
?>
<tbody>
<?php if (empty($plos)) { ?>
    <tr>
        <td colspan="2">
            <div class="alert alert-warning m-a-0">
                <?php echo lang('Please choose Program / No Program Learning Outcome found.') ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <?php foreach ($plos as $plo) { ?>
        <tr>
            <td class="col-lg-3">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio"
                           name="item_id" <?php echo $assessment_metric->get_item_id() === $plo->get_id() ? 'checked="checked"' : '' ?>
                           value="<?php echo intval($plo->get_id()) ?>" class="px"/>
                    <span class="lbl"><?php echo htmlfilter($plo->get_code()) ?>&ensp;</span>
                </label>
            </td>
            <td class="col-lg-9">
                <?php echo htmlfilter($plo->get_text()) ?>
            </td>
        </tr>
    <?php } ?>
<?php } ?>
</tbody>
