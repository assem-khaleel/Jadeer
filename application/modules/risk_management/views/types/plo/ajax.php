<?php
/**
 * Created by PhpStorm.
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */

$learning_domain = $this->input->get_post('learning_domain');


$program_id = $this->input->post('program_id');

$program_id = (isset($program_id) ? $program_id : null);

if(is_null($program_id) && $risk_management->get_level_type()==2) {
    $program_id = $risk_management->get_level_id();
}

if(is_null($program_id)) {
    $program_id = -1;
}


$plos = Orm_Cm_Program_Learning_Outcome::get_all(['program_id' => $program_id, 'learning_domain_id' => $learning_domain], 0, 0, ['code']);
?>
<tbody>
<?php if(empty($plos)) { ?>
    <tr>
        <td colspan="2">
            <div class="alert alert-default m-a-0">
                <?php echo lang('Please choose Program / No Program Learning Outcome found.') ?>
            </div>
        </td>
    </tr>
<?php } else { ?>
    <?php foreach ($plos as $plo) { ?>
        <tr>
            <td class="col-lg-3">
                <label class="radio" style="margin: 0 20px;">
                    <input type="radio" name="type_id" <?php echo $risk_management->get_type_id() === $plo->get_id() ? 'checked="checked"' : '' ?> value="<?php echo intval($plo->get_id()) ?>" class="px" />
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
