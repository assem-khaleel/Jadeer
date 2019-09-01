<?php
/* @var $programs Orm_Program */
/* @var $departments Orm_Department */
function draw_degree($fltr)
{
    ob_start();
    ?>
    <div class="col-md-12 m-b-2">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Degree') ?></span>
            <select id="degree_block" name="fltr[degree_id]" class="form-control">
                <option value=""><?php echo lang('All Degrees') ?></option>
                <?php foreach (Orm_Degree::get_all() as $degree) : ?>
                    <?php $selected = (isset($fltr['degree_id']) && $degree->get_id() == $fltr['degree_id'] ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo (int)$degree->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($degree->get_name()); ?></option>
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

<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/program/filter', '/program', [Orm_Campus::class, Orm_College::class, Orm_Department::class, 'keyword'], 'ajax_block', draw_degree($fltr)); ?>
        </div>

        <div id="ajax_block" >
            <?php $this->load->view('program/data_table'); ?>
        </div>
    </div>
</div>

