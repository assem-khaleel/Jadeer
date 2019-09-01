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

<div class="table-primary">
    <div class="table-header">
        <?php echo filter_block('/accreditation/national_ssr18_filter', '/accreditation/national_ssr18', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class,'keyword'],'ajax_block', draw_exclude($fltr)); ?>
    </div>
    <div id="ajax_block" >
        <?php $this->load->view('accreditation/ssr18_datatable'); ?>
    </div>
</div>