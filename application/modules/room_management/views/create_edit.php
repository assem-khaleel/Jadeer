<?php
/** @var $room Orm_Rm_Room_Management */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/room_management/save", array('id' => 'room-management-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Room Management'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="name"><?php echo lang('Room Title') .' ( '. lang('English').' ) ' ?></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="<?php echo lang('Room Title') ?>" id="name" name="name_en" class="form-control" value="<?php echo $room->get_name_en() ?>">
                            <?php echo Validator::get_html_error_message('name_en'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="name"><?php echo lang('Room Title') .' ( '. lang('Arabic').' ) ' ?></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="<?php echo lang('Room Title') ?>" id="name" name="name_ar" class="form-control" value="<?php echo $room->get_name_ar() ?>">
                            <?php echo Validator::get_html_error_message('name_ar'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="room_type"><?php echo lang('Room Type') ?></label>
                        <div class="col-sm-9">
                            <select id="room_type" name="room_type" class="form-control">
                                <option value=""><?php echo lang('Select One'); ?></option>
                                <?php foreach (Orm_Rm_Room_Management::$type_list as $key=>$type) { ?>
                                    <?php $selected = ($key == $room->get_room_type()) ? ' selected="selected"' : ''; ?>
                                    <option value="<?php echo (int)$key; ?>"<?php echo $selected; ?>><?php echo lang($type); ?></option>
                                <?php } ?>
                            </select>
                            <?php echo Validator::get_html_error_message('room_type'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="room_number"><?php echo lang('Room Number') ?></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="<?php echo lang('Room Number') ?>" id="room_number" name="room_number" class="form-control" value="<?php echo $room->get_room_number() ?>">
                            <?php echo Validator::get_html_error_message('room_number'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
                        <div class="col-sm-9">
                            <select id="college_block" name="college_id" class="form-control" onchange="get_departments_by_college(this, 1, 1);">
                                <option value=""><?php echo lang('All College') ?></option>
                                <?php
                                foreach (Orm_College::get_all() as $college) {
                                    $selected = ($college->get_id() == $room->get_college_id() ? 'selected="selected"' : '');
                                    ?>
                                    <option value="<?php echo (int) $college->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($college->get_name()) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('college_id'); ?>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id" id="id" value="<?php echo intval($room->get_id())?>" />
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#room-management-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>
