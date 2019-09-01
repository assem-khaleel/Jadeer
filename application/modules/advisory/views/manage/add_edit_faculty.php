<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 10/24/17
 * Time: 3:36 PM
 */
/** @var $faculty_program Orm_Ad_Faculty_Program */
$college_id = intval($this->input->post('college_id'));
$department_id = intval($this->input->post('department_id'));
$program_id = intval($this->input->post('program_id'));
$user_login=Orm_User::get_logged_user();
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <?php echo form_open("/advisory/save_faculty", array('id' => 'faculty-form')); ?>
        <div class="modal-header">
            <span class="panel-title">
                <?php echo lang('Select Faculty'); ?>
            </span>
        </div>
        <div class="modal-body">
            <?php if($user_login->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){ ?>
                <div class="form-group" id="college_wrapper">
                    <div class="row">
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
                </div>

                <div class="form-group" id="department_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Department') ?></label>
                        <div class="col-sm-9">
                            <select id="department_block" name="department_id" class="form-control"
                                    onchange="get_programs_by_department(this,0, 1);">
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
                </div>

                <div class="form-group" id="program_wrapper">
                    <div class="row">
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
                </div>
            <?php } elseif($user_login->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){ ?>
                <div class="form-group" id="college_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
                        <div class="col-sm-9">
                            <select id="college_block" name="college_id" class="form-control"
                                    onchange="get_departments_by_college(this, 0, 1);">
                                <option value="<?php echo (int)$user_login->get_college_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                            </select>
                            <?php echo Validator::get_html_error_message('college_id'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="department_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Department') ?></label>
                        <div class="col-sm-9">
                            <select id="department_block" name="department_id" class="form-control"
                                    onchange="get_programs_by_department(this,0, 1);">
                                <option value=""><?php echo lang('All Department') ?></option>
                                <?php
                                if (!empty($user_login->get_college_id())) {
                                    foreach (Orm_Department::get_all(array('college_id' => $user_login->get_college_id())) as $department) {
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
                </div>

                <div class="form-group" id="program_wrapper">
                    <div class="row">
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
                </div>

            <?php }else{ ?>
                <div class="form-group" id="college_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
                        <div class="col-sm-9">
                            <select id="college_block" name="college_id" class="form-control">
                                <option value="<?php echo (int)$user_login->get_college_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                            </select>
                            <?php echo Validator::get_html_error_message('college_id'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="department_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Department') ?></label>
                        <div class="col-sm-9">
                            <select id="department_block" name="department_id" class="form-control">
                                <?php
                                if (!empty($user_login->get_college_id())) {
                                    ?>
                                    <option value="<?php echo (int)$user_login->get_department_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_department_obj()->get_name()) ?></option>

                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('department_id'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="program_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Program') ?></label>
                        <div class="col-sm-9">
                            <select id="program_block" name="program_id" class="form-control">
                                <?php
                                if (!empty($user_login->get_department_id())) {
                                    ?>
                                    <option value="<?php echo (int)$user_login->get_program_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_program_obj()->get_name()) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('program_id'); ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <div class="form-group">
                <!--                --><?php //echo filter_block('/award_management/users', '', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class, 'keyword'], 'ajax_block_user'); ?>
                <label class="control-label"><?php echo lang('Select Faculty Members') ?></label>


                <div id="more_users" class="more_items well">
                    <?php
                    if (!empty($user_ids)) {
                        foreach ($user_ids as $key => $user_id) {
                            ?>
                            <div class="item m-y-1">
                                <div class="form-group m-a-0">
                                    <input id="user_label_<?php echo $key ?>" type="text"
                                           onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>','',['Orm_User_Faculty'],'<?php echo lang('Find Candidate'); ?>')"
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
                                       onclick="find_users(this,'user_id_0','user_label_0','',['Orm_User_Faculty'],'<?php echo lang('Find Candidate'); ?>')"
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
    $('#faculty-form').on('submit', function (e) {
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
            '<input id="user_label_' + count + '" type="text" onclick="find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', \'\',[\'Orm_User_Faculty\',\'Orm_User_Staff\'],\'<?php echo lang('Find Managers'); ?>\')" readonly class="form-control"/>' +
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

