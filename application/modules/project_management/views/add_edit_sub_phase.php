<?php
/* @var Orm_Pm_Sub_Phase $phase */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($phase->get_id())) {
                echo lang('Create').' '.lang('Sub-Phase');
            } else {
                echo lang('Edit').' '.lang('Sub-Phase');
            }
            ?>
        </div>
        <?php echo form_open("",'id="sub-phase-form" class="form-horizontal"') ?>

        <div class="modal-body">

            <div class="form-group">


                <label for="phase_title_en" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                    (<?php echo lang('English'); ?>): *
                </label>

                <div class="col-sm-10">
                    <input type="text" name="title_en" class="form-control"
                           value="<?php echo htmlfilter($phase->get_title_en()); ?>" id="phase_title_en"/>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="phase_title_ar" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                    (<?php echo lang('Arabic'); ?>): *
                </label>

                <div class="col-sm-10">
                    <input type="text" name="title_ar" class="form-control"
                           value="<?php echo htmlfilter($phase->get_title_ar()); ?>" id="phase_title_ar"/>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="start_date" class="col-sm-2 control-label"><?php echo lang('Start Date'); ?>: *</label>

                <div class="col-sm-10">
                    <input type="text" name="start_date" class="form-control date-picker" id="start_date"
                           readonly="readonly"
                           value="<?php echo ($phase->get_start_date() != '0000-00-00'?$phase->get_start_date():'')  ?>"/>
                    <?php echo Validator::get_html_error_message('start_date'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="end_date" class="col-sm-2 control-label"><?php echo lang('End Date'); ?>: *</label>

                <div class="col-sm-10">
                    <input type="text" name="end_date" class="form-control date-picker" id="end_date"
                           readonly="readonly"
                           value="<?php echo ($phase->get_end_date() != '0000-00-00'?$phase->get_end_date():'') ?>"/>
                    <?php echo Validator::get_html_error_message('end_date'); ?>
                </div>
            </div>
            <?php if(!isset($edited_by_responsible)): ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo lang('responsible') ?> :*</label>

                    <div id="more_users" class="col-sm-10">
                        <?php
                        if (!empty($user_ids)) {
                            foreach ($user_ids as $key => $user_id) {
                                ?>
                                <div class="item m-y-1">
                                    <div class="form-group m-a-0">
                                        <input id="user_label_<?php echo $key ?>" type="text"
                                               onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>','',['Orm_User_Faculty','Orm_User_Staff'],'<?php echo lang('Find Managers'); ?>')"
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
                                            <span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>
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
                                           onclick="find_users(this,'user_id_0','user_label_0','',['Orm_User_Faculty','Orm_User_Staff'],'<?php echo lang('Find Managers'); ?>')"
                                           readonly
                                           class="form-control"
                                           value = "<?php echo ($phase->get_responsible())?Orm_User::get_instance($phase->get_responsible())->get_full_name():''; ?>"/>
                                    <input id="user_id_0" name="user_ids" value="<?php echo $phase->get_responsible(); ?>" type="hidden"/>
                                </div>
                            </div>
                        <?php } ?>

                        <?php echo Validator::get_html_error_message_no_arrow('user_ids'); ?>
                    </div>
                </div>
                <input type="hidden" id="url" value="/project_management/save_sub_phase">
            <?php else: ?>
                <div class="form-group" style="display: none;">
                    <label class="col-sm-2 control-label"><?php echo lang('responsible') ?> :*</label>

                    <div id="more_users" class="col-sm-10">
                        <?php
                        if (!empty($user_ids)) {
                            foreach ($user_ids as $key => $user_id) {
                                ?>
                                <div class="item m-y-1">
                                    <div class="form-group m-a-0">
                                        <input id="user_label_<?php echo $key ?>" type="text"
                                               onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>','',['Orm_User_Faculty','Orm_User_Staff'],'<?php echo lang('Find Managers'); ?>')"
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
                                            <span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>
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
                                           onclick="find_users(this,'user_id_0','user_label_0','',['Orm_User_Faculty','Orm_User_Staff'],'<?php echo lang('Find Managers'); ?>')"
                                           readonly
                                           class="form-control"
                                           value = "<?php echo ($phase->get_responsible())?Orm_User::get_instance($phase->get_responsible())->get_full_name():''; ?>"/>
                                    <input id="user_id_0" name="user_ids" value="<?php echo $phase->get_responsible(); ?>" type="hidden"/>
                                </div>
                            </div>
                        <?php } ?>

                        <?php echo Validator::get_html_error_message_no_arrow('user_ids'); ?>
                    </div>
                </div>
                <input type="hidden" id="url" value="/project_management/save_sub_phase/true">
            <?php endif; ?>
            <div class="form-group">
                <label for="desc_en" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                    (<?php echo lang('English'); ?>): </label>

                <div class="col-sm-10">
                        <textarea name="desc_en" class="form-control"
                                  id="desc_en"><?php echo htmlfilter($phase->get_desc_en()) ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="desc_ar" class="col-sm-2 control-label"><?php echo lang('Description'); ?>
                    (<?php echo lang('Arabic'); ?>): </label>

                <div class="col-sm-10">
                        <textarea name="desc_ar" class="form-control"
                                  id="desc_ar"><?php echo htmlfilter($phase->get_desc_ar()) ?></textarea>
                </div>
            </div>
            <?php if(isset($edited_by_responsible)): ?>
                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo lang('Work progress'); ?>: </label>
                    <div class="col-md-9">
                        <?php foreach (Orm_Pm_Sub_Phase::$sub_phase_status as $key => $status) {
                            /* @var $status Orm_Pm_Sub_Phase */
                            $selected = ($key == $phase->get_is_complete() ? 'checked="checked"' : '');
                            ?>
                            <label class="custom-control custom-radio">
                                <input form = "sub-phase-form" type="radio" name="progress" class="custom-control-input"
                                       value="<?php echo intval($key) ?>" <?php echo $selected ?>>
                                <span class="custom-control-indicator"></span>
                                <?php echo lang($status); ?>
                            </label>
                        <?php } ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="phase_id" value="<?php echo intval($phase_id);?>">
            <input type="hidden" name="sub_phase_id" value="<?php echo intval($phase->get_id());?>">
            <button type="button" class="btn btn-sm pull-left "
                    data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    var options = {
        todayBtn: "linked",
        orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
        format: 'yyyy-mm-dd',
        autoclose: true
    };
    $('.date-picker').datepicker(options);

    $('form#sub-phase-form').submit(function (e) {
        e.preventDefault();
        var url = $('#url').val();
        $.ajax({
            url: url,
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error === false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

</script>