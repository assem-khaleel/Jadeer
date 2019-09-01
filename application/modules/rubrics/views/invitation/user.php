<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 05/11/17
 * Time: 11:52
 */

/**
 * @var Orm_Rb_Rubrics $rubric
 *
 */

$evaluation = $rubric->get_evaluation();
if (isset($evaluation[0])) {
    $evaluation = $evaluation[0];
} else {
    $evaluation = new Orm_Rb_Evaluations();
}

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/rubrics/invitation/" . ($rubric->get_id() ?: ''), ['id' => 'invitation_form']); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Invitation').' '. lang('Managers'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div id="more_users" class="more_items ">
                    <?php if ($users = json_decode($evaluation->get_criteria(), 1)): ?>
                        <?php foreach ($users as $key => $user_id): ?>
                            <div class="item m-y-1">
                                <div class="form-group m-a-0">
                                    <input id="user_label_<?php echo $key ?>" type="text" readonly class="form-control"
                                           onclick="find_users(this,'users_<?php echo $key ?>','user_label_<?php echo $key ?>', '', ['<?php echo Orm_User::USER_FACULTY . "', '" . Orm_User::USER_STAFF ?>'])"
                                           value="<?php

                                           $user = Orm_user::get_instance(intval($user_id));

                                           if ($user->get_id()) {
                                               echo htmlfilter(Orm_user::get_instance(intval($user_id))->get_full_name());
                                           }
                                           ?>"/>

                                    <input id="users_<?php echo $key ?>" name="users[<?php echo $key ?>]"
                                           type="hidden" value="<?php echo $user_id; ?>"/>
                                    <?php echo Validator::get_html_error_message('users', $key); ?>
                                </div>
                                <button type="button" class="btn" aria-label="Left Align"
                                        onclick="remove_user(this);" style="margin-top: 5px;">
                                    <span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="item m-y-1">
                            <div class="form-group m-a-0">
                                <input id="user_label_0" type="text" readonly class="form-control"
                                       onclick="find_users(this,'users_0','user_label_0', '', ['<?php echo Orm_User::USER_STAFF ?>', '<?php echo Orm_User::USER_FACULTY ?>'])"/>
                                <input id="users_0" name="users" type="hidden"/>
                                <?php echo Validator::get_html_error_message('users', 0); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <hr/>
                <div class="more_link">
                    <button type="button" class="btn" aria-label="Left Align" onclick="add_user();">
                        <span class="fa fa-plus"
                              aria-hidden="true"></span> <?php echo lang('Add') . ' ' . lang('More'); ?>
                    </button>
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
<style>
    .select2-container {
        z-index: 9999;
    }
</style>
<script type="text/javascript">

    $('#invitation_form').submit(function (e) {
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

    function add_user() {
        var count = $('#more_users .item').length;
        $('#more_users').append('<div class="item m-y-1">' +
            '<div class="form-group m-a-0">' +
            '<input id="user_label_' + count + '" type="text" onclick="find_users(this,\'users_' + count + '\',\'user_label_' + count + '\', \'\', [\'<?php echo Orm_User::USER_FACULTY . "\', \'" . Orm_User::USER_STAFF ?>\'])" readonly class="form-control"/>' +
            '<input id="users_' + count + '" name="users[' + count + ']" type="hidden"/>' +
            '</div>' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="remove_user(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> Remove' +
            '</button>' +
            '</div>');
    }

    function remove_user(elemnt) {
        $(elemnt).parent('.item').remove();
        $('#more_users .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                $(this).attr('name', String($(this).attr('name')).replace(/\[\d+\]/g, '[' + index + ']'));
            });
        });
    }

</script>
