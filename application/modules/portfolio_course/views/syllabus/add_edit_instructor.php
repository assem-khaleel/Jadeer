<?php
/** @var $instructor_obj Orm_Pc_Instructor_Information */

?>

<div class="modal-dialog modal-sx animated fadeIn">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Edit Course Information</h4>
        </div>
        <?php echo form_open("/portfolio_course/syllabus/edit/{$level}/{$instructor_obj->get_id()}?id={$course_id}&section={$section}&faculty={$faculty}", ['method' => 'post', "class" => 'inline-form', "id" => "editInstructor", 'en']) ?>
        <div class="padding-sm-hr">
            <div class="modal-body">
                <div class="row form-group">
                    <label for="location" class="col-sm-3 control-label"><?php echo lang('Office Location') ?>:</label>
                    <div class="col-sm-9">
                        <input type="text" name="location" id="editLoc" class=" form-control"
                               placeholder="<?php echo lang('Office Location') ?>"
                               value="<?php echo $instructor_obj->get_office_location() ?>"/>
                        <?php echo Validator::get_html_error_message('location'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="hours" class="col-sm-3 control-label"><?php echo lang('Office Hours') ?>:</label>
                    <div class="col-sm-9">
                        <input type="text" name="hours" id="editHours" class=" form-control"
                               placeholder="<?php echo lang('Office Hours') ?>"
                               value="<?php echo $instructor_obj->get_office_hours() ?>"/>
                        <?php echo Validator::get_html_error_message('hours'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class=" text-right">
                    <button type="button" class="btn pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i
                                class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                    <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>><span
                            class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('#editInstructor').on('submit', function (e) {
        e.preventDefault();
        var files = $(":file:enabled", this);
        if (files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: $(":file:enabled", this),
                iframe: true,
                dataType: 'JSON'
            }).complete(function (data) {
                handle_response(data.responseJSON);
            });
        } else {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'JSON'
            }).done(function (msg) {
                handle_response(msg);
            });
        }

        function handle_response(msg) {
            if (msg.status == true) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }
    });
</script>