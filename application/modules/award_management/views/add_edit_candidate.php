user_ids<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/24/17
 * Time: 3:36 PM
 */
/** @var $candidate_award Orm_Wa_Award */

$candidate_user = Orm_Wa_Candidate_User::get_all(array('award_id'=>$candidate_award->get_id()));
//echo "<pre>";print_r($candidate_user);die();

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <?php echo form_open("/award_management/save_candidate", array('id' => 'candidate-form')); ?>
        <div class="modal-header">
            <span class="panel-title">
                <?php echo lang('Award Candidate'); ?>
            </span>
        </div>
        <div class="modal-body">
            <div class="form-group">

            <?php if (!empty($candidate_user)) {?>
                <label class="control-label"><?php echo lang('Available Candidates') ?></label>

                <div class="more_items well">
                    <?php foreach ($candidate_user as $ca) { ?>
                        <li>
                    <?php
                    echo Orm_User::get_instance($ca->get_user_id())->get_full_name().'<br>';

                    } ?>
                        </li>
                </div>

            <?php } ?>


                <label class="control-label"><?php echo lang('Select Candidate') ?></label>

                <div id="more_users" class="more_items well">


                    <?php
                    if (!empty($user_ids)) {
                        foreach ($user_ids as $key => $user_id) {

                            ?>
                            <div class="item m-y-1">

                                <div class="form-group m-a-0">

                                    <input id="user_label_<?php echo $key ?>" type="text"
                                           onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>','',['Orm_User_Faculty','Orm_User_Staff','Orm_User_Staff'],'<?php echo lang('Find Candidate'); ?>')"
                                           readonly class="form-control"
                                           value="<?php echo($user_id ? htmlfilter(Orm_User::get_instance($user_id)->get_full_name()) : ''); ?>"/>
                                    <input id="user_id_<?php echo $key ?>" name="user_ids[<?php echo $key ?>]"
                                           type="hidden"
                                           value="<?php echo $user_id; ?>"/>
                                    <?php echo Validator::get_html_error_message('user_id', $key); ?>
                                </div>
                                <?php if ($key) { ?>
                                    <button type="button" class="btn" aria-label="Left Align"
                                            onclick="remove_user(this);" style="margin-top: 5px;">
                                        <span class="fa fa-trash-o"
                                              aria-hidden="true"></span> <?php echo lang('Remove'); ?>
                                    </button>
                                <?php } ?>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="item m-y-1">
                            <div class="form-group m-a-0">
                                <input id="user_label_0" type="text"
                                       onclick="find_users(this,'user_id_0','user_label_0','',['Orm_User_Faculty','Orm_User_Staff','Orm_User_Student'],'<?php echo lang('Find Candidate'); ?>')"
                                       readonly
                                       class="form-control"/>
                                <input id="user_id_0" name="user_ids[0]" type="hidden"/>
                            </div>
                        </div>
                    <?php } ?>

                    <?php echo Validator::get_html_error_message_no_arrow('user_ids'); ?>
                </div>

                <div class="more_link">
                    <button type="button" class="btn" aria-label="Left Align" onclick="add_user();">
                        <span class="fa fa-plus"
                              aria-hidden="true"></span> <?php echo lang('Add') . ' ' . lang('More'); ?>
                    </button>
                </div>

            </div>
           <input type="hidden" name="id" value="<?php echo $candidate_award->get_id();?>">
        </div>
        <div class="modal-footer">
            <div class=" text-right">
                <button type="button" class="btn pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left">
                        <i class="fa fa-times"></i>
                    </span>
                    <?php echo lang('Close'); ?>
                </button>
                <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>>
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
    $('#candidate-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize()
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
    function add_user() {
        var count = $('#more_users .item').length;
        $('#more_users').append('<div class="item m-y-1">' +
            '<div class="form-group m-a-0">' +
            '<input id="user_label_' + count + '" type="text" onclick="find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', \'\',[\'Orm_User_Faculty\',\'Orm_User_Staff\',\'Orm_User_Student\'],\'<?php echo lang('Find Candidate'); ?>\')" readonly class="form-control"/>' +
            '<input id="user_id_' + count + '" name="user_ids[' + count + ']" type="hidden"/>' +
            '</div>' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="remove_user(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> Remove' +
            '</button>' +
            '</div>');
    }

    function remove_user(elemnt) {
        $(elemnt).parent('.item').find('textarea').each(function (index) {
            tinymce.remove(this);
        });
        $(elemnt).parent('.item').remove();
        $('#more_users .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                $(this).attr('name', String($(this).attr('name')).replace(/\[\d+\]/g, '[' + index + ']'));
            });
        });
    }

</script>