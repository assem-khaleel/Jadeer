<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 6/29/15
 * Time: 12:04 PM
 */
/** @var int $category */
/** @var Orm_Kpi_Legend[] $parameters */
/** @var Orm_Kpi $kpi */
/** @var Orm_User_Faculty | Orm_User_Staff $user */
$colleges = Orm_College::get_all();
$standards = Orm_Standard::get_all();
?>
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<?php
			if (!($kpi->get_id())) {
				echo lang('Create') . ' ' . lang('KPI');
			} else {
				echo lang('Edit') . ' ' . lang('KPI');
			}
			?>
		</div>
		<?php echo form_open('/kpi/save', 'id="kpi-form"') ?>
		<div class="modal-body">
			<?php if (($category == Orm_Kpi::KPI_ACCREDITATION) && ($user->get_role_obj()->get_admin_level() != Orm_Role::ROLE_COLLEGE_ADMIN)) { ?>
				<div class="row form-group">
					<label class="col-sm-4 control-label"><?php echo lang('College'); ?>:</label>
					<div class="col-sm-8">
						<select class="form-control m-b-1" name="college">
							<option value="0"><?php echo lang('Institution KPI'); ?></option>
							<?php foreach ($colleges as $college) { ?>
								<option
										value="<?php echo (int)$college->get_id(); ?>" <?php echo $college->get_id() == $kpi->get_college_id() ? 'selected="selected"' : ''; ?>><?php echo htmlfilter($college->get_name()); ?></option>
							<?php } ?>
						</select>
                    </div>
				</div>
			<?php } else { ?>
				<input type="hidden" name="college" value="0">
			<?php } ?>
			<?php if ($category == Orm_Kpi::KPI_ACCREDITATION) { ?>
				<div class="row form-group">
					<label class="col-sm-4 control-label"><?php echo lang('Standard'); ?>:</label>
					<div class="col-sm-8">
						<select class="form-control" name="standard">
							<?php foreach ($standards as $standard) { ?>
								<option
										value="<?php echo (int)$standard->get_id(); ?>" <?php echo Orm_Criteria::get_instance($kpi->get_criteria_id())->get_standard_id() == $standard->get_id() ? 'selected="selected"' : ''; ?>><?php echo htmlfilter($standard->get_code() . ' ' . $standard->get_title()); ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			<?php } else { ?>
				<input type="hidden" name="standard" value="0">
			<?php } ?>
			<div class="row form-group">
				<label class="col-sm-4 control-label"><?php echo lang('KPI Code'); ?>:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="code"
						   value="<?php echo htmlfilter($kpi->get_code()); ?>">
					<?php echo Validator::get_html_error_message('code'); ?>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4 control-label"><?php echo lang('KPI Title'); ?>:</label>
				<div class="col-sm-8">
                    <textarea class="form-control"
							  name="kpi_desc"><?php echo htmlfilter($kpi->get_title()); ?></textarea>
					<?php echo Validator::get_html_error_message('kpi_desc'); ?>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4 control-label"><?php echo lang('KPI Label'); ?>:</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="kpi_label"
						   value="<?php echo htmlfilter($kpi->get_chart_y_title()); ?>">
					<?php echo Validator::get_html_error_message('kpi_label'); ?>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4 control-label"><?php echo lang('Unit Responsible'); ?>:</label>
				<div class="col-sm-8">
					<?php echo Orm_Unit::draw_find_unit([],1,5,$kpi->get_unit_id()); ?>
				</div>
			</div>
			<?php if ($category == Orm_Kpi::KPI_ACCREDITATION) { ?>
				<div class="row form-group">
					<label class="col-sm-4 control-label"><?php echo lang('NCAAA KPI?'); ?>:</label>
					<div class="col-sm-8">
						<label class="checkbox-inline">
							<input type="radio" class="px" value="1"
								   name="ncaaa" <?php echo $kpi->get_ncaaa() == Orm_Kpi::KPI_NCAAA ? 'checked="checked"' : ''; ?>>
							<span class="lbl"><?php echo lang('Yes'); ?></span>
						</label>
						<label class="checkbox-inline">
							<input type="radio" class="px" value="0"
								   name="ncaaa" <?php echo $kpi->get_ncaaa() == Orm_Kpi::KPI_NOT_NCAAA ? 'checked="checked"' : ''; ?>>
							<span class="lbl"><?php echo lang('No'); ?></span>
						</label>
						<?php echo Validator::get_html_error_message('ncaaa'); ?>
					</div>
				</div>
			<?php } else { ?>
				<input type="hidden" name="ncaaa" value="<?php echo Orm_Kpi::KPI_NOT_NCAAA; ?>">
			<?php } ?>
			<div class="row form-group">
				<label class="col-sm-4 control-label"><?php echo lang('Semester Based'); ?>:</label>
				<div class="col-sm-8">
					<label class="checkbox-inline">
						<input type="radio" class="px" value="1"
							   name="is_semester" <?php echo $kpi->get_is_semester() == Orm_Kpi::KPI_SEMESTER_BASED ? 'checked="checked"' : ''; ?>>
						<span class="lbl"><?php echo lang('Yes'); ?></span>
					</label>
					<label class="checkbox-inline">
						<input type="radio" class="px" value="0"
							   name="is_semester" <?php echo $kpi->get_is_semester() == Orm_Kpi::KPI_YEARLY_BASED ? 'checked="checked"' : ''; ?>>
						<span class="lbl"><?php echo lang('No'); ?></span>
					</label>
					<?php echo Validator::get_html_error_message('is_semester'); ?>
					<p class="text-light-gray"><?php echo lang('If the values released per semester or academic year'); ?></p>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-4 control-label"><?php echo lang('Overall allowed'); ?>:</label>
				<div class="col-sm-8">
					<label class="checkbox-inline">
						<input type="radio" class="px" value="1"
							   name="overall" <?php echo $kpi->get_overall() == Orm_Kpi::KPI_ALLOW_OVERALL_AVERAGE ? 'checked="checked"' : ''; ?>>
						<span class="lbl"><?php echo lang('Yes'); ?></span>
					</label>
					<label class="checkbox-inline">
						<input type="radio" class="px" value="0"
							   name="overall" <?php echo $kpi->get_overall() == Orm_Kpi::KPI_NOT_ALLOW_OVERALL_AVERAGE ? 'checked="checked"' : ''; ?>>
						<span class="lbl"><?php echo lang('No'); ?></span>
					</label>
					<?php echo Validator::get_html_error_message('overall'); ?>
					<p class="text-light-gray"><?php echo lang('If the KPI has multiple values and can be average'); ?></p>
				</div>
			</div>
			<?php if (!$kpi->get_id()) { ?>
				<?php if (!License::get_instance()->check_module('survey')) { ?>
					<input type="hidden" name="kpi_type" value="<?php echo Orm_Kpi::KPI_QUANTITATIVE; ?>">
				<?php } else { ?>
					<div class="row form-group">
						<label class="col-sm-4 control-label"><?php echo lang('KPI Type'); ?>:</label>
						<div class="col-sm-8">
							<label class="checkbox-inline">
								<input type="radio" class="px" value="1" name="kpi_type"
									   onchange="typeChanged();" <?php echo $kpi->get_kpi_type() == Orm_Kpi::KPI_QUALITATIVE ? 'checked="checked"' : ''; ?>>
								<span class="lbl"><?php echo lang('Qualitative'); ?></span>
							</label>
							<label class="checkbox-inline">
								<input type="radio" class="px" value="2" name="kpi_type"
									   onchange="typeChanged();" <?php echo $kpi->get_kpi_type() == Orm_Kpi::KPI_QUANTITATIVE ? 'checked="checked"' : ''; ?>>
								<span class="lbl"><?php echo lang('Quantitative'); ?></span>
							</label>
							<?php echo Validator::get_html_error_message('kpi_type'); ?>
						</div>
					</div>
				<?php } ?>
			<?php } else { ?>
				<div class="row form-group">
					<label class="col-sm-4 control-label"><?php echo lang('KPI Type'); ?>:</label>
					<div class="col-sm-8">
						<?php echo $kpi->get_kpi_type() == Orm_Kpi::KPI_QUALITATIVE ? lang('Qualitative') : lang('Quantitative'); ?>
					</div>
				</div>
			<?php } ?>
			<?php if (!$kpi->get_id() || ($kpi->get_id() && $kpi->get_kpi_type() == Orm_Kpi::KPI_QUANTITATIVE)) { ?>
				<div class="form-group">
					<div class="table-primary table-responsive">
						<div class="table-header">
							<span class="table-caption"><?php echo lang('KPI Dimensions (Legends)'); ?></span>
							<div class="panel-heading-controls">
								<a href="javascript: void(0);" onclick="addMoreParameters();" class="btn btn-sm "
								   id="more-params" <?php echo $kpi->get_id() && $kpi->get_kpi_type() == Orm_Kpi::KPI_QUANTITATIVE ? '' : 'disabled="disabled"'; ?>
								   title="<?php echo lang('KPI Dimensions only apply to Quantitative KPI types.'); ?>">
                                    <span class="btn-label-icon left">
                                        <i class="fa fa-plus"></i>
                                    </span>
									<?php echo lang('Add'); ?>
								</a>
							</div>
						</div>
						<table class="table table-bordered" id="params-table">
							<thead>
							<tr>
								<th class="col-lg-10"><?php echo lang('Parameter'); ?></th>
								<th class="col-lg-2"><?php echo lang('Delete'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($parameters as $parameter) { ?>
								<tr>
									<td><input name="parameters[]" class="form-control input-sm"
											   value="<?php echo htmlfilter($parameter->get_title()); ?>"><input
												type="hidden" name="parameters_ids[]"
												value="<?php echo htmlfilter($parameter->get_id()); ?>"></td>
									<td><a class="btn btn-sm "
										   href="/kpi/remove_legend/?id=<?php echo urlencode($parameter->get_id()); ?>"
										   message="<?php echo lang('Are you sure ?') ?>"
										   data-toggle="deleteAction"><span class="btn-label-icon left"><i
														class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?>
										</a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
					<?php echo Validator::get_html_error_message('parameters'); ?>
				</div>
			<?php } ?>
		</div>
		<div class="modal-footer">
			<input type="hidden" name="id" value="<?php echo htmlfilter($kpi->get_id()); ?>">
			<input type="hidden" name="c"
				   value="<?php echo htmlfilter($kpi->get_id() ? $kpi->get_category_id() : $category); ?>">
			<button type="button" class="btn btn-sm pull-left  " data-dismiss="modal"><span class="btn-label-icon left"><i
							class=" fa fa-times"></i></span><?php echo lang('Close'); ?></button>
			<button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span
						class="btn-label-icon left "><i
							class="fa fa-floppy-o"></i></span><?php echo lang('Save & Next'); ?>
			</button>
		</div>
		<?php echo form_close() ?>
	</div>
</div>
<script>

	init_data_toggle();

	<?php if (License::get_instance()->check_module('survey')) { ?>
	<?php if ($kpi->get_kpi_type() == Orm_Kpi::KPI_QUALITATIVE) { ?>
	typeChanged();
	<?php } ?>

	function typeChanged() {
		if ($('input[name=kpi_type]:checked', '#kpi-form').val() == 1) {
			$('input[name=max_value]').attr('disabled', 'disabled');
			$('input[name=measure]').attr('disabled', 'disabled');
			$("#params-table").parents('div.table-primary').find("input,button,textarea,a").attr("disabled", "disabled");
		} else {
			$('input[name=max_value]').removeAttr('disabled');
			$('input[name=measure]').removeAttr('disabled');
			$("#params-table").parents('div.table-primary').find("input,button,textarea,a").removeAttr('disabled');
		}
	}
	<?php } else { ?>
	pxInit.push(function () {
		$("#params-table").parents('div.table-primary').find("input,button,textarea,a").removeAttr('disabled');
	});
	<?php } ?>

	$('form#kpi-form').submit(function (event) {
		event.preventDefault();
		$.ajax({
			url: '/kpi/save_kpi',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON'
		}).done(function (msg) {
			if (msg.error === false) {
				window.location.reload();
			} else {
				$('#ajaxModalDialog').html(msg.html);
			}
		});
	});

	function addMoreParameters() {
		if ($('a#more-params').is('[disabled=disabled]')) {
			return false;
		}
		var html =
			'<tr>' +
			'<td><input name="parameters[]" class="form-control input-sm" value=""><input type="hidden" name="parameters_ids[]" value=""></td>' +
			'<td><a class="btn btn-sm " href="/kpi/remove_legend/?id=0" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left "><i class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a></td>' +
			'</tr>';
		var last_tr = $('#params-table > tbody > tr:last');

		if (last_tr.length > 0) {
			last_tr.after(html);
		}
		else {
			$('#params-table > tbody').append(html);
		}
		init_data_toggle();
	}

	function after_delete_action(element, msg) {
		if (msg.status == true) {
			$(element).parents('tr').remove();
		}
	}

	$('#keyword').keydown(function (e) {
		if (e.which == 13) {
			$(this).parent().find('button').click();
			e.preventDefault();
		}

	});
</script>