<?php /* @var $member Orm_Tm_Members */ ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/training_management/save_member", array('id' => 'member-form')); ?>
        <div class="modal-header">
            <span class="panel-title">
                <?php echo lang('Certified Members'); ?>
            </span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="member_name"><?php echo lang('Certified Member') ?></label>
                        <div class="col-sm-9">
                            <input type="text"
                                   placeholder="<?php echo lang('Select') . ' ' . lang('Certified Member') ?>"
                                   onclick="find_users(this, 'member_id', 'member_name', null, ['<?php echo Orm_User::USER_FACULTY . "', '" . Orm_User::USER_STAFF; ?>'])"
                                   readonly class="form-control"
                                   id="member_name" name="member_name"
                                   value="<?php if ($member->get_user_id()) {
                                       echo $member->get_user_obj()->get_full_name();
                                   } ?>"/>
                            <input id="member_id" name="member_id" data-type="chair" type="hidden"
                                   value="<?php echo $member->get_user_id(); ?>"/>
                            <?php echo Validator::get_html_error_message('member_id'); ?>
                        </div>
                    </div>
                </div>



                <input type="hidden" name="id" id="id" value="<?php echo intval($member->get_id()) ?>"/>
                <input type="hidden" name="training_id" id="training_id" value="<?php echo intval($training_id) ?>"/>

            </div>
        </div>
        <div class="modal-footer">
            <div class=" text-right">
                <button type="button" class="btn pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left">
                        <i class="fa fa-times"></i>
                    </span>
                    <?php echo lang('Close'); ?>
                </button>
                <button id="saveCommit" type="submit" class="btn pull-right " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left">
                        <i class="fa fa-floppy-o"></i>
                    </span>
                    <?php echo lang('save'); ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">


    $('#member-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });
    });



</script>
