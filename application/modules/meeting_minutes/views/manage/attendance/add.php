<?php
/** @var $meeting Orm_Mm_Meeting */
/** @var $agenda Orm_Mm_Agenda */
/** @var $attendance Orm_Mm_Attendance */



if(Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_NOT_ADMIN) && Orm_Mm_Meeting::need_advisory()){
        $login='faculty';
    }else{
        $login='admin';
    }

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("meeting_minutes/attendance_add/{$meeting->get_id()}", array('id' => 'attendance-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Add').' '.lang('Attendees'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label"><?php echo lang('Attendees') ?></label>

                <div id="more_user" class="more_items well"></div>

                <div  class="more_link">
                    <button type="button" class="btn" aria-label="Left Align" onclick="add_user();">
                        <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add More'); ?>
                    </button>
                </div>
                <?php echo Validator::get_html_error_message('attendance_ids'); ?>
            </div>
            <hr />
            <div class="form-group">
                <label class="control-label"><?php echo lang('External Attendees') ?></label>
                <div id="more_user_ex" class="more_items well"></div>

                <div class="more_link">
                    <button type="button" class="btn" aria-label="Left Align" onclick="add_ex_user();">
                        <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add More'); ?>
                    </button>
                </div>
                <?php echo Validator::get_html_error_message('external_attendance_ids'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right "
                    <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php if($meeting->get_type_class()== "Orm_Mm_Meeting_Advisory"){?>

<script type="text/javascript">

    function add_user() {
        var count = $('#more_user .item').length;
        $('#more_user').append('<div class="item m-y-1 clearfix">' +
            '<div class="form-group">' +
            '<div class="col-sm-2">' +
            ' <div class="checkbox-inline">' +
            '<label class="custom-control custom-checkbox">'+
            '<input type="checkbox" class="custom-control-input" id="user_attend_' + count + '" name="attendance[' + count + '][attend]" value="1" />' +
            '<span class="custom-control-indicator"></span>'+
            '<?php echo lang('Attended'); ?>'+
            '</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-10">' +
            '<input id="user_label_' + count + '" type="text" onclick="' +
            'find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', null, [\'<?php echo Orm_User::USER_STUDENT ?>\'])" \ '+
            'readonly class="form-control"/>' +
            '<input id="user_id_' + count + '" name="attendance[' + count + '][user]" type="hidden"/>' +
            '</div>' +
        (count == 0 ? '': ( '<button type="button" class="btn" aria-label="Left Align" onclick="remove_user(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> ' +'<?php echo lang('Remove'); ?>'+
            '</button>' ))+
            '</div>');
    }
   if($('#more_user .item').length == 0){
       add_user();
   }

    function remove_user(elemnt) {

        $(elemnt).parent().parent().remove();

        $('#more_user .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                $(this).attr('name', String($(this).attr('name')).replace(/[\d]+/g, index));
            });
        });
    }

    function add_ex_user() {
        var count = $('#more_user_ex .item').length;
        $('#more_user_ex').append('<div class="item m-y-1 clearfix">' +
            '<div class="form-group m-a-0">' +
            '<div class="col-sm-2">' +
            '<div class="checkbox-inline">'+
            '<label class="custom-control custom-checkbox">'+
            '<input id="user_attend_' + count + '" name="external_attendance[' + count + '][attend]" type="checkbox" value="1" class="custom-control-input" />' +
            '<span class="custom-control-indicator"></span>'+
            '<?php echo lang('Attended'); ?>'+
            '</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-10">' +
            '<input id="ex_user_' + count + '" name="external_attendance[' + count + '][user]" type="text" class="form-control"/>' +
            '</div>' +
            '</div>' +
            (count == 0 ? '': ( '<button type="button" class="btn" aria-label="Left Align" onclick="remove_ex_user(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> ' +'<?php echo lang('Remove'); ?>'+
            '</button>')) +
            '</div>');
    }
    if($('#more_user_ex .item').length == 0){
        add_ex_user();
    }

    function remove_ex_user(elemnt) {
        $(elemnt).parent('.item').find('textarea').each(function (index) {
            tinymce.remove(this);
        });
        $(elemnt).parent('.item').remove();
        $('#more_user .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                $(this).attr('name', String($(this).attr('name')).replace(/[\d]+/g, index));
            });
        });
    }

    $('#attendance-form').on('submit', function (e) {
        e.preventDefault();

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });


</script>






<?php }else{?>


<script type="text/javascript">

    function add_user() {
        var count = $('#more_user .item').length;
        $('#more_user').append('<div class="item m-y-1 clearfix">' +
            '<div class="form-group">' +
            '<div class="col-sm-2">' +
            ' <div class="checkbox-inline">' +
            '<label class="custom-control custom-checkbox">'+
            '<input type="checkbox" class="custom-control-input" id="user_attend_' + count + '" name="attendance[' + count + '][attend]" value="1" />' +
            '<span class="custom-control-indicator"></span>'+
            '<?php echo lang('Attended'); ?>'+
            '</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-10">' +
            '<input id="user_label_' + count + '" type="text" onclick="' +
            '<?php if($login=='faculty'){?>'+
            'find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', null, [\'<?php echo Orm_User::USER_STUDENT ?>\'])" \ '+
            '<?php    }else{ ?>'+
            'find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', null, [\'<?php echo Orm_User::USER_FACULTY."\', \'".Orm_User::USER_STAFF ?>\'])" \ '+
            '<?php  }?>'+
            'readonly class="form-control"/>' +
            '<input id="user_id_' + count + '" name="attendance[' + count + '][user]" type="hidden"/>' +
            '</div>' +
        (count == 0 ? '': ( '<button type="button" class="btn" aria-label="Left Align" onclick="remove_user(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> ' +'<?php echo lang('Remove'); ?>'+
            '</button>' ))+
            '</div>');
    }
   if($('#more_user .item').length == 0){
       add_user();
   }

    function remove_user(elemnt) {

        $(elemnt).parent().parent().remove();

        $('#more_user .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                $(this).attr('name', String($(this).attr('name')).replace(/[\d]+/g, index));
            });
        });
    }

    function add_ex_user() {
        var count = $('#more_user_ex .item').length;
        $('#more_user_ex').append('<div class="item m-y-1 clearfix">' +
            '<div class="form-group m-a-0">' +
            '<div class="col-sm-2">' +
            '<div class="checkbox-inline">'+
            '<label class="custom-control custom-checkbox">'+
            '<input id="user_attend_' + count + '" name="external_attendance[' + count + '][attend]" type="checkbox" value="1" class="custom-control-input" />' +
            '<span class="custom-control-indicator"></span>'+
            '<?php echo lang('Attended'); ?>'+
            '</label>' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-10">' +
            '<input id="ex_user_' + count + '" name="external_attendance[' + count + '][user]" type="text" class="form-control"/>' +
            '</div>' +
            '</div>' +
            (count == 0 ? '': ( '<button type="button" class="btn" aria-label="Left Align" onclick="remove_ex_user(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> ' +'<?php echo lang('Remove'); ?>'+
            '</button>')) +
            '</div>');
    }

    if($('#more_user_ex .item').length == 0){
        add_ex_user();
    }

    function remove_ex_user(elemnt) {
        $(elemnt).parent('.item').find('textarea').each(function (index) {
            tinymce.remove(this);
        });
        $(elemnt).parent('.item').remove();
        $('#more_user .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                $(this).attr('name', String($(this).attr('name')).replace(/[\d]+/g, index));
            });
        });
    }

    $('#attendance-form').on('submit', function (e) {
        e.preventDefault();

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });


</script>
<?php }?>