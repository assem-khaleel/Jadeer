<?php
/** @var $attend Orm_Mm_Attendance */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/meeting_minutes/attendance_edit/".$attend->get_id(), array('id' => 'attendance-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Edit').' '.lang('Attendant'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <?php if($attend->get_user_id()): ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="user_name"><?php echo lang('Attendee') ?></label>
                        <div class="col-sm-9">
                            <input type="text"  onclick="
                                <?php if(Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_NOT_ADMIN) && Orm_Mm_Meeting::need_advisory()){?>
                                    find_users(this, 'user_id', 'user_name', null, ['<?php echo Orm_User::USER_STUDENT; ?>']);
                             <?php    }else{ ?>
                            find_users(this, 'user_id', 'user_name', null, ['<?php echo Orm_User::USER_FACULTY."', '".Orm_User::USER_STAFF; ?>']);
                               <?php  }?>
                                 " readonly class="form-control"
                                   id="user_name" name="user_name" value="<?php if($attend->get_user_id()) {echo htmlfilter($attend->get_user_id(true)->get_full_name());} ?>" />
                            <input id="user_id" name="user_id" data-type="chair" type="hidden" value="<?php echo (int) $attend->get_user_id(); ?>" />
                            <?php echo Validator::get_html_error_message('user_id'); ?>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="name"><?php echo lang('Attendee') ?></label>
                        <div class="col-sm-9">
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlfilter($attend->get_external_user_name()) ?>">
                            <?php echo Validator::get_html_error_message('name'); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <div class="row">
                        <div class="checkbox-inline col-sm-9 col-sm-offset-3">
                            <label class="custom-control custom-checkbox" >
                                <input type="checkbox" class="custom-control-input" id="attend" name="attend" <?php echo htmlfilter(($attend->get_attended())? 'checked="checked"': ''); ?>>
                                <span class="custom-control-indicator"></span>
                                <?php echo lang('Attended'); ?>
                            </label>
                        </div>
                    </div>
                </div>
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

    $('#attendance-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>