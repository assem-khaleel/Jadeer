<?php
/* @var $node Orm_Node */
if (Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) {
    $role = 'assessor';
}
$user_id = (isset($user_id) ? $user_id : 0);
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('', 'id="node_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Add').' '.lang($role); ?></h4>
        </div>
        <div class="modal-body">
            <div id="user_block">
                <?php if (!empty($role)): ?>
                    <?php echo Orm_User::draw_find_users('user_id', null, lang('User'), [Orm_User_Faculty::class, Orm_User_Staff::class]); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left"
                    data-dismiss="modal"><span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <button type="submit" id="save" name="save" class="btn pull-right"
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add'); ?></button>
            <div class="clearfix"></div>
        </div>
        <input type="hidden" name="role" id="role" value="<?php echo $role; ?>">
        <input type="hidden" name="node_id" value="<?php echo (int)$node->get_id(); ?>"/>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script type="text/javascript">
    init_data_toggle();

    $("#node_form").submit(function () {
        $.ajax({
            type: "POST",
            url: "/accreditation/save_user",
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            $('#ajaxModalDialog').html(msg.html);
        }).fail(function () {
            window.location.reload();
        });

        return false;
    });

</script>
