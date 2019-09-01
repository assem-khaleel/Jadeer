<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 6/29/15
 * Time: 12:04 PM
 */
/** @var array $fltr */
/** @var Orm_Kpi $kpi */
/** @var int $type */
?>
<div class="modal-dialog" style="width: 90%;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php echo lang('KPI Details View'); ?><br>
            <?php echo htmlfilter($kpi->get_title()); ?>
        </div>
        <?php echo form_open('/kpi/save_step_2', 'id="kpi-values-form"') ?>
            <div class="modal-body">
	            <?php echo $kpi->draw_details_chart($type,$fltr); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <a href="/kpi/pdf/?id=<?php echo urlencode($kpi->get_id()); ?>&t=<?php echo htmlfilter(Orm_Kpi::KPI_REPORT_DETAILS); ?>&college_id=<?php echo htmlfilter(isset($fltr['college_id']) ? $fltr['college_id'] : 0); ?>&program_id=<?php echo htmlfilter(isset($fltr['program_id']) ? $fltr['program_id'] : 0); ?>" class="btn btn-sm pull-right " ><span class="btn-label-icon left"><i class="fa fa-file-pdf-o"></i></span><?php echo lang('PDF'); ?></a>
                <a href="/kpi/image/?id=<?php echo urlencode($kpi->get_id()); ?>&t=<?php echo htmlfilter(Orm_Kpi::KPI_REPORT_DETAILS); ?>&college_id=<?php echo htmlfilter(isset($fltr['college_id']) ? $fltr['college_id'] : 0); ?>&program_id=<?php echo htmlfilter(isset($fltr['program_id']) ? $fltr['program_id'] : 0); ?>" class="btn btn-sm pull-right " ><span class="btn-label-icon left"><i class="fa fa-file-image-o"></i></span><?php echo lang('Image'); ?></a>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
	function afterModal() {
		<?php foreach (Orm_Kpi_Level::get_all(array('kpi_id' => $kpi->get_id())) as $level) {?>
        drawChart_<?php echo $level->get_id(); ?>_0();
		<?php } ?>
	}
</script>