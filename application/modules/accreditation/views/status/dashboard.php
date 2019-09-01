<?php
/**
 * Created by PhpStorm.
 * User: basel
 * Date: 22/12/15
 * Time: 10:39 am
 */
/**
 * @var string $mode
 * @var int $all_count
 * @var int $national_count
 * @var int $international_count
 */
?>
<script>
    google.load('visualization', '1', {'packages':['corechart', 'bar', 'table']});
</script>

<?php $this->load->view('legends'); ?>

<div class="well well-table-header">
	<form method="GET">
		<div class="row">
			<div class="col-md-6">
				<div class="input-group input-group-sm">
					<span class="input-group-addon"><?php echo lang('Agency') ?>:</span>
					<select class="form-control" id="agency-filter" onchange="filter()">
						<option value=""><?php echo lang('Select Agency'); ?></option>
						<?php foreach (Orm_As_Agency::get_all() as $agency) { ?>
							<option value="<?php echo intval($agency->get_id()); ?>"><?php echo htmlfilter($agency->get_name()); ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="input-group input-group-sm">
					<span class="input-group-addon"><?php echo lang('College') ?>:</span>
					<?php if (Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) { ?>
						<span class="form-control">
							<?php echo htmlfilter(Orm_User::get_logged_user()->get_college_obj()->get_name()); ?>
							<input type="hidden" id="college-filter" value="<?php echo intval(Orm_User::get_logged_user()->get_college_id()) ?>" >
						</span>
					<?php } else { ?>
						<select class="form-control" name="college-filter" id="college-filter" onchange="filter()">
							<option value=""><?php echo lang('All College') ?></option>
							<?php foreach (Orm_College::get_all() as $college) { ?>
								<option value="<?php echo intval($college->get_id()); ?>"><?php echo htmlfilter($college->get_name()); ?></option>
							<?php } ?>
						</select>
					<?php } ?>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="row">
	<div class="col-md-12" id="agency_container"></div>
</div>

<script>
	function filter() {
		var agency_id = $('#agency-filter').val();
		var college_id = $('#college-filter').val();
		if(agency_id) {
			ajaxRender('agency_container', "/accreditation/status/chart_agency?agency_id=" + agency_id + "&college_id=" + college_id);
		} else {
			$('#agency_container').html('');
		}
	}
	pxInit.push(function () {
	    var agency_id = <?php echo Orm_As_Agency::get_one(array('name_en' => 'NCAAA'))->get_id(); ?>;
        $('#agency-filter').val(agency_id);
        ajaxRender('agency_container', "/accreditation/status/chart_agency?agency_id=" + agency_id);
    });
</script>