<?php
function draw_year($fltr)
{
ob_start();
?>
<div class="col-md-12 m-b-1">
    <div class="input-group">
        <span class="input-group-addon"><?php echo lang('Year') ?></span>
        <select id="semester_block" name="fltr[year]" class="form-control">
            <option value=""><?php echo lang('All Years') ?></option>
            <?php foreach (Orm_Node::get_years() as $year) : ?>
                <?php $selected = (!empty($fltr['year']) && $fltr['year'] == $year ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $year; ?>" <?php echo $selected; ?>><?php echo $year; ?></option>
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

<div class="table-primary">
    <div class="table-header">
        <?php echo filter_block('/accreditation/international_filter', '/accreditation/international', ['keyword'],'', draw_year($fltr)); ?>
    </div>
    <div id="ajax_block">
        <?php $this->load->view('accreditation/international_datatable'); ?>
    </div>
</div>