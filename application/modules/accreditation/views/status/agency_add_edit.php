<?php
/**
 * @var Orm_As_Status $status_obj
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open_multipart('/accreditation/status/agency_save', 'id="agency_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo intval($status_obj->get_id()) ? lang('Edit').' '.lang('Agency') : lang('Add').' '.lang('Agency'); ?></h4>
        </div>
	    <div class="modal-body">

		    <?php if (!$status_obj->get_id()) { ?>
			    <div class="form-group">
				    <div class="input-group input-group-sm">
					    <span class="input-group-addon"><?php echo lang('Agency'); ?></span>

					    <select class="form-control" name="agency" id="agency">
						    <option value=""><?php echo lang('Select One'); ?></option>

						    <?php foreach (Orm_As_Agency_Mapping::get_all(array('program_id' => Orm_User::get_logged_user()->get_program_id())) as $agency) { ?>
							    <?php $selected = ($status_obj->get_agency() == $agency->get_agency_id()) ? ' selected="selected"' : ''; ?>
							    <option value="<?php echo $agency->get_agency_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($agency->get_agency_obj()->get_name()); ?></option>
						    <?php } ?>
					    </select>
				    </div>
				    <?php echo Validator::get_html_error_message('agency'); ?>
			    </div>
		    <?php } ?>

		    <div class="form-group">
			    <label class="control-label"><?php echo lang('Status'); ?></label>

			    <?php
				$statuses = Orm_As_Status::$types;
				unset($statuses[Orm_As_Status::ACC_NOT_ACCREDITED]);
				?>
			    <div class="form-control">
				    <?php foreach ($statuses as $status_id => $status) { ?>
					    <?php $checked = ($status_obj->get_status() == $status_id) ?  'checked="checked"' : ''; ?>
					    <div class="radio-inline">
						    <label>
							    <input type="radio" class="px status" value="<?php echo $status_id; ?>" <?php echo $checked; ?> name="status">
							    <span class="lbl"><?php echo lang($status['name']); ?></span>
						    </label>
					    </div>
				    <?php } ?>
			    </div>
			    <?php echo Validator::get_html_error_message('status'); ?>
		    </div>

		    <div class="form-group accredited-field" <?php echo (!in_array($status_obj->get_status() , array(Orm_As_Status::ACC_ACCREDITED, Orm_As_Status::ACC_NOT_ACCREDITED)) ? 'style="display: none;"' : '') ?> >
			    <label class="control-label"><?php echo lang('Accredited'); ?></label>

			    <div class="form-control">
				    <?php foreach (array(0 => 'no', 1 => 'yes') as $key => $value) { ?>
						<?php $checked = ($status_obj->get_accredited() == $key) ?  'checked="checked"' : ''; ?>
					    <div class="radio-inline">
						    <label>
							    <input type="radio" class="px" value="<?php echo $key; ?>"<?php echo $checked; ?> name="accredited">
							    <span class="lbl"><?php echo lang($value); ?></span>
						    </label>
					    </div>
				    <?php } ?>
			    </div>
		    </div>

		    <div class="form-group agency-field"  <?php echo (!in_array($status_obj->get_status() , array(Orm_As_Status::ACC_SUBMITTED, Orm_As_Status::ACC_VISITED, Orm_As_Status::ACC_ACCREDITED)) ? 'style="display: none;"' : '') ?>>
			    <label class="control-label">
					<?php echo $status_obj->get_status() == Orm_As_Status::ACC_SUBMITTED ? lang('Date Submitted') : ''; ?>
					<?php echo $status_obj->get_status() == Orm_As_Status::ACC_VISITED ? lang('Date Visited') : ''; ?>
					<?php echo $status_obj->get_status() == Orm_As_Status::ACC_ACCREDITED ? lang('Date Accredited') : ''; ?>
				</label>

			    <input type="text" name="status_date" class="form-control date-picker" id="status_date"
			           readonly="readonly"
			           value="<?php echo $status_obj->get_status_date() != '0000-00-00' ? htmlfilter($status_obj->get_status_date()) : ''; ?>"/>
			    <?php echo Validator::get_html_error_message('status_date'); ?>
		    </div>

			<div class="m-b-1">
				<label class="control-label"><?php echo lang('Attachment'); ?></label>

				<div style="border-radius: 2px; border: 1px solid #d6d6d6; min-height: 32px;" class="padding-sm">
					<div class="form-group m-a-0">
						<input type="file" name="file">
						<?php echo Validator::get_html_error_message('file_upload'); ?>
					</div>
					<?php if ($status_obj->get_attachment()) { ?>
					<hr style="margin: 10px 0;">
					<div>
						<a class="link" href="<?php echo htmlfilter($status_obj->get_attachment_link()) ?>"><i class="fa fa-paperclip"></i> <?php echo lang('Download Attachment'); ?></a>
					</div>
					<?php } ?>
				</div>
			</div>

		    <div class="form-group">
			    <label class="control-label"><?php echo lang('Note'); ?></label>

			    <textarea class="form-control" id="note" name="note"><?php echo xssfilter($status_obj->get_note()); ?></textarea>
			    <?php echo Validator::get_html_error_message('note'); ?>
		    </div>

		    <div class="row">
			    <div class="col-md-6">
				    <div class="panel panel-primary">
					    <div class="panel-heading">
						    <span class="panel-title"><?php echo lang('Program Chair'); ?></span>
					    </div>
					    <div class="panel-body">
						    <?php
						    $user_title = '';
						    $user_id = '';
						    if ($status_obj->get_program_chair()) {
							    $user_ref = Orm_User::get_instance($status_obj->get_program_chair());

							    if ($user_ref->get_id()) {
								    $user_title = $user_ref->get_full_name();
								    $user_id = $user_ref->get_id();
							    }
						    }
						    ?>
						    <div class="form-group">
							    <label class="control-label"><?php echo lang('Name'); ?></label>
							    <input type="text"  onclick="find_users(this, 'chair_id', 'chair_name', '<?php echo Orm_User_Faculty::class ?>')" readonly class="form-control"
									   id="chair_name" name="chair_name" value="<?php echo $user_title; ?>" />
							    <input id="chair_id" name="chair_id" data-type="chair" type="hidden" value="<?php echo $user_id; ?>" />
							    <?php echo Validator::get_html_error_message('chair_name'); ?>
						    </div>

						    <div class="form-group">
							    <label class="control-label"><?php echo lang('Email'); ?></label>
							    <input type="text" id="chair_email" name="chair_email" class="form-control" readonly value="<?php echo htmlfilter($status_obj->get_chair_email()); ?>"/>
							    <?php echo Validator::get_html_error_message('chair_email'); ?>
						    </div>

						    <div class="form-group">
							    <label class="control-label"><?php echo lang('Phone'); ?></label>
							    <input type="text" id="chair_phone" name="chair_phone" class="form-control" readonly value="<?php echo htmlfilter($status_obj->get_chair_phone()); ?>"/>
							    <?php echo Validator::get_html_error_message('chair_phone'); ?>
						    </div>
					    </div>
				    </div>
			    </div>

			    <div class="col-md-6">
				    <div class="panel panel-primary">
					    <div class="panel-heading">
						    <span class="panel-title"><?php echo lang('Dean'); ?></span>
					    </div>
					    <div class="panel-body">
						    <?php
						    $user_title = '';
						    $user_id = '';
						    if ($status_obj->get_dean()) {
							    $user_ref = Orm_User::get_instance($status_obj->get_dean());

							    if ($user_ref->get_id()) {
								    $user_title = $user_ref->get_full_name();
								    $user_id = $user_ref->get_id();
							    }
						    }
						    ?>
						    <div class="form-group">
							    <label class="control-label"><?php echo lang('Name'); ?></label>
							    <input type="text" onclick="find_users(this, 'dean_id', 'dean_name', '<?php echo Orm_User_Faculty::class ?>')" readonly class="form-control"
									   id="dean_name" name="dean_name" value="<?php echo $user_title; ?>" />
							    <input id="dean_id" name="dean_id" data-type="dean" type="hidden" value="<?php echo $user_id; ?>" />
							    <?php echo Validator::get_html_error_message('dean_name'); ?>
						    </div>

						    <div class="form-group">
							    <label class="control-label"><?php echo lang('Email'); ?></label>

							    <input type="text" id="dean_email" name="dean_email" class="form-control" readonly value="<?php echo htmlfilter($status_obj->get_dean_email()); ?>"/>
							    <?php echo Validator::get_html_error_message('dean_email'); ?>
						    </div>

						    <div class="form-group">
							    <label class="control-label"><?php echo lang('Phone'); ?></label>

							    <input type="text" id="dean_phone" name="dean_phone" class="form-control" readonly value="<?php echo htmlfilter($status_obj->get_dean_phone()); ?>"/>
							    <?php echo Validator::get_html_error_message('dean_phone'); ?>
						    </div>
					    </div>
				    </div>
			    </div>
		    </div>

	    </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left" data-dismiss="modal">
                <span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn pull-right" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa  fa-plus"></span><?php echo lang('Save'); ?>
            </button>
        </div>

        <input type="hidden" name="id" value="<?php echo intval($status_obj->get_id()); ?>"/>

        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
	init_data_toggle();

	$(document).ready(function() {
		$('.date-picker').datepicker({
			todayBtn: "linked",
			orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
			format: 'yyyy-mm-dd',
			autoclose: true
		});

		tinymce.remove("#note");
		tinymce.init({
			selector: "#note",
			height: 200,
			theme: "modern",
			menubar: false,
			statusbar: false
		});
	});

	$('input.status[type="radio"]').change(function() {
		if ($(this).val() == <?php echo Orm_As_Status::ACC_SUBMITTED; ?>) {
			$('.form-group.agency-field').show();
			$('.form-group.accredited-field').hide();
			$('.form-group.agency-field label').html('<?php echo lang('Date Submitted'); ?>');
		} else if ($(this).val() == <?php echo Orm_As_Status::ACC_VISITED; ?>) {
			$('.form-group.agency-field').show();
			$('.form-group.accredited-field').hide();
			$('.form-group.agency-field label').html('<?php echo lang('Date Visited'); ?>');
		} else if ($(this).val() >= <?php echo Orm_As_Status::ACC_ACCREDITED; ?>) {
			$('.form-group.agency-field').show();
			$('.form-group.accredited-field').show();
			$('.form-group.agency-field label').html('<?php echo lang('Date Accredited'); ?>');
		} else {
			$('.form-group.agency-field').hide();
			$('.form-group.accredited-field').hide();
		}
	});

	$("#agency_form").submit(function() {

		$.ajax(this.action, {
			data: $(this).serializeArray(),
			files: $(":file", this),
			iframe: true,
			dataType: 'json'
		}).done(function(msg) {
			if (msg.status == true) {
				window.location.reload();
			} else {
				$('#ajaxModalDialog').html(msg.html);
			}
		});

		return false;
	});

    this.find_onselect = function (user_id, property_id, property_label) {
		$.ajax({
            type: "GET",
            url: "/user/get/" + user_id,
            dataType: 'json'
        }).done(function (content) {
            if (content.success) {
				var type = $('#' + property_id).attr('data-type');

				$('#' + type + '_email').val(content.data.email);
                $('#' + type + '_phone').val(content.data.phone);
            }
        });
    };
</script>