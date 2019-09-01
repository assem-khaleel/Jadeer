<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/17/17
 * Time: 1:53 PM
 */
/* @var $section Orm_Course_Section */
/* @var $course Orm_Course */

$days = array(
    'saturday',
    'sunday',
    'monday',
    'tuesday',
    'wednesday',
    'thursday',
    'friday',
);


$room=Orm_Rm_Room_Management::get_instance($section->get_room_id());

?>
<style>
    input.schedule-time, label.schedule-label {
        visibility: hidden;
    }
</style>
<div class="col-md-9 col-lg-10">

    <?php echo form_open("/course_section/manage/{$section->get_id()}?course_id={$course->get_id()}"); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="panel-title"><?php echo lang('Sections Extra info') ?></span>
        </div>

        <div class="panel-body">

            <div class="alert alert-default"><div class=""></div><?php echo lang('You can enter your section location or choose from room list') ?></div>
            <div class="row form-group">
                <label class="col-sm-3 control-label"><?php echo lang('Location'); ?>:</label>
                <div class="col-sm-9">
                    <input type="text" name="extra_params[location]" class="form-control"
                           value="<?php echo $section->get_extra_item('location'); ?>">
                </div>
            </div>

            <div class="row form-group">
                    <label class="col-sm-3 control-label" for="room_type"><?php echo lang('Room Type') ?></label>
                    <div class="col-sm-3">
                        <select id="room_type" name="room_type" class="form-control" onchange="get_rooms_by_type(this);">
                            <option value=""><?php echo lang('Select One'); ?></option>
                            <?php foreach (Orm_Rm_Room_Management::$type_list as $key=>$type) { ?>

                                <option value="<?php echo (int)$key; ?>" <?php echo ($key == $room->get_room_type()) ? ' selected="selected"' : ''; ?> ><?php echo lang($type); ?></option>
                            <?php } ?>
                        </select>
                        <?php echo Validator::get_html_error_message('room_type'); ?>
                    </div>


                    <label class="col-sm-2 control-label" for="room_name"><?php echo lang('Room Name') ?></label>
                    <div class="col-sm-3">
                        <select id="room_name" name="room_name" data-select="<?php echo $room->get_id()?>" class="form-control">
                            <option value=""><?php echo lang('Select One'); ?></option>
                        </select>
                        <?php echo Validator::get_html_error_message('room_type'); ?>
                        <input type="hidden" name="room_id" id="room_id">
                    </div>
            </div>
            <div class="row form-group">
                <div id="info">
                    <?php

                     ?>
                        <label class="col-sm-3 control-label" for="room_number"><?php echo lang('Room Number') ?></label>
                        <label class="col-sm-3 control-label"  id="num"><?php echo $room->get_room_number();?></label>

                        <label class="col-sm-2 control-label"><?php echo lang('College') ?></label>
                        <label class="col-sm-3 control-label"  id="col_name"><?php echo $room->get_college_obj()->get_name();?></label>
                </div>
            </div>

            <h3><?php echo lang('Schedule'); ?></h3>
            <?php $schedule = $section->get_extra_item('schedule'); ?>

            <?php foreach ($days as $day) { ?>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <label class="checkbox-inline">
                            <input type="checkbox" <?php echo isset($schedule[$day]) ? 'checked' : ''; ?>
                                   name="extra_params[schedule][<?php echo $day; ?>]" class="px schedule"/>
                            <span class="lbl"><?php echo lang($day); ?></span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="schedule-label"><?php echo lang('From'); ?>:</label>
                            <input type="text" name="extra_params[schedule][<?php echo $day; ?>][from]"
                                   value="<?php echo isset($schedule[$day]['from']) ? $schedule[$day]['from'] : ''; ?>"
                                   class="form-control schedule-time" placeholder="<?php echo lang('From Date'); ?>"/>
                            <?php echo Validator::get_html_error_message($day . '_from'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="schedule-label"><?php echo lang('To'); ?>:</label>
                            <input type="text" name="extra_params[schedule][<?php echo $day; ?>][to]"
                                   value="<?php echo isset($schedule[$day]['to']) ? $schedule[$day]['to'] : ''; ?>"
                                   class="form-control schedule-time" placeholder="<?php echo lang('To Date'); ?>"/>
                            <?php echo Validator::get_html_error_message($day . '_to'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>


        </div>

        <div class="panel-footer">
            <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
                <?php echo lang('Save Changes'); ?>
            </button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>


<script>
    $('#view_room').hide();
    $('#info').hide();
    $('.schedule-time, .schedule-label').css("visibility", "hidden").attr('disabled', 'disabled');

    $(document).on('change', '.schedule', function () {
        schedule(this);
    });

    function schedule(elm) {
        if (elm.checked) {
            $(elm).parent().parent().parent().find('.schedule-time').css("visibility", "visible").removeAttr('disabled');
            $(elm).parent().parent().parent().find('.schedule-label').css("visibility", "visible").removeAttr('disabled');
        } else {
            $(elm).parent().parent().parent().find('.schedule-time').css("visibility", "hidden").attr('disabled', 'disabled');
            $(elm).parent().parent().parent().find('.schedule-label').css("visibility", "hidden").attr('disabled', 'disabled');
        }
    }

    pxInit.push(function () {
        var options = {
            minuteStep: 5,
            orientation: $('body').hasClass('right-to-left') ? {x: 'right', y: 'auto'} : {x: 'auto', y: 'auto'}
        };
        $('.schedule-time').timepicker(options);

        $('.schedule').each(function () {
            schedule(this);
        });
        if($('#room_type').val() > 0){
			$.ajax({
				type: "GET",
				url: "/course_section/get_room_by_type",
				data: {
					type:  $('#room_type').val()
				}
			}).done(function (msg) {
				$('#room_name').html(msg.html).val($('#room_name').attr('data-select'));

				$('#info').show();
			}).fail(function () {
				window.location.reload();
			});
		}

    });
    function get_rooms_by_type(elm) {

        type = $(elm).val();
    }
    get_rooms_by_type($('#room_name'));
    $('#room_type').on('change', function (e) {
        $.ajax({
            type: "GET",
            url: "/course_section/get_room_by_type",
            data: {
                type: type
            }
        }).done(function (msg) {
            $('#room_name').html(msg.html);

        }).fail(function () {
            window.location.reload();
        });
    });
    $('#room_name').on('change', function (e) {
            $('#view_room').show();
            $room_id=$('#room_name').val();
        console.log($room_id);
        $('#room_id').val($room_id);
        $.ajax({
            type: "GET",
            url: "/course_section/get_room_info",
            data: {
                room_id: $room_id
            }
        }).done(function (msg) {
            $('#info').show();
            $('#col_name').text(msg.col_name);
            $('#num').text(msg.num);

        })
    });
</script>