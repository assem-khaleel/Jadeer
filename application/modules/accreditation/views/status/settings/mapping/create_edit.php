<?php
/**
 * @var Orm_As_Agency[] $agencies
 * @var Orm_College[] $colleges
 */
?>
	<div class="col-md-8 col-lg-9">
		<?php echo form_open("/accreditation/status_settings/mapping_save/{$agency_id}"); ?>

		<div class="well">
			<h3 class="m-t-1"><?php echo htmlfilter(Orm_As_Agency::get_instance($agency_id)->get_name())?></h3>


			<div class="form-group">
				<label class="control-label"><?php echo lang('Colleges'); ?></label>
				<div class="checkbox">
					<label>
						<input type="checkbox" class="px" onchange="check_all(this);" > <span class="lbl"><?php echo lang('Check All'); ?></span>
					</label>
				</div>
				<?php foreach (Orm_College::get_all() as $college) { ?>
					<?php $selected = isset($colleges) && in_array($college->get_id(), $colleges) ? 'checked="checked"' : '' ?>
					<div class="checkbox">
						<label>
							<input type="checkbox" <?php echo $selected; ?> value="<?php echo intval($college->get_id()); ?>" class="px colleges" name="colleges[]"> <span class="lbl"><?php echo htmlfilter($college->get_name()); ?></span>
						</label>
					</div>
				<?php } ?>
			</div>

			<button type="submit" class="btn" <?php echo data_loading_text() ?>>
				<span class="btn-label-icon left fa fa-save"></span><?php echo lang('Save Changes'); ?>
			</button>
		</div>
		<?php echo form_close(); ?>

		<script>
			function check_all(elm) {
				if($(elm).is(':checked')) {
					$('.colleges').prop('checked', true);
				} else {
					$('.colleges').prop('checked', false);
				}
			}
		</script>

	</div>
<?php echo '</div>'; ?>