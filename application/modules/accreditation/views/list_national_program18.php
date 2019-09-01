<?php
function draw_exclude($fltr)
{
    ob_start();
    ?>
    <div class="col-md-4 m-b-2">
        <div class="checkbox">
            <label class="custom-control custom-checkbox" >
                <input type="checkbox" class="custom-control-input" name="fltr[exclude_na]" <?php echo(!empty($fltr['exclude_na']) ? 'checked="checked"' : ''); ?>>
                <span class="custom-control-indicator"></span>
                <?php echo lang('Exclude Not Started'); ?>
            </label>
        </div>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
?>


<?php if(Orm_Node::get_active_program2018_node()->get_id()) { ?>
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/accreditation/national_program18_filter', '/accreditation/national_program18', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class,'keyword'],'ajax_block', draw_exclude($fltr)); ?>
        </div>
        <div id="ajax_block" >
            <?php $this->load->view('accreditation/program18_datatable'); ?>
        </div>
    </div>
<?php } else { ?>
    <div class="well well-sm m-a-0">
        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('QMS Program Management'); ?></h3>
        <?php if (Orm_Node::check_if_can_generate()) { ?>
            <br>
            <div class="text-center" id="program-management-container">
                <button class="btn" onclick="$('#program-management').submit();"><?php echo lang('Create').' '.lang('Program Management'); ?></button>
                <?php echo form_open('/accreditation/generate', array('id' => 'program-management', 'class' => 'hidden', 'data-toggle' => 'ajaxSubmit', 'data-target' => 'program-management-container')); ?>
                <?php echo form_hidden('system', Orm_Node::SYSTEM_PROGRAM2018); ?>
                <?php echo form_hidden('type','national'); ?>
                <?php echo form_close(); ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
