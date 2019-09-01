<?php /* @var Orm_Sp_Recommendation_Type $type */ ?>
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<?php
			if (!($type->get_id()))
			{
				echo lang('Create').' '.lang('Recommendation Type');
			} else
			{
				echo lang('Edit').' '.lang('Recommendation Type');
			}
			?>
		</div>
		<?php echo form_open("" . $type->get_id(), 'id="type-form" class="form-horizontal"') ?>
		<div class="modal-body">

			<div class="form-group">
				<label  for="title_ar"  class="col-sm-2 control-label"> <?php echo lang('Title'); ?> (<?php echo lang('Arabic'); ?>): *</label>
				<div class="col-sm-10">
					<input name="title_ar" type="text" class="form-control"
						   value="<?php echo htmlfilter($type->get_title_ar()); ?>"/>
					<?php echo Validator::get_html_error_message('title_ar'); ?>
				</div>
			</div>
			<div class="form-group">
				<label for="title_en" class="col-sm-2 control-label"> <?php echo lang('Title'); ?> (<?php echo lang('English'); ?>): *</label>

				<div class="col-sm-10">
					<input name="title_en" type="text" class="form-control"
						   value="<?php echo htmlfilter($type->get_title_en()); ?>"/>
					<?php echo Validator::get_html_error_message('title_en'); ?>
				</div>
			</div>
			<div class="form-group">
				<label for="code" class="col-sm-2 control-label"> <?php echo lang('Code'); ?>: *</label>

				<div class="col-sm-10">
					<input name="code" type="text" class="form-control" value="<?php echo htmlfilter($type->get_code()); ?>"/>
					<?php echo Validator::get_html_error_message('code'); ?>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="hidden" name="id" value="<?php echo urlencode($type->get_id()); ?>">
			<button type="button" class="btn btn-sm pull-left "
					data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
			<button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
		</div>
		<?php echo form_close() ?>
	</div>
</div>
<script>
	init_data_toggle();
	$('form#type-form').submit(function (e) {
		e.preventDefault();

		$.ajax({
			url: '/strategic_planning/recommendation_type/save',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'JSON'
		}).done(function (msg) {
			if (msg.error == false) {
				window.location.reload(true);
			} else {
				$('#ajaxModalDialog').html(msg.html);
			}
		});
	});
</script>