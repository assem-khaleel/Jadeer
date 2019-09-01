<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/24/17
 * Time: 3:36 PM
 */
/** @var $candidates_award Orm_Wa_Candidate_User[] */
/** @var $winner_award Orm_Wa_Award */

$winner_user = Orm_Wa_Winner_Award::get_all(array('award_id'=>$winner_award->get_id()));
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <?php echo form_open("/award_management/save_current_winner", array('id' => 'winner-form')); ?>
        <div class="modal-header">
            <span class="panel-title">
                <?php echo lang('Award Winner'); ?>
            </span>
        </div>
        <div class="modal-body">
            <div class="form-group">

                <?php if (!empty($winner_user)) {?>
                    <label class="control-label"><?php echo lang('Available Winners') ?></label>

                    <div class="more_items well">
                    <?php if(is_array($winner_user)): ?>
                        <?php foreach ($winner_user as $win) { ?>
                        <li>
                            <?php
                            echo Orm_User::get_instance($win->get_user_id())->get_full_name().'<br>';

                            } ?>
                            <?php endif; ?>
                        </li>
                    </div>

                <?php } ?>


                <label class="control-label"><?php echo lang('Select Winner') ?></label>
                <div id="more_users" class="more_items well">
                    <?php
                    $ids = [];
                    foreach ($candidates_award as $candidate_award) {
                        $ids[] = $candidate_award->get_user_id();
                    }
                    if (!empty($user_ids)) {
                        foreach ($user_ids as $key => $user_id) {
                            ?>
                            <div class="item m-y-1">
                                <div class="form-group m-a-0">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input id="user_label_<?php echo $key ?>" type="text"
                                                   onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>','',['Orm_User_Faculty','Orm_User_Staff','Orm_User_Student'],'<?php echo lang('Find winner'); ?>', '<?php echo implode(',', $ids) ?>')"
                                                   readonly class="form-control"
                                                   value=" "/>
                                            <input id="user_id_<?php echo $key ?>" name="user_ids[<?php echo $key ?>]"
                                                   type="hidden"
                                                   value="<?php echo $user_id; ?>"/>
                                            <?php echo Validator::get_html_error_message('user_id', $key); ?>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="px leader" type="checkbox" value="1"
                                                   name="receive[<?php echo $key ?>]"/>
                                            <span class="lbl"><?php echo lang('Received award'); ?></span>
                                        </div>
                                    </div>
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
                            <div class="form-group m-a-0">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input id="user_label_0" type="text"
                                               onclick="find_users(this,'user_id_0','user_label_0','',['Orm_User_Faculty','Orm_User_Staff','Orm_User_Student'],'<?php echo lang('Find Winner'); ?>', '<?php echo implode(',', $ids) ?>')"
                                               readonly
                                               class="form-control"/>
                                        <input id="user_id_0" name="user_ids[0]" type="hidden"/>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="px leader" type="checkbox" value="1" name="receive[]"/>
                                        <span class="lbl">
                                                <?php echo lang('Received award'); ?>
                                            </span>
                                    </div>
                                </div>
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
            <input type="hidden" name="id" value="<?php echo $winner_award->get_id(); ?>">
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
</div>

<script type="text/javascript">
    $('#winner-form').on('submit', function (e) {
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
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<input id="user_label_' + count + '" type="text" onclick="find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', \'\',[\'Orm_User_Faculty\',\'Orm_User_Staff\',\'Orm_User_Student\'],\'<?php echo lang('Find Winner'); ?>\', \'<?php echo implode(',', $ids) ?>\')" readonly class="form-control"/>' +
            '<input id="user_id_' + count + '" name="user_ids[' + count + ']" type="hidden"/>' +
            '</div>' +
            '<div class="col-md-2">' +
            '<input class="px leader" type="checkbox" value="1" name="receive['+ count +']">' +
            '<span class="lbl"> <?php echo lang('Received award') ?></span>' +
            '</div>' +
            '</div>' +
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