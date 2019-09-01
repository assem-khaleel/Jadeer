<?php
/** @var $committee Orm_C_Committee */


$college_id = intval($this->input->post('college_id'));
$department_id = intval($this->input->post('department_id'));
$program_id = intval($this->input->post('program_id'));

switch ($committee->get_type()) {

    case Orm_C_Committee::COMMITTEE_COLLEGE_LEVEL:
        $college_id = $committee->get_type_id() ?: $college_id;
        $department_id = 0;
        $program_id = 0;
        break;

    case Orm_C_Committee::COMMITTEE_PROGRAM_LEVEL:
        $college_id = Orm_Program::get_instance($committee->get_type_id())->get_department_obj()->get_college_id() ?: $college_id;
        $department_id = Orm_Program::get_instance($committee->get_type_id())->get_department_id() ?: $department_id;
        $program_id = $committee->get_type_id() ?: $program_id;
        break;

    default :
        $college_id = 0;
        $department_id = 0;
        $program_id = 0;
        break;
}
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/committee_work/save", array('id' => 'committee-form')); ?>
        <div class="modal-header">
            <span class="panel-title">
                <?php echo lang('Committee'); ?>
            </span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <?php if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_INSTITUTION_ADMIN) { ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">
                                <?php echo lang('Level') ?>
                            </label>
                            <div class="col-sm-9">
                                <select id="type" name="type" class="form-control" onchange="change_type(this);">
                                    <?php
                                    foreach (Orm_C_Committee::get_types() as $type => $type_name) {
                                        $selected = ($type == $committee->get_type() ? 'selected="selected"' : '');
                                        ?>
                                        <option value="<?php echo (int)$type ?>" <?php echo $selected ?>>
                                            <?php echo htmlfilter($type_name) ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php echo Validator::get_html_error_message('type'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group" id="college_wrapper">
                        <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
                        <div class="col-sm-9">
                            <select id="college_block" name="college_id" class="form-control"
                                    onchange="get_departments_by_college(this, 0, 1);">
                                <option value=""><?php echo lang('All College') ?></option>
                                <?php
                                foreach (Orm_College::get_all() as $college) {
                                    $selected = ($college->get_id() == $college_id ? 'selected="selected"' : '');
                                    ?>
                                    <option
                                        value="<?php echo (int)$college->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($college->get_name()) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('college_id'); ?>
                        </div>
                    </div>

                    <div class="row form-group" id="department_wrapper">
                        <label class="col-sm-3 control-label"><?php echo lang('Department') ?></label>
                        <div class="col-sm-9">
                            <select id="department_block" name="department_id" class="form-control"
                                    onchange="get_programs_by_department(this, 0, 1);">
                                <option value=""><?php echo lang('All Department') ?></option>
                                <?php
                                if (!empty($college_id)) {
                                    foreach (Orm_Department::get_all(array('college_id' => $college_id)) as $department) {
                                        $selected = ($department->get_id() == $department_id ? 'selected="selected"' : '');
                                        ?>
                                        <option
                                            value="<?php echo (int)$department->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($department->get_name()) ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('department_id'); ?>
                        </div>
                    </div>

                    <div class="row form-group" id="program_wrapper">
                        <label class="col-sm-3 control-label"><?php echo lang('Program') ?></label>
                        <div class="col-sm-9">
                            <select id="program_block" name="program_id" class="form-control">
                                <option value=""><?php echo lang('All Program') ?></option>
                                <?php
                                if (!empty($department_id)) {
                                    foreach (Orm_Program::get_all(array('department_id' => $department_id)) as $program) {
                                        $selected = ($program->get_id() == $program_id ? 'selected="selected"' : '');
                                        ?>
                                        <option
                                            value="<?php echo (int)$program->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($program->get_name()) ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('program_id'); ?>
                        </div>
                    </div>


                <?php } ?>


                <div class="row form-group">
                    <label for="title_en" class="col-sm-3 control-label">
                        <?php echo lang('Committee Name') . ' ( ' . lang('English') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="title_en" id="editTitle_en" class="form-control"
                               placeholder="<?php echo lang('Committee Name') . ' ( ' . lang('English') . ' ) ' ?>"
                               value="<?php echo htmlfilter($committee->get_title_en()); ?>"/>
                        <?php echo Validator::get_html_error_message('title_en'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="col-sm-3 control-label">
                        <?php echo lang('Committee Name') . ' ( ' . lang('Arabic') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="title_ar" id="editTitle_ar" class="form-control"
                               placeholder="<?php echo lang('Committee Name') . ' ( ' . lang('Arabic') . ' ) ' ?>"
                               value="<?php echo htmlfilter($committee->get_title_ar()); ?>"/>
                        <?php echo Validator::get_html_error_message('title_ar'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="description_en"
                           class="col-sm-3 control-label">
                        <?php echo lang('Committee Description') . ' ( ' . lang('English') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <textarea type="text" name="description_en" id="editDesc_en" class="form-control"
                                  placeholder="<?php echo lang('Committee Description') . ' ( ' . lang('English') . ' ) ' ?>"><?php echo xssfilter($committee->get_description_en()); ?></textarea>
                        <?php echo Validator::get_html_error_message('description_en'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="description_ar"
                           class="col-sm-3 control-label">
                        <?php echo lang('Committee Description') . ' ( ' . lang('Arabic') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <textarea type="text" name="description_ar" id="editDesc_ar" class="form-control"
                                  placeholder="<?php echo lang('Committee Description') . ' ( ' . lang('Arabic') . ' ) ' ?>"><?php echo xssfilter($committee->get_description_ar()); ?></textarea>
                        <?php echo Validator::get_html_error_message('description_ar'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Start date') ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="start_date" name="start_date" class="form-control date-range"
                               placeholder="<?php echo lang('Start Date') ?>"
                               value="<?php echo $committee->get_start_date() == '0000-00-00' ? '' : date('Y-m-d', strtotime($committee->get_start_date())) ?>">
                        <?php echo Validator::get_html_error_message('start_date'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('End date') ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="end_date" name="end_date" class="form-control date-range"
                               placeholder="<?php echo lang('End Date') ?>"
                               value="<?php echo $committee->get_end_date() == '0000-00-00' ? '' : date('Y-m-d', strtotime($committee->get_end_date())) ?>">
                        <?php echo Validator::get_html_error_message('end_date'); ?>
                    </div>
                </div>
                <div class="row form-group" id="memeber_group">
                    <label class="col-sm-3 control-label"><?php echo lang('Members') ?>
                    </label>

                    <div id="more_users" class="col-sm-9 more_items well">

                        <?php
                        if (!empty($user_ids)) {
                            foreach ($user_ids as $key => $user_id) {
                                ?>
                                <div class="item m-y-1">
                                    <div class="form-group m-a-0">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <input id="user_label_<?php echo $key ?>" type="text"
                                                       onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>','',['Orm_User_Faculty','Orm_User_Staff'],'<?php echo lang('Find Members'); ?>')"
                                                       readonly class="form-control"
                                                       value="<?php echo($user_id ? htmlfilter(Orm_User::get_instance($user_id)->get_full_name()) : ''); ?>"/>
                                                <input id="user_id_<?php echo $key ?>"
                                                       name="user_ids[<?php echo $key ?>][id]"
                                                       type="hidden" placeholder="<?php echo lang('Select Member'); ?>"
                                                       value="<?php echo $user_id; ?>"/>


                                            </div>
                                            <div class="col-md-2">
                                                <input class="px leader" type="radio" value="<?php echo $key ?>"
                                                       name="leader"
                                                    <?php echo (isset($leader) && $leader == $key) || $committee->get_leader()->get_user_id() == $user_id ? 'checked="checked"' : ''; ?> />
                                                <span class="lbl">
                                                    <?php echo lang('Leader'); ?>
                                                </span>

                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($key) { ?>
                                        <button type="button" class="btn" aria-label="Left Align"
                                                onclick="remove_user(this);" style="margin-top: 5px;">
                                            <span class="fa fa-trash-o" aria-hidden="true"></span>
                                            <?php echo lang('Remove'); ?>
                                        </button>
                                    <?php } ?>
                                    <?php echo Validator::get_html_error_message_no_arrow("user_id[$key][id]"); ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="item m-y-1">
                                <div class="form-group m-a-0">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input id="user_label_0" type="text"
                                                   onclick="find_users(this,'user_id_0','user_label_0','',['Orm_User_Faculty','Orm_User_Staff'],'<?php echo lang('Find Members'); ?>')"
                                                   readonly placeholder="<?php echo lang('Select Member'); ?>"
                                                   class="form-control"/>
                                            <input id="user_id_0" name="user_ids[0][id]" type="hidden"/>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="px leader" type="radio" value="0" name="leader"/>
                                            <span class="lbl">
                                                <?php echo lang('Leader'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                    <div class="more_link">
                        <button id="addMore" type="button" class="btn" aria-label="Left Align" onclick="add_user();">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                            <?php echo lang('Add More'); ?>
                        </button>
                    </div>
                    <div id="leader_error">
                        <?php echo Validator::get_html_error_message_no_arrow("leader"); ?>
                    </div>
                    <?php echo Validator::get_html_error_message_no_arrow('user_ids'); ?>
                </div>
                <input type="hidden" name="id" id="id" value="<?php echo intval($committee->get_id()) ?>"/>

                <?php if (Orm_User::get_logged_user()->get_class_type() != Orm_User::USER_STAFF) { ?>
                    <?php if (Orm_User::get_logged_user()->get_college_id() || Orm_User::get_logged_user()->get_program_id()) { ?>
                        <div class="alert alert-warning m-a-0">
                            <?php echo lang('This user will be assigned to his college or program automatically'); ?>
                        </div>
                    <?php } ?>
                <?php } ?>

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

    function change_type(elm) {

        type = $(elm).val();

        switch (type) {
            case '<?php echo Orm_C_Committee::COMMITTEE_INSTITUTION_LEVEL ?>' :
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                break;
            case '<?php echo Orm_C_Committee::COMMITTEE_COLLEGE_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                break;
            case '<?php echo Orm_C_Committee::COMMITTEE_PROGRAM_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').show();
                $('#program_wrapper').show();
                break;
        }
    }
    change_type($('#type'));

    $('.leader').change(function () {
        if ($(this).has(':checked')) {
            $('.leader').removeAttr('checked');
            $(this).prop('checked', true);
        }
    });


    $('#committee-form').on('submit', function (e) {
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

    $(".date-range").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: '<?php echo date('Y-m-d'); ?>'
    });

    function add_user() {
        var count = $('#more_users .item').length;
        $('#more_users').append('<div class="item m-y-1">' +
            '<div class="form-group m-a-0">' +
            '<div class="row">' +
            '<div class="col-md-10">' +
            '<input id="user_label_' + count + '" type="text" placeholder="<?php echo lang('Select Member');?>" onclick="find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', \'\', [\'Orm_User_Faculty\',\'Orm_User_Staff\'],\'<?php echo lang('Find Members')?>\');" readonly class="form-control"/>' +
            '<input id="user_id_' + count + '" name="user_ids[' + count + '][id]" type="hidden"/>' +
            '</div>' +
            '<div class="col-md-2">' +
            '<input class="px leader" type="radio" value="' + count + '" name="leader">' +
            '<span class="lbl"> <?php echo lang('Leader') ?></span>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="remove_user(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove') ?>' +
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
                $(this).attr('name', String($(this).attr('name')).replace(/\[\d+]/g, '[' + index + ']'));
            });
        });
    }
    $(document).on('change', '.leader', function () {
        $("#memeber_group").removeClass('form-message-light has-error');
        $("#leader_error").remove();
    });
</script>