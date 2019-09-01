<?php
/* @var $all_training Orm_Tm_Training[] */

function draw_type($fltr)
{
    ob_start();
    ?>
    <div class="col-md-12 m-b-2">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Type') ?></span>
            <select id="degree_block" name="fltr[type_id]" class="form-control">
                <option value=""><?php echo lang('All Types') ?></option>
                <?php foreach (Orm_Tm_Type::get_all() as $type) : ?>
                    <?php $selected = (isset($fltr['type_id']) && $type->get_id() == $fltr['type_id'] ? 'selected="selected"' : ''); ?>
                    <option
                        value="<?php echo (int)$type->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($type->get_name()); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

?>
<div class="table-primary table-responsive">
    <div class="table-header">

        <?php
        echo filter_block('/training_management/training_general/filter', '/training_management/training_general', ['keyword'], 'ajax_block', draw_type($fltr));
        ?>

    </div>
    <div id="ajax_block">
        <?php $this->load->view('general/data_table'); ?>
    </div>

</div>



