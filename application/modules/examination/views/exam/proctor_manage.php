<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 03/05/17
 * Time: 10:32 ص
 */
/* @var $exam Orm_Tst_Exam*/

?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php if(!($exam && $exam->get_id() && !$exam->check_end() && $exam->get_semester_id()==Orm_Semester::get_current_semester()->get_id())): ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Proctors'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class='alert alert-warning m-a-0'><?php echo lang('Cant edit this exam.') ?></div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
        </div>

        <?php else: ?>
        <?php echo form_open("/examination/proctor_manage/".($exam->get_id()?: ''), array('id' => 'exam_form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Proctors'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <div id="more_monitors" class="more_items ">
                        <?php if(empty($monitor_ids)): ?>
                            <div class="item m-y-1">
                                <div class="form-group m-a-0">
                                    <input id="user_label_0" type="text"
                                           onclick="find_users(this,'user_id_0','user_label_0', '', ['<?php echo Orm_User::USER_STAFF ?>', '<?php echo Orm_User::USER_FACULTY ?>'])"
                                           readonly
                                           class="form-control"/>
                                    <input id="user_id_0" name="monitor_ids[0]" type="hidden"/>
                                    <?php echo Validator::get_html_error_message('monitor_ids', 0); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($monitor_ids as $key => $monitor): ?>
                            <div class="item m-y-1">
                                <div class="form-group m-a-0">
                                    <input id="user_label_<?php echo $key ?>" type="text"
                                           onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>', '', ['<?php echo Orm_User::USER_FACULTY."', '".Orm_User::USER_STAFF ?>'])"
                                           readonly class="form-control"
                                           value="<?php

                                           $user = Orm_user::get_instance(intval($monitor));

                                           if($user && $user->get_id()) {
                                               echo htmlfilter(Orm_user::get_instance(intval($monitor))->get_full_name());
                                           }
                                               ?>" />

                                    <input id="user_id_<?php echo $key ?>" name="monitor_ids[<?php echo $key ?>]"
                                           type="hidden"
                                           value="<?php echo $monitor; ?>"/>
                                    <?php echo Validator::get_html_error_message('monitor_ids', $key); ?>
                                </div>
                                <button type="button" class="btn" aria-label="Left Align"
                                        onclick="remove_monitor(this);" style="margin-top: 5px;">
                                    <span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>
                                </button>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <hr />
                    <div class="more_link">
                        <button type="button" class="btn" aria-label="Left Align" onclick="add_monitor();">
                            <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add').' '.lang('More'); ?>
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


        </div>
        <?php echo form_close(); ?>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">

    $('#exam_form').submit(function(e){
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

    function add_monitor() {
        var count = $('#more_monitors .item').length;
        $('#more_monitors').append('<div class="item m-y-1">' +
            '<div class="form-group m-a-0">' +
            '<input id="user_label_' + count + '" type="text" onclick="find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', \'\', [\'<?php echo Orm_User::USER_FACULTY."\', \'".Orm_User::USER_STAFF ?>\'])" readonly class="form-control"/>' +
            '<input id="user_id_' + count + '" name="monitor_ids[' + count + ']" type="hidden"/>' +
            '</div>' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="remove_monitor(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> Remove' +
            '</button>' +
            '</div>');
    }

    function remove_monitor(elemnt) {
        $(elemnt).parent('.item').find('textarea').each(function (index) {
            tinymce.remove(this);
        });
        $(elemnt).parent('.item').remove();
        $('#more_monitors .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                $(this).attr('name', String($(this).attr('name')).replace(/\[\d+\]/g, '[' + index + ']'));
            });
        });
    }

</script>
