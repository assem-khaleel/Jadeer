<?php
/** @var $group Orm_Thread_Group */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/thread/group_manage/{$group->get_id()}", 'id="reviewer_form"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Add').' '.lang('Group'); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo lang('Group Name') ?> (<?php echo lang('English') ?>): *</label>
                        <input class="form-control" name="name_english" value="<?php echo htmlfilter($group->get_group_name_en()); ?>">
                        <?php echo Validator::get_html_error_message('name_english'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo lang('Group Name') ?> (<?php echo lang('Arabic') ?>): *</label>
                        <input class="form-control" name="name_arabic" value="<?php echo htmlfilter($group->get_group_name_ar()); ?>">
                        <?php echo Validator::get_html_error_message('name_arabic'); ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo lang('Description') ?> (<?php echo lang('English') ?>):</label>
                        <textarea class="form-control"
                                  name="desc_english"><?php echo htmlfilter($group->get_group_desc_en()); ?></textarea>
                        <?php echo Validator::get_html_error_message('desc_english'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo lang('Description') ?> (<?php echo lang('Arabic') ?>):</label>
                        <textarea class="form-control"
                                  name="desc_arabic"><?php echo htmlfilter($group->get_group_desc_ar()); ?></textarea>
                        <?php echo Validator::get_html_error_message('desc_arabic'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label"><?php echo lang('Member') ?></label>
                        <div id="more_users" class="more_items well p-a-0">
                            <?php
                            if (!empty($user_ids)) {
                                foreach ($user_ids as $key => $user_id) {
                                    ?>
                                    <div class="item m-y-1">
                                        <div class="row form-group m-a-0">
                                            <div class="col-md-10">
                                                <input id="user_label_<?php echo $key ?>" type="text"
                                                       onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>','',['Orm_User_Staff','Orm_User_Faculty','Orm_User_Student'],'<?php echo lang('Find Members'); ?>')"
                                                       readonly class="form-control"
                                                       value="<?php echo($user_id ? htmlfilter(Orm_User::get_instance($user_id)->get_full_name()) : ''); ?>"/>
                                                <input id="user_id_<?php echo $key ?>" name="user_ids[<?php echo $key ?>]"
                                                       type="hidden"
                                                       value="<?php echo $user_id; ?>"/>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if ($key) { ?>
                                                    <button type="button" class="btn btn-block btn-danger" aria-label="Left Align" onclick="remove_user(this);">
                                                        <span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>
                                                    </button>
                                                <?php } else { ?>
                                                    <div class="more_link">
                                                        <button type="button" class="btn btn-block" aria-label="Left Align" onclick="add_user();">
                                                            <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add').' '.lang('More'); ?>
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="item m-y-1">
                                    <div class="row form-group m-a-0">
                                        <div class="col-md-10">
                                            <input id="user_label_0" type="text"
                                                   onclick="find_users(this,'user_id_0','user_label_0','',['Orm_User_Staff','Orm_User_Faculty','Orm_User_Student'],'<?php echo lang('Find Members'); ?>')"
                                                   readonly
                                                   class="form-control"/>
                                            <input id="user_id_0" name="user_ids[0]" type="hidden"/>
                                            <?php echo Validator::get_html_error_message('user_ids'); ?>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="more_link">
                                                <button type="button" class="btn btn-block" aria-label="Left Align" onclick="add_user();">
                                                    <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add').' '.lang('More'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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
                <span class="btn-label-icon left fa fa-save"></span><?php echo lang('Save'); ?>
            </button>
            <div class="clearfix"></div>
        </div>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script>
    function add_user() {
        var count = $('#more_users .item').length;
        $('#more_users').append(
            '<div class="item m-y-1">' +
                '<div class="row form-group m-a-0">' +
                    '<div class="col-md-10">' +
                        '<input id="user_label_' + count + '" type="text" onclick="find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', \'\',[\'Orm_User_Staff\',\'Orm_User_Faculty\',\'Orm_User_Student\'],\'<?php echo lang('Find Members'); ?>\')" readonly class="form-control"/>' +
                        '<input id="user_id_' + count + '" name="user_ids[' + count + ']" type="hidden"/>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                        '<button type="button" class="btn btn-block btn-danger" aria-label="Left Align" onclick="remove_user(this);" >' +
                            '<span class="fa fa-trash-o" aria-hidden="true"></span> Remove' +
                        '</button>' +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    }

    function remove_user(elemnt) {
        $(elemnt).parents('.item').remove();
        $('#more_users .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                if($(this).attr('name')) {
                    $(this).attr('name', $(this).attr('name').replace(/\[\d+\]/g, '[' + index + ']'));
                }
            });
        });
    }

    $('#reviewer_form').submit(function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize()
        }).done(function (msg) {
            if (msg.status == false) {
                $('#ajaxModalDialog').html(msg.html);
            } else {
                window.location.reload();
            }
        }).fail(function () {
            window.location.reload();
        });

    });
</script>